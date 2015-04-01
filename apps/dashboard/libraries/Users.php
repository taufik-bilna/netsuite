<?php

/*
 * class Users
 * 
 */

namespace Ns\Dashboard\Libraries;

use Ns\Dashboard\Models\Admin\AdminUsers;

class Users{

    /**
     * Login user
     *
     * @param   string $login
     * @param   string $password
     * @return  
     */
	public function login($username, $password)
    {
    	$auth = $this->authenticate($username, $password);
        if ( $auth->getId() ) {
            $this->recordLogin($auth);
        }
        return $this;
    }

    /**
     * Authenticate user name and password and save loaded record
     *
     * @param string $username
     * @param string $password
     * @return boolean
     * @throws Exception $e
     */
    public function authenticate($username, $password)
    {
    	try{
            $rs = new AdminUsers::FindByEmail($username);
    	    
            if( false == $rs ){
                throw new \Exception("Can't find username $username", 1);
                
            }
        }catch(\Exception $e){
            $rs = false;
        }
        return $rs;
    }

    /**
     * Authenticate user by $username and $password
     *
     * @param Ns\Dashboard\Models\Admin\AdminUsers $user
     * @return 
     */
    public function recordLogin(AdminUsers $users)
    {
    	$users->setLogdate = date('Y-m-d H:i:s');
    	$users->setLognum  = $users->getLognum() + 1;
    	$users->save();

    	return $this;
    }
}