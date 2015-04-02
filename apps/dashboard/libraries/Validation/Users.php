<?php

/*
 * class Users
 * 
 */

namespace Ns\Dashboard\Libraries\Validation;

use Ns\Dashboard\Models\Admin\AdminUsers;

class Users{

    /**
     * Validate hash against hashing method (with or without salt)
     *
     * @param string $password
     * @param string $hash
     * @return bool
     * @throws Exception
     */
    public function validateHash($password, $hash)
    {
        $hashArr = explode(':', $hash);
        switch (count($hashArr)) {
            case 1:          
                return $this->hash($password) === $hash;
            case 2:
                return $this->hash($hashArr[1] . $password) === $hashArr[0];
        }

        throw new \Exception("Invalid hash.", 1);
        
    }

    /**
     * Hash a string
     *
     * @param string $data
     * @return string
     */
    public function hash($data)
    {
        return md5($data);
    }
}