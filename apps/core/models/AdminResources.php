<?php
namespace Backend\Core\Models;

class AdminResources extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $resource_id;

    /**
     *
     * @var string
     */
    protected $resource_name;

    /**
     *
     * @var string
     */
    protected $access;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field resource_id
     *
     * @param string $resource_id
     * @return $this
     */
    public function setResourceId($resource_id)
    {
        $this->resource_id = $resource_id;

        return $this;
    }

    /**
     * Method to set the value of field resource_name
     *
     * @param string $resource_name
     * @return $this
     */
    public function setResourceName($resource_name)
    {
        $this->resource_name = $resource_name;

        return $this;
    }

    /**
     * Method to set the value of field access
     *
     * @param string $access
     * @return $this
     */
    public function setAccess($access)
    {
        $this->access = $access;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field resource_id
     *
     * @return string
     */
    public function getResourceId()
    {
        return $this->resource_id;
    }

    /**
     * Returns the value of field resource_name
     *
     * @return string
     */
    public function getResourceName()
    {
        return $this->resource_name;
    }

    /**
     * Returns the value of field access
     *
     * @return string
     */
    public function getAccess()
    {
        return $this->access;
    }

}
