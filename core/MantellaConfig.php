<?php
/**
 * MantellaMVC - A PHP Framework For Web Applications
 *
 * @class	MantellaConfig
 * @alias	CONF
 * @version	1.2
 * @author	Vasilij Olhov <vsl@inbox.lv>
 */
final class MantellaConfig {

    /**
	 * Set of shared variables as pair key-value.
	 *
	 * @var array
	 */
    private static $_vars = array();

    /**
	 * Set of parameters for endors
	 *
	 * @var array
	 */
    private static $_vendor_params = array();


	/**
	 * Initialize Config class: read config file and define global variables
	 *
	 * @param	string	$config_file
	 * @param	string	$root_path
	 * @return	void
	 */
    public function init($config_file, $root_path) {
  		// read ini file
  		$cfg = parse_ini_file($config_file, true);
        
		// ==== Global definitions ====
		define('M_ROOT_PATH', $root_path ); // path from web root directory

        if ( !empty( $cfg['globals']['PHP_LOG_PATH'] ) ) {
            ini_set("log_errors", 'On');
            ini_set("error_log", self::isAbsolutePath( $cfg['globals']['PHP_LOG_PATH'] )
                                 ? $cfg['globals']['PHP_LOG_PATH']
                                 : M_ROOT_PATH.$cfg['globals']['PHP_LOG_PATH']
            );
        }

        ini_set( // switch error displaying on page
			'display_errors',
			empty( $cfg['globals']['ERROR_DISPLAY'] ) ? 'Off' : strval( $cfg['globals']['ERROR_DISPLAY'] )
		);

        define( // path of errors log-file
        	'M_ERR_PATH',
			( !isset($cfg['globals']['ERROR_LOG_PATH']) || empty($cfg['globals']['ERROR_LOG_PATH']) )
				? null
				: ( self::isAbsolutePath( $cfg['globals']['ERROR_LOG_PATH'] )
				    ? $cfg['globals']['ERROR_LOG_PATH'] 				// already absolute path
				    : M_ROOT_PATH.$cfg['globals']['ERROR_LOG_PATH'] ) 	// relative path to absolute
        );

        define( // application path
        	'M_APP_PATH',
			empty( $cfg['globals']['M_APP_PATH'] ) ? M_ROOT_PATH.'app/' : M_ROOT_PATH.$cfg['globals']['APP_PATH']
        );

        define( // name of site
        	'M_SITE_NAME',
			empty( $cfg['globals']['SITE_NAME'] ) ? 'Mantella Site' : $cfg['globals']['SITE_NAME']
        );

        define( // name of site
        	'M_ADMIN_EMAIL',
			empty( $cfg['globals']['ADMIN_EMAIL'] ) ? null : $cfg['globals']['ADMIN_EMAIL']
        );


      	define( // prefix in url
        	'M_URL_PREFIX',
			empty( $cfg['globals']['URL_PREFIX'] ) ? null : $cfg['globals']['URL_PREFIX']
        );


        if ( !$cfg['globals']['BASE_URL'] ) {
            $_path = str_replace('\\', '/', M_ROOT_PATH);
            $_proto = $_SERVER['SERVER_PORT'] != 443 ? 'http://' : 'https://';
            $_port = $_SERVER['SERVER_PORT'] != 443 && $_SERVER['SERVER_PORT'] != 80 ? ':' . $_SERVER['SERVER_PORT'] : '';
            $cfg['globals']['BASE_URL'] = strtolower($_proto . $_SERVER['SERVER_NAME'].$_port.preg_replace('/^[\w:\/]*'.str_replace('/', '\/', $_SERVER["DOCUMENT_ROOT"]).'/i', '', $_path));
		}
        define('M_BASE_URL', $cfg['globals']['BASE_URL'] );

		
        // ==== Custom definitions ====
		foreach( $cfg['definitions'] as $name => $value ) {
	        define( $name , $value );
		}


		// ==== Read databases and init DBManager ====
		$databases = array();
		foreach( $cfg['databases'] as $name => $value) {
			$db = explode(".",$name);
			if ( !isset( $databases[$db[0]] ) ) {
				$databases[$db[0]] = array(
					'driver'	=> "unknown",
					'host'		=> "localhost",
					'port'		=> null,
					'database'	=> "base",
					'username'	=> null,
					'password'	=> null,
					'charset'	=> null,
					'prefix'	=> null
				);
			}
			$databases[ $db[0] ][ $db[1] ] = $value;
		}
        if (class_exists('DBM')) { DBM::init( $databases ); }

        
        // ==== Vendors ====
		foreach( $cfg['vendors'] as $name => $params ) {
            self::set( "vendor_".$name, $params);
            $init_path = realpath(M_ROOT_PATH."vendors/".$name."/init.php");
            if(file_exists($init_path)) { include_once($init_path); }
		}

    }



	/**
	 * Set shared variable
	 *
	 * @param	string	$key
	 * @param	mixed	$value
	 * @return	void
	 */
    public function set( $name, $value) {
    	self::$_vars[$name] = $value;
    }


	/**
	 * Get shared variable value
	 *
	 * @param	string	$key
	 * @return	mixed
	 */
    public function get( $name ) {
        return empty(self::$_vars[$name]) ? null : self::$_vars[$name];
    }

	/**
	 * Remove shared variable
	 *
	 * @param	string	$key
	 * @return	void
	 */
    public function clear( $name ) {
        if ( isset(self::$_vars[$name]) ) {
        	unset( self::$_vars[$name] );
        }
    }


	/**
	 * Define if path is absolute
	 *
	 * @param	string	$path
	 * @return	boolean
	 */
    private function isAbsolutePath( $path = ' ' ) {
    	return (boolean)($path[0]==DIRECTORY_SEPARATOR || $path[0]=='.');
    }

}
class_alias('MantellaConfig', 'CONF');