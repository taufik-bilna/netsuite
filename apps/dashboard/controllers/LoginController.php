<?php
/*
 * @author      Bilna Development <development@bilna.com> 
 */

namespace Ns\Dashboard\Controllers;

//use Phalcon\Http\Request;
use Ns\Core\Controllers\CoreController,
    Ns\Dashboard\Models\Admin\AdminUsers as Users; 


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
        
        if( $this->request->getPost() )
        {
            $loginData = $this->request->getPost('login');
            if( is_array($loginData) && array_key_exists('username', $loginData) && array_key_exists('password', $loginData) )
            {             
                $user = new Users;
                $user->login($loginData['username'], $loginData['password']);
debug($user->getId());die;
                if( $this->__validateHash($loginData['password'], $user->getPassword()) )
                {
                    $result = true;
                }
            }
        }
    }

    public function logoutAction()
    {
        die('ok logout');
    }

    /**
     * Validate hash against hashing method (with or without salt)
     *
     * @param string $password
     * @param string $hash
     * @return bool
     * @throws Exception
     */
    private function __validateHash($password, $hash)
    {
        $hashArr = explode(':', $hash);
        switch (count($hashArr)) {
            case 1:
                return $this->hash($password) === $hash;
            case 2:
                return $this->hash($hashArr[1] . $password) === $hashArr[0];
        }
        throw new \Exception("Invalid hash.", 1);
        
    }

    /**
     * Hash a string
     *
     * @param string $data
     * @return string
     */
    public function hash($data)
    {
        return md5($data);
    }

}

