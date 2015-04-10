<?php

namespace Ns\Core\Libraries\Phalcon\Flash;

use Phalcon\Flash\Session;

class Message extends Session
{
	public function error($message)
	{
		$message = '<button data-dismiss="alert" class="close close-sm" type="button"><i class="icon-remove"></i></button>'.$message;
		parent::error($msg);
	}
}