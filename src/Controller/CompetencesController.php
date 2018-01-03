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

        $connection = ConnectionManager::get('default');
        $userscompetences= $connection->execute("
            SELECT * FROM UsersCompetences
            WHERE competence_id= " .$id. " AND user_id= " .$this->Auth->user()['id']. "");
        
      
        $fileTable = TableRegistry::get('Files');
        $files = $fileTable->find('all');
        

        foreach ($userscompetences as $userscompetence) {
            $competencesContentFile['userscompetences']['competence'] = $userscompetence;
        }
        
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
        //$this->Set('notacontents', $notacontents);


    }

    public function evaluation(){
        $this->viewBuilder()->layout('admin');

        $user = $this->Auth->user();


        if ($user['role'] == 'Administrador' )
        {
            $connection = ConnectionManager::get('default');
            $queryEvaluation = $connection->execute("
                SELECT UC.id, C.name, U.username, U.email, UC.booleannote, UC.numericnote
                FROM competences AS C
                INNER JOIN userscompetences AS UC ON C.id = UC.competence_id
                INNER JOIN users AS U ON U.id = UC.user_id
                ");
            $i = 0;
            foreach ( $queryEvaluation as $evaluation )
            {
                $evaluations[$i] = $evaluation;
                $i++;
            }
            $this->set('evaluations', $evaluations);
        }

        if ( $user['role'] == 'Gestor de contenidos' )
        {
            $connection = ConnectionManager::get('default');
            $queryCompetences = $connection->execute("
                SELECT C.id
                FROM competences AS C
                INNER JOIN userscompetences AS UC ON C.id = UC.competence_id
                WHERE UC.user_id = " .$user['id']. "
                ");
            $queryEvaluation = array();
            $i = 0;
            foreach ( $queryCompetences as $queryCompetence)
            {
                $queryEvaluations[$i]= $connection->execute("
                SELECT UC.id, C.name, U.username, U.email, UC.booleannote, UC.numericnote
                FROM competences AS C
                INNER JOIN userscompetences AS UC ON C.id = UC.competence_id
                INNER JOIN users AS U ON U.id = UC.user_id
                WHERE C.id  = " . $queryCompetence['id']."
                ");
                $i++;
            }
            $evaluations = array();
            $k=0;
            for ( $j = 0; $j < count($queryEvaluations); $j++)
            {
                foreach ($queryEvaluations[$j] as $queryEvaluation) {

                    $evaluations[$k] = $queryEvaluation;
                    $k++;
                    
                }
            }
            $this->set('evaluations', $evaluations);
            

        }


    }

    public function addEvaluation(){
        if ($this->request->is('post')) {
            $dataForm = $this->request->getData();


            $booleanNote = $dataForm['dualNote'];
            $numericNote = $dataForm['numericNote'];

            if ($numericNote == '' && $booleanNote == 'c')
            {
                $this->Flash->error('Por favor introduce algún sistema de calificación');
                return $this->redirect(['controller' => 'competences', 'action' => 'evaluation']);
            }

            if ($numericNote != '' && $booleanNote != 'c')
            {
                $this->Flash->error('Por favor introduce un único sistema de calificación');
                return $this->redirect(['controller' => 'competences', 'action' => 'evaluation']);
            }

            $usersCompetencesTable = TableRegistry::get('Userscompetences');    

            $userCompetence = $usersCompetencesTable->get($dataForm['id']);
            if ( $numericNote != 0)
            {
                $userCompetence->numericnote = $numericNote;
                $userCompetence->booleannote = '';
            }else{ 
                $userCompetence->numericnote = '';
                if ( $booleanNote == 'a')
                {
                    $userCompetence->booleannote = 'Aprobado';
                }else{
                    $userCompetence->booleannote = 'Suspenso';
                }
                
            }

            if( $usersCompetencesTable->save($userCompetence) ){
                $this->Flash->success('Calificado correctamente');
                return $this->redirect(['controller' => 'competences', 'action' => 'evaluation']); 
            }else{
                $this->Flash->error('Ha habido un error al subir la calificación');
                return $this->redirect(['controller' => 'competences', 'action' => 'evaluation']);
            }

        }

    }

    public function deleteEvaluation(){
        if ($this->request->is('post')) {
            $dataForm = $this->request->getData();

            $usersCompetencesTable = TableRegistry::get('Userscompetences');    

            $userCompetence = $usersCompetencesTable->get($dataForm['id']);

            $userCompetence->numericnote = '';

            $userCompetence->booleannote = '';

            if( $usersCompetencesTable->save($userCompetence) ){
                $this->Flash->success('Calificación eliminada correctamente');
                return $this->redirect(['controller' => 'competences', 'action' => 'evaluation']); 
            }else{
                $this->Flash->error('Ha habido un error al eliminar la calificación');
                return $this->redirect(['controller' => 'competences', 'action' => 'evaluation']);
            }
        }

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