<?php
class Mailer extends PHPMailer {
	private	  $_error	= "";


	public function __construct() {
		parent::__construct(true);
        $this->setSender( M_ADMIN_EMAIL , M_SITE_NAME );
	}



    // -- Chain setters --
    public function setSender( $email, $name=null) {
		$this->SetFrom( 	$email, $name );
		$this->AddReplyTo( 	$email, $name );
		return $this;
    }

	public function setReceiver( $email, $name=null, $where='to') {
		switch($where) {
			case 'to' : $this->AddAddress( $email, $name); break;
			case 'cc' : $this->AddCC( $email, $name); break;
			case 'bcc': $this->AddBCC($email, $name); break;
		}
		return $this;
	}

	public function setSubject( $text ) {
       $this->Subject = $text;
       return $this;
	}

	public function setBody( $text ) {
        $this->MsgHTML($text);
        return $this;
	}



    // -- Advanced body setters --
    public function loadBody( $html_filename ) {
    	try {
    		$this->MsgHTML( file_get_contents( $html_filename ) );
    		return true;
    	}
    	catch(phpmailerException $e) {
    		return $this->_setError($e);
    	}
    }

    public function setAttachment( $attachment_filename, $attachment_name ) {
    	try {
    		$this->AddAttachment( $attachment_filename, $attachment_name );
    		return true;
    	}
    	catch(phpmailerException $e) {
    		return $this->_setError($e);
    	}
    }



	// -- Send function --
    public function sendMail() {
    	try {
    		$this->Send();
    	}
    	catch(phpmailerException $e) {
    		return $this->_setError($e);
    	}
    }



    // -- Error routine --
    public function getError() {
    	$err = $this->_error;
    	$this->_error = null;
    	return $err;
    }


	private function _setError( $exception ) {
		$this->_error = $exception->getMessage();
		return false;
	}

}

?>