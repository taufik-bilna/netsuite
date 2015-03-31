<?php
namespace Backend\Core\Models;

class AdminRules extends \Phalcon\Mvc\Model
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
    protected $admin_role_id;

    /**
     *
     * @var string
     */
    protected $resource_id;

    /**
     *
     * @var string
     */
    protected $privileges;

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
     * Method to set the value of field admin_role_id
     *
     * @param integer $admin_role_id
     * @return $this
     */
    public function setAdminRoleId($admin_role_id)
    {
        $this->admin_role_id = $admin_role_id;

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
     * Method to set the value of field privileges
     *
     * @param string $privileges
     * @return $this
     */
    public function setPrivileges($privileges)
    {
        $this->privileges = $privileges;

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
     * Returns the value of field admin_role_id
     *
     * @return integer
     */
    public function getAdminRoleId()
    {
        return $this->admin_role_id;
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
     * Returns the value of field privileges
     *
     * @return string
     */
    public function getPrivileges()
    {
        return $this->privileges;
    }

}
