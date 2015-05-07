<?php

namespace Ns\Netsuite\Controllers\Log;

use Ns\Core\Controllers\CoreController; 
use Ns\Netsuite\Libraries\Grid\ApilogGrid;
/**
 * @RoutePrefix("")
 */
class ApiController extends CoreController
{
	/*
	 * index
     * @return mixed
     *
     * @Route("/apilog", methods={"GET", "POST"}, name="apilog") 
     */
    public function indexAction()
    {
    	try{
    		$grid = new ApilogGrid($this->view);
            if ($response = $grid->getResponse()) {
                return $response;
            }
    	}catch(\Exception $e){
            throw $e;
        }
    }
}