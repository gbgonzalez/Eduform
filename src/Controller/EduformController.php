<?php
    namespace App\Controller;
    use App\Controller\AppController;
    use Cake\Event\Event;
    use Cake\Validation\Validation;


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
            $this->Auth->allow(['index', 'login', 'logout']);
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
                

                $this->Flash->error(__('Invalid username or password, try again'));
            }
        }

        public function home(){
        
            if($this->Auth->user()['role'] == "Administrador"){

                $this->viewBuilder()->layout('admin');
            }
            if($this->Auth->user()['role'] == "Alumno"){

                $this->viewBuilder()->layout('admin');
            }
            if($this->Auth->user()['role'] == "Gestor de contenidos"){

                $this->viewBuilder()->layout('admin');
            }


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
            
            return false;
        }

    }

?>
