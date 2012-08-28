<?php
/**
 * Simple mailer class by Ryan Yonzon <rawswift@gmail.com>
 */

class Mailer {
	
	private $_to;
	private $_subject;
	private $_mail_body;
	private $_mail_header;
	
	// instantiate
	function __construct() {
		// initialize mail header; mail as text and high priority mail
		$this->_mail_header = "MIME-Version: 1.0\n";
		$this->_mail_header .= "Content-type: text/plain;charset=iso-8859-1\n";
		$this->_mail_header .= "X-Priority: 1 (Highest)\n";    
		$this->_mail_header .= "Importance: High\n";
	}
	
	// set mail To address
	function setTo($to = '') {
		$this->_to = $to;
	}
	
	// set mail From address
	function setFrom($from = '', $name = '') {
		$this->_mail_header = "From: \"" . $name . "\" <" . $from . ">\n";
	}
	
	// set mail Subject
	function setSubject($subject = '') {
		$this->_subject = $subject;
	}
	
	// set mail Message body
	function setMessage($mail_body = '') {
		$this->_mail_body = $mail_body;
	}
		
	// optional header info for Carbon Copy (CC)
	function setCC($cc = '') {
		$this->_mail_header .= "Cc:" . $cc . "\n";  	
	}
	
	// optional header info for Blind Carbon Copy (BCC)
	function setBCC($bcc = '') {
		$this->_mail_header .= "Bcc:" . $bcc . "\n";		
	}

	// send mail
	function sendMail() {
		return mail($this->_to, $this->_subject, $this->_mail_body, $this->_mail_header);		
	}	
	
}

// -EOF-