<?php

namespace Ns\Core\Libraries\Grid;

use Ns\Core\Libraries\Phalcon\Mvc\Model as AbstractModel;
 
class GridItem implements \Iterator, \ArrayAccess, \Countable
{
	/**
     * Item object.
     *
     * @var mixed|Row|AbstractModel
     */
    protected $_object;


    /**
     * Grid object.
     *
     * @var AbstractGrid
     */
    protected $_grid;

    /**
     * Object data.
     *
     * @var array
     */
    private $_objectData;

    /**
     * Current array position.
     *
     * @var int
     */
    private $_position = 0;

    /**
     * Current data keys.
     *
     * @var array
     */
    private $_dataKeys = [];

    /**
     * Create new grid item.
     *
     * @param AbstractGrid $grid   Grid object.
     * @param mixed        $object Grid item object.
     */
    public function __construct($grid, $object)
    {
        $this->_grid = $grid;
        $this->_object = $object;

        // Resolve object data with normalizing keys.
        $data = $object;
error_log("\natasnya lg ".json_encode($data), 3, '/tmp/phalcon.log');
        if (!is_array($data)) {
error_log("\natas".json_encode($data), 3, '/tmp/phalcon.log');
            $data = $object->toArray();
error_log("\n".json_encode($data), 3, '/tmp/phalcon.log');
        }
//print_r($data);        
        foreach ($data as $key => $value) {

            if ($value instanceof AbstractModel) {
//error_log("\n".print_r($key,1), 3, '/tmp/phalcon.log');
                foreach ($value->toArray() as $fieldName => $fieldValue) {
                    $data[$key . '.' . $fieldName] = $fieldValue;
                    //$data[$fieldName] = $fieldValue;
                }
                unset($data[$key]);
            }
            /*print_r($key);
            print_r($value);*/
        }

        $this->_objectData = $data;
        $this->_dataKeys = array_keys($data);
    }

    /**
     * Get grid object.
     *
     * @return AbstractGrid
     */
    public function getGrid()
    {
        return $this->_grid;
    }

    /**
     * Get object.
     *
     * @return AbstractModel|mixed|Row
     */
    public function getObject()
    {
        return $this->_object;
    }

    /**
     * Rewind array.
     *
     * @return void
     */
    public function rewind()
    {
        $this->_position = 0;
    }

    /**
     * Current array item.
     *
     * @return mixed
     */
    public function current()
    {
        return $this->_objectData[$this->_position];
    }

    /**
     * Current item key.
     *
     * @return mixed
     */
    public function key()
    {
        return $this->_dataKeys[$this->_position];
    }

    /**
     * Next item.
     *
     * @return void
     */
    public function next()
    {
        ++$this->_position;
    }

    /**
     * Check that current position is valid.
     *
     * @return bool
     */
    public function valid()
    {
        return isset($this->_objectData[$this->_position]);
    }

    /**
     * Check that offset is exists.
     *
     * @param mixed $offset Offset name.
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->_objectData[$offset]);
    }

    /**
     * Get offset.
     *
     * @param mixed $offset Offset name.
     *
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->_objectData[$offset] : null;
    }

    /**
     * Set offset
     *
     * @param mixed $offset Offset name.
     * @param mixed $value  Offset value.
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->_objectData[] = $value;
        } else {
            $this->_objectData[$offset] = $value;
        }
    }

    /**
     * Unset offset.
     *
     * @param mixed $offset Offset name.
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->_objectData[$offset]);
    }

    /**
     * Count objects.
     *
     * @return int
     */
    public function count()
    {
        return count($this->_objectData);
    }
}