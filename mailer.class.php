<?php
/**
 * A simple PHP mailer class
 * https://github.com/rawswift/simple-mailer
 *
 * Copyright (c) 2012 Ryan Yonzon, <rawswift@gmail.com>
 * Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php
 *
 * @todo:
 *	- Validate passed values in parameters e.g. if passed value is null and/or a blank string.
 *	- Make sure that there's a "From" (sender's address) somewhere in the mail header, before sending out. (validate mail header)
 *	- Array value support for "$to" parameter (Multiple recipients) in "setTo" method. (check if passed value is an array, then iterate key-value pairs)
 *	- HTML body support (Content-type), refer to http://php.net/manual/en/function.mail.php
 *	- File attachment support
 */

class Mailer {
	
	private $_to;
	private $_subject;
	private $_mail_body;
	private $_mail_header;
	private $_mail_flags = null;
	
	// instantiate
	public function __construct() {
		// initialize mail header; mail as text and high priority mail
		$this->_mail_header = "MIME-Version: 1.0\n";
		$this->_mail_header .= "Content-type: text/plain;charset=iso-8859-1\n";
		$this->_mail_header .= "X-Priority: 1 (Highest)\n";    
		$this->_mail_header .= "Importance: High\n";
	}
	
	// set mail To address (mail recipient(s))
	public function setTo($to = '', $name = null) {
		if (!is_null($name) && isset($name) && $name != '') {
			$this->_to = $name . " <" . $to . ">";
		} else {
			// can also support multiple recipients
			// e.g.
			//		- user@example.com, anotheruser@example.com
			//		- User <user@example.com>, Another User <anotheruser@example.com>
			$this->_to = $to;
		}
	}
	
	// set mail From address
	public function setFrom($from = '', $name = null) {
		if (!is_null($name) && isset($name) && $name != '') {
			$this->_mail_header = "From: \"" . $name . "\" <" . $from . ">\n";
		} else {
			$this->_mail_header = "From: " . $from . "\n";
		}
	}

	// The user that the webserver runs as should be added as a trusted user to the sendmail configuration
	// to prevent a 'X-Warning' header from being added to the message
	// when the envelope sender (-f) is set using this method.
	// For sendmail users, this file is /etc/mail/trusted-users.
	public function setEnvelopeSenderAddress($address = null) {
		if (isset($address) && !is_null($address)) {
			$this->_mail_flags = "-f" . $address;
		} else {
			$this->_mail_flags = null;
		}
	}	
	
	// set mail Subject
	public function setSubject($subject = '') {
		$this->_subject = $subject;
	}
	
	// set mail Message body
	public function setMessage($mail_body = '') {
		$this->_mail_body = $mail_body;
	}
		
	// optional header info for Carbon Copy (CC)
	public function setCC($cc = '') {
		$this->_mail_header .= "Cc:" . $cc . "\n";  	
	}
	
	// optional header info for Blind Carbon Copy (BCC)
	public function setBCC($bcc = '') {
		$this->_mail_header .= "Bcc:" . $bcc . "\n";		
	}

	// send mail
	public function sendMail() {
		return mail($this->_to, $this->_subject, $this->_mail_body, $this->_mail_header, $this->_mail_flags);
	}	
	
}

// -EOF-