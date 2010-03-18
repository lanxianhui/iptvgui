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
$srviceroot_add = new csrviceroot_add();
$Page =& $srviceroot_add;

// Page init processing
$srviceroot_add->Page_Init();

// Page main processing
$srviceroot_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var srviceroot_add = new ew_Page("srviceroot_add");

// page properties
srviceroot_add.PageID = "add"; // page ID
var EW_PAGE_ID = srviceroot_add.PageID; // for backward compatibility

// extend page with ValidateForm function
srviceroot_add.ValidateForm = function(fobj) {
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
srviceroot_add.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
srviceroot_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
srviceroot_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">添加到 表: Srviceroot<br><br>
<a href="<?php echo $srviceroot->getReturnUrl() ?>">返回</a></span></p>
<?php $srviceroot_add->ShowMessage() ?>
<form name="fsrvicerootadd" id="fsrvicerootadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return srviceroot_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="srviceroot">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
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
class csrviceroot_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'srviceroot';

	// Page Object Name
	var $PageObjName = 'srviceroot_add';

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
	function csrviceroot_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["srviceroot"] = new csrviceroot();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $x_ewPriv = 0;

	// 
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsFormError, $srviceroot;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $srviceroot->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $srviceroot->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$srviceroot->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $srviceroot->CurrentAction = "C"; // Copy Record
		  } else {
		    $srviceroot->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($srviceroot->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("没有数据"); // No record found
		      $this->Page_Terminate("srvicerootlist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$srviceroot->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("添加成功"); // Set up success message
					$sReturnUrl = $srviceroot->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$srviceroot->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $srviceroot;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $srviceroot;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $srviceroot;
		$srviceroot->rootname->setFormValue($objForm->GetValue("x_rootname"));
		$srviceroot->rootorder->setFormValue($objForm->GetValue("x_rootorder"));
		$srviceroot->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $srviceroot;
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

			// rootname
			$srviceroot->rootname->HrefValue = "";

			// rootorder
			$srviceroot->rootorder->HrefValue = "";
		} elseif ($srviceroot->RowType == EW_ROWTYPE_ADD) { // Add row

			// rootname
			$srviceroot->rootname->EditCustomAttributes = "";
			$srviceroot->rootname->EditValue = ew_HtmlEncode($srviceroot->rootname->CurrentValue);

			// rootorder
			$srviceroot->rootorder->EditCustomAttributes = "";
			$srviceroot->rootorder->EditValue = ew_HtmlEncode($srviceroot->rootorder->CurrentValue);
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

	// Add record
	function AddRow() {
		global $conn, $Security, $srviceroot;
		$rsnew = array();

		// Field rootname
		$srviceroot->rootname->SetDbValueDef($srviceroot->rootname->CurrentValue, NULL);
		$rsnew['rootname'] =& $srviceroot->rootname->DbValue;

		// Field rootorder
		$srviceroot->rootorder->SetDbValueDef($srviceroot->rootorder->CurrentValue, NULL);
		$rsnew['rootorder'] =& $srviceroot->rootorder->DbValue;

		// Call Row Inserting event
		$bInsertRow = $srviceroot->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($srviceroot->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($srviceroot->CancelMessage <> "") {
				$this->setMessage($srviceroot->CancelMessage);
				$srviceroot->CancelMessage = "";
			} else {
				$this->setMessage("已取消");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$srviceroot->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $srviceroot->id->DbValue;

			// Call Row Inserted event
			$srviceroot->Row_Inserted($rsnew);
		}
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
