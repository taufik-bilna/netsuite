<?php
namespace Ns\Dashboard\Controllers;

use Ns\Core\Controllers\CoreController;

class ErrorsController extends CoreController
{
    public function initialize()
    {
        $this->tag->setTitle('Oops!');
        parent::initialize();
    }

    public function show404Action()
    {
echo "<br/>controller Errors 404";    
    }

    public function show401Action()
    {
echo "<br/>controller Errors 401";
        /*$response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setStatusCode(401, "Unauthorized");
        $response->setContent( json_encode(array('Result' => 'ERROR',
            'Message' => 'You don\'t have access to this module.',)));
        $response->send();
        exit;*/
    }

    public function show411Action()
    {
echo "<br/>controller Errors 40111111";
    }

    public function show500Action()
    {
echo "<br/>controller Errors 500";
    }

    public function deleteAction()
    {
echo "<br/>controller Errors delete";        
    }
}
