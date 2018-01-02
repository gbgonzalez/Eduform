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

        $this->viewBuilder()->layout('admin');
        $user = $this->Auth->user();

        $subjects = TableRegistry::get('Subjects')->find();
    
        $subjectsForms = TableRegistry::get('Subjects')->find('list',array('fields' => ['Subjects.id','Subjects.name']));

        $categories = TableRegistry::get('Categories')->find();
        
        $categoriesForms = TableRegistry::get('Categories')->find('list',array('fields' => ['Categories.id','Categories.name']));
        
        $categoriesCompetences = TableRegistry::get('Categoriescompetences')->find();       

        if ( $user['role'] == 'Administrador' )
        {
            $competences = TableRegistry::get('Competences')->find('all', ['contain' => ['Categories', 'Subjects']]);
        }else{
     

            $connection = ConnectionManager::get('default');
            $queryCompetences = $connection->execute("
                SELECT C.id, C.name, C.description, S.name as subjectName,C.subject_id
                FROM competences AS C
                INNER JOIN userscompetences AS UC ON C.id = UC.competence_id
                INNER JOIN subjects AS S ON S.id = C.subject_id
                WHERE UC.user_id = " .$user['id']. "
                ");
            $queryCategories = $connection->execute("
                SELECT CAC.competence_id, CA.name, CA.description, CA.id
                FROM categories AS CA
                INNER JOIN categoriescompetences AS CAC ON CAC.category_id = CA.id
                ");
            
            $competences = array();
            $i = 0;
            foreach ( $queryCompetences as $competence )
            {
                $competences[$i] = array(
                    'id' => $competence['id'],
                    'name' => $competence['description'],
                    'description' => $competence['id'],
                    'subjectName' => $competence['subjectName'],
                    'subject_id' => $competence['subject_id'],
                    'categories' => array(),
                    );  
                $j=0;

                foreach ( $queryCategories as $category )
                {
                     
                    if ( $competence['id'] == $category['competence_id'])
                    {
                        $competences[$i]['categories'][$j]= array(
                                                'id' => $category['id'],
                                                'name' => $category['name'],
                                                'description' => $category['description'] 
                                                );


                         $j++;
                    }
                }
                
                $i++;
            }
        }
 
        $this->set('competences', $competences);
 
        $this->Set('subjectsForms', $subjectsForms);

        $this->Set('categoriesForms', $categoriesForms);

        $this->Set('categoriesCompetences', $categoriesCompetences);
    
    }

    public function view($id){

        $this->viewBuilder()->layout('admin');

        $competence = $this->Competences->get($id);

        $competencesContentFile = ['name' => $competence['name']];

        $connection = ConnectionManager::get('default');
        $contents = $connection->execute("
            SELECT * FROM Contents
            WHERE competence_id= " .$id. "");

      
        $fileTable = TableRegistry::get('Files');
        $files = $fileTable->find('all');
        $i=0;

        foreach ( $contents as $content )
        {
            $competencesContentFile['contents'][$i]['name'] = $content['name'];
            $competencesContentFile['contents'][$i]['id'] = $content['id'];
            $competencesContentFile['contents'][$i]['description'] = $content['description'];      
            $j=0;      
            foreach ( $files as $file )
            {
                if ($file['content_id'] == $content['id'] ){
                    $competencesContentFile['contents'][$i]['files'][$j]['name'] = $file['name'];
                }
                $j++;

            }

            $i++;
        }


        $this->Set('competencesContentFile', $competencesContentFile);


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