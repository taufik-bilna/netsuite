<?php

namespace Ns\Dashboard\Controllers;

//use Phalcon\Http\Request;
use Ns\Core\Controllers\CoreController; 
//use Phalcon\Logger\Adapter\File as FileAdapter;

class IndexController extends CoreController
{
	//protected $logger;

	/*
	 * initialize
     */
	public function initialize()
	{
		parent::initialize();
	}

	/*
	 * example logger usage
     */
    public function indexAction()
    {
    	//$logger = $this->di->get('logger');
    	/*$this->logger->log(__METHOD__." This is a message");*/
        $this->view->selected   = "test cscsc scscscsc";
    }

    public function testingAction()
    {
        //$logger = $this->di->get('logger');
        /*$this->logger->log(__METHOD__." This is a message");*/
        $this->view->selected   = "testing";
    }

    /*
	 * example logger usage
     */
    public function testAction()
    {
    	//$logger = $this->di->get('logger');
    	/*$this->logger->log(__METHOD__." This is a message xxxxx");
    	$v = 'test di Dashboard module';

    	$this->logger->push(new FileAdapter('/tmp/Dashboard_xxxxx_'.date("Ymd").'.log'));
    	$this->logger->log('xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx');

        $this->setJsonResponse();
        return array('success' => true, 'data' => $v);*/
        echo "string scss scsc";
    	//$this->view->setVar("v", $v);
    }

}

