<?php
/**
 * User: Akbar
 * Date: 11/26/2014
 * Time: 2:27 PM
 */

namespace Api\Core\Models;


class BaseModel extends \Phalcon\Mvc\Model {

	public function __get($property) {
		if (property_exists($this, $property)) {
			$prop = new ReflectionProperty($this,$property);

			if($prop->isProtected())
				return $this->$property;

		}
	}
} 