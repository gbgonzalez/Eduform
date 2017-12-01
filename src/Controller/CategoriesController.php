<?php

// src/Controller/CategoriesController.php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Validation\Validation;


class CategoriesController extends AppController {

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
        $categories = $this->set('categories', $this->Categories->find('all'));
        $subjects = $this->set('subjects', $this->Categories->Subjects->find('list', array('fields' => ['Subjects.id','Subjects.name'])));
        $subjectsb = $this->set('subjectsb', $this->Categories->Subjects->find('all'));
    }

    public function delete(){

        
        $this->request->allowMethod(['post', 'delete']);

        $categorie = $this->Categories->get($this->request->data['id']);

        if ($this->Categories->delete($categorie)) {
            $this->Flash->success(__('La categoria ha sido eliminado correctamentes'));
           return $this->redirect(['controller' => 'categories', 'action' => 'index']);
        }else{
            $this->Flash->error(__('La categoria no ha podido ser borrado'));
            return $this->redirect(['controller' => 'categories', 'action' => 'index']);
        }
        

    }// end of function delete

    public function add()
    {
        $categories = $this->Categories->newEntity();
        
        
        if ($this->request->is('post')) {
            // Prior to 3.4.0 $this->request->data() was used.
            
            $dataForm = $this->request->getData();
            $formatData = [
             "name" => $dataForm["name"], 
             "description" =>  $dataForm["description"],
             "subject_id" =>   $dataForm["subject_id"],
             ];
             
           
            $categories = $this->Categories->patchEntity($categories,  $formatData);

            if ( $this->Categories->save($categories))
            {

                $this->Flash->success('La categoria ha sido creado correctamente');
                return $this->redirect(['controller' => 'categories', 'action' => 'index']);
            }else{
                $this->Flash->error('Problema');
            }

        }// end of if post 

    }// end of add 

    public function update(){

        
        $categories = $this->Categories->get($this->request->data['id']);

        $formatData = [
         "name" => $this->request->data["name"], 
         "description" =>  $this->request->data["description"],
         "subject_id" => $this->request->data["subject_id"]
         ];
   
        // Prior to 3.4.0 $this->request->data() was used.
        $this->Categories->patchEntity($categories, $formatData);
        if ($this->Categories->save($categories)) {
            $this->Flash->success(__('La categoria ha sido modificada ha sido modificado.'));
            return $this->redirect(['controller' => 'categories', 'action' => 'index']);
        }else{
            $this->Flash->error(__('Erorr al modificar'));
            return $this->redirect(['controller' => 'categories', 'action' => 'index']);
        }
            
        

        //$this->set('user', $article);
    }

}