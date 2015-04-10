<?php

namespace Ns\Core\Libraries\Phalcon\Mvc;

use Phalcon\Mvc\Model as PhalconModel;

class Model extends PhalconModel
{
	/**
     * Set/Get attribute wrapper
     *
     * @param   string $method
     * @param   array $args
     * @return  mixed
     */
    //public function __call($method, $args=NULL)
    //{
        //parent::__call($method, $args=NULL);
        /*switch (substr($method, 0, 3)) {
            case 'get' :
                $key = $this->_underscore(substr($method,3));
                $data = $this->getData($key, isset($args[0]) ? $args[0] : null);
                return $data;

            case 'set' :
                $key = $this->_underscore(substr($method,3));
                $result = $this->setData($key, isset($args[0]) ? $args[0] : null);
                return $result;

            case 'uns' :
                $key = $this->_underscore(substr($method,3));
                $result = $this->unsetData($key);
                return $result;

            // case 'has' :
            //     $key = $this->_underscore(substr($method,3));
            //     return isset($this->_data[$key]);
        }
        throw new \Exception("Invalid method ".get_class($this)."::".$method."(".print_r($args,1).")");*/
    //}

    /**
     * Converts field names for setters and geters
     *
     *
     * @param string $name
     * @return string
     */
    protected function _underscore($name)
    {
        $result = strtolower(preg_replace('/(.)([A-Z])/', "$1_$2", $name));
        return $result;
    }

    /**
     * Overwrite data in the object.
     *
     *
     * @param string|int $property
     * @param mixed $value
     * @return this
     */
    public function setData($property, $value=null)
    {
    	$this->$property = $value;
        return $this;
    }

    /**
     * Retrieves data from the object
     *
     *
     * @param string $property
     * @return mixed
     */
    public function getData($property='')
    {

    	if( isset($this->$property) )
			return $this->$property;
    }

    /**
     * Unset data from the object.
     *
     * $property can be a string only. Array will be ignored.
     *
     * @param string $property
     * @return 
     */
    public function unsetData($property=null)
    {
    	if(is_null($property))
    		return new \Exception('Property or Key can\'t be null');

    	unset($this->$property);

    	return $this; 
    }
}