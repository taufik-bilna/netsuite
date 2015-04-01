<?php
/*
 * @author      Bilna Development <development@bilna.com> 
 */

namespace Ns\Dashboard\Controllers;

//use Phalcon\Http\Request;
use Ns\Core\Controllers\CoreController; 
//use Phalcon\Logger\Adapter\File as FileAdapter;

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
     */
    public function indexAction()
    {
        if( $this->request->getPost() )
        {
die('chdbch');
        }else{
            die('ok');
        }
    }

    public function check()
    {
        die('hbsvdhc');
    }
}

