<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "consultinginfo.php" ?>
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
$consulting_edit = new cconsulting_edit();
$Page =& $consulting_edit;

// Page init processing
$consulting_edit->Page_Init();

// Page main processing
$consulting_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var consulting_edit = new ew_Page("consulting_edit");

// page properties
consulting_edit.PageID = "edit"; // page ID
var EW_PAGE_ID = consulting_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
consulting_edit.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_title"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 称呼");
		elm = fobj.elements["x" + infix + "_company"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 公司");
		elm = fobj.elements["x" + infix + "_phone"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 电话");
		elm = fobj.elements["x" + infix + "_content"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 内容");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
consulting_edit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
consulting_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
consulting_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
<script type="text/javascript">
<!--
_width_multiplier = 16;
_height_multiplier = 60;
var ew_DHTMLEditors = [];

// update value from editor to textarea
function ew_UpdateTextArea() {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof FCKeditorAPI != 'undefined') {			
			var inst;			
			for (inst in FCKeditorAPI.__Instances)
				FCKeditorAPI.__Instances[inst].UpdateLinkedField();
	}
}

// update value from textarea to editor
function ew_UpdateDHTMLEditor(name) {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof FCKeditorAPI != 'undefined') {
		var inst = FCKeditorAPI.GetInstance(name);		
		if (inst)
			inst.SetHTML(inst.LinkedField.value)
	}
}

// focus editor
function ew_FocusDHTMLEditor(name) {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof FCKeditorAPI != 'undefined') {
		var inst = FCKeditorAPI.GetInstance(name);	
		if (inst && inst.EditorWindow) {
			inst.EditorWindow.focus();
		}
	}
}

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker">编辑 表: Consulting<br><br>
<a href="<?php echo $consulting->getReturnUrl() ?>">返回</a></span></p>
<?php $consulting_edit->ShowMessage() ?>
<form name="fconsultingedit" id="fconsultingedit" action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="a_table" id="a_table" value="consulting">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($consulting->id->Visible) { // id ?>
	<tr<?php echo $consulting->id->RowAttributes ?>>
		<td class="ewTableHeader">咨询ID</td>
		<td<?php echo $consulting->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $consulting->id->ViewAttributes() ?>><?php echo $consulting->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($consulting->id->CurrentValue) ?>">
</span><?php echo $consulting->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($consulting->title->Visible) { // title ?>
	<tr<?php echo $consulting->title->RowAttributes ?>>
		<td class="ewTableHeader">称呼<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $consulting->title->CellAttributes() ?>><span id="el_title">
<input type="text" name="x_title" id="x_title" size="30" maxlength="200" value="<?php echo $consulting->title->EditValue ?>"<?php echo $consulting->title->EditAttributes() ?>>
</span><?php echo $consulting->title->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($consulting->company->Visible) { // company ?>
	<tr<?php echo $consulting->company->RowAttributes ?>>
		<td class="ewTableHeader">公司<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $consulting->company->CellAttributes() ?>><span id="el_company">
<input type="text" name="x_company" id="x_company" size="30" maxlength="200" value="<?php echo $consulting->company->EditValue ?>"<?php echo $consulting->company->EditAttributes() ?>>
</span><?php echo $consulting->company->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($consulting->phone->Visible) { // phone ?>
	<tr<?php echo $consulting->phone->RowAttributes ?>>
		<td class="ewTableHeader">电话<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $consulting->phone->CellAttributes() ?>><span id="el_phone">
<input type="text" name="x_phone" id="x_phone" size="30" maxlength="200" value="<?php echo $consulting->phone->EditValue ?>"<?php echo $consulting->phone->EditAttributes() ?>>
</span><?php echo $consulting->phone->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($consulting->content->Visible) { // content ?>
	<tr<?php echo $consulting->content->RowAttributes ?>>
		<td class="ewTableHeader">内容<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $consulting->content->CellAttributes() ?>><span id="el_content">
<textarea name="x_content" id="x_content" cols="35" rows="4"<?php echo $consulting->content->EditAttributes() ?>><?php echo $consulting->content->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_content", function() {
	var sBasePath = 'fckeditor/';
	var oFCKeditor = new FCKeditor('x_content', 35*_width_multiplier, 4*_height_multiplier);
	oFCKeditor.BasePath = sBasePath;
	oFCKeditor.ReplaceTextarea();
	this.active = true;
}));
-->
</script>
</span><?php echo $consulting->content->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="button" name="btnAction" id="btnAction" value="    编辑    " onclick="ew_SubmitForm(consulting_edit, this.form);">
</form>
<script type="text/javascript">
<!--
ew_CreateEditor();  // Create DHTML editor(s)

//-->
</script>
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
class cconsulting_edit {

	// Page ID
	var $PageID = 'edit';

	// Table Name
	var $TableName = 'consulting';

	// Page Object Name
	var $PageObjName = 'consulting_edit';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $consulting;
		if ($consulting->UseTokenInUrl) $PageUrl .= "t=" . $consulting->TableVar . "&"; // add page token
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
		global $objForm, $consulting;
		if ($consulting->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($consulting->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($consulting->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cconsulting_edit() {
		global $conn;

		// Initialize table object
		$GLOBALS["consulting"] = new cconsulting();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'consulting', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $consulting;

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
		global $objForm, $gsFormError, $consulting;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$consulting->id->setQueryStringValue($_GET["id"]);

		// Create form object
		$objForm = new cFormObj();
		if (@$_POST["a_edit"] <> "") {
			$consulting->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$consulting->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$this->RestoreFormValues();
			}
		} else {
			$consulting->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($consulting->id->CurrentValue == "")
			$this->Page_Terminate("consultinglist.php"); // Invalid key, return to list
		switch ($consulting->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage("没有数据"); // No record found
					$this->Page_Terminate("consultinglist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$consulting->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage("更新成功"); // Update success
					$sReturnUrl = $consulting->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$consulting->RowType = EW_ROWTYPE_EDIT; // Render as edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $consulting;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $consulting;
		$consulting->id->setFormValue($objForm->GetValue("x_id"));
		$consulting->title->setFormValue($objForm->GetValue("x_title"));
		$consulting->company->setFormValue($objForm->GetValue("x_company"));
		$consulting->phone->setFormValue($objForm->GetValue("x_phone"));
		$consulting->content->setFormValue($objForm->GetValue("x_content"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $consulting;
		$this->LoadRow();
		$consulting->id->CurrentValue = $consulting->id->FormValue;
		$consulting->title->CurrentValue = $consulting->title->FormValue;
		$consulting->company->CurrentValue = $consulting->company->FormValue;
		$consulting->phone->CurrentValue = $consulting->phone->FormValue;
		$consulting->content->CurrentValue = $consulting->content->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $consulting;
		$sFilter = $consulting->KeyFilter();

		// Call Row Selecting event
		$consulting->Row_Selecting($sFilter);

		// Load sql based on filter
		$consulting->CurrentFilter = $sFilter;
		$sSql = $consulting->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$consulting->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $consulting;
		$consulting->id->setDbValue($rs->fields('id'));
		$consulting->title->setDbValue($rs->fields('title'));
		$consulting->company->setDbValue($rs->fields('company'));
		$consulting->phone->setDbValue($rs->fields('phone'));
		$consulting->content->setDbValue($rs->fields('content'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $consulting;

		// Call Row_Rendering event
		$consulting->Row_Rendering();

		// Common render codes for all row types
		// id

		$consulting->id->CellCssStyle = "";
		$consulting->id->CellCssClass = "";

		// title
		$consulting->title->CellCssStyle = "";
		$consulting->title->CellCssClass = "";

		// company
		$consulting->company->CellCssStyle = "";
		$consulting->company->CellCssClass = "";

		// phone
		$consulting->phone->CellCssStyle = "";
		$consulting->phone->CellCssClass = "";

		// content
		$consulting->content->CellCssStyle = "";
		$consulting->content->CellCssClass = "";
		if ($consulting->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$consulting->id->ViewValue = $consulting->id->CurrentValue;
			$consulting->id->CssStyle = "";
			$consulting->id->CssClass = "";
			$consulting->id->ViewCustomAttributes = "";

			// title
			$consulting->title->ViewValue = $consulting->title->CurrentValue;
			$consulting->title->CssStyle = "";
			$consulting->title->CssClass = "";
			$consulting->title->ViewCustomAttributes = "";

			// company
			$consulting->company->ViewValue = $consulting->company->CurrentValue;
			$consulting->company->CssStyle = "";
			$consulting->company->CssClass = "";
			$consulting->company->ViewCustomAttributes = "";

			// phone
			$consulting->phone->ViewValue = $consulting->phone->CurrentValue;
			$consulting->phone->CssStyle = "";
			$consulting->phone->CssClass = "";
			$consulting->phone->ViewCustomAttributes = "";

			// content
			$consulting->content->ViewValue = $consulting->content->CurrentValue;
			$consulting->content->CssStyle = "";
			$consulting->content->CssClass = "";
			$consulting->content->ViewCustomAttributes = "";

			// id
			$consulting->id->HrefValue = "";

			// title
			$consulting->title->HrefValue = "";

			// company
			$consulting->company->HrefValue = "";

			// phone
			$consulting->phone->HrefValue = "";

			// content
			$consulting->content->HrefValue = "";
		} elseif ($consulting->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$consulting->id->EditCustomAttributes = "";
			$consulting->id->EditValue = $consulting->id->CurrentValue;
			$consulting->id->CssStyle = "";
			$consulting->id->CssClass = "";
			$consulting->id->ViewCustomAttributes = "";

			// title
			$consulting->title->EditCustomAttributes = "";
			$consulting->title->EditValue = ew_HtmlEncode($consulting->title->CurrentValue);

			// company
			$consulting->company->EditCustomAttributes = "";
			$consulting->company->EditValue = ew_HtmlEncode($consulting->company->CurrentValue);

			// phone
			$consulting->phone->EditCustomAttributes = "";
			$consulting->phone->EditValue = ew_HtmlEncode($consulting->phone->CurrentValue);

			// content
			$consulting->content->EditCustomAttributes = "";
			$consulting->content->EditValue = ew_HtmlEncode($consulting->content->CurrentValue);

			// Edit refer script
			// id

			$consulting->id->HrefValue = "";

			// title
			$consulting->title->HrefValue = "";

			// company
			$consulting->company->HrefValue = "";

			// phone
			$consulting->phone->HrefValue = "";

			// content
			$consulting->content->HrefValue = "";
		}

		// Call Row Rendered event
		$consulting->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $consulting;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($consulting->title->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 称呼";
		}
		if ($consulting->company->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 公司";
		}
		if ($consulting->phone->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 电话";
		}
		if ($consulting->content->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 内容";
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
		global $conn, $Security, $consulting;
		$sFilter = $consulting->KeyFilter();
		$consulting->CurrentFilter = $sFilter;
		$sSql = $consulting->SQL();
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
			// Field title

			$consulting->title->SetDbValueDef($consulting->title->CurrentValue, NULL);
			$rsnew['title'] =& $consulting->title->DbValue;

			// Field company
			$consulting->company->SetDbValueDef($consulting->company->CurrentValue, NULL);
			$rsnew['company'] =& $consulting->company->DbValue;

			// Field phone
			$consulting->phone->SetDbValueDef($consulting->phone->CurrentValue, NULL);
			$rsnew['phone'] =& $consulting->phone->DbValue;

			// Field content
			$consulting->content->SetDbValueDef($consulting->content->CurrentValue, NULL);
			$rsnew['content'] =& $consulting->content->DbValue;

			// Call Row Updating event
			$bUpdateRow = $consulting->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($consulting->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($consulting->CancelMessage <> "") {
					$this->setMessage($consulting->CancelMessage);
					$consulting->CancelMessage = "";
				} else {
					$this->setMessage("操作已取消");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$consulting->Row_Updated($rsold, $rsnew);
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
