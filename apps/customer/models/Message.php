<?php

namespace Ns\Netsuite\Models;

use Ns\Core\Libraries\Phalcon\Mvc\Model as Model;

class Message extends Model
{

    /**
     *
     * @var integer
     */
    public $message_id;

    /**
     *
     * @var integer
     */
    public $queue_id;

    /**
     *
     * @var string
     */
    public $handle;

    /**
     *
     * @var string
     */
    public $body;

    /**
     *
     * @var string
     */
    public $md5;

    /**
     *
     * @var decimal
     */
    public $timeout;

    /**
     *
     * @var datetime
     */
    public $created;

    /**
     *
     * @var priority
     */
    public $priority;

    /**
     * Method to set the value of field messageId
     *
     * @param integer $id
     * @return $this
     */
    public function setMessageId($messageId)
    {
        $this->message_id = $messageId;

        return $this;
    }

    /**
     * Method to set the value of field queueId
     *
     * @param integer $queueId
     * @return $this
     */
    public function setQueueId($queueId)
    {
        $this->queue_id = $queueId;

        return $this;
    }

    /**
     * Method to set the value of field handle
     *
     * @param string $handle
     * @return $this
     */
    public function setHandle($handle)
    {
        $this->handle = $handle;

        return $this;
    }

    /**
     * Method to set the value of field body
     *
     * @param string $body
     * @return $this
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Method to set the value of field md5
     *
     * @param string $md5
     * @return $this
     */
    public function setMd5($md5)
    {
        $this->md5 = $md5;

        return $this;
    }

    /**
     * Method to set the value of field timeout
     *
     * @param integer $timeout
     * @return $this
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * Method to set the value of field created
     *
     * @param datetime $created
     * @return $this
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Method to set the value of field priority
     *
     * @param integer $priority
     * @return $this
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Returns the value of field message_id
     *
     * @return integer
     */
    public function getMessageId()
    {
        return $this->message_id;
    }

    /**
     * Returns the value of field queue_id
     *
     * @return integer
     */
    public function getQueueId()
    {
        return $this->queue_id;
    }

    /**
     * Returns the value of field handle
     *
     * @return string
     */
    public function getHandle()
    {
        return $this->handle;
    }

    /**
     * Returns the value of field body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Returns the value of field md5
     *
     * @return string
     */
    public function getMd5()
    {
        return $this->md5;
    }

    /**
     * Returns the value of field timeout
     *
     * @return integer
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * Returns the value of field created
     *
     * @return datetime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Returns the value of field priority
     *
     * @return datetime
     */
    public function getPriority()
    {
        return $this->priority;
    }

    public function initialize()
    {
        /*$this->hasMany("role_id", "Ns\User\Models\Admin\AdminUsers", "admin_role_id", array(
            "foreignKey" => array(
                "message" => "The Role cannot be deleted because other Users are using it"
            )
        ));*/
    }

    /**
     * Independent Column Mapping.
     */
    /*public function columnMap()
    {
        return array(
            'message_id' => 'message_id', 
            'queue_id' => 'queue_id', 
            'handle' => 'handle', 
            'body' => 'body',
            'md5' => 'md5',
            'timeout' => 'timeout',
            'created' => 'created',
            'priority'=> 'priority',
            'body' => 'action' 
        );
    }*/
}
