<?php

// src/Controller/CompetencesController.php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Validation\Validation;
use Cake\ORM\TableRegistry;


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
        $this->Auth->allow(['add', 'logout']);
    }

    public function index()
    {
        $this->viewBuilder()->layout('admin');
        $competences = $this->set('competences', $this->Competences->find('all'));
        $subjects = TableRegistry::get('Subjects')->find();
        
        $subjectsForms = TableRegistry::get('Subjects')->find('list',array('fields' => ['Subjects.id','Subjects.name']));

        $this->set('subjects', $subjects);
        $this->Set('subjectsForms', $subjectsForms);



        
    }
    public function add()
    {
        $competences = $this->Competences->newEntity();
        //debug($this->Competences);
        if ($this->request->is('post')) {
            // Prior to 3.4.0 $this->request->data() was used.
            
            $dataForm = $this->request->getData();

            
            $formatData = [
             "name" => $dataForm["name"], 
             "description" =>  $dataForm["description"],
             "subject_id" =>  $dataForm["subject_id"]
             ];


            $competences = $this->Competences->patchEntity($competences,  $formatData);
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

        $formatData = [
         "name" => $this->request->data["name"], 
         "description" =>  $this->request->data["description"],
         "subject_id" =>  $this->request->data["subject_id"]
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

}