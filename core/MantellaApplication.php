<?php
require_once('MantellaException.php');
require_once('MantellaController.php');

/**
 * MantellaMVC - A PHP Framework For Web Applications
 *
 * @class  MantellaApplication
 * @version  1.2
 * @author   Vasilij Olhov <vsl@inbox.lv>
 */
 
class MantellaApplication {

	/**
	 * Default controller for application.
	 *
	 * @var string
	 */
    private $_defaultController = null;

	/**
	 * Default action for application/
	 *
	 * @var string
	 */
    private $_defaultAction = null;

	/**
	 * List of files, which will be included on application start
	 *
	 * @var array()
	 */
    private $_autoload = array( 'MantellaModel.php',
    							'MantellaCollection.php',
    							'MantellaView.php',
    							'MantellaRequest.php',
    							'MantellaLocalization.php'
    );


	/**
	 * Create a new application instance.
	 *
	 * @param  string  $defaultController
	 * @param  string  $defaultAction
	 * @return void
	 */
    function __construct($controller="Index", $action="_") {
    	$this->_defaultController = $controller;
    	$this->_defaultAction = $action;
    }


	/**
	 * Run application: find route, create controller and call routed method of controller.
	 *
	 * @param  void
	 * @return void
	 */
    public function run() {

    	foreach($this->_autoload as $filename) {
    		require_once($filename);
    	}
        $this->includeObjects("models");
		$this->includeObjects("collections");
        $this->includeObjects("controllers");
        $this->includeObjects("mappers");

    	$route = $this->getRoute();
        
        if (!preg_match('#^[A-Za-z0-9_-]+$#',$route['classname']) || !file_exists($route['classpath'])) {
      		throw new MantellaException("Controller file '".$route['classpath']."' not found." , 404);
      	}
      	require_once($route['classpath']);
        if (!class_exists($route['classname'])) {
        	throw new MantellaException("Controller class '".$route['classname']."' not found." , 404);
        }
        $controller = new $route['classname'];

        $gag = false;
        if (!method_exists($controller, $route['method'])) {
        	if ( !method_exists($controller, "gag") ) {
        		throw new MantellaException("Controller 'gag' or method '".$route['classname']."::".$route['method']."' not found." , 404);
        	}
            $gag = true; // action not exists, but gag exists
        }

        $act = strtolower( substr($route['method'],2, strlen($route['method'])) );

        $request = new MantellaRequest();
        $request->setPrefix( $route['prefix'] );
        $request->setAction( $act );
        $request->setController( $route['classname'] );

        // -- call controllers's init-method if exists
        if (method_exists($controller, "init")) {
        	call_user_func( array( $controller, "init"), $request );
        }

        if ($gag) { // --- then call gag-method
            call_user_func( array($controller, 'gag'), $request ); 
        }	
        else { // --- then call action-method
            call_user_func( array($controller, $route['method']), $request ); 
        }	

    }


	/**
	 * Parse URL and return url-prefix, controller class, action method.
	 *
	 * @param  void
	 * @return array
	 */
	private function getRoute() {
    	$ret = array(
    				  'prefix'		=> "",
    				  'classpath'	=> realpath(M_APP_PATH."controllers/")."/",
    				  'classname'	=> "",
    				  'method'		=> ""
    				);

    	$uri = $_SERVER['REQUEST_URI'];
        if ($uri[0] == '/') { $uri = substr($uri,1,strlen($uri)); }
        $uri_parts = explode('/', $uri);
        
        if ( M_URL_PREFIX && count($uri_parts)>2 ) { $ret['prefix'] = array_shift($uri_parts); }
     	
        $ret['method'] = array_pop($uri_parts);
     	$ret['method'] = ( strpos($ret['method'],"?") !== false ) ? substr($ret['method'],0,strpos($ret['method'],"?")) : $ret['method'];
     	$ret['method'] = "do" . ucfirst( ($ret['method']=="") ? $this->_defaultAction : str_replace("-","_",$ret['method']) );
        
        
        // if it's index-page without any actions and parameters
        if (count($uri_parts) == 0) { 
            $uri_parts[0] = $this->_defaultController; 
        }
        
        for ($i=0; $i<count($uri_parts); $i++) {
            if ($i == (count($uri_parts)-1)) {
    	       $ret['classpath'] .= ucfirst($uri_parts[$i]).".php";
               $ret['classname'] .= ucfirst($uri_parts[$i])."Controller";
            }
            else {
               $ret['classpath'] .= !empty($uri_parts[$i]) ? $uri_parts[$i]."/" : '';
               $ret['classname'] .= ucfirst($uri_parts[$i])."_";
            }
        }            
       
    	return $ret;
	}


	/**
	 * Include all php files in application_folder / $folder.
	 *
	 * @param  string $folder
	 * @return void
	 */
	private function includeObjects($folder) {
    	$path = M_APP_PATH.$folder."/";
    	$files = glob($path."*.php");
    	foreach($files as $file) { require_once($file); }
	}


}

