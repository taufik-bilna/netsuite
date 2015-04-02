<?php
namespace Ns\Dashboard\Helpers;

class Test{
	
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
    	die('cdshbchjsvd');
        $hashArr = explode(':', $hash);
        switch (count($hashArr)) {
            case 1:
            	die('here');
                return $this->hash($password) === $hash;
            case 2:
            	die('kmn larinya');
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