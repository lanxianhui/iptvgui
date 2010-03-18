<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "srvicerootinfo.php" ?>
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
$srviceroot_edit = new csrviceroot_edit();
$Page =& $srviceroot_edit;

// Page init processing
$srviceroot_edit->Page_Init();

// Page main processing
$srviceroot_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var srviceroot_edit = new ew_Page("srviceroot_edit");

// page properties
srviceroot_edit.PageID = "edit"; // page ID
var EW_PAGE_ID = srviceroot_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
srviceroot_edit.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, "必填项 - 根类型排序");
		elm = fobj.elements["x" + infix + "_rootorder"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "错误的 Integer - 根类型排序");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
srviceroot_edit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
srviceroot_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
srviceroot_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">编辑 表: Srviceroot<br><br>
<a href="<?php echo $srviceroot->getReturnUrl() ?>">返回</a></span></p>
<?php $srviceroot_edit->ShowMessage() ?>
<form name="fsrvicerootedit" id="fsrvicerootedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return srviceroot_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="srviceroot">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($srviceroot->id->Visible) { // id ?>
	<tr<?php echo $srviceroot->id->RowAttributes ?>>
		<td class="ewTableHeader">根ID</td>
		<td<?php echo $srviceroot->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $srviceroot->id->ViewAttributes() ?>><?php echo $srviceroot->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($srviceroot->id->CurrentValue) ?>">
</span><?php echo $srviceroot->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($srviceroot->rootname->Visible) { // rootname ?>
	<tr<?php echo $srviceroot->rootname->RowAttributes ?>>
		<td class="ewTableHeader">根类型名<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $srviceroot->rootname->CellAttributes() ?>><span id="el_rootname">
<input type="text" name="x_rootname" id="x_rootname" size="30" maxlength="200" value="<?php echo $srviceroot->rootname->EditValue ?>"<?php echo $srviceroot->rootname->EditAttributes() ?>>
</span><?php echo $srviceroot->rootname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($srviceroot->rootorder->Visible) { // rootorder ?>
	<tr<?php echo $srviceroot->rootorder->RowAttributes ?>>
		<td class="ewTableHeader">根类型排序<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $srviceroot->rootorder->CellAttributes() ?>><span id="el_rootorder">
<input type="text" name="x_rootorder" id="x_rootorder" size="30" value="<?php echo $srviceroot->rootorder->EditValue ?>"<?php echo $srviceroot->rootorder->EditAttributes() ?>>
</span><?php echo $srviceroot->rootorder->CustomMsg ?></td>
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
class csrviceroot_edit {

	// Page ID
	var $PageID = 'edit';

	// Table Name
	var $TableName = 'srviceroot';

	// Page Object Name
	var $PageObjName = 'srviceroot_edit';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $srviceroot;
		if ($srviceroot->UseTokenInUrl) $PageUrl .= "t=" . $srviceroot->TableVar . "&"; // add page token
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
		global $objForm, $srviceroot;
		if ($srviceroot->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($srviceroot->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($srviceroot->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function csrviceroot_edit() {
		global $conn;

		// Initialize table object
		$GLOBALS["srviceroot"] = new csrviceroot();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'srviceroot', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $srviceroot;

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
		global $objForm, $gsFormError, $srviceroot;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$srviceroot->id->setQueryStringValue($_GET["id"]);

		// Create form object
		$objForm = new cFormObj();
		if (@$_POST["a_edit"] <> "") {
			$srviceroot->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$srviceroot->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$this->RestoreFormValues();
			}
		} else {
			$srviceroot->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($srviceroot->id->CurrentValue == "")
			$this->Page_Terminate("srvicerootlist.php"); // Invalid key, return to list
		switch ($srviceroot->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage("没有数据"); // No record found
					$this->Page_Terminate("srvicerootlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$srviceroot->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage("更新成功"); // Update success
					$sReturnUrl = $srviceroot->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$srviceroot->RowType = EW_ROWTYPE_EDIT; // Render as edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $srviceroot;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $srviceroot;
		$srviceroot->id->setFormValue($objForm->GetValue("x_id"));
		$srviceroot->rootname->setFormValue($objForm->GetValue("x_rootname"));
		$srviceroot->rootorder->setFormValue($objForm->GetValue("x_rootorder"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $srviceroot;
		$this->LoadRow();
		$srviceroot->id->CurrentValue = $srviceroot->id->FormValue;
		$srviceroot->rootname->CurrentValue = $srviceroot->rootname->FormValue;
		$srviceroot->rootorder->CurrentValue = $srviceroot->rootorder->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $srviceroot;
		$sFilter = $srviceroot->KeyFilter();

		// Call Row Selecting event
		$srviceroot->Row_Selecting($sFilter);

		// Load sql based on filter
		$srviceroot->CurrentFilter = $sFilter;
		$sSql = $srviceroot->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$srviceroot->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $srviceroot;
		$srviceroot->id->setDbValue($rs->fields('id'));
		$srviceroot->rootname->setDbValue($rs->fields('rootname'));
		$srviceroot->rootorder->setDbValue($rs->fields('rootorder'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $srviceroot;

		// Call Row_Rendering event
		$srviceroot->Row_Rendering();

		// Common render codes for all row types
		// id

		$srviceroot->id->CellCssStyle = "";
		$srviceroot->id->CellCssClass = "";

		// rootname
		$srviceroot->rootname->CellCssStyle = "";
		$srviceroot->rootname->CellCssClass = "";

		// rootorder
		$srviceroot->rootorder->CellCssStyle = "";
		$srviceroot->rootorder->CellCssClass = "";
		if ($srviceroot->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$srviceroot->id->ViewValue = $srviceroot->id->CurrentValue;
			$srviceroot->id->CssStyle = "";
			$srviceroot->id->CssClass = "";
			$srviceroot->id->ViewCustomAttributes = "";

			// rootname
			$srviceroot->rootname->ViewValue = $srviceroot->rootname->CurrentValue;
			$srviceroot->rootname->CssStyle = "";
			$srviceroot->rootname->CssClass = "";
			$srviceroot->rootname->ViewCustomAttributes = "";

			// rootorder
			$srviceroot->rootorder->ViewValue = $srviceroot->rootorder->CurrentValue;
			$srviceroot->rootorder->CssStyle = "";
			$srviceroot->rootorder->CssClass = "";
			$srviceroot->rootorder->ViewCustomAttributes = "";

			// id
			$srviceroot->id->HrefValue = "";

			// rootname
			$srviceroot->rootname->HrefValue = "";

			// rootorder
			$srviceroot->rootorder->HrefValue = "";
		} elseif ($srviceroot->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$srviceroot->id->EditCustomAttributes = "";
			$srviceroot->id->EditValue = $srviceroot->id->CurrentValue;
			$srviceroot->id->CssStyle = "";
			$srviceroot->id->CssClass = "";
			$srviceroot->id->ViewCustomAttributes = "";

			// rootname
			$srviceroot->rootname->EditCustomAttributes = "";
			$srviceroot->rootname->EditValue = ew_HtmlEncode($srviceroot->rootname->CurrentValue);

			// rootorder
			$srviceroot->rootorder->EditCustomAttributes = "";
			$srviceroot->rootorder->EditValue = ew_HtmlEncode($srviceroot->rootorder->CurrentValue);

			// Edit refer script
			// id

			$srviceroot->id->HrefValue = "";

			// rootname
			$srviceroot->rootname->HrefValue = "";

			// rootorder
			$srviceroot->rootorder->HrefValue = "";
		}

		// Call Row Rendered event
		$srviceroot->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $srviceroot;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($srviceroot->rootname->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 根类型名";
		}
		if ($srviceroot->rootorder->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 根类型排序";
		}
		if (!ew_CheckInteger($srviceroot->rootorder->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "错误的 Integer - 根类型排序";
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
		global $conn, $Security, $srviceroot;
		$sFilter = $srviceroot->KeyFilter();
		$srviceroot->CurrentFilter = $sFilter;
		$sSql = $srviceroot->SQL();
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

			$srviceroot->rootname->SetDbValueDef($srviceroot->rootname->CurrentValue, NULL);
			$rsnew['rootname'] =& $srviceroot->rootname->DbValue;

			// Field rootorder
			$srviceroot->rootorder->SetDbValueDef($srviceroot->rootorder->CurrentValue, NULL);
			$rsnew['rootorder'] =& $srviceroot->rootorder->DbValue;

			// Call Row Updating event
			$bUpdateRow = $srviceroot->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($srviceroot->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($srviceroot->CancelMessage <> "") {
					$this->setMessage($srviceroot->CancelMessage);
					$srviceroot->CancelMessage = "";
				} else {
					$this->setMessage("操作已取消");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$srviceroot->Row_Updated($rsold, $rsnew);
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
