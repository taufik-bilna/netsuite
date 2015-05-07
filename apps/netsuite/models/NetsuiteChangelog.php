<?php

namespace Ns\Netsuite\Models;

use Ns\Core\Libraries\Phalcon\Mvc\Model as Model;

class NetsuiteChangelog extends Model
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
    protected $action;

    /**
     *
     * @var datetime
     */
    protected $created_date;

    /**
     *
     * @var integer
     */
    protected $internal_id;

    /**
     *
     * @var string
     */
    protected $comment;

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
     * Method to set the value of field action
     *
     * @param integer $action
     * @return $this
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Method to set the value of field createdDate
     *
     * @param string $createdDate
     * @return $this
     */
    public function setCreatedDate($createdDate)
    {
        $this->created_date = $createdDate;

        return $this;
    }

    /**
     * Method to set the value of field internalId
     *
     * @param string $internalId
     * @return $this
     */
    public function setInternalId($internalId)
    {
        $this->internal_id = $internalId;

        return $this;
    }

    /**
     * Method to set the value of field comment
     *
     * @param string $comment
     * @return $this
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

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
     * Returns the value of field action
     *
     * @return integer
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Returns the value of field created_date
     *
     * @return string
     */
    public function getCreatedDate()
    {
        return $this->created_date;
    }

    /**
     * Returns the value of field internal_id
     *
     * @return string
     */
    public function getInternalId()
    {
        return $this->internal_id;
    }

    /**
     * Returns the value of field comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    public function initialize()
    {
        /*$this->hasMany("role_id", "Ns\User\Models\Admin\AdminUsers", "admin_role_id", array(
            "foreignKey" => array(
                "message" => "The Role cannot be deleted because other Users are using it"
            )
        ));*/
    }


}
