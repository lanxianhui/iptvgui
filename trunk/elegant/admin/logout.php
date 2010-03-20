<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "userfn6.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Define page object
$logout = new clogout();
$Page =& $logout;

// Page init processing
$logout->Page_Init();

// Page main processing
$logout->Page_Main();
?>
<?php

//
// Page Class
//
class clogout {

	// Page ID
	var $PageID = 'logout';

	// Page Object Name
	var $PageObjName = 'logout';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EW_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EW_SESSION_MESSAGE] .= "<br>" . $v;
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = $v;
		}
	}

	// Show Message
	function ShowMessage() {
		if ($this->getMessage() <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $this->getMessage() . "</span></p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}

	// Validate Page request
	function IsPageRequest() {
		return TRUE;
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function clogout() {
		global $conn;

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'logout', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $admin;
		global $Security;
		$Security = new cAdvancedSecurity();

		// Global page loading event (in userfn6.php)
		Page_Loading();

		// Page load event, used in current page
		$this->Page_Load();
	}

	//
	//  Page_Terminate
	//  - called when exit page
	//  - if URL specified, redirect to the URL
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page unload event, used in current page
		$this->Page_Unload();

		// Global page unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close Connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			ob_end_clean();
			header("Location: $url");
		}
		exit();
	}

	//
	// Page main processing
	//
	function Page_Main() {
		global $Security;
		$bValidate = TRUE;
		$sUsername = $Security->CurrentUserName();

		// Call User LoggingOut event
		$bValidate = $this->User_LoggingOut($sUsername);
		if (!$bValidate) {
			$sLastUrl = $Security->LastUrl();
			if ($sLastUrl == "")
				$sLastUrl = "index.php";
			$this->Page_Terminate($sLastUrl); // Go to last accessed url
		} else {
			if (@$_COOKIE[EW_PROJECT_NAME]['AutoLogin'] == "") // Not autologin
				setCookie(EW_PROJECT_NAME . '[UserName]', ""); // clear user name cookie
			setCookie(EW_PROJECT_NAME . '[Password]', ""); // clear password cookie
			setCookie(EW_PROJECT_NAME . '[LastUrl]', ""); // clear last url

			// Call User LoggedOut event
			$this->User_LoggedOut($sUsername);

			// Unset all of the session variables
			$_SESSION = array();

			// Delete the session cookie and kill the session
			if (isset($_COOKIE[session_name()]))
				setcookie(session_name(), '', time()-42000, '/');

			// Finally, destroy the session
			@session_destroy();
			$this->Page_Terminate("login.php"); // Go to login page
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// User Logging Out event
	function User_LoggingOut($usr) {

		// Enter your code here
		// To cancel, set return value to FALSE;

		return TRUE;
	}

	// User Logged Out event
	function User_LoggedOut($usr) {

		//echo "User Logged Out";
	}
}
?>
