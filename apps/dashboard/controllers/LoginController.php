<?php
/*
 * @author      Bilna Development <development@bilna.com> 
 */

namespace Ns\Dashboard\Controllers;

//use Phalcon\Http\Request;
use Ns\Core\Controllers\CoreController,
    Ns\Dashboard\Models\Admin\AdminUsers as Users; 
//use Phalcon\Logger\Adapter\File as FileAdapter;

class LoginController extends CoreController
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
            $post = $this->request->getPost();
            $user = new Users;
        }
    }

    public function logoutAction()
    {
        die('ok logout');
    }
}

