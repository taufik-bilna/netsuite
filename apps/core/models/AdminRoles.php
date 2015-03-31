<?php
namespace Backend\Core\Models;

class AdminRoles extends \Phalcon\Mvc\Model
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
    protected $role_name;

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
     * Method to set the value of field role_name
     *
     * @param string $role_name
     * @return $this
     */
    public function setRoleName($role_name)
    {
        $this->role_name = $role_name;

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
     * Returns the value of field role_name
     *
     * @return string
     */
    public function getRoleName()
    {
        return $this->role_name;
    }

}
