<?php

namespace Ns\System\Controllers\Permission;

use Ns\Core\Controllers\CoreController; 
use Ns\System\Libraries\Grid\RoleGrid;
/**
 * @RoutePrefix("")
 */
class RolesController extends CoreController
{
	/*
	 * index
     * @return mixed
     *
     * @Route("/roles", methods={"GET", "POST"}, name="roles-list") 
     */
    public function indexAction()
    {
    	try{
    		$grid = new RoleGrid($this->view);
            if ($response = $grid->getResponse()) {
                return $response;
            }
    	}catch(\Exception $e){
            throw $e;
        }
    }
}