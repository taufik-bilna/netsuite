<?php
/*
 * @author      Bilna Development <development@bilna.com> 
 */

namespace Ns\Dashboard\Controllers;

//use Phalcon\Http\Request;
use Ns\Core\Controllers\CoreController,
    Ns\Dashboard\Models\Admin\AdminUsers as Users,
    Ns\Dashboard\Libraries\Validation\Users as ValidateUser; 

use Ns\Dashboard\Models\Test\Robots;
use Ns\Dashboard\Models\Test\Parts;
use Ns\Dashboard\Models\Test\RobotsParts;
/**
 * @RoutePrefix("/")
 */
class LoginController extends CoreController
{
	/*
	 * initialize
     */
	public function initialize()
	{
		parent::initialize();
	}

	/**
     * Administrator login action
     *
     * @return mixed
     *
     * @Route("login", methods={"GET", "POST"}, name="login")
     */
    public function indexAction()
    {
        $result = false;
        try{
            if( $this->request->getPost() )
            {
                $loginData = $this->request->getPost('login');            
                if( is_array($loginData) && array_key_exists('username', $loginData) && array_key_exists('password', $loginData) )
                {             
                    $user = new Users;
                    $user->login($loginData['username'], $loginData['password']);

                    if( $this->security->checkHash($loginData['password'], $user->getPassword()))
                    {          
                        $this->session->set('auth', array(
                            'id'        => $user->getId(),
                            'username'  => $user->getUsername(),
                            'firstname' => $user->getFirstname(),
                            'lastname'  => $user->getLastname(),
                            'email'     => $user->getEmail(),
                            'adminRoleId' => $user->getAdminRoleId(),
                            'adminRoleName' => $user->getAdminRole()->getRoleName(),
                            'session_created_time'  => $_SERVER['REQUEST_TIME']
                        ));             
                        $result = true;
                    }else{
                        $this->flash->error('Invalid User Name or Password.');
                    }                  
                }
                if($result){
                    /*$this->dispatcher->forward(array(
                        'controller' => 'index'
                    ));*/
                    $this->response->redirect('dashboard');
                }             
            }
        }catch(\Exception $e){
            //echo $e->getMessage();
            $this->flash->error( (string) $e->getMessage() );
        }
    }

    public function logoutAction()
    {
        die('ok logout');
    }

    /**
     * Administrator register action
     *
     * @return mixed
     *
     * @Route("register", methods={"GET", "POST"}, name="register")
     */
    public function registerAction()
    {
        /*$view = $this->getDI()->get('view');
        $this->view->setVar("postId", $view);*/
    }

}

