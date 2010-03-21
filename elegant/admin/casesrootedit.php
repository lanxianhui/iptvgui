<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "casesrootinfo.php" ?>
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
$casesroot_edit = new ccasesroot_edit();
$Page =& $casesroot_edit;

// Page init processing
$casesroot_edit->Page_Init();

// Page main processing
$casesroot_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var casesroot_edit = new ew_Page("casesroot_edit");

// page properties
casesroot_edit.PageID = "edit"; // page ID
var EW_PAGE_ID = casesroot_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
casesroot_edit.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_rootname"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 根类型名");
		elm = fobj.elements["x" + infix + "_rootorder"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 根类排序");
		elm = fobj.elements["x" + infix + "_rootorder"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "错误的 Integer - 根类排序");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
casesroot_edit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
casesroot_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
casesroot_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
casesroot_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">编辑 表: Casesroot<br><br>
<a href="<?php echo $casesroot->getReturnUrl() ?>">返回</a></span></p>
<?php $casesroot_edit->ShowMessage() ?>
<form name="fcasesrootedit" id="fcasesrootedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return casesroot_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="casesroot">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($casesroot->id->Visible) { // id ?>
	<tr<?php echo $casesroot->id->RowAttributes ?>>
		<td class="ewTableHeader">案例根类ID</td>
		<td<?php echo $casesroot->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $casesroot->id->ViewAttributes() ?>><?php echo $casesroot->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($casesroot->id->CurrentValue) ?>">
</span><?php echo $casesroot->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($casesroot->rootname->Visible) { // rootname ?>
	<tr<?php echo $casesroot->rootname->RowAttributes ?>>
		<td class="ewTableHeader">根类型名<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $casesroot->rootname->CellAttributes() ?>><span id="el_rootname">
<input type="text" name="x_rootname" id="x_rootname" size="30" maxlength="200" value="<?php echo $casesroot->rootname->EditValue ?>"<?php echo $casesroot->rootname->EditAttributes() ?>>
</span><?php echo $casesroot->rootname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($casesroot->rootorder->Visible) { // rootorder ?>
	<tr<?php echo $casesroot->rootorder->RowAttributes ?>>
		<td class="ewTableHeader">根类排序<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $casesroot->rootorder->CellAttributes() ?>><span id="el_rootorder">
<input type="text" name="x_rootorder" id="x_rootorder" size="30" value="<?php echo $casesroot->rootorder->EditValue ?>"<?php echo $casesroot->rootorder->EditAttributes() ?>>
</span><?php echo $casesroot->rootorder->CustomMsg ?></td>
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
class ccasesroot_edit {

	// Page ID
	var $PageID = 'edit';

	// Table Name
	var $TableName = 'casesroot';

	// Page Object Name
	var $PageObjName = 'casesroot_edit';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $casesroot;
		if ($casesroot->UseTokenInUrl) $PageUrl .= "t=" . $casesroot->TableVar . "&"; // add page token
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
		global $objForm, $casesroot;
		if ($casesroot->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($casesroot->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($casesroot->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccasesroot_edit() {
		global $conn;

		// Initialize table object
		$GLOBALS["casesroot"] = new ccasesroot();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'casesroot', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $casesroot;
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
		global $objForm, $gsFormError, $casesroot;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$casesroot->id->setQueryStringValue($_GET["id"]);

		// Create form object
		$objForm = new cFormObj();
		if (@$_POST["a_edit"] <> "") {
			$casesroot->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$casesroot->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$this->RestoreFormValues();
			}
		} else {
			$casesroot->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($casesroot->id->CurrentValue == "")
			$this->Page_Terminate("casesrootlist.php"); // Invalid key, return to list
		switch ($casesroot->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage("没有数据"); // No record found
					$this->Page_Terminate("casesrootlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$casesroot->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage("更新成功"); // Update success
					$sReturnUrl = $casesroot->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "casesrootview.php")
						$sReturnUrl = $casesroot->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$casesroot->RowType = EW_ROWTYPE_EDIT; // Render as edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $casesroot;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $casesroot;
		$casesroot->id->setFormValue($objForm->GetValue("x_id"));
		$casesroot->rootname->setFormValue($objForm->GetValue("x_rootname"));
		$casesroot->rootorder->setFormValue($objForm->GetValue("x_rootorder"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $casesroot;
		$this->LoadRow();
		$casesroot->id->CurrentValue = $casesroot->id->FormValue;
		$casesroot->rootname->CurrentValue = $casesroot->rootname->FormValue;
		$casesroot->rootorder->CurrentValue = $casesroot->rootorder->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $casesroot;
		$sFilter = $casesroot->KeyFilter();

		// Call Row Selecting event
		$casesroot->Row_Selecting($sFilter);

		// Load sql based on filter
		$casesroot->CurrentFilter = $sFilter;
		$sSql = $casesroot->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$casesroot->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $casesroot;
		$casesroot->id->setDbValue($rs->fields('id'));
		$casesroot->rootname->setDbValue($rs->fields('rootname'));
		$casesroot->rootorder->setDbValue($rs->fields('rootorder'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $casesroot;

		// Call Row_Rendering event
		$casesroot->Row_Rendering();

		// Common render codes for all row types
		// id

		$casesroot->id->CellCssStyle = "";
		$casesroot->id->CellCssClass = "";

		// rootname
		$casesroot->rootname->CellCssStyle = "";
		$casesroot->rootname->CellCssClass = "";

		// rootorder
		$casesroot->rootorder->CellCssStyle = "";
		$casesroot->rootorder->CellCssClass = "";
		if ($casesroot->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$casesroot->id->ViewValue = $casesroot->id->CurrentValue;
			$casesroot->id->CssStyle = "";
			$casesroot->id->CssClass = "";
			$casesroot->id->ViewCustomAttributes = "";

			// rootname
			$casesroot->rootname->ViewValue = $casesroot->rootname->CurrentValue;
			$casesroot->rootname->CssStyle = "";
			$casesroot->rootname->CssClass = "";
			$casesroot->rootname->ViewCustomAttributes = "";

			// rootorder
			$casesroot->rootorder->ViewValue = $casesroot->rootorder->CurrentValue;
			$casesroot->rootorder->CssStyle = "";
			$casesroot->rootorder->CssClass = "";
			$casesroot->rootorder->ViewCustomAttributes = "";

			// id
			$casesroot->id->HrefValue = "";

			// rootname
			$casesroot->rootname->HrefValue = "";

			// rootorder
			$casesroot->rootorder->HrefValue = "";
		} elseif ($casesroot->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$casesroot->id->EditCustomAttributes = "";
			$casesroot->id->EditValue = $casesroot->id->CurrentValue;
			$casesroot->id->CssStyle = "";
			$casesroot->id->CssClass = "";
			$casesroot->id->ViewCustomAttributes = "";

			// rootname
			$casesroot->rootname->EditCustomAttributes = "";
			$casesroot->rootname->EditValue = ew_HtmlEncode($casesroot->rootname->CurrentValue);

			// rootorder
			$casesroot->rootorder->EditCustomAttributes = "";
			$casesroot->rootorder->EditValue = ew_HtmlEncode($casesroot->rootorder->CurrentValue);

			// Edit refer script
			// id

			$casesroot->id->HrefValue = "";

			// rootname
			$casesroot->rootname->HrefValue = "";

			// rootorder
			$casesroot->rootorder->HrefValue = "";
		}

		// Call Row Rendered event
		$casesroot->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $casesroot;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($casesroot->rootname->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 根类型名";
		}
		if ($casesroot->rootorder->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 根类排序";
		}
		if (!ew_CheckInteger($casesroot->rootorder->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "错误的 Integer - 根类排序";
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
		global $conn, $Security, $casesroot;
		$sFilter = $casesroot->KeyFilter();
		$casesroot->CurrentFilter = $sFilter;
		$sSql = $casesroot->SQL();
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
			// Field rootname

			$casesroot->rootname->SetDbValueDef($casesroot->rootname->CurrentValue, "");
			$rsnew['rootname'] =& $casesroot->rootname->DbValue;

			// Field rootorder
			$casesroot->rootorder->SetDbValueDef($casesroot->rootorder->CurrentValue, 0);
			$rsnew['rootorder'] =& $casesroot->rootorder->DbValue;

			// Call Row Updating event
			$bUpdateRow = $casesroot->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($casesroot->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($casesroot->CancelMessage <> "") {
					$this->setMessage($casesroot->CancelMessage);
					$casesroot->CancelMessage = "";
				} else {
					$this->setMessage("操作已取消");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$casesroot->Row_Updated($rsold, $rsnew);
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
