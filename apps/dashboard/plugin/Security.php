<?php
namespace Ns\Dashboard\Plugin;

use Phalcon\Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Acl\Adapter\Memory as AclList;

use Ns\Dashboard\Models\AdminRoles,
	Ns\Dashboard\Models\AdminRules,
	Ns\Dashboard\Models\AdminUsers;

/**
 * SecurityPlugin
 *
 * This is the security plugin which controls that users only have access to the modules they're assigned to
 */
class Security extends Plugin
{

	/**
	 * Returns an existing or new access control list
	 *
	 * @returns AclList
	 */
	public function getAcl()
	{

		//throw new \Exception("something");

		//if (!isset($this->persistent->acl)) {
		if (true) {

			$acl = new AclList();

			$acl->setDefaultAction(Acl::DENY);

			//Register roles
			//get roles from table admin_roles
			$roles = array(
				'users'  => new Role('Users'),
				'guests' => new Role('Guests')
			);
			foreach ($roles as $role) {
				$acl->addRole($role);
			}

			//Private area resources
			$privateResources = array(
				'companies'    => array('index', 'search', 'new', 'edit', 'save', 'create', 'delete'),
				'products'     => array('index', 'search', 'new', 'edit', 'save', 'create', 'delete'),
				'producttypes' => array('index', 'search', 'new', 'edit', 'save', 'create', 'delete'),
				'invoices'     => array('index', 'profile'),
				'dashboard'     => array('index', 'test', 'testing'),
				'errors'     => array('show404', 'show401', 'show500','show411', 'delete')
			);
			foreach ($privateResources as $resource => $actions) {
				$acl->addResource(new Resource($resource), $actions);
			}

			//Public area resources
			$publicResources = array(
				'index'      => array('index','testing'),
				'about'      => array('index'),
				'register'   => array('index'),
				'errors'     => array('show404', 'show401', 'show500','show411', 'delete'),
				'session'    => array('index', 'register', 'start', 'end'),
				'contact'    => array('index', 'send')
			);
			foreach ($publicResources as $resource => $actions) {
				$acl->addResource(new Resource($resource), $actions);
			}

			//Grant access to public areas to both users and guests
			foreach ($roles as $role) {
				foreach ($publicResources as $resource => $actions) {
					foreach ($actions as $action){
// echo "<br/>role name ".$role->getName();
// echo "<br/>resource ".$resource;
// echo "<br/>action ".$action;						
						$acl->allow($role->getName(), $resource, $action);
					}
				}
			}

			//Grant acess to private area to role Users
			foreach ($privateResources as $resource => $actions) {
				foreach ($actions as $action){
// echo "<br/>role name Users";
// echo "<br/>resource ".$resource;
// echo "<br/>action ".$action;						
					$acl->allow('Users', $resource, $action);
				}
			}

			//The acl is stored in session, APC would be useful here too
			$this->persistent->acl = $acl;
		}

		return $this->persistent->acl;
	}

	/**
	 * This action is executed before execute any action in the application
	 *
	 * @param Event $event
	 * @param Dispatcher $dispatcher
	 */
	public function beforeDispatch(Event $event, Dispatcher $dispatcher)
	{
/*echo '<pre>';
print_r($dispatcher);
echo '</pre>';
die;*/
		$auth = $this->session->get('auth');
		if (!$auth){
			$role = 'Guests';
		} else {
			$role = 'Users';
		}

		$controller = $dispatcher->getControllerName();
		$action = $dispatcher->getActionName();
echo "<br/>controller ".$controller;
echo "<br/>action ".$action;
		$acl = $this->getAcl();
//die;
		$allowed = $acl->isAllowed($role, $controller, $action);
		if ($allowed != Acl::ALLOW) {
//die('bchsbdhcbsdhcbdshcb');			
			// $dispatcher->forward(array(
			// 	'controller' => 'errors',
			// 	'action'     => 'show401'
			// ));
			// return false;
echo "<br/>not allowed ";			//die;
			$dispatcher->forward(array(
				'controller' => 'errors',
				'action' => 'show401'
			));
			return false;
		}

	}
}
