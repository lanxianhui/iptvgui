<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "servicecatinfo.php" ?>
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
$servicecat_edit = new cservicecat_edit();
$Page =& $servicecat_edit;

// Page init processing
$servicecat_edit->Page_Init();

// Page main processing
$servicecat_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var servicecat_edit = new ew_Page("servicecat_edit");

// page properties
servicecat_edit.PageID = "edit"; // page ID
var EW_PAGE_ID = servicecat_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
servicecat_edit.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, "必填项 - 类型名字");
		elm = fobj.elements["x" + infix + "_rootid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 所属根类型");
		elm = fobj.elements["x" + infix + "_catdesc"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 类型描述");
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
servicecat_edit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
servicecat_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
servicecat_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
servicecat_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">编辑 表: Servicecat<br><br>
<a href="<?php echo $servicecat->getReturnUrl() ?>">返回</a></span></p>
<?php $servicecat_edit->ShowMessage() ?>
<form name="fservicecatedit" id="fservicecatedit" action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="a_table" id="a_table" value="servicecat">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($servicecat->id->Visible) { // id ?>
	<tr<?php echo $servicecat->id->RowAttributes ?>>
		<td class="ewTableHeader">类型ID</td>
		<td<?php echo $servicecat->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $servicecat->id->ViewAttributes() ?>><?php echo $servicecat->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($servicecat->id->CurrentValue) ?>">
</span><?php echo $servicecat->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($servicecat->catname->Visible) { // catname ?>
	<tr<?php echo $servicecat->catname->RowAttributes ?>>
		<td class="ewTableHeader">类型名字<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $servicecat->catname->CellAttributes() ?>><span id="el_catname">
<input type="text" name="x_catname" id="x_catname" size="30" maxlength="200" value="<?php echo $servicecat->catname->EditValue ?>"<?php echo $servicecat->catname->EditAttributes() ?>>
</span><?php echo $servicecat->catname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($servicecat->rootid->Visible) { // rootid ?>
	<tr<?php echo $servicecat->rootid->RowAttributes ?>>
		<td class="ewTableHeader">所属根类型<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $servicecat->rootid->CellAttributes() ?>><span id="el_rootid">
<select id="x_rootid" name="x_rootid"<?php echo $servicecat->rootid->EditAttributes() ?>>
<?php
if (is_array($servicecat->rootid->EditValue)) {
	$arwrk = $servicecat->rootid->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($servicecat->rootid->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $servicecat->rootid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($servicecat->catdesc->Visible) { // catdesc ?>
	<tr<?php echo $servicecat->catdesc->RowAttributes ?>>
		<td class="ewTableHeader">类型描述<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $servicecat->catdesc->CellAttributes() ?>><span id="el_catdesc">
<textarea name="x_catdesc" id="x_catdesc" cols="35" rows="4"<?php echo $servicecat->catdesc->EditAttributes() ?>><?php echo $servicecat->catdesc->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_catdesc", function() {
	var sBasePath = 'fckeditor/';
	var oFCKeditor = new FCKeditor('x_catdesc', 35*_width_multiplier, 4*_height_multiplier);
	oFCKeditor.BasePath = sBasePath;
	oFCKeditor.ReplaceTextarea();
	this.active = true;
}));
-->
</script>
</span><?php echo $servicecat->catdesc->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($servicecat->catorder->Visible) { // catorder ?>
	<tr<?php echo $servicecat->catorder->RowAttributes ?>>
		<td class="ewTableHeader">类型排序<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $servicecat->catorder->CellAttributes() ?>><span id="el_catorder">
<input type="text" name="x_catorder" id="x_catorder" size="30" value="<?php echo $servicecat->catorder->EditValue ?>"<?php echo $servicecat->catorder->EditAttributes() ?>>
</span><?php echo $servicecat->catorder->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="button" name="btnAction" id="btnAction" value="    编辑    " onclick="ew_SubmitForm(servicecat_edit, this.form);">
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
class cservicecat_edit {

	// Page ID
	var $PageID = 'edit';

	// Table Name
	var $TableName = 'servicecat';

	// Page Object Name
	var $PageObjName = 'servicecat_edit';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $servicecat;
		if ($servicecat->UseTokenInUrl) $PageUrl .= "t=" . $servicecat->TableVar . "&"; // add page token
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
		global $objForm, $servicecat;
		if ($servicecat->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($servicecat->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($servicecat->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cservicecat_edit() {
		global $conn;

		// Initialize table object
		$GLOBALS["servicecat"] = new cservicecat();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'servicecat', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $servicecat;
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
		global $objForm, $gsFormError, $servicecat;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$servicecat->id->setQueryStringValue($_GET["id"]);

		// Create form object
		$objForm = new cFormObj();
		if (@$_POST["a_edit"] <> "") {
			$servicecat->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$servicecat->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$this->RestoreFormValues();
			}
		} else {
			$servicecat->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($servicecat->id->CurrentValue == "")
			$this->Page_Terminate("servicecatlist.php"); // Invalid key, return to list
		switch ($servicecat->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage("没有数据"); // No record found
					$this->Page_Terminate("servicecatlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$servicecat->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage("更新成功"); // Update success
					$sReturnUrl = $servicecat->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "servicecatview.php")
						$sReturnUrl = $servicecat->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$servicecat->RowType = EW_ROWTYPE_EDIT; // Render as edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $servicecat;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $servicecat;
		$servicecat->id->setFormValue($objForm->GetValue("x_id"));
		$servicecat->catname->setFormValue($objForm->GetValue("x_catname"));
		$servicecat->rootid->setFormValue($objForm->GetValue("x_rootid"));
		$servicecat->catdesc->setFormValue($objForm->GetValue("x_catdesc"));
		$servicecat->catorder->setFormValue($objForm->GetValue("x_catorder"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $servicecat;
		$this->LoadRow();
		$servicecat->id->CurrentValue = $servicecat->id->FormValue;
		$servicecat->catname->CurrentValue = $servicecat->catname->FormValue;
		$servicecat->rootid->CurrentValue = $servicecat->rootid->FormValue;
		$servicecat->catdesc->CurrentValue = $servicecat->catdesc->FormValue;
		$servicecat->catorder->CurrentValue = $servicecat->catorder->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $servicecat;
		$sFilter = $servicecat->KeyFilter();

		// Call Row Selecting event
		$servicecat->Row_Selecting($sFilter);

		// Load sql based on filter
		$servicecat->CurrentFilter = $sFilter;
		$sSql = $servicecat->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$servicecat->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $servicecat;
		$servicecat->id->setDbValue($rs->fields('id'));
		$servicecat->catname->setDbValue($rs->fields('catname'));
		$servicecat->rootid->setDbValue($rs->fields('rootid'));
		$servicecat->catdesc->setDbValue($rs->fields('catdesc'));
		$servicecat->catorder->setDbValue($rs->fields('catorder'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $servicecat;

		// Call Row_Rendering event
		$servicecat->Row_Rendering();

		// Common render codes for all row types
		// id

		$servicecat->id->CellCssStyle = "";
		$servicecat->id->CellCssClass = "";

		// catname
		$servicecat->catname->CellCssStyle = "";
		$servicecat->catname->CellCssClass = "";

		// rootid
		$servicecat->rootid->CellCssStyle = "";
		$servicecat->rootid->CellCssClass = "";

		// catdesc
		$servicecat->catdesc->CellCssStyle = "";
		$servicecat->catdesc->CellCssClass = "";

		// catorder
		$servicecat->catorder->CellCssStyle = "";
		$servicecat->catorder->CellCssClass = "";
		if ($servicecat->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$servicecat->id->ViewValue = $servicecat->id->CurrentValue;
			$servicecat->id->CssStyle = "";
			$servicecat->id->CssClass = "";
			$servicecat->id->ViewCustomAttributes = "";

			// catname
			$servicecat->catname->ViewValue = $servicecat->catname->CurrentValue;
			$servicecat->catname->CssStyle = "";
			$servicecat->catname->CssClass = "";
			$servicecat->catname->ViewCustomAttributes = "";

			// rootid
			if (strval($servicecat->rootid->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `rootname` FROM `serviceroot` WHERE `id` = " . ew_AdjustSql($servicecat->rootid->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$servicecat->rootid->ViewValue = $rswrk->fields('rootname');
					$rswrk->Close();
				} else {
					$servicecat->rootid->ViewValue = $servicecat->rootid->CurrentValue;
				}
			} else {
				$servicecat->rootid->ViewValue = NULL;
			}
			$servicecat->rootid->CssStyle = "";
			$servicecat->rootid->CssClass = "";
			$servicecat->rootid->ViewCustomAttributes = "";

			// catdesc
			$servicecat->catdesc->ViewValue = $servicecat->catdesc->CurrentValue;
			$servicecat->catdesc->CssStyle = "";
			$servicecat->catdesc->CssClass = "";
			$servicecat->catdesc->ViewCustomAttributes = "";

			// catorder
			$servicecat->catorder->ViewValue = $servicecat->catorder->CurrentValue;
			$servicecat->catorder->CssStyle = "";
			$servicecat->catorder->CssClass = "";
			$servicecat->catorder->ViewCustomAttributes = "";

			// id
			$servicecat->id->HrefValue = "";

			// catname
			$servicecat->catname->HrefValue = "";

			// rootid
			$servicecat->rootid->HrefValue = "";

			// catdesc
			$servicecat->catdesc->HrefValue = "";

			// catorder
			$servicecat->catorder->HrefValue = "";
		} elseif ($servicecat->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$servicecat->id->EditCustomAttributes = "";
			$servicecat->id->EditValue = $servicecat->id->CurrentValue;
			$servicecat->id->CssStyle = "";
			$servicecat->id->CssClass = "";
			$servicecat->id->ViewCustomAttributes = "";

			// catname
			$servicecat->catname->EditCustomAttributes = "";
			$servicecat->catname->EditValue = ew_HtmlEncode($servicecat->catname->CurrentValue);

			// rootid
			$servicecat->rootid->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id`, `rootname`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `serviceroot`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "请选择"));
			$servicecat->rootid->EditValue = $arwrk;

			// catdesc
			$servicecat->catdesc->EditCustomAttributes = "";
			$servicecat->catdesc->EditValue = ew_HtmlEncode($servicecat->catdesc->CurrentValue);

			// catorder
			$servicecat->catorder->EditCustomAttributes = "";
			$servicecat->catorder->EditValue = ew_HtmlEncode($servicecat->catorder->CurrentValue);

			// Edit refer script
			// id

			$servicecat->id->HrefValue = "";

			// catname
			$servicecat->catname->HrefValue = "";

			// rootid
			$servicecat->rootid->HrefValue = "";

			// catdesc
			$servicecat->catdesc->HrefValue = "";

			// catorder
			$servicecat->catorder->HrefValue = "";
		}

		// Call Row Rendered event
		$servicecat->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $servicecat;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($servicecat->catname->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 类型名字";
		}
		if ($servicecat->rootid->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 所属根类型";
		}
		if ($servicecat->catdesc->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 类型描述";
		}
		if ($servicecat->catorder->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 类型排序";
		}
		if (!ew_CheckInteger($servicecat->catorder->FormValue)) {
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
		global $conn, $Security, $servicecat;
		$sFilter = $servicecat->KeyFilter();
		$servicecat->CurrentFilter = $sFilter;
		$sSql = $servicecat->SQL();
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

			$servicecat->catname->SetDbValueDef($servicecat->catname->CurrentValue, NULL);
			$rsnew['catname'] =& $servicecat->catname->DbValue;

			// Field rootid
			$servicecat->rootid->SetDbValueDef($servicecat->rootid->CurrentValue, NULL);
			$rsnew['rootid'] =& $servicecat->rootid->DbValue;

			// Field catdesc
			$servicecat->catdesc->SetDbValueDef($servicecat->catdesc->CurrentValue, NULL);
			$rsnew['catdesc'] =& $servicecat->catdesc->DbValue;

			// Field catorder
			$servicecat->catorder->SetDbValueDef($servicecat->catorder->CurrentValue, NULL);
			$rsnew['catorder'] =& $servicecat->catorder->DbValue;

			// Call Row Updating event
			$bUpdateRow = $servicecat->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($servicecat->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($servicecat->CancelMessage <> "") {
					$this->setMessage($servicecat->CancelMessage);
					$servicecat->CancelMessage = "";
				} else {
					$this->setMessage("操作已取消");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$servicecat->Row_Updated($rsold, $rsnew);
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
