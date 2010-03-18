<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "casesinfo.php" ?>
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
$cases_edit = new ccases_edit();
$Page =& $cases_edit;

// Page init processing
$cases_edit->Page_Init();

// Page main processing
$cases_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var cases_edit = new ew_Page("cases_edit");

// page properties
cases_edit.PageID = "edit"; // page ID
var EW_PAGE_ID = cases_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
cases_edit.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_casetitle"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 案例标题");
		elm = fobj.elements["x" + infix + "_casepic"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, "不允许上传的文件类型");
		elm = fobj.elements["x" + infix + "_casedesc"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 案例描述");
		elm = fobj.elements["x" + infix + "_catid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 案例类型");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
cases_edit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
cases_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
cases_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">编辑 表: Cases<br><br>
<a href="<?php echo $cases->getReturnUrl() ?>">返回</a></span></p>
<?php $cases_edit->ShowMessage() ?>
<form name="fcasesedit" id="fcasesedit" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data">
<p>
<input type="hidden" name="a_table" id="a_table" value="cases">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($cases->id->Visible) { // id ?>
	<tr<?php echo $cases->id->RowAttributes ?>>
		<td class="ewTableHeader">案例ID</td>
		<td<?php echo $cases->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $cases->id->ViewAttributes() ?>><?php echo $cases->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($cases->id->CurrentValue) ?>">
</span><?php echo $cases->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cases->casetitle->Visible) { // casetitle ?>
	<tr<?php echo $cases->casetitle->RowAttributes ?>>
		<td class="ewTableHeader">案例标题<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $cases->casetitle->CellAttributes() ?>><span id="el_casetitle">
<input type="text" name="x_casetitle" id="x_casetitle" size="30" maxlength="200" value="<?php echo $cases->casetitle->EditValue ?>"<?php echo $cases->casetitle->EditAttributes() ?>>
</span><?php echo $cases->casetitle->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cases->casepic->Visible) { // casepic ?>
	<tr<?php echo $cases->casepic->RowAttributes ?>>
		<td class="ewTableHeader">案例图片<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $cases->casepic->CellAttributes() ?>><span id="el_casepic">
<div id="old_x_casepic">
<?php if ($cases->casepic->HrefValue <> "") { ?>
<?php if (!is_null($cases->casepic->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, EW_UPLOAD_DEST_PATH) . $cases->casepic->Upload->DbValue ?>" border=0<?php echo $cases->casepic->ViewAttributes() ?>>
<?php } elseif (!in_array($cases->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($cases->casepic->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, EW_UPLOAD_DEST_PATH) . $cases->casepic->Upload->DbValue ?>" border=0<?php echo $cases->casepic->ViewAttributes() ?>>
<?php } elseif (!in_array($cases->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_casepic">
<?php if (!is_null($cases->casepic->Upload->DbValue)) { ?>
<input type="radio" name="a_casepic" id="a_casepic" value="1" checked="checked">保持&nbsp;
<input type="radio" name="a_casepic" id="a_casepic" value="2">移除&nbsp;
<input type="radio" name="a_casepic" id="a_casepic" value="3">替换<br>
<?php } else { ?>
<input type="hidden" name="a_casepic" id="a_casepic" value="3">
<?php } ?>
<input type="file" name="x_casepic" id="x_casepic" onchange="if (this.form.a_casepic[2]) this.form.a_casepic[2].checked=true;"<?php echo $cases->casepic->EditAttributes() ?>>
</div>
</span><?php echo $cases->casepic->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cases->casedesc->Visible) { // casedesc ?>
	<tr<?php echo $cases->casedesc->RowAttributes ?>>
		<td class="ewTableHeader">案例描述<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $cases->casedesc->CellAttributes() ?>><span id="el_casedesc">
<textarea name="x_casedesc" id="x_casedesc" cols="35" rows="4"<?php echo $cases->casedesc->EditAttributes() ?>><?php echo $cases->casedesc->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_casedesc", function() {
	var sBasePath = 'fckeditor/';
	var oFCKeditor = new FCKeditor('x_casedesc', 35*_width_multiplier, 4*_height_multiplier);
	oFCKeditor.BasePath = sBasePath;
	oFCKeditor.ReplaceTextarea();
	this.active = true;
}));
-->
</script>
</span><?php echo $cases->casedesc->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cases->catid->Visible) { // catid ?>
	<tr<?php echo $cases->catid->RowAttributes ?>>
		<td class="ewTableHeader">案例类型<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $cases->catid->CellAttributes() ?>><span id="el_catid">
<select id="x_catid" name="x_catid"<?php echo $cases->catid->EditAttributes() ?>>
<?php
if (is_array($cases->catid->EditValue)) {
	$arwrk = $cases->catid->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($cases->catid->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $cases->catid->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="button" name="btnAction" id="btnAction" value="    编辑    " onclick="ew_SubmitForm(cases_edit, this.form);">
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
class ccases_edit {

	// Page ID
	var $PageID = 'edit';

	// Table Name
	var $TableName = 'cases';

	// Page Object Name
	var $PageObjName = 'cases_edit';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $cases;
		if ($cases->UseTokenInUrl) $PageUrl .= "t=" . $cases->TableVar . "&"; // add page token
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
		global $objForm, $cases;
		if ($cases->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($cases->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($cases->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccases_edit() {
		global $conn;

		// Initialize table object
		$GLOBALS["cases"] = new ccases();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cases', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $cases;

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
		global $objForm, $gsFormError, $cases;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$cases->id->setQueryStringValue($_GET["id"]);

		// Create form object
		$objForm = new cFormObj();
		if (@$_POST["a_edit"] <> "") {
			$cases->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->GetUploadFiles(); // Get upload files
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$cases->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$this->RestoreFormValues();
			}
		} else {
			$cases->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($cases->id->CurrentValue == "")
			$this->Page_Terminate("caseslist.php"); // Invalid key, return to list
		switch ($cases->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage("没有数据"); // No record found
					$this->Page_Terminate("caseslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$cases->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage("更新成功"); // Update success
					$sReturnUrl = $cases->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$cases->RowType = EW_ROWTYPE_EDIT; // Render as edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $cases;

		// Get upload data
			if ($cases->casepic->Upload->UploadFile()) {

				// No action required
			} else {
				echo $cases->casepic->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $cases;
		$cases->id->setFormValue($objForm->GetValue("x_id"));
		$cases->casetitle->setFormValue($objForm->GetValue("x_casetitle"));
		$cases->casedesc->setFormValue($objForm->GetValue("x_casedesc"));
		$cases->catid->setFormValue($objForm->GetValue("x_catid"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $cases;
		$this->LoadRow();
		$cases->id->CurrentValue = $cases->id->FormValue;
		$cases->casetitle->CurrentValue = $cases->casetitle->FormValue;
		$cases->casedesc->CurrentValue = $cases->casedesc->FormValue;
		$cases->catid->CurrentValue = $cases->catid->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $cases;
		$sFilter = $cases->KeyFilter();

		// Call Row Selecting event
		$cases->Row_Selecting($sFilter);

		// Load sql based on filter
		$cases->CurrentFilter = $sFilter;
		$sSql = $cases->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$cases->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $cases;
		$cases->id->setDbValue($rs->fields('id'));
		$cases->casetitle->setDbValue($rs->fields('casetitle'));
		$cases->casepic->Upload->DbValue = $rs->fields('casepic');
		$cases->casedesc->setDbValue($rs->fields('casedesc'));
		$cases->catid->setDbValue($rs->fields('catid'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $cases;

		// Call Row_Rendering event
		$cases->Row_Rendering();

		// Common render codes for all row types
		// id

		$cases->id->CellCssStyle = "";
		$cases->id->CellCssClass = "";

		// casetitle
		$cases->casetitle->CellCssStyle = "";
		$cases->casetitle->CellCssClass = "";

		// casepic
		$cases->casepic->CellCssStyle = "";
		$cases->casepic->CellCssClass = "";

		// casedesc
		$cases->casedesc->CellCssStyle = "";
		$cases->casedesc->CellCssClass = "";

		// catid
		$cases->catid->CellCssStyle = "";
		$cases->catid->CellCssClass = "";
		if ($cases->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$cases->id->ViewValue = $cases->id->CurrentValue;
			$cases->id->CssStyle = "";
			$cases->id->CssClass = "";
			$cases->id->ViewCustomAttributes = "";

			// casetitle
			$cases->casetitle->ViewValue = $cases->casetitle->CurrentValue;
			$cases->casetitle->CssStyle = "";
			$cases->casetitle->CssClass = "";
			$cases->casetitle->ViewCustomAttributes = "";

			// casepic
			if (!is_null($cases->casepic->Upload->DbValue)) {
				$cases->casepic->ViewValue = $cases->casepic->Upload->DbValue;
				$cases->casepic->ImageAlt = "";
			} else {
				$cases->casepic->ViewValue = "";
			}
			$cases->casepic->CssStyle = "";
			$cases->casepic->CssClass = "";
			$cases->casepic->ViewCustomAttributes = "";

			// casedesc
			$cases->casedesc->ViewValue = $cases->casedesc->CurrentValue;
			$cases->casedesc->CssStyle = "";
			$cases->casedesc->CssClass = "";
			$cases->casedesc->ViewCustomAttributes = "";

			// catid
			if (strval($cases->catid->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `catname` FROM `casescat` WHERE `id` = " . ew_AdjustSql($cases->catid->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$cases->catid->ViewValue = $rswrk->fields('catname');
					$rswrk->Close();
				} else {
					$cases->catid->ViewValue = $cases->catid->CurrentValue;
				}
			} else {
				$cases->catid->ViewValue = NULL;
			}
			$cases->catid->CssStyle = "";
			$cases->catid->CssClass = "";
			$cases->catid->ViewCustomAttributes = "";

			// id
			$cases->id->HrefValue = "";

			// casetitle
			$cases->casetitle->HrefValue = "";

			// casepic
			$cases->casepic->HrefValue = "";

			// casedesc
			$cases->casedesc->HrefValue = "";

			// catid
			$cases->catid->HrefValue = "";
		} elseif ($cases->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$cases->id->EditCustomAttributes = "";
			$cases->id->EditValue = $cases->id->CurrentValue;
			$cases->id->CssStyle = "";
			$cases->id->CssClass = "";
			$cases->id->ViewCustomAttributes = "";

			// casetitle
			$cases->casetitle->EditCustomAttributes = "";
			$cases->casetitle->EditValue = ew_HtmlEncode($cases->casetitle->CurrentValue);

			// casepic
			$cases->casepic->EditCustomAttributes = "";
			if (!is_null($cases->casepic->Upload->DbValue)) {
				$cases->casepic->EditValue = $cases->casepic->Upload->DbValue;
				$cases->casepic->ImageAlt = "";
			} else {
				$cases->casepic->EditValue = "";
			}

			// casedesc
			$cases->casedesc->EditCustomAttributes = "";
			$cases->casedesc->EditValue = ew_HtmlEncode($cases->casedesc->CurrentValue);

			// catid
			$cases->catid->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id`, `catname`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `casescat`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "请选择"));
			$cases->catid->EditValue = $arwrk;

			// Edit refer script
			// id

			$cases->id->HrefValue = "";

			// casetitle
			$cases->casetitle->HrefValue = "";

			// casepic
			$cases->casepic->HrefValue = "";

			// casedesc
			$cases->casedesc->HrefValue = "";

			// catid
			$cases->catid->HrefValue = "";
		}

		// Call Row Rendered event
		$cases->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $cases;

		// Initialize
		$gsFormError = "";
		if (!ew_CheckFileType($cases->casepic->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "不允许上传的文件类型";
		}
		if ($cases->casepic->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($cases->casepic->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "文件大小超过限制 (%s 字节)");
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($cases->casetitle->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 案例标题";
		}
		if ($cases->casedesc->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 案例描述";
		}
		if ($cases->catid->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 案例类型";
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
		global $conn, $Security, $cases;
		$sFilter = $cases->KeyFilter();
		$cases->CurrentFilter = $sFilter;
		$sSql = $cases->SQL();
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
			// Field casetitle

			$cases->casetitle->SetDbValueDef($cases->casetitle->CurrentValue, "");
			$rsnew['casetitle'] =& $cases->casetitle->DbValue;

			// Field casepic
			$cases->casepic->Upload->SaveToSession(); // Save file value to Session
			if ($cases->casepic->Upload->Action == "2" || $cases->casepic->Upload->Action == "3") { // Update/Remove
			$cases->casepic->Upload->DbValue = $rs->fields('casepic'); // Get original value
			if (is_null($cases->casepic->Upload->Value)) {
				$rsnew['casepic'] = NULL;
			} else {
				$rsnew['casepic'] = ew_UploadFileNameEx(ew_UploadPathEx(True, EW_UPLOAD_DEST_PATH), $cases->casepic->Upload->FileName);
			}
			}

			// Field casedesc
			$cases->casedesc->SetDbValueDef($cases->casedesc->CurrentValue, "");
			$rsnew['casedesc'] =& $cases->casedesc->DbValue;

			// Field catid
			$cases->catid->SetDbValueDef($cases->catid->CurrentValue, 0);
			$rsnew['catid'] =& $cases->catid->DbValue;

			// Call Row Updating event
			$bUpdateRow = $cases->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {

			// Field casepic
			if (!is_null($cases->casepic->Upload->Value)) {
				$cases->casepic->Upload->SaveToFile(EW_UPLOAD_DEST_PATH, $rsnew['casepic'], FALSE);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($cases->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($cases->CancelMessage <> "") {
					$this->setMessage($cases->CancelMessage);
					$cases->CancelMessage = "";
				} else {
					$this->setMessage("操作已取消");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$cases->Row_Updated($rsold, $rsnew);
		$rs->Close();

		// Field casepic
		$cases->casepic->Upload->RemoveFromSession(); // Remove file value from Session
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
