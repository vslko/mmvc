<?php
set_time_limit ( 600 ); // 10 minutes
error_reporting(E_ALL);

/**
 * MantellaMVC - A PHP Framework For Web Applications
 *
 * @class    MantellaCronTask
 * @version	1.2
 * @author	Vasilij Olhov <vsl@inbox.lv>
 */
class MantellaCronTask {

	/**
	 * Last error message.
	 *
	 * @var string
	 */
    private $_ERROR = null;

	/**
	 * Path to cron log file.
	 *
	 * @var string
	 */
    private $_LOG_PATH = null;


	/**
	 * Create a new cron-task object instance.
	 *
	 * @param  string	$index_path
	 * @param  string	$log_path
	 * @return void
	 */
    function __construct( $index_path, $config_file="config.ini", $log_file=null )  {

        $this->_LOG_PATH = ($log_file) ? $log_file : 'logs/crons.log';

        require_once($index_path.'./library/MantellaConfig.php');
        require_once($index_path.'./library/MantellaException.php');
        require_once($index_path.'./library/MantellaDBManager.php');
        require_once($index_path.'./library/MantellaModel.php');
        require_once($index_path.'./library/MantellaValidator.php');
        require_once($index_path.'./library/MantellaCollection.php');
        require_once($index_path.'./library/MantellaLocalization.php');
        require_once($index_path.'./library/MantellaView.php');

        @set_include_path( get_include_path() . PATH_SEPARATOR . '../config/');
        CONF::init($config_file, realpath ( dirname( __FILE__) . '/../' ) . '/' );
  	}



	/**
	 * Get last error
	 *
	 * @param  void
	 * @return string
	 */

    public function getError() {
    	return $this->_ERROR;
    }


	/**
	 * Get model instance by name
	 *
	 * @param  string	$name
	 * @return MantellaModel
	 */
	public function getModel($name) {
        $path = M_APP_PATH."models/".$name.".php";
        if (!file_exists($path)) { return $this->_err("File '".$path."' not found"); }
        require_once($path);
        $class_name = ucfirst($name."Model");
        if (!class_exists($class_name)) { return $this->_err("Class '".$class_name."' not found"); }
        return ( new $class_name );
	}


	/**
	 * Get collection instance by name
	 *
	 * @param  string	$name
	 * @return MantellaCollection
	 */
	public function getCollection($name) {
		$path = M_APP_PATH."collections/".$name.".php";
		if (!file_exists($path)) { return $this->_err("File '".$path."' not found"); }
		require_once($path);
		$class_name = ucfirst($name."Collection");
    	if (!class_exists($class_name)) { return $this->_err("Class '".$class_name."' not found"); }

    	// create collection instance
    	$collection = new $class_name;
        // define model instance in collection
    	if (! ($model = $this->getModel($collection->getModelName())) ) { return $this->_err("Collection '".$class_name."' not initialized"); }
        $collection->setModelInstance($model);

    	return $collection;
	}


	/**
	 * Get method of php script execution ( CLI / CRONTAB / WEB )
	 *
	 * @param  void
	 * @return string
	 */
    public function getExecutionMode() {
    	if (PHP_SAPI == 'cli') {
    		if ( isset($_SERVER['TERM']) ) { return 'CLI'; }
		    else { return 'CRONTAB'; }
		}
		else { return 'WEB'; }
    }


	/**
	 * Get arguments from onsole command line (for CLI/CRONTAB execution)
	 *
	 * @param  void
	 * @return array
	 */
    public function getArguments() {
    	global $argc, $argv;

    	$arguments = array();
    	if ( (int)$argc ) {
    		$arguments = $argv;
    		array_shift($arguments);
    	}
		return $arguments;    }



	/**
	 * Write log into log-file, defined in constructor
	 *
	 * @param  string	$type
	 * @param  string	$message
	 * @return void
	 */
    public function writeLog($type='INFO', $message='') {
    	$info = debug_backtrace(); $info = $info[0];
    	$cron = substr($info['file'] , strrpos($info['file'],"/")+1, strlen($info['file']) );
    	$cron = substr( $cron, 0, strrpos($cron,".") );

    	$path = M_ROOT_PATH . $this->_LOG_PATH;
        $log = gmdate("d.m.Y H:i:s O") . "\t[CRON:".$cron.",". str_repeat('0',(5-strlen($info['line']))).$info['line']." -> ".strtoupper($type)."]\t\t" . $message . " \n";

        if ( !($H = @fopen( $path,"a")) ) { return false; }
   		@fwrite( $H, $log );
   		@fclose( $H );
    }


	/**
	 * Remember error message in class, return always FALSE
	 *
	 * @param  string	$message
	 * @return boolean
	 */
	protected function _err( $message ) {
		$this->_ERROR = $message;
		return false;
	}

}