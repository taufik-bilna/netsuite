<?php

/*
 * @author      Bilna Development <development@bilna.com> 
 */
namespace Api\Core\Libraries;

class ValidateLib
{
    private $logger;
    private $kernel;

    public function setLogger($logger)
    {
        $this->logger = $logger;
    }

    public function setKernel(\AppKernel $kernel)
    {
        $this->kernel = $kernel;
    }

    public function validateRequestContent($param)
    {
    	$responseMessage = DefaultConstant::getResponseCode();
    	if($param!=''){
    		$data = json_decode($param);
    		
    		if(!$data){
    			$responseCode	= DefaultConstant::RCODE_API_INVALID_INPUT;	
    		}else{
    			return $data;
    		}
        }else{
        	$responseCode	= DefaultConstant::RCODE_INPUT_STRUCTURE;
        }
    	throw new \Exception($responseMessage[$responseCode], $responseCode);
    }

    public function validateMaxLength($name, $data=NULL, $max=NULL)
    {
    	if(!is_null($max) && strlen(strip_tags($data)) > $max){
    		throw new \Exception($name. " character cannot exceed ".$max.".");
    	}
    	
    	return $data;
    }

    public function validateMinLength($name, $data=NULL, $min=NULL)
    {
    	if(!is_null($min) && strlen(strip_tags($data)) < $min){
    		throw new \Exception($name. " must be at least have ".$min." character.");
    	}
    	
    	return $data;
    }

    public function validateString($name, $data=NULL, $nullable, $min=NULL, $max=NULL, $type=NULL)
    {
    	if($nullable == false && (is_null($data) || empty($data))){
    		throw new \Exception($name. " cannot be empty.");
    	}
    	if(!is_null($min) && strlen(strip_tags($data)) < $min){
    		throw new \Exception($name. " must be at least have ".$min." character.");
    	}
    	if(!is_null($max) && strlen(strip_tags($data)) > $max){
    		throw new \Exception($name. " character cannot exceed ".$max.".");
    	}
    	if(!is_null($type) && $type == "ALNUM"){
    		$data = preg_replace("/[^a-zA-Z0-9-_\.]+/i", "", strtolower(strip_tags($data)));
    	}
    	if(!is_null($type) && $type == "STRING"){
    		$data = strip_tags($data);
    	}
    	if(!is_null($type) && $type == "PRICE"){
    		$data = (int)strip_tags($data);
    	}
    	if(!is_null($type) && $type == "EMAIL"){
    		if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
    			throw new \Exception("Enter a valid ".$name.".");
    		}
    	}
    	if(!is_null($type) && $type == "PASSWORD"){
    		$filterData = preg_replace("/[a-zA-Z0-9-_\.]+/i", "", strip_tags($data));
    		if($filterData !== "")
    			throw new \Exception($name." cannot have special character.");
    	}
    	if(!is_null($type) && $type == "DATE"){
    		$filterData = preg_replace("/[0-9]{1,2}-[0-9]{1,2}-[0-9]{4}/i", "", strip_tags($data));
    		if($filterData !== "")
    			throw new \Exception($name." is not a valid date.");
    	}
    	if(!is_null($type) && $type == "DATEDURATION"){
    		$filterData = preg_replace("/[0-9]{1,2}-[0-9]{1,2}-[0-9]{4} - [0-9]{1,2}-[0-9]{1,2}-[0-9]{4}/i", "", strip_tags($data));
    		if($filterData !== "")
    			throw new \Exception($name." is not a valid date duration.");
    	}
    	
    	return $data;
    }

    public function validateEqual($name, $data=NULL, $name2, $data2=NULL)
    {
    	if($data !== $data2){
    		throw new \Exception($name. " must be equal with ".$name2.".");
    	}
    	 
    	return true;
    }

    public function validatePicture($data)
    {
		if(!is_null($data)){
	    	$imageMimeType = DefaultConstant::imageMimeType();
	    	
	    	if(!in_array($data->getMimeType(), $imageMimeType, true)){
	    		throw new \Exception("Only allow jpg and png file(s).");
	    	}
		}
    	
    	return true;
    }
}