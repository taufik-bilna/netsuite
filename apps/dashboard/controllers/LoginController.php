<?php
/*
 * @author      Bilna Development <development@bilna.com> 
 */

namespace Ns\Dashboard\Controllers;

//use Phalcon\Http\Request;
use Ns\Core\Controllers\CoreController,
    Ns\Dashboard\Models\Admin\AdminUsers as Users,
    Ns\Dashboard\Libraries\Validation\Users as ValidateUser; 


class LoginController extends CoreController
{
	/*
	 * initialize
     */
	public function initialize()
	{
		parent::initialize();
	}

	/*
	 * index 
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
                    $usersHelper = new ValidateUser;

                    if( $usersHelper->validateHash($loginData['password'], $user->getPassword()) )
                    {                
                        $result = true;
                    }                  
                }
die($result);                
            }
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }

    public function logoutAction()
    {
        die('ok logout');
    }

    

}

