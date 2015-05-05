<?php

namespace Ns\System\Controllers\Permission;

use Ns\Core\Controllers\CoreController; 
use Ns\System\Libraries\Grid\UserGrid;
/**
 * @RoutePrefix("")
 */
class UsersController extends CoreController
{
	/*
	 * index
     * @return mixed
     *
     * @Route("/users", methods={"GET", "POST"}, name="users-list") 
     */
    public function indexAction()
    {
    	try{
    		$grid = new UserGrid($this->view);
            if ($response = $grid->getResponse()) {
                return $response;
            }
    	}catch(\Exception $e){
            throw $e;
        }
    }
}