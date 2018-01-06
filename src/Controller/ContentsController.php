<?php

// src/Controller/ContentsController.php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Validation\Validation;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Filesystem\Folder;

class ContentsController extends AppController {

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        /**/
        $this->set('current_user', $this->Auth->user());
        /**/
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['logout']);
    }

    public function initialize()  {
          parent::initialize();
          $this->loadComponent('Upload');    ## Load upload component for uploading images
    }

    public function index()
    {

    	$this->viewBuilder()->layout('admin');

        

    	$contents = $this->set('contents', $this->Contents
    				->find('all', ['contain' => ['Competences']]));

    	$competencesForm = TableRegistry::get('Competences')->find('list',array('fields' => ['Competences.id','Competences.name']));

    	$files = TableRegistry::get('Files')->find('all');


    	$this->set('competencesForm', $competencesForm);
    	$this->set('files', $files);

    }

    public function add(){
    	$content = $this->Contents->newEntity();       
        
        if ($this->request->is('post')) {
            // Prior to 3.4.0 $this->request->data() was used.
            
            $dataForm = $this->request->getData();
            $formatData = [
             "name" => $dataForm["name"], 
             "description" => $dataForm["description"],
             "competence_id" =>  $dataForm["competence_id"]
             ];
           
            $content = $this->Contents->patchEntity($content,  $formatData);

            if ( $this->Contents->save($content))
            {
                $this->Flash->success('El contenido ha sido creado correctamente');
                return $this->redirect(['controller' => 'contents', 'action' => 'index']);
            }else{
                $this->Flash->error('Problema al crear el contenido');
                return $this->redirect(['controller' => 'contents', 'action' => 'index']);
            }

        }// end of if post 
    } // end of function add

    public function delete(){

        
        $this->request->allowMethod(['post', 'delete']);

        $content = $this->Contents->get($this->request->data['id']);

        if ($this->Contents->delete($content)) {
            $this->Flash->success(__('El contenido ha sido eliminado correctamentes'));
           return $this->redirect(['controller' => 'contents', 'action' => 'index']);
        }else{
            $this->Flash->error(__('Problema al borrar el contenido'));
            return $this->redirect(['controller' => 'contents', 'action' => 'index']);
        }
        

    }// end of function delete


    public function update(){

        
        $content = $this->Contents->get($this->request->data['id']);

        $formatData = [
         "name" =>  $this->request->data["name"],
         "description" =>  $this->request->data["description"],
         "competence_id" => $this->request->data["competence_id"]
         ];
   
        // Prior to 3.4.0 $this->request->data() was used.
        $this->Contents->patchEntity($content, $formatData);

        if ($this->Contents->save($content)) {
            $this->Flash->success(__('El contenido ha sido modificado'));
            return $this->redirect(['controller' => 'contents', 'action' => 'index']);
        }else{
            $this->Flash->error(__('Problema al modificar el contenido'));
            return $this->redirect(['controller' => 'contents', 'action' => 'index']);
        }
            
    }// end of function update


    public function uploadFile(){
        
        $filesTable = TableRegistry::get('Files');
        $file = $filesTable->newEntity();
        $fileUpload = $this->request->data;

        if(!empty( $fileUpload['contents']['files']['name']) )
        {
            $this->Upload->upload($fileUpload['contents']['files']); 
            if($this->Upload->uploaded) {

                $name= $fileUpload['contents']['files']['name'];
                $this->Upload->file_new_name_body = $name;

                $process = WWW_ROOT .'uploads'. DS . $fileUpload['id'];


                $folder = new Folder($process, true, 0755);
                
                $process = $process. DS.  $name;
                move_uploaded_file($fileUpload['contents']['files']['tmp_name'], $process);

                $this->Upload->process($process);
                
                $file->name = $name;
                $file->content_id = $fileUpload['id'];


                $filesTable->save($file);


                $this->Flash->success(__('El archivos se ha subido correctamente'));
               return $this->redirect(['controller' => 'contents', 'action' => 'index']);
                    
                    
            }
            } else {
                unset($this->request->data['user_detail']["profile_image"]); 
                $this->Flash->error(__('Problema con la subida del archivo'));
                return $this->redirect(['controller' => 'contents', 'action' => 'index']);
            }

        }

    public function deleteFile(){
        if ($this->request->is('post')) {
            // Prior to 3.4.0 $this->request->data() was used.
            
            $dataForm = $this->request->getData();

            $filesTable = TableRegistry::get('Files');
            $entity = $filesTable->get( $dataForm['id'] );
            
            $deleteResult =  $filesTable->delete($entity);

            if($deleteResult)
            {
                
                $this->Flash->success(__('Se ha borrado el archivo de este contenido'));
                return $this->redirect(['controller' => 'contents', 'action' => 'index']);
            
            }else{
                
                $this->Flash->error(__('Erorr al borrar el archivo'));
                return $this->redirect(['controller' => 'contents', 'action' => 'index']);
            }



        }// end of if post
    }

    public function download($content_id, $name){

        $filePath = WWW_ROOT .'uploads'. DS . $content_id. DS. $name;
        
        $this->response->file($filePath , array('download'=> true, 'name'=> $name));
        return $this->response;
        
    }
        

    public function isAuthorized($user)
    {

        // Admin can access every action
        if (($user['role'] === 'Administrador' || $user['role'] === 'Gestor de Contenidos')) {
            return true;
        }
        
        $this->Flash->error(__('No esta autorizado a acceder a este panel'));
        return false;
    }


}
