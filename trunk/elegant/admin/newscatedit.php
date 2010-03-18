<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "newscatinfo.php" ?>
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
$newscat_edit = new cnewscat_edit();
$Page =& $newscat_edit;

// Page init processing
$newscat_edit->Page_Init();

// Page main processing
$newscat_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var newscat_edit = new ew_Page("newscat_edit");

// page properties
newscat_edit.PageID = "edit"; // page ID
var EW_PAGE_ID = newscat_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
newscat_edit.ValidateForm = function(fobj) {
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
newscat_edit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
newscat_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
newscat_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">编辑 表: Newscat<br><br>
<a href="<?php echo $newscat->getReturnUrl() ?>">返回</a></span></p>
<?php $newscat_edit->ShowMessage() ?>
<form name="fnewscatedit" id="fnewscatedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return newscat_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="newscat">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($newscat->id->Visible) { // id ?>
	<tr<?php echo $newscat->id->RowAttributes ?>>
		<td class="ewTableHeader">类型ID</td>
		<td<?php echo $newscat->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $newscat->id->ViewAttributes() ?>><?php echo $newscat->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($newscat->id->CurrentValue) ?>">
</span><?php echo $newscat->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($newscat->catname->Visible) { // catname ?>
	<tr<?php echo $newscat->catname->RowAttributes ?>>
		<td class="ewTableHeader">类型名称<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $newscat->catname->CellAttributes() ?>><span id="el_catname">
<input type="text" name="x_catname" id="x_catname" size="30" maxlength="200" value="<?php echo $newscat->catname->EditValue ?>"<?php echo $newscat->catname->EditAttributes() ?>>
</span><?php echo $newscat->catname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($newscat->catorder->Visible) { // catorder ?>
	<tr<?php echo $newscat->catorder->RowAttributes ?>>
		<td class="ewTableHeader">类型排序<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $newscat->catorder->CellAttributes() ?>><span id="el_catorder">
<input type="text" name="x_catorder" id="x_catorder" size="30" value="<?php echo $newscat->catorder->EditValue ?>"<?php echo $newscat->catorder->EditAttributes() ?>>
</span><?php echo $newscat->catorder->CustomMsg ?></td>
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
class cnewscat_edit {

	// Page ID
	var $PageID = 'edit';

	// Table Name
	var $TableName = 'newscat';

	// Page Object Name
	var $PageObjName = 'newscat_edit';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $newscat;
		if ($newscat->UseTokenInUrl) $PageUrl .= "t=" . $newscat->TableVar . "&"; // add page token
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
		global $objForm, $newscat;
		if ($newscat->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($newscat->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($newscat->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cnewscat_edit() {
		global $conn;

		// Initialize table object
		$GLOBALS["newscat"] = new cnewscat();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'newscat', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $newscat;

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
		global $objForm, $gsFormError, $newscat;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$newscat->id->setQueryStringValue($_GET["id"]);

		// Create form object
		$objForm = new cFormObj();
		if (@$_POST["a_edit"] <> "") {
			$newscat->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$newscat->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$this->RestoreFormValues();
			}
		} else {
			$newscat->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($newscat->id->CurrentValue == "")
			$this->Page_Terminate("newscatlist.php"); // Invalid key, return to list
		switch ($newscat->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage("没有数据"); // No record found
					$this->Page_Terminate("newscatlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$newscat->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage("更新成功"); // Update success
					$sReturnUrl = $newscat->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$newscat->RowType = EW_ROWTYPE_EDIT; // Render as edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $newscat;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $newscat;
		$newscat->id->setFormValue($objForm->GetValue("x_id"));
		$newscat->catname->setFormValue($objForm->GetValue("x_catname"));
		$newscat->catorder->setFormValue($objForm->GetValue("x_catorder"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $newscat;
		$this->LoadRow();
		$newscat->id->CurrentValue = $newscat->id->FormValue;
		$newscat->catname->CurrentValue = $newscat->catname->FormValue;
		$newscat->catorder->CurrentValue = $newscat->catorder->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $newscat;
		$sFilter = $newscat->KeyFilter();

		// Call Row Selecting event
		$newscat->Row_Selecting($sFilter);

		// Load sql based on filter
		$newscat->CurrentFilter = $sFilter;
		$sSql = $newscat->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$newscat->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $newscat;
		$newscat->id->setDbValue($rs->fields('id'));
		$newscat->catname->setDbValue($rs->fields('catname'));
		$newscat->catorder->setDbValue($rs->fields('catorder'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $newscat;

		// Call Row_Rendering event
		$newscat->Row_Rendering();

		// Common render codes for all row types
		// id

		$newscat->id->CellCssStyle = "";
		$newscat->id->CellCssClass = "";

		// catname
		$newscat->catname->CellCssStyle = "";
		$newscat->catname->CellCssClass = "";

		// catorder
		$newscat->catorder->CellCssStyle = "";
		$newscat->catorder->CellCssClass = "";
		if ($newscat->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$newscat->id->ViewValue = $newscat->id->CurrentValue;
			$newscat->id->CssStyle = "";
			$newscat->id->CssClass = "";
			$newscat->id->ViewCustomAttributes = "";

			// catname
			$newscat->catname->ViewValue = $newscat->catname->CurrentValue;
			$newscat->catname->CssStyle = "";
			$newscat->catname->CssClass = "";
			$newscat->catname->ViewCustomAttributes = "";

			// catorder
			$newscat->catorder->ViewValue = $newscat->catorder->CurrentValue;
			$newscat->catorder->CssStyle = "";
			$newscat->catorder->CssClass = "";
			$newscat->catorder->ViewCustomAttributes = "";

			// id
			$newscat->id->HrefValue = "";

			// catname
			$newscat->catname->HrefValue = "";

			// catorder
			$newscat->catorder->HrefValue = "";
		} elseif ($newscat->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$newscat->id->EditCustomAttributes = "";
			$newscat->id->EditValue = $newscat->id->CurrentValue;
			$newscat->id->CssStyle = "";
			$newscat->id->CssClass = "";
			$newscat->id->ViewCustomAttributes = "";

			// catname
			$newscat->catname->EditCustomAttributes = "";
			$newscat->catname->EditValue = ew_HtmlEncode($newscat->catname->CurrentValue);

			// catorder
			$newscat->catorder->EditCustomAttributes = "";
			$newscat->catorder->EditValue = ew_HtmlEncode($newscat->catorder->CurrentValue);

			// Edit refer script
			// id

			$newscat->id->HrefValue = "";

			// catname
			$newscat->catname->HrefValue = "";

			// catorder
			$newscat->catorder->HrefValue = "";
		}

		// Call Row Rendered event
		$newscat->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $newscat;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($newscat->catname->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 类型名称";
		}
		if ($newscat->catorder->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 类型排序";
		}
		if (!ew_CheckInteger($newscat->catorder->FormValue)) {
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
		global $conn, $Security, $newscat;
		$sFilter = $newscat->KeyFilter();
		$newscat->CurrentFilter = $sFilter;
		$sSql = $newscat->SQL();
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

			$newscat->catname->SetDbValueDef($newscat->catname->CurrentValue, NULL);
			$rsnew['catname'] =& $newscat->catname->DbValue;

			// Field catorder
			$newscat->catorder->SetDbValueDef($newscat->catorder->CurrentValue, NULL);
			$rsnew['catorder'] =& $newscat->catorder->DbValue;

			// Call Row Updating event
			$bUpdateRow = $newscat->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($newscat->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($newscat->CancelMessage <> "") {
					$this->setMessage($newscat->CancelMessage);
					$newscat->CancelMessage = "";
				} else {
					$this->setMessage("操作已取消");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$newscat->Row_Updated($rsold, $rsnew);
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
