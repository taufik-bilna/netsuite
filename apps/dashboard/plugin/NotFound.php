<?php
namespace Ns\Dashboard\Plugin;

use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Dispatcher;
use Phalcon\Mvc\Dispatcher\Exception as DispatcherException;
use Phalcon\Mvc\Dispatcher as MvcDispatcher;

/**
 * NotFoundPlugin
 *
 * Handles not-found controller/actions
 */
class NotFound extends Plugin
{

	/**
	 * This action is executed before execute any action in the application
	 *
	 * @param Event $event
	 * @param Dispatcher $dispatcher
	 */
	public function beforeException(Event $event, MvcDispatcher $dispatcher, $exception)
	{	
		if ($exception instanceof DispatcherException) {
echo "\nexception code : ".$exception->getCode()." - ".$exception->getMessage();die;			
			switch ($exception->getCode()) {
				case Dispatcher::EXCEPTION_HANDLER_NOT_FOUND:
				case Dispatcher::EXCEPTION_ACTION_NOT_FOUND:
					$dispatcher->forward(array(
						'controller' => 'errors',
						'action' => 'show404'
					));
					return false;
			}
		}

		self::printException($exception);die;

		$dispatcher->forward(array(
			'controller' => 'errors',
			'action'     => 'show500'
		));
		return false;
	}

	/**
     * Display exception
     *
     * @param Exception $e
     */
    public static function printException(\Exception $e)
    {
    	print '<pre>';

        print $e->getMessage() . "\n\n";
        print $e->getTraceAsString();
        print '</pre>';
    }
}
