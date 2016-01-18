<?php
/**
 * MantellaMVC - A PHP Framework For Web Applications
 *
 * @class    MantellaRequest
 * @version    1.2
 * @author    Vasilij Olhov <vsl@inbox.lv>
 */
class MantellaRequest {

	/**
	 * Url-prefix value
	 *
	 * @var string
	 */
    private $_PREFIX = null;


	/**
	 * Controller name
	 *
	 * @var string
	 */
    private $_CONTROLLER = null;


	/**
	 * Controller action methode
	 *
	 * @var string
	 */
    private $_ACTION = null;


	/**
	 * Create a new request instance.
	 *
	 * @param  void
	 * @return void
	 */
	public function __construct() {
		// do nothing
	}


	/**
	 * Setter for url-prefix
	 *
	 * @param  string
	 * @return void
	 */
	public function setPrefix($prefix) {
		$this->_PREFIX = $prefix;
	}


	/**
	 * Getter for url-prefix
	 *
	 * @param  void
	 * @return string
	 */
	public function getPrefix() {
		return $this->_PREFIX;
	}


	/**
	 * Setter for controller name
	 *
	 * @param  string
	 * @return void
	 */
	public function setController($controller) {
		$this->_CONTROLLER = substr($controller, 0, -10); // cut word "Controller" at end
	}


	/**
	 * Getter for controller name
	 *
	 * @param  void
	 * @return string
	 */
	public function getController() {
		return $this->_CONTROLLER;
	}


	/**
	 * Setter for controller action method
	 *
	 * @param  string
	 * @return void
	 */
	public function setAction($action) {
		$this->_ACTION = $action;
	}


	/**
	 * Getter for controller action method
	 *
	 * @param  void
	 * @return string
	 */
	public function getAction() {
		return $this->_ACTION;
	}


	/**
	 * Get value of GET or POST variable in HTTP request
	 *
	 * @param  string	$var_name
	 * @param  string	$default_value
	 * @param  boolean	$can_value_be_null
	 * @return string
	 */
	public function getVar($varname, $defaultValue=null, $canValueNull=false) {
 		$ret = null;
 		$ret = ( isset($_POST[$varname]) ) 	? $_POST[$varname]
											: (
												(isset($_GET[$varname])) ? $_GET[$varname] : $defaultValue
											  );
		if ( $canValueNull && !$ret ) { $ret = $defaultValue; }

		return $ret;
	}


	/**
	 * Get value of POST variable in HTTP request
	 *
	 * @param  string	$var_name
	 * @param  string	$default_value
	 * @param  boolean	$can_value_be_null
	 * @return string
	 */
	public function getPost($varname, $defaultValue=null, $canValueNull=false) {
		return ($this->getVarType($varname) === "POST")
					? $this->getVar($varname, $defaultValue, $canValueNull)
					: null;
	}


	/**
	 * Get value of GET variable in HTTP request
	 *
	 * @param  string	$var_name
	 * @param  string	$default_value
	 * @param  boolean	$can_value_be_null
	 * @return string
	 */
	public function getGET($varname, $defaultValue=null, $canValueNull=false) {
		return ($this->getVarType($varname) === "GET")
					? $this->getVar($varname, $defaultValue, $canValueNull)
					: null;
	}


	/**
	 * Get all valuef of POST anf GET variables in HTTP request
	 *
	 * @param  void
	 * @return array
	 */
	public function getVars() {
       return array_merge($_POST, $_GET);
	}


	/**
	 * Return is POST or GET variable by name
	 *
	 * @param  string	$var_name
	 * @return string
	 */
    public function getVarType($varname) {
    	return array_key_exists($varname,$_POST) ? 'POST'
    									 : ( array_key_exists($varname,$_GET) ? 'GET' : 'UNKNOWN' ) ;
    }


	/**
	 * Return is there Ajax request
	 *
	 * @param  void
	 * @return boolean
	 */
    public function isAjax() {
    	return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ? true : false;
    }


	/**
	 * Send JSON package with SUCCESS flag to client
	 *
	 * @param  mixed	$data
	 * @param  string	$message
	 * @return void
	 */
	public function replyJson( $data , $message="") {
		$reply =array( 'success'=>true, 'message'=>$message, 'data'=>$data );
		$this->sendJson( $reply );
	}


	/**
	 * Send JSON package with FAILED flag to client
	 *
	 * @param  string	$message
	 * @return void
	 */
   	public function replyJsonError($errorMessage) {
		$reply = array( 'success'=>false, 'message'=>$errorMessage );
		$this->sendJson( $reply );
	}

	/**
	 * Output JSON package and terminate application
	 *
	 * @param  mixed	$reply
	 * @return void
	 */
    private function sendJson( $reply ) {
        header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Sun, 01 Jan 2012 01:01:01 GMT');
		header('Content-type: application/json');
        print( json_encode($reply) );
        exit;
    }


	/**
	 * Output text and terminate application
	 *
	 * @param  string	$content
	 * @return void
	 */
	public function reply( $content ) {
		print( $content );
		exit;
	}


	/**
	 * Output dump of object
	 *
	 * @param  mixed	$object
	 * @return void
	 */
	public function dump( $object ) {
		echo "<pre style='padding:12px; padding-right:24px; margin:12px; border:1px solid #ccc; border-radius: 8px; display:inline-block; font-size:12px; font-family:Tahoma; background-color:#FAFAFA; color:#555;'>\n" .
			   print_r( $object , true) .
			 "</pre>";
	}


	/**
	 * Redirection
	 *
	 * @param  string	$url
	 * @return void
	 */
    public function redirect( $url ) {
    	header("Location: ".$url);
    	exit;
    }


	/**
	 * Generate headers for file downloading, output it and terminate application
	 *
	 * @param  string	$file_path
	 * @param  string	$file_name
	 * @return void
	 */
	public function download( $filepath, $filename=null ) {
    	if (!file_exists($filepath)) { $this->error(404, "File not exists"); }

    	header("Expires: 0");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header("Content-Type: application/octet-stream;");
		header("Content-Transfer-Encoding: binary");
		header('Content-length: '.filesize($filepath));
		header('Content-disposition: attachment; filename="' . ( $filename ? $filename : basename($filepath).'"' ) );
		ob_clean();
    	flush();
    	readfile($filepath);
    	exit;
	}



	/**
	 * Generate table in excel file for downloading, output it and terminate application
	 *
	 * @param  array	$headers
	 * @param  array of arrays	$data
	 * @param  string	$filename
	 * @return void
	 */
	public function excelReport( $headers, $data, $filename="report.xls" ) {
		header('Content-Description: File Transfer');
		header ("Content-Type: application/vnd.ms-excel");
		header('Content-Disposition: attachment; filename="'.$filename.'"');
		header('Content-Transfer-Encoding: binary');
		header("Accept-Ranges: bytes");
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		//header('Content-Length: ' . filesize($file));
		ob_clean();
    	flush();
		printf( '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">' . "\n".
			    '<head>' . "\n".
			    '<title>Excel report</title>' . "\n" .
				'<style type="text/css">' . "\n" .
				'table { mso-displayed-decimal-separator:"\."; mso-displayed-thousand-separator:"\,"; }' . "\n" .
				'body { margin: 0px; font-size: 12px; font-family: Arial, Sans-Serif, sans-serif; color:black; }' . "\n".
				'</style>' . "\n".
				'<META HTTP-EQUIV="Content-Type" Content="application/vnd.ms-excel; charset=UTF-8">' . "\n".
				'<style>' . "\n".
				'@page {' . "\n".
				'mso-page-orientation:landscape;' . "\n".
				'margin:.25in .25in .5in .25in;' . "\n".
				'mso-header-margin:.5in;' . "\n".
				'mso-footer-margin:.25in;' . "\n".
				'mso-footer-data:"&R&P of &N";' . "\n".
				'mso-horizontal-page-align:center;' . "\n".
				'mso-vertical-page-align:center;' . "\n".
				'}' . "\n".
				'br { mso-data-placement:same-cell; }' . "\n".
				'td { vertical-align: top; }' . "\n".
				'</style>' . "\n".
				'<!--[if gte mso 9]><xml>' . "\n".
				'<x:ExcelWorkbook>' . "\n".
				'<x:ExcelWorksheets>' . "\n".
				'<x:ExcelWorksheet>' . "\n".
				'<x:Name>general_report</x:Name>' . "\n".
				'<x:WorksheetOptions>' . "\n".
				'<x:Print>' . "\n".
				'<x:ValidPrinterInfo/>' . "\n".
				'</x:Print>' . "\n".
				'</x:WorksheetOptions>' . "\n".
				'</x:ExcelWorksheet>' . "\n".
				'</x:ExcelWorksheets>' . "\n".
				'</x:ExcelWorkbook>' . "\n".
				'</xml><![endif]-->' . "\n".
				'</head>' . "\n".
				'<body>' . "\n" );

        printf("<table>\n");
        // -- headers
        printf("<tr>\n");
        foreach($headers as $header) { printf("<th>".$header."</th>\n"); }
        printf("</tr>\n");

		// -- data
        for($i=0; $i<count($data); $i++) {
        	printf("<tr>\n");
        	foreach($data[$i] as $key => $d) {
        		if (strlen($d)<1) { $d = "-"; }
        		$d = str_replace(array("\r","\n"), array("", " "), $d);
        		printf("<td>".$d."</td>\n");
        	}
        	printf("</tr>\n");
        }

		// -- tail
		printf("</table>\n".
			   "</body>\n".
			   "</html>\n");

    	exit;
	}





	/**
	 * Raise MantellaException
	 *
	 * @param  integer	$cause
	 * @param  string	$message
	 * @return void
	 */
	public function error( $cause, $message=null ) {
        throw new MantellaException($message , (int)$cause);
	}


}