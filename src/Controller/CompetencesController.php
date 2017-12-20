<?php

// src/Controller/CompetencesController.php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Validation\Validation;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

class CompetencesController extends AppController {

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        /**/
        $this->set('current_user', $this->Auth->user());
        /**/
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow('logout');
    }

    public function index()
    {

        if($this->Auth->user()['role'] == "Administrador"){

            $this->viewBuilder()->layout('admin');

            $subjects = TableRegistry::get('Subjects')->find();
        
            $subjectsForms = TableRegistry::get('Subjects')->find('list',array('fields' => ['Subjects.id','Subjects.name']));

            $categories = TableRegistry::get('Categories')->find();
            
            $categoriesForms = TableRegistry::get('Categories')->find('list',array('fields' => ['Categories.id','Categories.name']));

           // $Competencias = TableRegistry::get('Competences'); 
            
            $categoriesCompetences = TableRegistry::get('Categoriescompetences')->find();       


            $competences = TableRegistry::get('Competences')->find('all', ['contain' => ['Categories', 'Subjects']]);
     
            $this->set('competences', $competences);
     
            $this->Set('subjectsForms', $subjectsForms);

            $this->Set('categoriesForms', $categoriesForms);

            $this->Set('categoriesCompetences', $categoriesCompetences);

        }
        if($this->Auth->user()['role'] == "Alumno"){

            $this->viewBuilder()->layout('alumno');

            $subjects = TableRegistry::get('Subjects')->find();
        
            $subjectsForms = TableRegistry::get('Subjects')->find('list',array('fields' => ['Subjects.id','Subjects.name']));

            $categories = TableRegistry::get('Categories')->find();
            
            $categoriesForms = TableRegistry::get('Categories')->find('list',array('fields' => ['Categories.id','Categories.name']));

            
           /* $UserCompetences = TableRegistry::get('Userscompetences')->find('all',['contain' => ['Competences']],array('fields' => ['UsersCompetences.competence_id']))->where( [ 'user_id' => $this->Auth->user()['id'] ] );
            */

            $categoriesCompetences = TableRegistry::get('Categoriescompetences')->find();       

            $competences = TableRegistry::get('Competences')->find('all', ['contain' => ['Categories', 'Subjects']]);
     
            $this->set('competences', $competences);
     
            $this->Set('subjectsForms', $subjectsForms);

            $this->Set('categoriesForms', $categoriesForms);

            $this->Set('categoriesCompetences', $categoriesCompetences);

        }
    
    }

    public function view($id){

        $this->viewBuilder()->layout('admin');

        $competence = $this->Competences->get($id);


    
        
        $contentTable = TableRegistry::get('Contents');

        $fileTable = TableRegistry::get('Files');

        $contents = $contentTable->find('all')->where( [ 'competence_id' => $id ] );


        $files = $fileTable->find('all');






       

        $this->Set('competence', $competence);

        $this->Set('contents', $contents);


        $this->Set('files', $files);


        

    

    }


    public function add()
    {
       
        //debug($this->Competences);
        if ($this->request->is('post')) {
            // Prior to 3.4.0 $this->request->data() was used.
            
            $dataForm = $this->request->getData();
            
            for ( $i = 0; $i < count($dataForm["category_id"]); $i++ )
            {

                $array[$i] = $dataForm["category_id"][$i];
            }
            
            $formatData = [
             "name" => $dataForm["name"], 
             "description" =>  $dataForm["description"],
             "subject_id" =>  $dataForm["subject_id"],
             "categories" => [ '_ids' => $array ]
            
             ];

         

            $competences = $this->Competences->newEntity();
            $competences = $this->Competences->patchEntity($competences, $formatData, ['associated' => ['Categories']]);

            if ( $this->Competences->save($competences))
            {
            
                $this->Flash->success('La competencia ha sido creado correctamente');
               
                return $this->redirect(['controller' => 'competences', 'action' => 'index']);
            }else{
                $this->Flash->error('Problema');
            }

        }// end of if post 

    }// end of add 

     public function delete(){

        
        $this->request->allowMethod(['post', 'delete']);

        $competence = $this->Competences->get($this->request->data['id']);

        if ($this->Competences->delete($competence)) {
            $this->Flash->success(__('La competencia ha sido eliminada correctamentes'));
           return $this->redirect(['controller' => 'competences', 'action' => 'index']);
        }else{
            $this->Flash->error(__('La competencia no ha podido ser borrada'));
            return $this->redirect(['controller' => 'competences', 'action' => 'index']);
        }
        

    }// end of function delete

    public function update(){

        
        $competence = $this->Competences->get($this->request->data['id']);

        $dataForm = $this->request->getData();
        $array = array();
        for ( $i = 0; $i < count($dataForm["category_id"]); $i++ )
        {
            $array[$i] = $dataForm["category_id"][$i];
        }

        $formatData = [
         "name" => $this->request->data["name"], 
         "description" =>  $this->request->data["description"],
         "subject_id" =>  $this->request->data["subject_id"],
         "categories" => [ '_ids' => $array ]
         ];
   
        // Prior to 3.4.0 $this->request->data() was used.
        $this->Competences->patchEntity($competence, $formatData);
        if ($this->Competences->save($competence)) {
            $this->Flash->success(__('La competencia ha sido modificada.'));
            return $this->redirect(['controller' => 'competences', 'action' => 'index']);
        }else{
            $this->Flash->error(__('Erorr al modificar'));
            return $this->redirect(['controller' => 'competences', 'action' => 'index']);
        }
            
    } // end of function update 

    public function isAuthorized($user)
    {

        // Admin can access every action
        if (($user['role'] === 'Administrador' || $user['role'] === 'Alumno' || $user['role'] === 'Gestor de Contenidos')) {
            return true;
        }
        
        return false;
    }

}