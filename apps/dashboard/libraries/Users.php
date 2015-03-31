<?php

/*
 * class Users
 * 
 */

namespace Ns\Dashboard\Libraries;

use Ns\Dashboard\Models\Admin\AdminUsers;

class Users{

	public function login($username, $password)
    {
    	$auth = $this->authenticate($username, $password);
        if ( $auth->getId() ) {
            $this->recordLogin($auth);
        }
        return $this;
    }

    public function authenticate($username, $password)
    {
    	$adminUsers = new AdminUsers::FindByEmail($username);
    	return $adminUsers;
    }

    public function recordLogin(AdminUsers $users)
    {
    	$users->setLogdate = date('Y-m-d H:i:s');
    	$users->setLognum  = $users->getLognum() + 1;
    	$users->save();

    	return $this;
    }
}