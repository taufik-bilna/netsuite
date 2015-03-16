<?php

/*
 * @author 		Bilna Development <development@bilna.com> 
 */
 
namespace Api\Core\Libraries;

class ApiFunctionLib
{

    /**
     * get requestId, still in dummy
     *
     * @param nothing
     * @return string
     */
    public static function getRequestId()
    {
        return md5(rand(0,1000));
    }
    
    /**
     * get ResponseCodeDescription, still in dummy
     *
     * @param string
     * @return string
     */
    public static function getResponseCodeDescription($code)
    {
    	$responseCode	= DefaultConstant::getResponseCode();
    	
    	return $responseCode[$code];
    }
    
    public static  function safeSQL($string)
    {
        $string = stripslashes($string);
        $string = strip_tags($string);
        $string = mysql_real_escape_string($string);
        return $string;
	}
	
    public static function debug($var)
    {
    	echo "<pre>".print_r($var)."</pre>";
    }

    /**
     * Authenticate
     *
     * @param   string  $clientId   The HTTP Authentication clientId
     * @param   string  $clientToken   The HTTP Authentication clientToken    
     *
     */
    public function authenticate($clientId, $clientToken) {
        if(!ctype_alnum($clientId))
            return false;
         
        if(isset($clientId) && isset($clientToken)) {
            $clientToken = crypt($clientToken);
            // Check database here with $clientId and $clientToken
            return true;
        }
        else
            return false;
    }

}