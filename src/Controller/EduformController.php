<?php
    namespace App\Controller;
    use App\Controller\AppController;
    use Cake\Event\Event;
    use Cake\Validation\Validation;
    use Cake\ORM\TableRegistry;



    class EduformController extends AppController
    {
    	 public function beforeFilter(Event $event)
        {
            parent::beforeFilter($event);
            /**/
            $this->set('current_user', $this->Auth->user());
            /**/
            // Allow users to register and logout.
            // You should not add the "login" action to allow list. Doing so would
            // cause problems with normal functioning of AuthComponent.
            $this->Auth->allow(['index', 'login', 'logout', 'information', 'contact']);
        }

    	public function index()
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
                    return $this->redirect($this->Auth->redirectUrl());
                }
                

                $this->Flash->error(__('Usuario o contraseña incorrecta, intentelo de nuevo'));
                return $this->redirect($this->Auth->redirectUrl());
            }
        }

        public function information(){
            $this->viewBuilder()->layout('information');
        }
        public function contact(){
            $this->viewBuilder()->layout('information');
        }

        public function home(){
        
            $this->viewBuilder()->layout('admin');
            $user = $this->Auth->user();

            if ($user['role'] == 'Administrador')
            {
                $usersTable = TableRegistry::get('Users');
                $totalUsers = $usersTable->find()->count();
                $categoriesTable = TableRegistry::get('Categories');
                $totalCategories = $categoriesTable->find()->count();
                $competencesTable = TableRegistry::get('Competences');
                $totalCompetences = $competencesTable->find()->count();
                $subjectsTable = TableRegistry::get('Subjects');
                $totalSubjects = $subjectsTable->find()->count();
                $contentsTable = TableRegistry::get('Contents');
                $totalContents = $contentsTable->find()->count();
                $totals = array (
                            'users' => $totalUsers,
                            'categories' => $totalCategories,
                            'competences' => $totalCompetences,
                            'contents' => $totalContents,
                            'subjects' => $totalSubjects
                    );

            }else{
                return $this->redirect(['controller' => 'users', 'action' => 'view']);   
            }
            $this->Set('totals', $totals);
        }

        public function logout()
        {
            return $this->redirect($this->Auth->logout());
        }

        public function isAuthorized($user)
        {
            // Admin can access every action
            if (($user['role'] === 'Administrador' || $user['role'] === 'Alumno' || $user['role'] === 'Gestor de Contenidos')) {
                return true;
            }
            
            $this->Flash->error(__('No esta autorizado a acceder a este panel'));
            return false;
        }

    }

?>
