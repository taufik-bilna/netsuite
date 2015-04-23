<?php

namespace Ns\Core\Libraries\Phalcon\Mvc;

use Phalcon\DI;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Mvc\Model as PhalconModel;

class Model extends PhalconModel
{
	/*
	 * initialize
     */
	public function initialize()
	{
		parent::initialize();
	}
	
    /**
     * Implement a method that returns a string key based
     * on the query parameters
     */
    protected static function _createKey($parameters)
    {
        $uniqueKey = array();
        foreach ($parameters as $key => $value) {
            if (is_scalar($value)) {
                $uniqueKey[] = $key . ':' . $value;
            } else {
                if (is_array($value)) {
                    $uniqueKey[] = $key . ':[' . self::_createKey($value) .']';
                }
            }
        }
        return join(',', $uniqueKey);
    }
    
	/**
     * Set/Get attribute wrapper
     *
     * @param   string $method
     * @param   array $args
     * @return  mixed
     */
     /*public function __call($method, $args=NULL)
     {
        switch (substr($method, 0, 3)) {
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
        throw new \Exception("Invalid method ".get_class($this)."::".$method."(".print_r($args,1).")");
    }*/

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
    	/*if( $this->$property() ){
error_log("\n".debug($this->$property()), 3, '/tmp/wolv_ns.log');        
            return $this->$property();
        }*/

        if(property_exists($this,$property)) {
//error_log("\n".debug($this->$property), 3, '/tmp/wolv_ns.log');		
        	return $this->$property;
        }
//error_log("\nadminrole ".print_r($this->getAdminRole(),1), 3, '/tmp/wolv_ns.log');         
//        return $this->$property;
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

    /**
     * Get table name.
     *
     * @return string
     */
    public static function getTableName()
    {
        $reader = DI::getDefault()->get('annotations');
        $reflector = $reader->get(get_called_class());
        $annotations = $reflector->getClassAnnotations();

        return $annotations->get('Source')->getArgument(0);
    }

    /**
     * Find method overload.
     * Get entities according to some condition.
     *
     * @param string      $condition Condition string.
     * @param array       $params    Condition params.
     * @param string|null $order     Order by field name.
     * @param string|null $limit     Selection limit.
     *
     * @return PhalconModel\ResultsetInterface
     */
    public static function get($condition, $params, $order = null, $limit = null)
    {
        $condition = vsprintf($condition, $params);
        $parameters = [$condition];

        if ($order) {
            $parameters['order'] = $order;
        }

        if ($limit) {
            $parameters['limit'] = $limit;
        }

        return self::find($parameters);
    }

    /**
     * FindFirst method overload.
     * Get entity according to some condition.
     *
     * @param string      $condition Condition string.
     * @param array       $params    Condition params.
     * @param string|null $order     Order by field name.
     *
     * @return AbstractModel
     */
    public static function getFirst($condition, $params, $order = null)
    {
        $condition = vsprintf($condition, $params);
        $parameters = [$condition];

        if ($order) {
            $parameters['order'] = $order;
        }

        return self::findFirst($parameters);
    }

    /**
     * Get builder associated with table of this model.
     *
     * @param string|null $tableAlias Table alias to use in query.
     *
     * @return Builder
     */
    public static function getBuilder($tableAlias = null)
    {
        $builder = new Builder();
        $table = get_called_class();
        if (!$tableAlias) {
            $builder->from($table);
        } else {
            $builder->addFrom($table, $tableAlias);
        }

        return $builder;
    }

    /**
     * Get identity.
     *
     * @return mixed
     */
    public function getId()
    {
        if (property_exists($this, 'id')) {
            return $this->id;
        }

        $primaryKeys = $this->getDI()->get('modelsMetadata')->getPrimaryKeyAttributes($this);

        switch (count($primaryKeys)) {
            case 0:
                return null;
                break;
            case 1:
                return $this->{$primaryKeys[0]};
                break;
            default:
                return array_intersect_key(
                    get_object_vars($this),
                    array_flip($primaryKeys)
                );
        }
    }
}