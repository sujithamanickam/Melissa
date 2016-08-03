<?php

// Define some constants
define( "RECIPIENT_NAME", "Melissa Website" );
define( "RECIPIENT_EMAIL", "sujithamanickam.27@gmail.com" );
define( "EMAIL_SUBJECT", "Website Visitor Message" );

// Read the form values
$success = false;
$data = json_decode(file_get_contents("php://input"));
//echo file_get_contents("php://input");

$senderFirstName = isset( $data->{'first_name'} ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $data->{'first_name'} ) : "";
$senderLastName = isset( $data->{'last_name'} ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $data->{'last_name'} ) : "";
$senderPostcode = isset( $data->{'postcode'} ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $data->{'postcode'} ) : "";
$senderEmail = isset( $data->{'email'} ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $data->{'email'} ) : "";
$senderMobile = isset( $data->{'mobile'} ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $data->{'mobile'} ) : "";
$senderPosition = isset( $data->{'position'} ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $data->{'position'} ) : "";
$senderMessage = isset( $data->{'message'} ) ? preg_replace( "/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $data->{'message'} ) : "";



$messageToSend = "<table border='1px'> ";
$messageToSend .= "<tr width='300px'><td>First name</td><td width='500px'>". $senderFirstName."</td></tr> ";
$messageToSend .= "<tr width='300px'><td>Last name</td><td width='500px'>". $senderLastName."</td></tr> ";
$messageToSend .= "<tr width='300px'><td>Postcode</td><td width='500px'>". $senderPostcode."</td></tr> ";
$messageToSend .= "<tr width='300px'><td>Email</td><td width='500px'>". $senderEmail."</td></tr> ";
$messageToSend .= "<tr width='300px'><td>Mobile</td><td width='500px'>". $senderMobile."</td></tr> ";
$messageToSend .= "<tr width='300px'><td>Position</td><td width='500px'>". $senderPosition."</td></tr> ";
$messageToSend .= "<tr width='300px'><td>Message</td><td width='500px'>". $senderMessage."</td></tr> ";
$messageToSend .= "</table> ";

// If all values exist, send the email
if ( $senderFirstName && $senderEmail && $senderMobile && $senderPosition && $messageToSend ) {
$recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-Type: text/html; charset=ISO-8859-1' . "\r\n";
$headers .= "From: " . $senderFirstName . " <" . $senderEmail . ">". "\r\n";
$success = mail( $recipient, EMAIL_SUBJECT, $messageToSend, $headers );
}

	echo $success ? "success" : "error";
	
// Return an appropriate response to the browser
?>