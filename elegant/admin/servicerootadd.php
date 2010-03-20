<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "servicerootinfo.php" ?>
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
$serviceroot_add = new cserviceroot_add();
$Page =& $serviceroot_add;

// Page init processing
$serviceroot_add->Page_Init();

// Page main processing
$serviceroot_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var serviceroot_add = new ew_Page("serviceroot_add");

// page properties
serviceroot_add.PageID = "add"; // page ID
var EW_PAGE_ID = serviceroot_add.PageID; // for backward compatibility

// extend page with ValidateForm function
serviceroot_add.ValidateForm = function(fobj) {
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
serviceroot_add.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
serviceroot_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
serviceroot_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
serviceroot_add.ValidateRequired = false; // no JavaScript validation
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
<a href="<?php echo $serviceroot->getReturnUrl() ?>">返回</a></span></p>
<?php $serviceroot_add->ShowMessage() ?>
<form name="fservicerootadd" id="fservicerootadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return serviceroot_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="serviceroot">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($serviceroot->rootname->Visible) { // rootname ?>
	<tr<?php echo $serviceroot->rootname->RowAttributes ?>>
		<td class="ewTableHeader">根类型名<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $serviceroot->rootname->CellAttributes() ?>><span id="el_rootname">
<input type="text" name="x_rootname" id="x_rootname" size="30" maxlength="200" value="<?php echo $serviceroot->rootname->EditValue ?>"<?php echo $serviceroot->rootname->EditAttributes() ?>>
</span><?php echo $serviceroot->rootname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($serviceroot->rootorder->Visible) { // rootorder ?>
	<tr<?php echo $serviceroot->rootorder->RowAttributes ?>>
		<td class="ewTableHeader">根类型排序<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $serviceroot->rootorder->CellAttributes() ?>><span id="el_rootorder">
<input type="text" name="x_rootorder" id="x_rootorder" size="30" value="<?php echo $serviceroot->rootorder->EditValue ?>"<?php echo $serviceroot->rootorder->EditAttributes() ?>>
</span><?php echo $serviceroot->rootorder->CustomMsg ?></td>
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
class cserviceroot_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'serviceroot';

	// Page Object Name
	var $PageObjName = 'serviceroot_add';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $serviceroot;
		if ($serviceroot->UseTokenInUrl) $PageUrl .= "t=" . $serviceroot->TableVar . "&"; // add page token
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
		global $objForm, $serviceroot;
		if ($serviceroot->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($serviceroot->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($serviceroot->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cserviceroot_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["serviceroot"] = new cserviceroot();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'serviceroot', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $serviceroot;
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
		global $objForm, $gsFormError, $serviceroot;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $serviceroot->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $serviceroot->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$serviceroot->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $serviceroot->CurrentAction = "C"; // Copy Record
		  } else {
		    $serviceroot->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($serviceroot->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("没有数据"); // No record found
		      $this->Page_Terminate("servicerootlist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$serviceroot->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("添加成功"); // Set up success message
					$sReturnUrl = $serviceroot->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "servicerootview.php")
						$sReturnUrl = $serviceroot->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$serviceroot->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $serviceroot;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $serviceroot;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $serviceroot;
		$serviceroot->rootname->setFormValue($objForm->GetValue("x_rootname"));
		$serviceroot->rootorder->setFormValue($objForm->GetValue("x_rootorder"));
		$serviceroot->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $serviceroot;
		$serviceroot->id->CurrentValue = $serviceroot->id->FormValue;
		$serviceroot->rootname->CurrentValue = $serviceroot->rootname->FormValue;
		$serviceroot->rootorder->CurrentValue = $serviceroot->rootorder->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $serviceroot;
		$sFilter = $serviceroot->KeyFilter();

		// Call Row Selecting event
		$serviceroot->Row_Selecting($sFilter);

		// Load sql based on filter
		$serviceroot->CurrentFilter = $sFilter;
		$sSql = $serviceroot->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$serviceroot->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $serviceroot;
		$serviceroot->id->setDbValue($rs->fields('id'));
		$serviceroot->rootname->setDbValue($rs->fields('rootname'));
		$serviceroot->rootorder->setDbValue($rs->fields('rootorder'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $serviceroot;

		// Call Row_Rendering event
		$serviceroot->Row_Rendering();

		// Common render codes for all row types
		// rootname

		$serviceroot->rootname->CellCssStyle = "";
		$serviceroot->rootname->CellCssClass = "";

		// rootorder
		$serviceroot->rootorder->CellCssStyle = "";
		$serviceroot->rootorder->CellCssClass = "";
		if ($serviceroot->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$serviceroot->id->ViewValue = $serviceroot->id->CurrentValue;
			$serviceroot->id->CssStyle = "";
			$serviceroot->id->CssClass = "";
			$serviceroot->id->ViewCustomAttributes = "";

			// rootname
			$serviceroot->rootname->ViewValue = $serviceroot->rootname->CurrentValue;
			$serviceroot->rootname->CssStyle = "";
			$serviceroot->rootname->CssClass = "";
			$serviceroot->rootname->ViewCustomAttributes = "";

			// rootorder
			$serviceroot->rootorder->ViewValue = $serviceroot->rootorder->CurrentValue;
			$serviceroot->rootorder->CssStyle = "";
			$serviceroot->rootorder->CssClass = "";
			$serviceroot->rootorder->ViewCustomAttributes = "";

			// rootname
			$serviceroot->rootname->HrefValue = "";

			// rootorder
			$serviceroot->rootorder->HrefValue = "";
		} elseif ($serviceroot->RowType == EW_ROWTYPE_ADD) { // Add row

			// rootname
			$serviceroot->rootname->EditCustomAttributes = "";
			$serviceroot->rootname->EditValue = ew_HtmlEncode($serviceroot->rootname->CurrentValue);

			// rootorder
			$serviceroot->rootorder->EditCustomAttributes = "";
			$serviceroot->rootorder->EditValue = ew_HtmlEncode($serviceroot->rootorder->CurrentValue);
		}

		// Call Row Rendered event
		$serviceroot->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $serviceroot;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($serviceroot->rootname->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 根类型名";
		}
		if ($serviceroot->rootorder->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 根类型排序";
		}
		if (!ew_CheckInteger($serviceroot->rootorder->FormValue)) {
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
		global $conn, $Security, $serviceroot;
		$rsnew = array();

		// Field rootname
		$serviceroot->rootname->SetDbValueDef($serviceroot->rootname->CurrentValue, NULL);
		$rsnew['rootname'] =& $serviceroot->rootname->DbValue;

		// Field rootorder
		$serviceroot->rootorder->SetDbValueDef($serviceroot->rootorder->CurrentValue, NULL);
		$rsnew['rootorder'] =& $serviceroot->rootorder->DbValue;

		// Call Row Inserting event
		$bInsertRow = $serviceroot->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($serviceroot->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($serviceroot->CancelMessage <> "") {
				$this->setMessage($serviceroot->CancelMessage);
				$serviceroot->CancelMessage = "";
			} else {
				$this->setMessage("已取消");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$serviceroot->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $serviceroot->id->DbValue;

			// Call Row Inserted event
			$serviceroot->Row_Inserted($rsnew);
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
