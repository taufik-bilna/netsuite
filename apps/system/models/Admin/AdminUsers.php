<?php

namespace Ns\System\Models\Admin;

use Phalcon\Mvc\Model\Validator\Email;
use Phalcon\Mvc\Model\Relation;
use Ns\Core\Libraries\Phalcon\Mvc\Model as Model;

class AdminUsers extends Model
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
    protected $firstname;

    /**
     *
     * @var string
     */
    protected $lastname;

    /**
     *
     * @var string
     */
    protected $email;

    /**
     *
     * @var string
     */
    protected $username;

    /**
     *
     * @var string
     */
    protected $password;

    /**
     *
     * @var integer
     */
    protected $admin_role_id;

    /**
     *
     * @var string
     */
    protected $created;

    /**
     *
     * @var string
     */
    protected $modified;

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
     *
     * @var integer
     */
    protected $reload_acl_flag;

    /**
     *
     * @var integer
     */
    protected $is_active;

    /**
     *
     * @var string
     */
    protected $rp_token;

    /**
     *
     * @var string
     */
    protected $rp_token_created_at;

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
     * Method to set the value of field firstname
     *
     * @param string $firstname
     * @return $this
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Method to set the value of field lastname
     *
     * @param string $lastname
     * @return $this
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Method to set the value of field email
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Method to set the value of field username
     *
     * @param string $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Method to set the value of field password
     *
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

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
     * Method to set the value of field created
     *
     * @param string $created
     * @return $this
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Method to set the value of field modified
     *
     * @param string $modified
     * @return $this
     */
    public function setModified($modified)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Method to set the value of field logdate
     *
     * @param string $logdate
     * @return $this
     */
    public function setLogdate($logdate)
    {
        $this->logdate = $logdate;

        return $this;
    }

    /**
     * Method to set the value of field lognum
     *
     * @param integer $lognum
     * @return $this
     */
    public function setLognum($lognum)
    {
        $this->lognum = $lognum;

        return $this;
    }

    /**
     * Method to set the value of field reload_acl_flag
     *
     * @param integer $reload_acl_flag
     * @return $this
     */
    public function setReloadAclFlag($reload_acl_flag)
    {
        $this->reload_acl_flag = $reload_acl_flag;

        return $this;
    }

    /**
     * Method to set the value of field is_active
     *
     * @param integer $is_active
     * @return $this
     */
    public function setIsActive($is_active)
    {
        $this->is_active = $is_active;

        return $this;
    }

    /**
     * Method to set the value of field rp_token
     *
     * @param string $rp_token
     * @return $this
     */
    public function setRpToken($rp_token)
    {
        $this->rp_token = $rp_token;

        return $this;
    }

    /**
     * Method to set the value of field rp_token_created_at
     *
     * @param string $rp_token_created_at
     * @return $this
     */
    public function setRpTokenCreatedAt($rp_token_created_at)
    {
        $this->rp_token_created_at = $rp_token_created_at;

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
     * Returns the value of field firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Returns the value of field lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Returns the value of field email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Returns the value of field username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Returns the value of field password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
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
     * Returns the value of field created
     *
     * @return string
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Returns the value of field modified
     *
     * @return string
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * Returns the value of field logdate
     *
     * @return string
     */
    public function getLogdate()
    {
        return $this->logdate;
    }

    /**
     * Returns the value of field lognum
     *
     * @return integer
     */
    public function getLognum()
    {
        return $this->lognum;
    }

    /**
     * Returns the value of field reload_acl_flag
     *
     * @return integer
     */
    public function getReloadAclFlag()
    {
        return $this->reload_acl_flag;
    }

    /**
     * Returns the value of field is_active
     *
     * @return integer
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Returns the value of field rp_token
     *
     * @return string
     */
    public function getRpToken()
    {
        return $this->rp_token;
    }

    /**
     * Returns the value of field rp_token_created_at
     *
     * @return string
     */
    public function getRpTokenCreatedAt()
    {
        return $this->rp_token_created_at;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasOne(
            'admin_role_id',
            'Ns\User\Models\Admin\AdminRoles',
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