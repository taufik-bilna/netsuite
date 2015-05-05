<?php

namespace Ns\Netsuite\Controllers;

use Ns\Core\Controllers\CoreController; 
use Ns\Netsuite\Libraries\Grid\ImportGrid;
/**
 * @RoutePrefix("")
 */
class ImportController extends CoreController
{
	/*
	 * index
     * @return mixed
     *
     * @Route("/import-status", methods={"GET", "POST"}, name="import-status") 
     */
    public function indexAction()
    {
    	try{
    		$grid = new ImportGrid($this->view);
            if ($response = $grid->getResponse()) {
                return $response;
            }
    	}catch(\Exception $e){
            throw $e;
        }
    }
}