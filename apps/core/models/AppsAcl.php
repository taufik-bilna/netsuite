<?php

class AppsAcl extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var integer
     */
    protected $app_id;

    /**
     *
     * @var string
     */
    protected $app_privileged_id;

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
     * @param integer $app_id
     * @return $this
     */
    public function setAppId($app_id)
    {
        $this->app_id = $app_id;

        return $this;
    }

    /**
     * Method to set the value of field app_privileged_id
     *
     * @param string $app_privileged_id
     * @return $this
     */
    public function setAppPrivilegedId($app_privileged_id)
    {
        $this->app_privileged_id = $app_privileged_id;

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
     * @return integer
     */
    public function getAppId()
    {
        return $this->app_id;
    }

    /**
     * Returns the value of field app_privileged_id
     *
     * @return string
     */
    public function getAppPrivilegedId()
    {
        return $this->app_privileged_id;
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

}
