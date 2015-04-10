<?php
/**
 * BaseModel class.
 */
namespace Ns\Core\Models;

abstract class BaseModel {
    
    protected $clientID;
    protected $clientToken;
    protected $url;
    protected $data;
    protected $post;
    
    /**
     * constructor method.
     */
    public function __construct(){
    	$this->di					= \Phalcon\DI::getDefault();
    	
        $this->clientID             = "BACKENDWOLVERINE";#uniqid();
        $this->clientToken          = (int)microtime(TRUE);
        
        $this->data['clientId']     = $this->clientID;
        $this->data['clientToken']  = $this->clientToken;
        $this->apilogger   			= $this->di->getApilogger();
        $this->common				= new Common();
        $this->redis			 	= $this->di->getRedis();    
        $this->config				= $this->di->getConfig();    
    }
    
    /**
     * prepare data set for API parameter, sort by abjad, exclude clientID & clientToken
     */
    public function _setData($data = []){
    	$this->dataredis	= $data;
    	unset($this->dataredis['clientId']);
    	unset($this->dataredis['clientToken']);
    	$this->dataredis	= $this->common->arraySortByKey($this->dataredis, "ASC");
    	$temp				= "";
    	foreach($this->dataredis as $k => $v){
    		if(is_array($v)) $v = json_encode($v);
    		$temp	.= urlencode($k)."=".urlencode($v)."&";
    	}
    	$this->dataredis	= substr($temp,0,strlen($temp)-1);
    	if(strlen($this->dataredis)==0)  $this->dataredis	= "null";
    }
    
    /**
     * before shoot API data, always check cache api data from Mr Redis
     */
    public function getCache($url, $data = []){
    	$this->_setData($data);
    	$this->cacheredis 	= $this->redis->hGet("api/$url",$this->dataredis );
    	#$this->common->debug("api/$url",FALSE);
    	#$this->common->debug($this->dataredis);
    	if( $this->cacheredis){
    		return $this->cacheredis;
    	}else{
    		return FALSE;
    	}
    }
    
    
    /**
     * curl api method.
     */
    protected function request($url){
    	$api							= ['time' => []];
    	$api['time']['start'] 			= $this->common->microtime_float();
		
		$this->APINulis					= 	substr_count($url,"/set")>0 	||  
											substr_count($url,"/update")>0 	||  
											substr_count($url,"/remove")>0  ||  
											substr_count($url,"/update")>0 		? TRUE : FALSE;
		$this->cacheData				= $this->APINulis==FALSE && $this->config['cache']['redis']['enable']==TRUE ? $this->getCache($url, $this->data) : FALSE;
    	if( $this->cacheData && $this->APINulis == FALSE ){
			$responseData 				= json_decode($this->cacheData, TRUE);    	
			$this->response				= $this->cacheData;
			$this->source				= array(
												'source' 	=> 'Redis',
												'hashname'	=> "api/$url",
												'value'		=> $this->dataredis
												);        
    	}else{//if not exist, then read from API
	    	$this->curl   				= $this->di->getCurl();
	        $this->curl->setBaseUri($this->config->api->endpoint);
	        $response     				= $this->curl->post($url, ['data' => json_encode($this->data)]);
	        $responseData 				= json_decode($response->body, TRUE);
	        //save to redis
	        if($this->APINulis == FALSE && $this->config['cache']['redis']['enable']==TRUE ) 
	        	$this->redis->hSet("api/$url",$this->dataredis, $response->body );
	        $this->response				= $response->body;	
	        $this->source				= "API";        
    	}
    	if(!$responseData){
    		$responseData['responseCode']			 	= "xxx";
    		$responseData['responseCodeDescription']	= "Something went wrong..";
    	}
    	if($this->config->api->debug==TRUE){
    		$api['source']				= $this->source;
        	$api['time']['end'] 		= $this->common->microtime_float();
	        $api['time']['totaltime']	= $api['time']['end'] - $api['time']['start'];
	        $api['totaltime']			= $api['time']['totaltime'];
	        unset($api['time']);
	        $api['endpoint']			= $this->config->api->endpoint.$url;
	        $api['parameter']			= json_encode($this->data);
	        $api['response']			= $this->response;
	        $this->api					= $api;
	        $this->apilogger->log(print_r($this->api,1));
        }
        return $responseData;
    }
}
