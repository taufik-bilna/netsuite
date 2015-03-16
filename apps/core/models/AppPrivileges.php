<?php

class AppPrivileges extends \Phalcon\Mvc\Model
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
    protected $app_id;

    /**
     *
     * @var integer
     */
    protected $privilege_id;

    /**
     *
     * @var integer
     */
    protected $status;

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
     * Method to set the value of field app_id
     *
     * @param string $app_id
     * @return $this
     */
    public function setAppId($app_id)
    {
        $this->app_id = $app_id;

        return $this;
    }

    /**
     * Method to set the value of field privilege_id
     *
     * @param integer $privilege_id
     * @return $this
     */
    public function setPrivilegeId($privilege_id)
    {
        $this->privilege_id = $privilege_id;

        return $this;
    }

    /**
     * Method to set the value of field status
     *
     * @param integer $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

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
     * Returns the value of field app_id
     *
     * @return string
     */
    public function getAppId()
    {
        return $this->app_id;
    }

    /**
     * Returns the value of field privilege_id
     *
     * @return integer
     */
    public function getPrivilegeId()
    {
        return $this->privilege_id;
    }

    /**
     * Returns the value of field status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }
    public function initialize()
    {
        $this->belongsTo('privilege_id', 'Privilege', 'id', array('foreignKey' => true));
        $this->belongsTo('app_id', 'Apps', 'id', array('foreignKey' => true));
    }

}
