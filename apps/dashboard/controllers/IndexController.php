<?php
/*
 * @author      Bilna Development <development@bilna.com> 
 */

namespace Ns\Dashboard\Controllers;

//use Phalcon\Http\Request;
use Ns\Core\Controllers\CoreController; 
use Ns\Dashboard\Models\Admin\AdminUsers as Users;
use Ns\Dashboard\Libraries\Grid\UserGrid;
use Phalcon\Paginator\Adapter\QueryBuilder;
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
/*
			$builder = $this->modelsManager->createBuilder();
	    	$builder
	    		->from(['r' => 'Ns\Dashboard\Models\Test\Robots'])
	    		//->columns(array('r.*', 'rp.*', 'p.*'))
	    		->columns(array('r.*'))
	    		//->leftJoin('Ns\Dashboard\Models\Test\RobotsParts', 'r.id = rp.robots_id', 'rp')
	    		//->leftJoin('Ns\Dashboard\Models\Test\Parts', 'rp.parts_id = p.id', 'p')
	    		->orderBy('r.id DESC');
//echo $builder->getPhql();die;	    	
	    	$paginator = new QueryBuilder(
	            [
	                "builder" => $builder,
	                "limit" => 10,
	                "page" => 1
	            ]
	        );
	        $_paginator = $paginator->getPaginate();	
//debug($_paginator->items->toArray());die;
	    	foreach ($_paginator->items as $item) {
				debug($item->toArray());	    	
	    	}	
	    		
die;  		     
*/
/*        $params = 'price[currency]=IDR&qty[from]=0&qty[to]=1';
$this->getDI()->getRequest()->get();

die;*/
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

