<?php


/**
 * Class Router
 */
class Router {
	
	public $header;
	public $footer;
	public $styles;
	public $jscripts;
	private $urlMap;
	private $basicPath;
	
	public function __construct($header = null, $footer = null, $styles = null, $javascripts = null, $api = null)
    {/*
		$this->header = Config::$header;
		$this->footer = Config::$footer;
		$this->jscripts = explode("," , Config::$header);
	*/
		$this->urlMap = array();
        $basicPath = "/";
	}
	
	public function mapUrl($method, $request, $destination_page, $destination_css, $destination_js)
	{
		$scriptdir = dirname($_SERVER['SCRIPT_NAME']);

        $request = str_replace("//","/", $this->basicPath.$request);

        if($destination_page == "*")
            $destination = "*";
        else
            $destination = str_replace("//","/",getcwd().$this->basicPath.$destination_page);

        if(substr($request, -2) == "/*") {

		    $request = rtrim($request,"*");
            $map = array("request"=>$request, "destination"=>$destination, "directory"=>$request);
        }
        else
            $map = array("request"=>$request, "destination"=>$destination, "directory"=>false);


		$path = realpath(getcwd().$map["request"]);
		//$request = $scriptdir.$request;
		//echo $request.'<br>';
		$this->urlMap["req"]["path_".$this->basicPath][] =  $map;

        //TODO: methods mapping
	/*
		switch($method)
		{
			case: 'GET'
			case: 'POST'
			case: 'PUT'
			case: 'PATCH'
			case: 'OPTIONS'
			case: 'ALL'
		}*/
	}
	
	public function getRoute($request = null) {
	    $result = "./public/html/404.html";
		if($request != null)
		    foreach ($this->urlMap["req"]["path_".$this->basicPath] as $map) {
                if($map["request"] == $request) {
                    $result = $map["destination"];
                    break;
                } else if($map["directory"]) {
                    if($map["request"] == substr($request, 0, strlen($map["request"]))) {

                        if(substr($map["destination"], -1) == "*"){
                            $result = rtrim($map["destination"], "*").basename($request);
                            //$result = ".".$request;
                            break;
                        } else{
                            $result = $map["destination"];
                            self::setBasicPath($map["directory"]);
                            break;
                        }
                    }
                }
            }
		return $result;
		//TODO: response codes
	}

	public function setBasicPath($path) {
        $this->basicPath = $path;
    }
	
	
}