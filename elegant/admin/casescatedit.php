<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "casescatinfo.php" ?>
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
$casescat_edit = new ccasescat_edit();
$Page =& $casescat_edit;

// Page init processing
$casescat_edit->Page_Init();

// Page main processing
$casescat_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var casescat_edit = new ew_Page("casescat_edit");

// page properties
casescat_edit.PageID = "edit"; // page ID
var EW_PAGE_ID = casescat_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
casescat_edit.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_catname"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 类型名称");
		elm = fobj.elements["x" + infix + "_catorder"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 类型排序");
		elm = fobj.elements["x" + infix + "_catorder"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "错误的 Integer - 类型排序");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
casescat_edit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
casescat_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
casescat_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">编辑 表: Casescat<br><br>
<a href="<?php echo $casescat->getReturnUrl() ?>">返回</a></span></p>
<?php $casescat_edit->ShowMessage() ?>
<form name="fcasescatedit" id="fcasescatedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return casescat_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="casescat">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($casescat->id->Visible) { // id ?>
	<tr<?php echo $casescat->id->RowAttributes ?>>
		<td class="ewTableHeader">类型ID</td>
		<td<?php echo $casescat->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $casescat->id->ViewAttributes() ?>><?php echo $casescat->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($casescat->id->CurrentValue) ?>">
</span><?php echo $casescat->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($casescat->catname->Visible) { // catname ?>
	<tr<?php echo $casescat->catname->RowAttributes ?>>
		<td class="ewTableHeader">类型名称<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $casescat->catname->CellAttributes() ?>><span id="el_catname">
<input type="text" name="x_catname" id="x_catname" size="30" maxlength="200" value="<?php echo $casescat->catname->EditValue ?>"<?php echo $casescat->catname->EditAttributes() ?>>
</span><?php echo $casescat->catname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($casescat->catorder->Visible) { // catorder ?>
	<tr<?php echo $casescat->catorder->RowAttributes ?>>
		<td class="ewTableHeader">类型排序<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $casescat->catorder->CellAttributes() ?>><span id="el_catorder">
<input type="text" name="x_catorder" id="x_catorder" size="30" value="<?php echo $casescat->catorder->EditValue ?>"<?php echo $casescat->catorder->EditAttributes() ?>>
</span><?php echo $casescat->catorder->CustomMsg ?></td>
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
class ccasescat_edit {

	// Page ID
	var $PageID = 'edit';

	// Table Name
	var $TableName = 'casescat';

	// Page Object Name
	var $PageObjName = 'casescat_edit';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $casescat;
		if ($casescat->UseTokenInUrl) $PageUrl .= "t=" . $casescat->TableVar . "&"; // add page token
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
		global $objForm, $casescat;
		if ($casescat->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($casescat->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($casescat->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccasescat_edit() {
		global $conn;

		// Initialize table object
		$GLOBALS["casescat"] = new ccasescat();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'casescat', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $casescat;

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
		global $objForm, $gsFormError, $casescat;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$casescat->id->setQueryStringValue($_GET["id"]);

		// Create form object
		$objForm = new cFormObj();
		if (@$_POST["a_edit"] <> "") {
			$casescat->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$casescat->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$this->RestoreFormValues();
			}
		} else {
			$casescat->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($casescat->id->CurrentValue == "")
			$this->Page_Terminate("casescatlist.php"); // Invalid key, return to list
		switch ($casescat->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage("没有数据"); // No record found
					$this->Page_Terminate("casescatlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$casescat->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage("更新成功"); // Update success
					$sReturnUrl = $casescat->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$casescat->RowType = EW_ROWTYPE_EDIT; // Render as edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $casescat;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $casescat;
		$casescat->id->setFormValue($objForm->GetValue("x_id"));
		$casescat->catname->setFormValue($objForm->GetValue("x_catname"));
		$casescat->catorder->setFormValue($objForm->GetValue("x_catorder"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $casescat;
		$this->LoadRow();
		$casescat->id->CurrentValue = $casescat->id->FormValue;
		$casescat->catname->CurrentValue = $casescat->catname->FormValue;
		$casescat->catorder->CurrentValue = $casescat->catorder->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $casescat;
		$sFilter = $casescat->KeyFilter();

		// Call Row Selecting event
		$casescat->Row_Selecting($sFilter);

		// Load sql based on filter
		$casescat->CurrentFilter = $sFilter;
		$sSql = $casescat->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$casescat->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $casescat;
		$casescat->id->setDbValue($rs->fields('id'));
		$casescat->catname->setDbValue($rs->fields('catname'));
		$casescat->catorder->setDbValue($rs->fields('catorder'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $casescat;

		// Call Row_Rendering event
		$casescat->Row_Rendering();

		// Common render codes for all row types
		// id

		$casescat->id->CellCssStyle = "";
		$casescat->id->CellCssClass = "";

		// catname
		$casescat->catname->CellCssStyle = "";
		$casescat->catname->CellCssClass = "";

		// catorder
		$casescat->catorder->CellCssStyle = "";
		$casescat->catorder->CellCssClass = "";
		if ($casescat->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$casescat->id->ViewValue = $casescat->id->CurrentValue;
			$casescat->id->CssStyle = "";
			$casescat->id->CssClass = "";
			$casescat->id->ViewCustomAttributes = "";

			// catname
			$casescat->catname->ViewValue = $casescat->catname->CurrentValue;
			$casescat->catname->CssStyle = "";
			$casescat->catname->CssClass = "";
			$casescat->catname->ViewCustomAttributes = "";

			// catorder
			$casescat->catorder->ViewValue = $casescat->catorder->CurrentValue;
			$casescat->catorder->CssStyle = "";
			$casescat->catorder->CssClass = "";
			$casescat->catorder->ViewCustomAttributes = "";

			// id
			$casescat->id->HrefValue = "";

			// catname
			$casescat->catname->HrefValue = "";

			// catorder
			$casescat->catorder->HrefValue = "";
		} elseif ($casescat->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$casescat->id->EditCustomAttributes = "";
			$casescat->id->EditValue = $casescat->id->CurrentValue;
			$casescat->id->CssStyle = "";
			$casescat->id->CssClass = "";
			$casescat->id->ViewCustomAttributes = "";

			// catname
			$casescat->catname->EditCustomAttributes = "";
			$casescat->catname->EditValue = ew_HtmlEncode($casescat->catname->CurrentValue);

			// catorder
			$casescat->catorder->EditCustomAttributes = "";
			$casescat->catorder->EditValue = ew_HtmlEncode($casescat->catorder->CurrentValue);

			// Edit refer script
			// id

			$casescat->id->HrefValue = "";

			// catname
			$casescat->catname->HrefValue = "";

			// catorder
			$casescat->catorder->HrefValue = "";
		}

		// Call Row Rendered event
		$casescat->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $casescat;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($casescat->catname->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 类型名称";
		}
		if ($casescat->catorder->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 类型排序";
		}
		if (!ew_CheckInteger($casescat->catorder->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "错误的 Integer - 类型排序";
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
		global $conn, $Security, $casescat;
		$sFilter = $casescat->KeyFilter();
		$casescat->CurrentFilter = $sFilter;
		$sSql = $casescat->SQL();
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
			// Field catname

			$casescat->catname->SetDbValueDef($casescat->catname->CurrentValue, NULL);
			$rsnew['catname'] =& $casescat->catname->DbValue;

			// Field catorder
			$casescat->catorder->SetDbValueDef($casescat->catorder->CurrentValue, NULL);
			$rsnew['catorder'] =& $casescat->catorder->DbValue;

			// Call Row Updating event
			$bUpdateRow = $casescat->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($casescat->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($casescat->CancelMessage <> "") {
					$this->setMessage($casescat->CancelMessage);
					$casescat->CancelMessage = "";
				} else {
					$this->setMessage("操作已取消");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$casescat->Row_Updated($rsold, $rsnew);
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
