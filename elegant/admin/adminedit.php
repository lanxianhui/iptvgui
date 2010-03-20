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
$admin_edit = new cadmin_edit();
$Page =& $admin_edit;

// Page init processing
$admin_edit->Page_Init();

// Page main processing
$admin_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var admin_edit = new ew_Page("admin_edit");

// page properties
admin_edit.PageID = "edit"; // page ID
var EW_PAGE_ID = admin_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
admin_edit.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_usename"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 账号名称");
		elm = fobj.elements["x" + infix + "_usepass"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 账号密码");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
admin_edit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
admin_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
admin_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
admin_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker">编辑 表: Admin<br><br>
<a href="<?php echo $admin->getReturnUrl() ?>">返回</a></span></p>
<?php $admin_edit->ShowMessage() ?>
<form name="fadminedit" id="fadminedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return admin_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="admin">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($admin->id->Visible) { // id ?>
	<tr<?php echo $admin->id->RowAttributes ?>>
		<td class="ewTableHeader">账号ID</td>
		<td<?php echo $admin->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $admin->id->ViewAttributes() ?>><?php echo $admin->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($admin->id->CurrentValue) ?>">
</span><?php echo $admin->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($admin->usename->Visible) { // usename ?>
	<tr<?php echo $admin->usename->RowAttributes ?>>
		<td class="ewTableHeader">账号名称<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $admin->usename->CellAttributes() ?>><span id="el_usename">
<input type="text" name="x_usename" id="x_usename" size="30" maxlength="200" value="<?php echo $admin->usename->EditValue ?>"<?php echo $admin->usename->EditAttributes() ?>>
</span><?php echo $admin->usename->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($admin->usepass->Visible) { // usepass ?>
	<tr<?php echo $admin->usepass->RowAttributes ?>>
		<td class="ewTableHeader">账号密码<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $admin->usepass->CellAttributes() ?>><span id="el_usepass">
<input type="password" name="x_usepass" id="x_usepass" value="<?php echo $admin->usepass->EditValue ?>" size="30" maxlength="200"<?php echo $admin->usepass->EditAttributes() ?>>
</span><?php echo $admin->usepass->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="    编辑    ">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php

//
// Page Class
//
class cadmin_edit {

	// Page ID
	var $PageID = 'edit';

	// Table Name
	var $TableName = 'admin';

	// Page Object Name
	var $PageObjName = 'admin_edit';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $admin;
		if ($admin->UseTokenInUrl) $PageUrl .= "t=" . $admin->TableVar . "&"; // add page token
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
		global $objForm, $admin;
		if ($admin->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($admin->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($admin->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cadmin_edit() {
		global $conn;

		// Initialize table object
		$GLOBALS["admin"] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'admin', TRUE);

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
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

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
		global $objForm, $gsFormError, $admin;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$admin->id->setQueryStringValue($_GET["id"]);

		// Create form object
		$objForm = new cFormObj();
		if (@$_POST["a_edit"] <> "") {
			$admin->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$admin->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$this->RestoreFormValues();
			}
		} else {
			$admin->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($admin->id->CurrentValue == "")
			$this->Page_Terminate("adminlist.php"); // Invalid key, return to list
		switch ($admin->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage("没有数据"); // No record found
					$this->Page_Terminate("adminlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$admin->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage("更新成功"); // Update success
					$sReturnUrl = $admin->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "adminview.php")
						$sReturnUrl = $admin->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$admin->RowType = EW_ROWTYPE_EDIT; // Render as edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $admin;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $admin;
		$admin->id->setFormValue($objForm->GetValue("x_id"));
		$admin->usename->setFormValue($objForm->GetValue("x_usename"));
		$admin->usepass->setFormValue($objForm->GetValue("x_usepass"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $admin;
		$this->LoadRow();
		$admin->id->CurrentValue = $admin->id->FormValue;
		$admin->usename->CurrentValue = $admin->usename->FormValue;
		$admin->usepass->CurrentValue = $admin->usepass->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $admin;
		$sFilter = $admin->KeyFilter();

		// Call Row Selecting event
		$admin->Row_Selecting($sFilter);

		// Load sql based on filter
		$admin->CurrentFilter = $sFilter;
		$sSql = $admin->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$admin->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $admin;
		$admin->id->setDbValue($rs->fields('id'));
		$admin->usename->setDbValue($rs->fields('usename'));
		$admin->usepass->setDbValue($rs->fields('usepass'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $admin;

		// Call Row_Rendering event
		$admin->Row_Rendering();

		// Common render codes for all row types
		// id

		$admin->id->CellCssStyle = "";
		$admin->id->CellCssClass = "";

		// usename
		$admin->usename->CellCssStyle = "";
		$admin->usename->CellCssClass = "";

		// usepass
		$admin->usepass->CellCssStyle = "";
		$admin->usepass->CellCssClass = "";
		if ($admin->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$admin->id->ViewValue = $admin->id->CurrentValue;
			$admin->id->CssStyle = "";
			$admin->id->CssClass = "";
			$admin->id->ViewCustomAttributes = "";

			// usename
			$admin->usename->ViewValue = $admin->usename->CurrentValue;
			$admin->usename->CssStyle = "";
			$admin->usename->CssClass = "";
			$admin->usename->ViewCustomAttributes = "";

			// usepass
			$admin->usepass->ViewValue = "********";
			$admin->usepass->CssStyle = "";
			$admin->usepass->CssClass = "";
			$admin->usepass->ViewCustomAttributes = "";

			// id
			$admin->id->HrefValue = "";

			// usename
			$admin->usename->HrefValue = "";

			// usepass
			$admin->usepass->HrefValue = "";
		} elseif ($admin->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$admin->id->EditCustomAttributes = "";
			$admin->id->EditValue = $admin->id->CurrentValue;
			$admin->id->CssStyle = "";
			$admin->id->CssClass = "";
			$admin->id->ViewCustomAttributes = "";

			// usename
			$admin->usename->EditCustomAttributes = "";
			$admin->usename->EditValue = ew_HtmlEncode($admin->usename->CurrentValue);

			// usepass
			$admin->usepass->EditCustomAttributes = "";
			$admin->usepass->EditValue = ew_HtmlEncode($admin->usepass->CurrentValue);

			// Edit refer script
			// id

			$admin->id->HrefValue = "";

			// usename
			$admin->usename->HrefValue = "";

			// usepass
			$admin->usepass->HrefValue = "";
		}

		// Call Row Rendered event
		$admin->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $admin;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($admin->usename->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 账号名称";
		}
		if ($admin->usepass->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 账号密码";
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $admin;
		$sFilter = $admin->KeyFilter();
		$admin->CurrentFilter = $sFilter;
		$sSql = $admin->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// Field id
			// Field usename

			$admin->usename->SetDbValueDef($admin->usename->CurrentValue, NULL);
			$rsnew['usename'] =& $admin->usename->DbValue;

			// Field usepass
			$admin->usepass->SetDbValueDef($admin->usepass->CurrentValue, NULL);
			$rsnew['usepass'] =& $admin->usepass->DbValue;

			// Call Row Updating event
			$bUpdateRow = $admin->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($admin->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($admin->CancelMessage <> "") {
					$this->setMessage($admin->CancelMessage);
					$admin->CancelMessage = "";
				} else {
					$this->setMessage("操作已取消");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$admin->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
