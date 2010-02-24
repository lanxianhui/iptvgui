<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "expertinfo.php" ?>
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
$expert_add = new cexpert_add();
$Page =& $expert_add;

// Page init processing
$expert_add->Page_Init();

// Page main processing
$expert_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var expert_add = new ew_Page("expert_add");

// page properties
expert_add.PageID = "add"; // page ID
var EW_PAGE_ID = expert_add.PageID; // for backward compatibility

// extend page with ValidateForm function
expert_add.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_username"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 专家姓名");
		elm = fobj.elements["x" + infix + "_title"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 专家头衔");
		elm = fobj.elements["x" + infix + "_userpic"];
		aelm = fobj.elements["a" + infix + "_userpic"];
		var chk_userpic = (aelm && aelm[0])?(aelm[2].checked):true;
		if (elm && chk_userpic && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 专家头像");
		elm = fobj.elements["x" + infix + "_userpic"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, "不允许上传的文件类型");
		elm = fobj.elements["x" + infix + "_userdesc"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 专家描述");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
expert_add.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
expert_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
expert_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
expert_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">添加到 表: Expert<br><br>
<a href="<?php echo $expert->getReturnUrl() ?>">返回</a></span></p>
<?php $expert_add->ShowMessage() ?>
<form name="fexpertadd" id="fexpertadd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return expert_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="expert">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($expert->username->Visible) { // username ?>
	<tr<?php echo $expert->username->RowAttributes ?>>
		<td class="ewTableHeader">专家姓名<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $expert->username->CellAttributes() ?>><span id="el_username">
<input type="text" name="x_username" id="x_username" size="30" maxlength="200" value="<?php echo $expert->username->EditValue ?>"<?php echo $expert->username->EditAttributes() ?>>
</span><?php echo $expert->username->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expert->title->Visible) { // title ?>
	<tr<?php echo $expert->title->RowAttributes ?>>
		<td class="ewTableHeader">专家头衔<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $expert->title->CellAttributes() ?>><span id="el_title">
<input type="text" name="x_title" id="x_title" size="30" maxlength="200" value="<?php echo $expert->title->EditValue ?>"<?php echo $expert->title->EditAttributes() ?>>
</span><?php echo $expert->title->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expert->userpic->Visible) { // userpic ?>
	<tr<?php echo $expert->userpic->RowAttributes ?>>
		<td class="ewTableHeader">专家头像<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $expert->userpic->CellAttributes() ?>><span id="el_userpic">
<input type="file" name="x_userpic" id="x_userpic"<?php echo $expert->userpic->EditAttributes() ?>>
</div>
</span><?php echo $expert->userpic->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expert->userdesc->Visible) { // userdesc ?>
	<tr<?php echo $expert->userdesc->RowAttributes ?>>
		<td class="ewTableHeader">专家描述<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $expert->userdesc->CellAttributes() ?>><span id="el_userdesc">
<textarea name="x_userdesc" id="x_userdesc" cols="35" rows="4"<?php echo $expert->userdesc->EditAttributes() ?>><?php echo $expert->userdesc->EditValue ?></textarea>
</span><?php echo $expert->userdesc->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="    添加    ">
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
class cexpert_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'expert';

	// Page Object Name
	var $PageObjName = 'expert_add';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $expert;
		if ($expert->UseTokenInUrl) $PageUrl .= "t=" . $expert->TableVar . "&"; // add page token
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
		global $objForm, $expert;
		if ($expert->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($expert->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($expert->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cexpert_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["expert"] = new cexpert();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'expert', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $expert;
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
	var $x_ewPriv = 0;

	// 
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsFormError, $expert;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $expert->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $expert->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->GetUploadFiles(); // Get upload files
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$expert->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $expert->CurrentAction = "C"; // Copy Record
		  } else {
		    $expert->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($expert->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("没有数据"); // No record found
		      $this->Page_Terminate("expertlist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$expert->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("添加成功"); // Set up success message
					$sReturnUrl = $expert->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "expertview.php")
						$sReturnUrl = $expert->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$expert->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $expert;

		// Get upload data
			if ($expert->userpic->Upload->UploadFile()) {

				// No action required
			} else {
				echo $expert->userpic->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load default values
	function LoadDefaultValues() {
		global $expert;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $expert;
		$expert->username->setFormValue($objForm->GetValue("x_username"));
		$expert->title->setFormValue($objForm->GetValue("x_title"));
		$expert->userdesc->setFormValue($objForm->GetValue("x_userdesc"));
		$expert->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $expert;
		$expert->id->CurrentValue = $expert->id->FormValue;
		$expert->username->CurrentValue = $expert->username->FormValue;
		$expert->title->CurrentValue = $expert->title->FormValue;
		$expert->userdesc->CurrentValue = $expert->userdesc->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $expert;
		$sFilter = $expert->KeyFilter();

		// Call Row Selecting event
		$expert->Row_Selecting($sFilter);

		// Load sql based on filter
		$expert->CurrentFilter = $sFilter;
		$sSql = $expert->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$expert->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $expert;
		$expert->id->setDbValue($rs->fields('id'));
		$expert->username->setDbValue($rs->fields('username'));
		$expert->title->setDbValue($rs->fields('title'));
		$expert->userpic->Upload->DbValue = $rs->fields('userpic');
		$expert->userdesc->setDbValue($rs->fields('userdesc'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $expert;

		// Call Row_Rendering event
		$expert->Row_Rendering();

		// Common render codes for all row types
		// username

		$expert->username->CellCssStyle = "";
		$expert->username->CellCssClass = "";

		// title
		$expert->title->CellCssStyle = "";
		$expert->title->CellCssClass = "";

		// userpic
		$expert->userpic->CellCssStyle = "";
		$expert->userpic->CellCssClass = "";

		// userdesc
		$expert->userdesc->CellCssStyle = "";
		$expert->userdesc->CellCssClass = "";
		if ($expert->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$expert->id->ViewValue = $expert->id->CurrentValue;
			$expert->id->CssStyle = "";
			$expert->id->CssClass = "";
			$expert->id->ViewCustomAttributes = "";

			// username
			$expert->username->ViewValue = $expert->username->CurrentValue;
			$expert->username->CssStyle = "";
			$expert->username->CssClass = "";
			$expert->username->ViewCustomAttributes = "";

			// title
			$expert->title->ViewValue = $expert->title->CurrentValue;
			$expert->title->CssStyle = "";
			$expert->title->CssClass = "";
			$expert->title->ViewCustomAttributes = "";

			// userpic
			if (!is_null($expert->userpic->Upload->DbValue)) {
				$expert->userpic->ViewValue = $expert->userpic->Upload->DbValue;
				$expert->userpic->ImageWidth = 160;
				$expert->userpic->ImageHeight = 200;
				$expert->userpic->ImageAlt = "";
			} else {
				$expert->userpic->ViewValue = "";
			}
			$expert->userpic->CssStyle = "";
			$expert->userpic->CssClass = "";
			$expert->userpic->ViewCustomAttributes = "";

			// userdesc
			$expert->userdesc->ViewValue = $expert->userdesc->CurrentValue;
			$expert->userdesc->CssStyle = "";
			$expert->userdesc->CssClass = "";
			$expert->userdesc->ViewCustomAttributes = "";

			// username
			$expert->username->HrefValue = "";

			// title
			$expert->title->HrefValue = "";

			// userpic
			$expert->userpic->HrefValue = "";

			// userdesc
			$expert->userdesc->HrefValue = "";
		} elseif ($expert->RowType == EW_ROWTYPE_ADD) { // Add row

			// username
			$expert->username->EditCustomAttributes = "";
			$expert->username->EditValue = ew_HtmlEncode($expert->username->CurrentValue);

			// title
			$expert->title->EditCustomAttributes = "";
			$expert->title->EditValue = ew_HtmlEncode($expert->title->CurrentValue);

			// userpic
			$expert->userpic->EditCustomAttributes = "";
			if (!is_null($expert->userpic->Upload->DbValue)) {
				$expert->userpic->EditValue = $expert->userpic->Upload->DbValue;
				$expert->userpic->ImageWidth = 160;
				$expert->userpic->ImageHeight = 200;
				$expert->userpic->ImageAlt = "";
			} else {
				$expert->userpic->EditValue = "";
			}

			// userdesc
			$expert->userdesc->EditCustomAttributes = "";
			$expert->userdesc->EditValue = ew_HtmlEncode($expert->userdesc->CurrentValue);
		}

		// Call Row Rendered event
		$expert->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $expert;

		// Initialize
		$gsFormError = "";
		if (!ew_CheckFileType($expert->userpic->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "不允许上传的文件类型";
		}
		if ($expert->userpic->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($expert->userpic->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "文件大小超过限制 (%s 字节)");
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($expert->username->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 专家姓名";
		}
		if ($expert->title->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 专家头衔";
		}
		if (is_null($expert->userpic->Upload->Value)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 专家头像";
		}
		if ($expert->userdesc->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 专家描述";
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

	// Add record
	function AddRow() {
		global $conn, $Security, $expert;
		$rsnew = array();

		// Field username
		$expert->username->SetDbValueDef($expert->username->CurrentValue, "");
		$rsnew['username'] =& $expert->username->DbValue;

		// Field title
		$expert->title->SetDbValueDef($expert->title->CurrentValue, "");
		$rsnew['title'] =& $expert->title->DbValue;

		// Field userpic
		$expert->userpic->Upload->SaveToSession(); // Save file value to Session
		if (is_null($expert->userpic->Upload->Value)) {
			$rsnew['userpic'] = NULL;
		} else {
			$rsnew['userpic'] = ew_UploadFileNameEx(ew_UploadPathEx(True, EW_UPLOAD_DEST_PATH), $expert->userpic->Upload->FileName);
		}

		// Field userdesc
		$expert->userdesc->SetDbValueDef($expert->userdesc->CurrentValue, "");
		$rsnew['userdesc'] =& $expert->userdesc->DbValue;

		// Call Row Inserting event
		$bInsertRow = $expert->Row_Inserting($rsnew);
		if ($bInsertRow) {

			// Field userpic
			if (!is_null($expert->userpic->Upload->Value)) {
				$expert->userpic->Upload->SaveToFile(EW_UPLOAD_DEST_PATH, $rsnew['userpic'], FALSE);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($expert->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($expert->CancelMessage <> "") {
				$this->setMessage($expert->CancelMessage);
				$expert->CancelMessage = "";
			} else {
				$this->setMessage("已取消");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$expert->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $expert->id->DbValue;

			// Call Row Inserted event
			$expert->Row_Inserted($rsnew);
		}

		// Field userpic
		$expert->userpic->Upload->RemoveFromSession(); // Remove file value from Session
		return $AddRow;
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
