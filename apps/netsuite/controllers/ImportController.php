<?php

namespace Ns\Netsuite\Controllers;

use Ns\Core\Controllers\CoreController; 
use Ns\Netsuite\Libraries\Grid\ImportGrid;
use Ns\Netsuite\Libraries\Grid\ApilogtestGrid;
use Ns\Netsuite\Libraries\Grid\Apilogtest2Grid;
use Phalcon\Mvc\View;
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
    		//$grid = new ImportGrid($this->view);
            $this->apilogtestgridAction();
            $this->importgridAction();
            
            /*if ($response = $grid->getResponse()) {
                return $response;
            }*/
    	}catch(\Exception $e){
            throw $e;
        }
    }

    public function importgridAction()
    {
        return new ImportGrid($this->view);
    }

    public function apilogtestgridAction()
    {
        return new Apilogtest2Grid($this->view);
    }

    public function ajaxtestAction()
    {
        /*$this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        try{
            $grid = new ApilogGrid($this->view, null, 'http://localhost.bilna-ns/importtest');
            $grid->setUrl('http://localhost.bilna-ns/importtest');
            if ($response = $grid->getResponse()) {
                return $response;
            }
        }catch(\Exception $e){
            throw $e;
        }*/

    }

    /*public function testAction()
    {
        //$this->apilogtestgridAction();
        $this->importgridAction();
        
    }*/

}