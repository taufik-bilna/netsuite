<?php

namespace Ns\Netsuite\Controllers\Log;

use Ns\Core\Controllers\CoreController; 
use Ns\Netsuite\Libraries\Grid\ChangelogGrid;
/**
 * @RoutePrefix("")
 */
class ChangelogController extends CoreController
{
	/*
	 * index
     * @return mixed
     *
     * @Route("/changelog", methods={"GET", "POST"}, name="changelog") 
     */
    public function indexAction()
    {
    	try{
    		$grid = new ChangelogGrid($this->view);
            /*if ($response = $grid->getResponse()) {
                return $response;
            }*/
    	}catch(\Exception $e){
            throw $e;
        }
    }
}