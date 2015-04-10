<?php

namespace Ns\Dashboard\Models\Admin;

use Phalcon\Mvc\Model\Validator\Email;
use Phalcon\Mvc\Model\Relation;
use Ns\Core\Libraries\Phalcon\Mvc\Model as Model;

class AdminUsers extends Model
{
    /*
     * initialize
     */
    /*public function initialize()
    {
        parent::initialize();
    }*/
    
    /**
     *
     * @var integer
     */
    protected $admin_role_id;

    /**
     *
     * @var string
     */
    protected $logdate;

    /**
     *
     * @var integer
     */
    protected $lognum;

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    /*public function getId()
    {
        return $this->id;
    }*/

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasOne(
            'admin_role_id',
            'Ns\Dashboard\Models\Admin\AdminRoles',
            'role_id',
            array(
                'alias' => 'adminRole'
            )
        );
    }

    /**
     * Validations and business logic
     */
    public function validation()
    {

        $this->validate(new Email(
                array(
                    'field'    => 'username',
                    'required' => true,
                )
            )
        );
        return $this->validationHasFailed() != true;
    }

	public function beforeValidationOnCreate()
    {
        $this->created     = date("Y-m-d H:i:s");
        $this->modified    = date("Y-m-d H:i:s");
    }
    
     /**
     * Try to login user in admin and save loaded record
     *
     * @param string $username
     * @param string $password
     * @return this
     * @throws 
     */
    public function login($username, $password)
    {
        if ( $this->authenticate($username, $password) ) {
          
            $this->recordLogin();
        }
        return $this;
    }
    
    /**
     * @return User
     */
    public static function findFirstByEmail($parameters = array())
    {
        return parent::findFirstByEmail($parameters);
    }

    /**
     * Authenticate user name and password
     *
     * @param string $username
     * @param string $password
     * @return boolean
     * @throws 
     */
    public function authenticate($username, $password)
    {
        try{
            $rs = self::findFirstByEmail($username);

            if( false == $rs ){
                throw new \Exception("Can't find username $username", 1);
                
            }
            self::assign($rs->toArray());
        }catch(\Exception $e){

            $rs = false;
        }

        return $rs;
    }

    /**
     * save loaded record
     *
     * @param 
     * @return 
     */
    public function recordLogin()
    {
       
        /*self::assign(array(
            'logdate' => date('Y-m-d H:i:s'),
            'lognum'  => $this->getLognum() + 1
        ));*/
        $this->logdate = date('Y-m-d H:i:s');
        $this->lognum = $this->lognum + 1;

        $this->save();
//debug($this->logdate);die; 
        return $this;
    }
}