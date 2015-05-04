<?php

namespace Ns\User\Controllers;

use Ns\Core\Controllers\CoreController; 
use Ns\User\Libraries\Grid\UserGrid;
/**
 * @RoutePrefix("")
 */
class IndexController extends CoreController
{
	/*
	 * index
     * @return mixed
     *
     * @Route("/user", methods={"GET", "POST"}, name="dashboard") 
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