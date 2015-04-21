<?php
/*
 * @author      Bilna Development <development@bilna.com> 
 */

namespace Ns\Dashboard\Controllers;

//use Phalcon\Http\Request;
use Ns\Core\Controllers\CoreController; 
use Ns\Dashboard\Models\Admin\AdminUsers as Users;
use Ns\Dashboard\Libraries\Grid\UserGrid;
/**
 * @RoutePrefix("")
 */
class IndexController extends CoreController
{
	/*
	 * initialize
     */
	public function initialize()
	{
		parent::initialize();
	}

	/*
	 * index
     * @return mixed
     *
     * @Route("/dashboard", methods={"GET", "POST"}, name="dashboard") 
     */
    public function indexAction()
    {
        try{
//debug($this->session->get('auth'));die;            
            $grid = new UserGrid($this->view);
            if ($response = $grid->getResponse()) {
                return $response;
            }
        }catch(\Exception $e)
        {
            //debug("catch error ".$e->getMessage());die;
            throw $e;
            
        }            
    }

    public function check()
    {
        die('hbsvdhc');
    }
}

