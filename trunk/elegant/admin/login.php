<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "admininfo.php" ?>
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
$login = new clogin();
$Page =& $login;

// Page init processing
$login->Page_Init();

// Page main processing
$login->Page_Main();
?>
<?php include "header.php" ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<script type="text/javascript">
<!--
var login = new ew_Page("login");

// extend page with ValidateForm function
login.ValidateForm = function(fobj)
{
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (!ew_HasValue(fobj.username))
		return ew_OnError(this, fobj.username, "请输入用户 ID");
	if (!ew_HasValue(fobj.password))
		return ew_OnError(this, fobj.password, "请输入密码");

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	return true;
}

// extend page with Form_CustomValidate function
login.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// requires js validation
<?php if (EW_CLIENT_VALIDATE) { ?>
login.ValidateRequired = true;
<?php } else { ?>
login.ValidateRequired = false;
<?php } ?>

//-->
</script>
<p><span class="phpmaker">登录页</span></p>
<?php $login->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return login.ValidateForm(this);">
<table border="0" cellspacing="0" cellpadding="4">
	<tr>
		<td><span class="phpmaker">用户名</span></td>
		<td><span class="phpmaker"><input type="text" name="username" id="username" size="20" value="<?php echo $login->sUsername ?>"></span></td>
	</tr>
	<tr>
		<td><span class="phpmaker">密码</span></td>
		<td><span class="phpmaker"><input type="password" name="password" id="password" size="20"></span></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><span class="phpmaker">
		<label><input type="radio" name="rememberme" id="rememberme" value="a"<?php if ($login->sLoginType == "a") { ?> checked="checked"<?php } ?>>自动登录直到我点击退出登录</label><br>
		<label><input type="radio" name="rememberme" id="rememberme" value="u"<?php if ($login->sLoginType == "u") { ?>  checked="checked"<?php } ?>>保存用户名</label><br>
		<label><input type="radio" name="rememberme" id="rememberme" value=""<?php if ($login->sLoginType == "") { ?> checked="checked"<?php } ?>>每次都需要登录</label>
		</span></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><span class="phpmaker"><input type="submit" name="submit" id="submit" value="    登录    "></span></td>
	</tr>
</table>
</form>
<br>
<p><span class="phpmaker">
</span></p>
<script language="JavaScript" type="text/javascript">
<!--

// Write your startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php

//
// Page Class
//
class clogin {

	// Page ID
	var $PageID = 'login';

	// Page Object Name
	var $PageObjName = 'login';

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
	function clogin() {
		global $conn;

		// Initialize table object
		$GLOBALS["admin"] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'login', TRUE);

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
	var $sUsername;
	var $sLoginType;

	//
	// Page main processing
	//
	function Page_Main() {
		global $Security, $gsFormError;
		$sLastUrl = $Security->LastUrl(); // Get Last Url
		if ($sLastUrl == "")
			$sLastUrl = "index.php";
		if (!$Security->IsLoggedIn())
			$Security->AutoLogin();
		if (@$_POST["username"] <> "") {

			// Setup variables
			$this->sUsername = ew_StripSlashes(@$_POST["username"]);
			$sPassword = ew_StripSlashes(@$_POST["password"]);
			$this->sLoginType = strtolower(@$_POST["rememberme"]);
			$bValidate = $this->ValidateForm($this->sUsername, $sPassword);
			if (!$bValidate)
				$this->setMessage($gsFormError);
		} else {
			if ($Security->IsLoggedIn()) {
				if ($this->getMessage() == "")
					$this->Page_Terminate($sLastUrl); // Return to last accessed page
			}
			$bValidate = FALSE;

			// Restore settings
			$this->sUsername = @$_COOKIE[EW_PROJECT_NAME]['UserName'];
			if (@$_COOKIE[EW_PROJECT_NAME]['AutoLogin'] == "autologin") {
				$this->sLoginType = "a";
			} elseif (@$_COOKIE[EW_PROJECT_NAME]['AutoLogin'] == "rememberusername") {
				$this->sLoginType = "u";
			} else {
				$this->sLoginType = "";
			}
		}
		if ($bValidate) {
			$bValidPwd = FALSE;

			// Call loggin in event
			$bValidate = $this->User_LoggingIn($this->sUsername, $sPassword);
			if ($bValidate) {
				$bValidPwd = $Security->ValidateUser($this->sUsername, $sPassword);
				if (!$bValidPwd)
					$this->setMessage("错误的用户 ID 或者密码"); // Invalid User ID/password
			} else {
				if ($this->getMessage() == "")
					$this->setMessage("取消登录"); // Login cancelled
			}
			if ($bValidPwd) {

				// Write cookies
				$expirytime = time() + 365*24*60*60; // Change cookie expiry time here
				if ($this->sLoginType == "a") { // Auto login
					setcookie(EW_PROJECT_NAME . '[AutoLogin]',  "autologin", $expirytime); // Set up autologin cookies
					setcookie(EW_PROJECT_NAME . '[UserName]', $this->sUsername, $expirytime); // Set up user name cookies
					setcookie(EW_PROJECT_NAME . '[Password]', TEAencrypt($sPassword, EW_RANDOM_KEY), $expirytime); // Set up password cookies
				} elseif ($this->sLoginType == "u") { // Remember user name
					setcookie(EW_PROJECT_NAME . '[AutoLogin]', "rememberusername", $expirytime); // Set up remember user name cookies
					setcookie(EW_PROJECT_NAME . '[UserName]', $this->sUsername, $expirytime); // Set up user name cookies			
				} else {
					setcookie(EW_PROJECT_NAME . '[AutoLogin]', "", $expirytime); // Clear autologin cookies
				}

				// Call loggedin event
				$this->User_LoggedIn($this->sUsername);
				$this->Page_Terminate($sLastUrl); // Return to last accessed URL
			} else {

				// Call user login error event
				$this->User_LoginError($this->sUsername, $sPassword);
			}
		}
	}

	//
	// Validate form
	//
	function ValidateForm($usr, $pwd) {
		global $gsFormError;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (trim($usr) == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "请输入用户 ID";
		}
		if (trim($pwd) == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "请输入密码";
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form Custom Validate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// User Logging In event
	function User_LoggingIn($usr, $pwd) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// User Logged In event
	function User_LoggedIn($usr) {

		//echo "User Logged In";
	}

	// User Login Error event
	function User_LoginError($usr, $pwd) {

		//echo "User Login Error";
	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
