<?php

namespace Ns\Netsuite\Controllers;

use Ns\Core\Controllers\CoreController; 
use Ns\Netsuite\Libraries\Grid\ExportGrid;
/**
 * @RoutePrefix("")
 */
class ExportController extends CoreController
{
	/*
	 * index
     * @return mixed
     *
     * @Route("/export-status", methods={"GET", "POST"}, name="export-status") 
     */
    public function indexAction()
    {
    	try{
    		$grid = new ExportGrid($this->view);
            /*if ($response = $grid->getResponse()) {
                return $response;
            }*/
    	}catch(\Exception $e){
            throw $e;
        }
    }
}