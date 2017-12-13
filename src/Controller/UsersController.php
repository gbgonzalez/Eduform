<?php

// src/Controller/UsersController.php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Validation\Validation;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;


class UsersController extends AppController {

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
        $users = $this->set('users', $this->Users->find('all', ['contain' => ['Competences']]));

        $competences = TableRegistry::get('Competences')->find('all', ['contain' => ['Users', 'Subjects']]);

        $subjectsForm = TableRegistry::get('Subjects')->find('list',array('fields' => ['Subjects.id','Subjects.name']));

        $this->set('competences', $competences);

        $this->set('subjectsForm', $subjectsForm);
     
    }

    public function add()
    {
        $user = $this->Users->newEntity();       
        
        if ($this->request->is('post')) {
            // Prior to 3.4.0 $this->request->data() was used.
            
            $dataForm = $this->request->getData();
            $formatData = [
             "dni" => $dataForm["DNI"], 
             "username" =>  $dataForm["Usuario"],
             "email" => $dataForm["email"],
             "password" =>  $dataForm["password"],
             "address" => $dataForm["address"],
             "role" => $dataForm["role"],
             ];
           
            $user = $this->Users->patchEntity($user,  $formatData);
            if ( $this->Users->save($user))
            {
                $this->Flash->success('El usuario ha sido creado correctamente');
                return $this->redirect(['controller' => 'users', 'action' => 'index']);
            }else{
                $this->Flash->error('Problema');
            }

        }// end of if post 

    }// end of add 

    public function delete(){

        
        $this->request->allowMethod(['post', 'delete']);

        $user = $this->Users->get($this->request->data['id']);

        if ($this->Users->delete($user)) {
            $this->Flash->success(__('El usuario ha sido eliminado correctamentes'));
           return $this->redirect(['controller' => 'users', 'action' => 'index']);
        }else{
            $this->Flash->error(__('El usuario no ha podido ser borrado'));
            return $this->redirect(['controller' => 'users', 'action' => 'index']);
        }
        

    }// end of function delete

    public function update(){

        
        $user = $this->Users->get($this->request->data['id']);

        $formatData = [
         "dni" => $this->request->data["DNI"], 
         "username" =>  $this->request->data["Usuario"],
         "password" =>  $this->request->data["password"],
         "address" => $this->request->data["address"],
         "role" => $this->request->data["role"],
         ];
   
        // Prior to 3.4.0 $this->request->data() was used.
        $this->Users->patchEntity($user, $formatData);
        if ($this->Users->save($user)) {
            $this->Flash->success(__('El usuario ha sido modificado.'));
            return $this->redirect(['controller' => 'users', 'action' => 'index']);
        }else{
            $this->Flash->error(__('Erorr al modificar'));
            return $this->redirect(['controller' => 'users', 'action' => 'index']);
        }
            
    }


    // add subject
    public function addSubject(){

        //$user = $this->Users->newEntity();    

        
        if ($this->request->is('post')) {
            // Prior to 3.4.0 $this->request->data() was used.
            
            $dataForm = $this->request->getData();

            $connection = ConnectionManager::get('default');
            $results = $connection->execute("SELECT id FROM competences 
            WHERE subject_id = " .$dataForm['subject_id']. "");
            $j = 0;
            $formatDatas = array();
            foreach ($results as $result)
            {
                $formatDatas[$j] = [
                    'user_id' => $dataForm['id'],
                    'competence_id' => $result['id'],

                ];
                $j++;
            }

            $usersCompetencesTable = TableRegistry::get('Userscompetences');

            for ( $k = 0; $k< count($formatDatas); $k++ ) {
                $usersCompetences = $usersCompetencesTable->newEntity();
                $usersCompetences->user_id = $formatDatas[$k]['user_id'];
                $usersCompetences->competence_id = $formatDatas[$k]['competence_id'];
                $usersCompetencesTable->save($usersCompetences);
            }

            $this->Flash->success(__('El la materia se ha asignado correctamente.'));
            return $this->redirect(['controller' => 'users', 'action' => 'index']); 

        }// end of if post 


    }// end of function addSubject

    public function deleteSubject(){
        if ($this->request->is('post')) {
            // Prior to 3.4.0 $this->request->data() was used.
            
            $dataForm = $this->request->getData();

            $connection = ConnectionManager::get('default');
            $results = $connection->execute("SELECT id FROM competences 
            WHERE subject_id = " .$dataForm['subject_id']. "");

            $j = 0;
            $formatDatas = array();
            foreach ($results as $result)
            {
                $deleteArray[$j] = [
                    'user_id' => $dataForm['user_id'],
                    'competence_id' => $result['id']
                ];
                $j++;
            }

            $k = 0;
            for ( $i=0; $i < count($deleteArray); $i++ )
            {
                $resultsIdCompetences[$k] = $connection->execute("SELECT id FROM userscompetences 
                WHERE competence_id = " .$deleteArray[$i]['competence_id']. "
                AND user_id = " .$deleteArray[$i]['user_id']. "");   
                $k++;
            }
            $usersCompetencesTable = TableRegistry::get('Userscompetences');
            for ($l = 0; $l< count($resultsIdCompetences); $l++)
            {
                foreach($resultsIdCompetences[$l] as $competencesID)
                {
                    $entity = $usersCompetencesTable->get( $competencesID['id'] );
                    $deleteResult =  $usersCompetencesTable->delete($entity);
                }
            }
            
            if($deleteResult)
            {
                
                $this->Flash->success(__('El usuario ya no pertenece a esa materia.'));
                return $this->redirect(['controller' => 'users', 'action' => 'index']);
            
            }else{
                
                $this->Flash->error(__('Erorr al eliminar la materia'));
                return $this->redirect(['controller' => 'users', 'action' => 'index']);
            }


       

        }//end of if post

    }//end of function delete subject


    public function login()
    {
        if ($this->request->is('post')) {

//DNI
            if (Validation::numeric($this->request->data['username'])) {
                $this->Auth->config('authenticate', [
                    'Form' => [
                        'fields' => ['username' => 'dni']
                    ]
                ]);
                $this->Auth->constructAuthenticate();
                $this->request->data['dni'] = $this->request->data['username'];
                unset($this->request->data['username']);
            }

//EMAIL
         
            if (Validation::email($this->request->data['username'])) {
                $this->Auth->config('authenticate', [
                    'Form' => [
                        'fields' => ['username' => 'email']
                    ]
                ]);
                $this->Auth->constructAuthenticate();
                $this->request->data['email'] = $this->request->data['username'];
                unset($this->request->data['username']);
                $this->set('current_user', $this->Auth->user());
            }


            $user = $this->Auth->identify();

            if ($user) {
                $this->Auth->setUser($user);
                /**/
                $this->set('current_user', $this->Auth->user());
                /**/
                
                return $this->redirect('/eduform/home');
                /*return $this->redirect($this->Auth->redirectUrl());*/
            }

            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
    
    public function isAuthorized($user)
    {
        // Admin can access every action
        if (($user['role'] === 'Administrador')) {
            return true;
        }

        return false;
    }


}
