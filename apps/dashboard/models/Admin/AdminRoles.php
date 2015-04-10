<?php

namespace Ns\Dashboard\Models\Admin;

use Ns\Core\Libraries\Phalcon\Mvc\Model as Model;

class AdminRoles extends Model
{

    /**
     *
     * @var integer
     */
    public $role_id;

    /**
     *
     * @var string
     */
    public $role_name;

    /**
     * Method to set the value of field roleId
     *
     * @param integer $id
     * @return $this
     */
    public function setRoleId($id)
    {
        $this->role_id = $id;

        return $this;
    }

    /**
     * Method to set the value of field roleName
     *
     * @param string $roleName
     * @return $this
     */
    public function setRoleName($roleName)
    {
        $this->role_name = $roleName;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getRoleId()
    {
        return $this->role_id;
    }

    /**
     * Returns the value of field roleName
     *
     * @return string
     */
    public function getRoleName()
    {
        return $this->role_name;
    }

    public function initialize()
    {
        $this->hasMany("role_id", "Ns\Dashboard\Models\Admin\AdminUsers", "admin_role_id", array(
            "foreignKey" => array(
                "message" => "The Role cannot be deleted because other Users are using it"
            )
        ));
    }
}
