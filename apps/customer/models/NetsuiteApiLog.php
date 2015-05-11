<?php

namespace Ns\Netsuite\Models;

use Ns\Core\Libraries\Phalcon\Mvc\Model as Model;

class NetsuiteApiLog extends Model
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var longtext
     */
    protected $request;

    /**
     *
     * @var longtext
     */
    protected $response;

    /**
     *
     * @var datetime
     */
    protected $call_date;

    /**
     *
     * @var varchar
     */
    protected $operation;

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
     * Method to set the value of field request
     *
     * @param integer $request
     * @return $this
     */
    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * Method to set the value of field response
     *
     * @param string $response
     * @return $this
     */
    public function setResponse($response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * Method to set the value of field callDate
     *
     * @param string $callDate
     * @return $this
     */
    public function setCallDate($callDate)
    {
        $this->call_date = $callDate;

        return $this;
    }

    /**
     * Method to set the value of field operation
     *
     * @param string $operation
     * @return $this
     */
    public function setOperation($operation)
    {
        $this->operation = $operation;

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
     * Returns the value of field request
     *
     * @return integer
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Returns the value of field response
     *
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Returns the value of field call_date
     *
     * @return string
     */
    public function getCallDate()
    {
        return $this->call_date;
    }

    /**
     * Returns the value of field operation
     *
     * @return string
     */
    public function getOperation()
    {
        return $this->operation;
    }

    public function initialize()
    {

    }


}
