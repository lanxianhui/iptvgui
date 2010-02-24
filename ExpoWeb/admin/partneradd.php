<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "partnerinfo.php" ?>
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
$partner_add = new cpartner_add();
$Page =& $partner_add;

// Page init processing
$partner_add->Page_Init();

// Page main processing
$partner_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var partner_add = new ew_Page("partner_add");

// page properties
partner_add.PageID = "add"; // page ID
var EW_PAGE_ID = partner_add.PageID; // for backward compatibility

// extend page with ValidateForm function
partner_add.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_pname"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 合作伙伴名");
		elm = fobj.elements["x" + infix + "_paddress"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 合作伙伴链接");
		elm = fobj.elements["x" + infix + "_pimage"];
		aelm = fobj.elements["a" + infix + "_pimage"];
		var chk_pimage = (aelm && aelm[0])?(aelm[2].checked):true;
		if (elm && chk_pimage && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 合作伙伴Logo");
		elm = fobj.elements["x" + infix + "_pimage"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, "不允许上传的文件类型");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
partner_add.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
partner_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
partner_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
partner_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">添加到 表: Partner<br><br>
<a href="<?php echo $partner->getReturnUrl() ?>">返回</a></span></p>
<?php $partner_add->ShowMessage() ?>
<form name="fpartneradd" id="fpartneradd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return partner_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="partner">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($partner->pname->Visible) { // pname ?>
	<tr<?php echo $partner->pname->RowAttributes ?>>
		<td class="ewTableHeader">合作伙伴名<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $partner->pname->CellAttributes() ?>><span id="el_pname">
<input type="text" name="x_pname" id="x_pname" size="30" maxlength="200" value="<?php echo $partner->pname->EditValue ?>"<?php echo $partner->pname->EditAttributes() ?>>
</span><?php echo $partner->pname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($partner->paddress->Visible) { // paddress ?>
	<tr<?php echo $partner->paddress->RowAttributes ?>>
		<td class="ewTableHeader">合作伙伴链接<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $partner->paddress->CellAttributes() ?>><span id="el_paddress">
<input type="text" name="x_paddress" id="x_paddress" value="<?php echo $partner->paddress->EditValue ?>"<?php echo $partner->paddress->EditAttributes() ?>>
</span><?php echo $partner->paddress->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($partner->pimage->Visible) { // pimage ?>
	<tr<?php echo $partner->pimage->RowAttributes ?>>
		<td class="ewTableHeader">合作伙伴Logo<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $partner->pimage->CellAttributes() ?>><span id="el_pimage">
<input type="file" name="x_pimage" id="x_pimage"<?php echo $partner->pimage->EditAttributes() ?>>
</div>
</span><?php echo $partner->pimage->CustomMsg ?></td>
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
class cpartner_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'partner';

	// Page Object Name
	var $PageObjName = 'partner_add';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $partner;
		if ($partner->UseTokenInUrl) $PageUrl .= "t=" . $partner->TableVar . "&"; // add page token
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
		global $objForm, $partner;
		if ($partner->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($partner->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($partner->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cpartner_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["partner"] = new cpartner();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'partner', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $partner;
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
		global $objForm, $gsFormError, $partner;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $partner->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $partner->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->GetUploadFiles(); // Get upload files
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$partner->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $partner->CurrentAction = "C"; // Copy Record
		  } else {
		    $partner->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($partner->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("没有数据"); // No record found
		      $this->Page_Terminate("partnerlist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$partner->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("添加成功"); // Set up success message
					$sReturnUrl = $partner->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "partnerview.php")
						$sReturnUrl = $partner->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$partner->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $partner;

		// Get upload data
			if ($partner->pimage->Upload->UploadFile()) {

				// No action required
			} else {
				echo $partner->pimage->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load default values
	function LoadDefaultValues() {
		global $partner;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $partner;
		$partner->pname->setFormValue($objForm->GetValue("x_pname"));
		$partner->paddress->setFormValue($objForm->GetValue("x_paddress"));
		$partner->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $partner;
		$partner->id->CurrentValue = $partner->id->FormValue;
		$partner->pname->CurrentValue = $partner->pname->FormValue;
		$partner->paddress->CurrentValue = $partner->paddress->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $partner;
		$sFilter = $partner->KeyFilter();

		// Call Row Selecting event
		$partner->Row_Selecting($sFilter);

		// Load sql based on filter
		$partner->CurrentFilter = $sFilter;
		$sSql = $partner->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$partner->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $partner;
		$partner->id->setDbValue($rs->fields('id'));
		$partner->pname->setDbValue($rs->fields('pname'));
		$partner->paddress->setDbValue($rs->fields('paddress'));
		$partner->pimage->Upload->DbValue = $rs->fields('pimage');
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $partner;

		// Call Row_Rendering event
		$partner->Row_Rendering();

		// Common render codes for all row types
		// pname

		$partner->pname->CellCssStyle = "";
		$partner->pname->CellCssClass = "";

		// paddress
		$partner->paddress->CellCssStyle = "";
		$partner->paddress->CellCssClass = "";

		// pimage
		$partner->pimage->CellCssStyle = "";
		$partner->pimage->CellCssClass = "";
		if ($partner->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$partner->id->ViewValue = $partner->id->CurrentValue;
			$partner->id->CssStyle = "";
			$partner->id->CssClass = "";
			$partner->id->ViewCustomAttributes = "";

			// pname
			$partner->pname->ViewValue = $partner->pname->CurrentValue;
			$partner->pname->CssStyle = "";
			$partner->pname->CssClass = "";
			$partner->pname->ViewCustomAttributes = "";

			// paddress
			$partner->paddress->ViewValue = $partner->paddress->CurrentValue;
			$partner->paddress->CssStyle = "";
			$partner->paddress->CssClass = "";
			$partner->paddress->ViewCustomAttributes = "";

			// pimage
			if (!is_null($partner->pimage->Upload->DbValue)) {
				$partner->pimage->ViewValue = $partner->pimage->Upload->DbValue;
				$partner->pimage->ImageAlt = "";
			} else {
				$partner->pimage->ViewValue = "";
			}
			$partner->pimage->CssStyle = "";
			$partner->pimage->CssClass = "";
			$partner->pimage->ViewCustomAttributes = "";

			// pname
			$partner->pname->HrefValue = "";

			// paddress
			$partner->paddress->HrefValue = "";

			// pimage
			$partner->pimage->HrefValue = "";
		} elseif ($partner->RowType == EW_ROWTYPE_ADD) { // Add row

			// pname
			$partner->pname->EditCustomAttributes = "";
			$partner->pname->EditValue = ew_HtmlEncode($partner->pname->CurrentValue);

			// paddress
			$partner->paddress->EditCustomAttributes = "";
			$partner->paddress->EditValue = ew_HtmlEncode($partner->paddress->CurrentValue);

			// pimage
			$partner->pimage->EditCustomAttributes = "";
			if (!is_null($partner->pimage->Upload->DbValue)) {
				$partner->pimage->EditValue = $partner->pimage->Upload->DbValue;
				$partner->pimage->ImageAlt = "";
			} else {
				$partner->pimage->EditValue = "";
			}
		}

		// Call Row Rendered event
		$partner->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $partner;

		// Initialize
		$gsFormError = "";
		if (!ew_CheckFileType($partner->pimage->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "不允许上传的文件类型";
		}
		if ($partner->pimage->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($partner->pimage->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "文件大小超过限制 (%s 字节)");
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($partner->pname->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 合作伙伴名";
		}
		if ($partner->paddress->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 合作伙伴链接";
		}
		if (is_null($partner->pimage->Upload->Value)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 合作伙伴Logo";
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
		global $conn, $Security, $partner;
		$rsnew = array();

		// Field pname
		$partner->pname->SetDbValueDef($partner->pname->CurrentValue, "");
		$rsnew['pname'] =& $partner->pname->DbValue;

		// Field paddress
		$partner->paddress->SetDbValueDef($partner->paddress->CurrentValue, "");
		$rsnew['paddress'] =& $partner->paddress->DbValue;

		// Field pimage
		$partner->pimage->Upload->SaveToSession(); // Save file value to Session
		if (is_null($partner->pimage->Upload->Value)) {
			$rsnew['pimage'] = NULL;
		} else {
			$rsnew['pimage'] = ew_UploadFileNameEx(ew_UploadPathEx(True, EW_UPLOAD_DEST_PATH), $partner->pimage->Upload->FileName);
		}

		// Call Row Inserting event
		$bInsertRow = $partner->Row_Inserting($rsnew);
		if ($bInsertRow) {

			// Field pimage
			if (!is_null($partner->pimage->Upload->Value)) {
				$partner->pimage->Upload->SaveToFile(EW_UPLOAD_DEST_PATH, $rsnew['pimage'], FALSE);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($partner->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($partner->CancelMessage <> "") {
				$this->setMessage($partner->CancelMessage);
				$partner->CancelMessage = "";
			} else {
				$this->setMessage("已取消");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$partner->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $partner->id->DbValue;

			// Call Row Inserted event
			$partner->Row_Inserted($rsnew);
		}

		// Field pimage
		$partner->pimage->Upload->RemoveFromSession(); // Remove file value from Session
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
