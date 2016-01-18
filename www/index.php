<?php
/**
 * MantellaMVC - A PHP Framework For Web Applications
 *
 * Bootable index file
 *
 * @version    1.2
 * @author    Vasilij Olhov <vsl@inbox.lv>
 */


// ========== PREPARE =========
error_reporting(E_ALL);
session_start();

if (version_compare(PHP_VERSION, '5.0.0', '<') ) { exit("Sorry, MantellaMVC needs PHP version 5+!\n"); }

// ========== ROUTING =========
// MOD_REWRITE please configure via .htaccess or httpd.conf

// ========== SYSTEM INCLUDES ==========
@set_include_path( get_include_path() . PATH_SEPARATOR . "../app/config/");
require_once('../core/MantellaConfig.php');
require_once('../core/MantellaApplication.php');
require_once('../core/MantellaDBManager.php');



// ========== INITIAL CONFIGURATION ==========
CONF::init("../app/config.ini", dirname(__FILE__).'/../' );


// ========== INIT APPLICATION ==========
$app = new MantellaApplication('Index','_');
try {
	$app->run();
}
catch (Exception $e) {
	$e->logException();
	header( $e->getHttpHeader() );
	MantellaView::template("errors/".$e->getCode());
    if ( MantellaView::is_template_attached() ) {
    	MantellaView::set('error', $e->getFullError() );
    	MantellaView::show();
    }
    else {
    	PRINT "<div style=\"margin:100px; padding:30px; border:1px dotted #C0C0C0;\">
        	     ERROR " . $e->getCode() . ": " . $e->getHttpCause() . "</b><br /><br />
            	 <span style=\"font-size:11px; font-family:Arial; color:#777;\">
                	  &gt;&gt; Url: " . $_SERVER["SERVER_NAME"] . $_SERVER['REQUEST_URI'] . "<br >
		   	   		  &gt;&gt; Ref. Number: " . $e->getRef() ."<br />
		       		  &gt;&gt; Please inform " . ( (defined('M_ADMIN_EMAIL')) ? "<a style=\"color:#666;\" href=\"mailto: ".M_ADMIN_EMAIL."\">administrator</a>" : "administrator" ) . " about this problem, thanks!
		     	</span>
		   	  </div>\n";
    }
}
