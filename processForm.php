<?php

// Define some constants
	define( "RECIPIENT_NAME", "Melissa Website" );
	define( "RECIPIENT_EMAIL", "dandenong@melissabarcafe.com.au" );
	define( "EMAIL_SUBJECT", "Website Visitor Message" );

// Read the form values
	$success = false;
	$senderName = isset( $_POST['name'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['name'] ) : "";
	$senderEmail = isset( $_POST['email'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['email'] ) : "";
	$message = isset( $_POST['message'] ) ? preg_replace( "/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['message'] ) : "";

// If all values exist, send the email
	if ( $senderName && $senderEmail && $message ) {
		$recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
		$headers = "From: " . $senderName . " <" . $senderEmail . ">";
		$success = mail( $recipient, EMAIL_SUBJECT, $message, $headers );
	}

	echo $success ? "success" : "error";
// Return an appropriate response to the browser
?>