<?php
/**
 * MantellaMVC - A PHP Framework For Web Applications
 *
 * @class    MantellaLocalization
 * @alias	LNG
 * @version    1.2
 * @author    Vasilij Olhov <vsl@inbox.lv>
 */
final class MantellaLocalization {

	/**
	 * Relative path to folder with locales
	 *
	 * @var string
	 */
    private static $localizationsPath = "localizations/";

	/**
	 * Default language
	 *
	 * @var string
	 */
    private static $defaultLanguage = 'en';

	/**
	 * Set of translated phrases for current language
	 *
	 * @var array
	 */
    private static $words = array();

	/**
	 * Current language
	 *
	 * @var array
	 */
    private static $currentLanguage = array();


	/**
	 * Initialize Localization class: define current language and read translations
	 *
	 * @param	string	$language
	 * @return	void
	 */
    public static function init( $language='' ) {
        if ( defined('DEFAULT_LANGUAGE') ) { self::$defaultLanguage = DEFAULT_LANGUAGE; }
        $language = ( preg_match("/^[a-zA-Z]{2}$/Us", $language ) == 1 ) ? strtolower($language) : self::$defaultLanguage;

        $filename = M_APP_PATH . self::$localizationsPath . $language.".ini";
        if ( file_exists($filename) ) {
            self::$words = parse_ini_file($filename, true);
            self::$currentLanguage = array(
                'id'    => $language,
                'name'  => self::get('language')
            );
        }
    }


	/**
	 * Get translation(s) by keyword
	 *
	 * @param	string	$keyword
	 * @return	string|array
	 */
    public static function get( $word ) {

        if ( count(self::$words) == 0 ) {
        	self::init(null);
        }

        $def = explode(".",$word);
        if ( isset($def[1]) ) { // in section
        	$section = $def[0];
        	$var = $def[1];
        	return isset( self::$words[$section][$var]) ? self::$words[$section][$var] : $word;
        }
        return isset(self::$words[$word]) ? self::$words[$word] : $word;

    }


	/**
	 * Get current language as assoc array [id, name], or as value id $what defined
	 *
	 * @param	string	$keyword
	 * @return	array|string
	 */
    public static function getCurrent( $what = null ) {
        $lng = self::$currentLanguage;
        return ( $what ? ( !empty($lng[$what]) ? $lng[$what] : "" ) : $lng );
	}


	/**
	 * Get all available languages as array of assoc arrays [id, name]
	 *
	 * @param	void
	 * @return	array
	 */
    public static function languages( ) {
        $langs = array();
        $files = glob( M_APP_PATH . self::$localizationsPath . "*.ini" );
    	foreach($files as $file) {
    		$id = substr( basename($file) , 0 , -4);
    		$struct = parse_ini_file($file, true);
    		$langs[] = array(
    							'id'	=> $id,
    							'name'	=> isset($struct['language']) ? $struct['language'] : $id
    						);
    	}
        return $langs;
	}



}
class_alias('MantellaLocalization', 'LNG');


