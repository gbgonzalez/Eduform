<?php

// src/Controller/ContentsController.php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Validation\Validation;
use Cake\ORM\TableRegistry;

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
        $this->Auth->allow(['add', 'logout']);
    }

    public function index()
    {
    	$this->viewBuilder()->layout('admin');

    	$contents = $this->set('contents', $this->Contents
    				->find('all', ['contain' => ['Competences']]));

    	$competencesForm = TableRegistry::get('Competences')->find('list',array('fields' => ['Competences.id','Competences.name']));


    	$this->set('competencesForm', $competencesForm);

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
                $this->Flash->error('Problema');
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
            $this->Flash->error(__('El contenido no ha podido ser borrado'));
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
            $this->Flash->success(__('El contenido ha sido modificado.'));
            return $this->redirect(['controller' => 'contents', 'action' => 'index']);
        }else{
            $this->Flash->error(__('Erorr al modificar'));
            return $this->redirect(['controller' => 'contents', 'action' => 'index']);
        }
            
    }// end of function update


}