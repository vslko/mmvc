<?php
require_once('MantellaViewParser.php');
/**
 * MantellaMVC - A PHP Framework For Web Applications
 *
 * @class    MantellaView
 * @alias    VIEW
 * @version    1.2
 * @author	Vasilij Olhov <vsl@inbox.lv>
 */
final class MantellaView {

    /**
	 * Set of variables
	 *
	 * @var array
	 */
	private static $_vars = array();

    /**
	 * Formed content
	 *
	 * @var string
	 */
    private static $_content = null;


	/**
	 * Define active template in VIEW
	 *
	 * @param	string	$template_name
	 * @return	void
	 */
	public function template( $name ) {
    	$name = M_APP_PATH."views/".$name.".tmpl";
    	if (file_exists($name)) {
    		self::$_content = file_get_contents($name);
    	}
	}


	/**
	 * Check if template already assigned to VIEW
	 *
	 * @param	void
	 * @return	boolean
	 */
	public function is_template_attached() {
		return (self::$_content) ? true : false;
	}


	/**
	 * Add variables to view
	 *
	 * @param	array|string	$names
	 * @param	string	$value
	 * @return	void
	 */
	public function set( $names, $value=null ) {
    	if (is_array($names)) {
    		self::$_vars = array_merge(self::$_vars, $names);
    	}
    	else { self::$_vars[$names] = $value; }
	}


	/**
	 * Output rendered content
	 *
	 * @param	boolean	$terminate
	 * @return	void
	 */
	public function show($terminate=false) {
  		$content = self::render();
        PRINT $content;
        if ($terminate) { exit; }
	}


	/**
	 * Render content
	 *
	 * @param	void
	 * @return	string
	 */
    public function render() {
        extract( self::$_vars );
        ob_start();
   	  	@eval(" ?> " . ( MantellaViewParser::parse( self::$_content ) ) ." <?php ");
   	  	$content = ob_get_contents();
  		ob_end_clean();
        return $content;
    }

}

class_alias('MantellaView', 'VIEW');