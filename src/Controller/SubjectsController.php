<?php

// src/Controller/SubjectsController.php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Validation\Validation;

class SubjectsController extends AppController {

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
        $this->viewBuilder()->layout('admin');
        $subjects = $this->set('subjects', $this->Subjects->find('all'));
    }

    public function delete(){

        
        $this->request->allowMethod(['post', 'delete']);

        $matter = $this->Subjects->get($this->request->data['id']);

        if ($this->Subjects->delete($matter)) {
            $this->Flash->success(__('La materia ha sido eliminado correctamentes'));
           return $this->redirect(['controller' => 'subjects', 'action' => 'index']);
        }else{
            $this->Flash->error(__('La materia no ha podido ser borrado'));
            return $this->redirect(['controller' => 'subjects', 'action' => 'index']);
        }
        

    }// end of function delete

    public function add()
    {
        $subjects = $this->Subjects->newEntity();
        
        
        if ($this->request->is('post')) {
            // Prior to 3.4.0 $this->request->data() was used.
            
            $dataForm = $this->request->getData();
            $formatData = [
             "name" => $dataForm["name"], 
             "description" =>  $dataForm["description"]
             ];
           
            $subjects = $this->Subjects->patchEntity($subjects,  $formatData);
            if ( $this->Subjects->save($subjects))
            {
                $this->Flash->success('La materia ha sido creado correctamente');
                return $this->redirect(['controller' => 'subjects', 'action' => 'index']);
            }else{
                $this->Flash->error('Problema');
            }

        }// end of if post 

    }// end of add 

    public function update(){

        
        $subjects = $this->Subjects->get($this->request->data['id']);

        $formatData = [
         "name" => $this->request->data["name"], 
         "description" =>  $this->request->data["description"]
         ];
   
        // Prior to 3.4.0 $this->request->data() was used.
        $this->Subjects->patchEntity($subjects, $formatData);
        if ($this->Subjects->save($subjects)) {
            $this->Flash->success(__('La materia ha sido modificada ha sido modificado.'));
            return $this->redirect(['controller' => 'subjects', 'action' => 'index']);
        }else{
            $this->Flash->error(__('Erorr al modificar'));
            return $this->redirect(['controller' => 'subjects', 'action' => 'index']);
        }
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