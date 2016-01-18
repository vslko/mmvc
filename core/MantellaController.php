<?php
/**
 * MantellaMVC - A PHP Framework For Web Applications
 *
 * @class    MantellaController
 * @alias    CONF
 * @version    1.2
 * @author    Vasilij Olhov <vsl@inbox.lv>
 */
abstract class MantellaController {

	/**
	 * Create a new controller instance.
	 *
	 * @param  void
	 * @return void
	 */
  	function __construct()  {
    	// do nothing
  	}


	/**
	 * Get model instance by name
	 *
	 * @param  string	$name
	 * @return MantellaModel
	 */
    public function getModel($name) {
    	$path = M_APP_PATH."models/".$name.".php";
    	if (!file_exists($path)) {  throw new MantellaException("Model file '".$path."' not found." , 500); }
    	require_once($path);
    	$class_name = ucfirst($name."Model");
    	if (!class_exists($class_name)) { throw new MantellaException("Model class '".$class_name."' not found." , 500); }
    	return ( new $class_name );
    }


	/**
	 * Get collection instance by name
	 *
	 * @param  string	$name
	 * @return MantellaCollection
	 */
	public function getCollection($name) {
		// check if collection exists
		$path = M_APP_PATH."collections/".$name.".php";
		if (!file_exists($path)) { throw new MantellaException("Collection file '".$path."' not found." , 500); }
		require_once($path);
		$class_name = ucfirst($name."Collection");
    	if (!class_exists($class_name)) { throw new MantellaException("Collection class '".$class_name."' not found." , 500); }
    	// create collection instance
    	$collection = new $class_name;
        // define model instance in collection
    	if ( !( $coll = $this->getModel($collection->getModelName()) ) ) { return false; }
        $collection->setModelInstance($coll);
    	return $collection;
	}



	/**
	 * Get controller instance by name
	 *
	 * @param  string	$name
	 * @return MantellaController
	 */
    public function getController($name) {
    	$path = M_APP_PATH."controllers/".$name.".php";
    	if (!file_exists($path)) { throw new MantellaException("Controller file '".$path."' not found." , 500); }
    	require_once($path);
    	$class_name = ucfirst($name."Controller");
    	if (!class_exists($class_name)) { throw new MantellaException("Controller class '".$class_name."' not found." , 500); }
    	return ( new $class_name );
    }


}
