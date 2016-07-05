<?php
/*
 * Title: Practical English Writing Contact Form
 * URL:	http://www.practicalenglishwriting.com
 * Author: Aaron Snowberger
 * Last Modified: Feb 4, 2016
 */
 
// Deter mail header injection
/*if ( !isset( $_POST[ 'submit' ] )) {
	echo "<h1>Error</h1>\n
		<p>Accessing this page directly is not allowed.</p>";
	exit;
}*/

// If the form was submitted and is not empty
if ( ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) && ( !empty( $_POST[ 'action' ] ) ) ) :

	// Main Variables used throughout the script
	$domain = "http://" . $_SERVER["HTTP_HOST"]; // Root Doman - http://example.com
	$siteName = "De Anne Dubin";
	$siteEmail = "contactform@deannedubin.com";
	$sendto = "jekkilekki@gmail.com";
	$msg = ""; // For our messages to output to the user
	$err = ""; // For errors - IF we were doing JavaScript form validation (which we're not)
	
	
	
	// User submitted variables (via contact form)
	/*
	 * Process the web form variables
	 * Strip out any malicious attempts at code injection, just to be safe.
	 * All that is stored is safe html entities of code that might be submitted.
	 */
	if ( isset( $_POST[ 'ajaxrequest' ] )) { $ajaxrequest = $_POST[ 'ajaxrequest' ]; } else { $ajaxrequest = ''; }
	if ( isset( $_POST[ 'contactName' ] )) { $contactName = htmlentities( substr( $_POST[ "contactName" ], 0, 100 ), ENT_QUOTES ); } else { $contactName = ''; }
	if ( isset( $_POST[ 'contactEmail' ] )) { $contactEmail = htmlentities( substr( $_POST[ "contactEmail" ], 0, 100 ), ENT_QUOTES ); } else { $contactEmail = ''; }
	if ( isset( $_POST[ 'messageSubject' ] )) { $messageSubject = $_POST[ "messageSubject" ]; } else { $messageSubject = ''; } 
	if ( isset( $_POST[ 'messageContent' ] )) { 
		$messageContent = filter_var( $_POST[ 'messageContent' ], FILTER_SANITIZE_STRING ); 
	} else { $messageContent = ''; }
	
	// Reason for contact = our $messageSubject
	$reason['list'] = 'Mailing List';
	$reason['order'] = 'Order Request';
	$reason['error'] = 'Error Report';
	$reason['feedback'] = 'Feedback';
	$messageSubject = $siteName . ": " . $reason[ $_POST[ "messageSubject" ] ];
	
	
	// Check if the data entered for the Email is present and formatted like an Email
	if ( $contactEmail == "" /* || !eregi( '^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]{2,})+$', $contactEmail ) */  ) {
	 	echo "<script>$('#contactEmail').after('<span class=\"form-error\">Please enter a valid email address.</span>');</script>";
	}
	
	
	// IF NO ERROR - START
	if ( $err == "" ) : // Test if there are JavaScript form validation errors (not doing that here, so it'll just send anyway)

		// Prepare the Email elements to be sent
		$to			= $siteEmail;
		//$to 		= $siteName . " [Contact Form] <" . $siteEmail . ">";
		$subject 	= $messageSubject;
		$message 	= $messageContent;
	
		/*
		 * To make the email appear more legit (avoiding Spam), we add several key headers
		 * Add additional headers later to further customize the email if desired
		 */
		 
		// To send HTML mail, the Content-type header must be set
		// $headers = 'MIME-Version: 1.0' . "\r\n";
		// $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// compose headers
		$headers = 'From: ' . $siteName . ' <' . $siteEmail . '>' . "\r\n";
		$headers .= 'Reply-To: ' . $contactName . ' <' . $contactEmail . '>' . "\r\n";
		$headers .= 'Return-Path: ' . $siteName . ' <' . $siteEmail . '>' . "\r\n";
		$headers .= 'Date: ' . date("r") . "\r\n";
		$headers .= 'Mailed-By: ' . $siteName . "\r\n";
		$headers .= "X-Mailer: PHP/".phpversion();

		
		/*
		 * Send the email using PHP's mail function
		 */
		// Now, Mail it
		if ( mail( $to, $subject, $message, $headers ) ) :
			$msg .= "<p>Thank you for your email to <strong>" . $siteName . "</strong>. We will read your message and contact you if necessary.";
		else :
			$msg .= "We weren't able to send your message. Please contact " . $siteEmail . ".<br>";
		endif;


		/*
		 * Store the mail in our Database
		 */
		include( "log_formdb.php" ); // Contains the info for our database

		// Set default time zone, get the time, and prep it for DB entry
		date_default_timezone_set( 'Asia/Seoul' );
		$currtime = time();
		$datefordb = date( 'Y-m-d H:i:s', $currtime );

		

		/* *** MYSQL DB CONNECT - START *** */

		// Connect to DB with formdb info
		$forminfolink = mysqli_connect( $host, $user, $password, $dbname ); 
		// Insert the contact form info into the DB
		$forminfoquery = "INSERT INTO form_info (	
			contactform_id,
			contactform_timestamp,
			contactform_name,
			contactform_email,
			contactform_reason,
			contactform_message
		)
		VALUES (
			'',
			'".$datefordb."',
			'".$contactName."',
			'".$contactEmail."',
			'".$messageSubject."',
			'".$messageContent."'
		)";

		// Process the data - give feedback as to what happened with the DB query
		if ( $forminforesult = mysqli_query( $forminfolink, $forminfoquery )) :
			$msg .= "<p>Your form data has been processed and added to our database. Thanks again.</p>";
		else :
			$msg .= "<p class=\"hidden\">Unfortunately, there was a problem with the database.</p>";
		endif;

		mysqli_close( $forminfolink ); // Close the link to the DB

		/* *** MYSQL DB CONNECT - END *** */


		/*
		 * Finally, deal with AJAX - pop up the messages in place of the contact form
		 */
		if ( $ajaxrequest ) :
			echo "<script>$('#contactForm').hide(); $('#contactFormArea').append('<div class=\"mail sent\"><h2>Thanks!</h2><p>",$msg,"</p></div>').hide().fadeIn(1000);</script>";
		endif;


	endif;
	// IF NO ERROR - END
	
endif; // form submitted

?>










