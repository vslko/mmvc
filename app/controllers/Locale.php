<?php
class LocaleController extends MantellaController {

    public function do_( $R ) {
	    $result = "function _t( key ) {\n" .
				  "  var JS_T = ".json_encode( $data ).";\n" .
				  "  var kword = key.replace(/\s/g,'_');\n" .
				  "  return ( JS_T[kword] == undefined ) ? key : JS_T[kword];\n" .
				  "};\n" .
				  "function _tl( key ) { return _t(key).toLowerCase(); };\n";
    	$R->reply($result);

}