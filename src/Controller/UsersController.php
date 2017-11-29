<?php

// src/Controller/UsersController.php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Validation\Validation;

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
        $users = $this->set('users', $this->Users->find('all'));
     
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
            
        

        //$this->set('user', $article);
    }




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
            /*
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

*/
            $user = $this->Auth->identify();

            if ($user) {
                $this->Auth->setUser($user);
                /**/
                $this->set('current_user', $this->Auth->user());
                /**/
                return $this->redirect($this->Auth->redirectUrl());
            }

            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }


}