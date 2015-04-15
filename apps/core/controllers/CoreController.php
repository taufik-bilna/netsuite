<?php
/*
 * @author 		Bilna Development <development@bilna.com> 
 */

namespace Ns\Core\Controllers;

use Phalcon\Mvc\Controller;
/*use Ns\Core\Libraries\ApiFunctionLib as ApiKey;
use Ns\Core\Libraries\ValidateLib as Validate;
use Ns\Core\Libraries\DefaultConstant;*/

/**
 * @RoutePrefix("/")
 */
class CoreController extends Controller
{
	/*
	 * @var bool
	 * @access protected
	 *
	 */
	protected $isJsonResponse = false;

	/*
	 * @var string
	 * @access protected
	 *
	 */
	protected $data;

	/*
	 * @var array
	 * @access protected
	 *
	 */
	protected $responseMessage;
	/*
	 * initialize
     */
	public function initialize()
	{
		

	}

	/*
	 * Call this func to immediate response
	 *
	 * @return void
	 * @access public
	 *
	 */
	public function sendResponseImmidiate($data)
	{
    	if ($this->isJsonResponse) {
	      	if (is_array($data)) {
	        	$data = json_encode($data);
	      	}

	      	$this->response->setContent($data);
	    }
	    if(!$this->response->isSent()){
	    	$this->response->send();
	    }
  	}

	/*
	 * Call this func to set json response enabled
	 *
	 * @return void
	 * @access public
	 *
	 */
	public function setJsonResponse()
	{
    	$this->view->disable();

    	$this->isJsonResponse = true;
    	$this->response->setContentType('application/json', 'UTF-8');
  	}

  	/*
	 * After route executed event
	 *
	 * @return void
	 * @access public
	 *
	 */
  	public function afterExecuteRoute(\Phalcon\Mvc\Dispatcher $dispatcher)
  	{
	    if ($this->isJsonResponse) {
	    	$data = $dispatcher->getReturnedValue();
	      	if (is_array($data)) {
	        	$data = json_encode($data);
	      	}

	      	$this->response->setContent($data);
	    }
	    if(!$this->response->isSent()){
	    	$this->response->send();
	    }
    }

    /*
	 * forward/redirect
	 *
	 * @return void
	 * @access protected
	 *
	 */
    protected function forward($uri)
	{
		$uriParts = explode('/', $uri);
		$params = array_slice($uriParts, 2);
		return $this->dispatcher->forward(
			array(
				'controller' => $uriParts[0],
				'action' => $uriParts[1],
				'params' => $params
			)
		);
	}

	/**
	 * @return mixed
	 * 
	 * @Route("showcore", name="showcore")
	 */
	public function showcoreAction()
	{
		//echo 'show core action';
	}
}
