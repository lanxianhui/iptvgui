<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "casescatinfo.php" ?>
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
$casescat_add = new ccasescat_add();
$Page =& $casescat_add;

// Page init processing
$casescat_add->Page_Init();

// Page main processing
$casescat_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var casescat_add = new ew_Page("casescat_add");

// page properties
casescat_add.PageID = "add"; // page ID
var EW_PAGE_ID = casescat_add.PageID; // for backward compatibility

// extend page with ValidateForm function
casescat_add.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_rootid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 根类型");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
casescat_add.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
casescat_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
casescat_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
casescat_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">添加到 表: Casescat<br><br>
<a href="<?php echo $casescat->getReturnUrl() ?>">返回</a></span></p>
<?php $casescat_add->ShowMessage() ?>
<form name="fcasescatadd" id="fcasescatadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return casescat_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="casescat">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
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
<?php if ($casescat->rootid->Visible) { // rootid ?>
	<tr<?php echo $casescat->rootid->RowAttributes ?>>
		<td class="ewTableHeader">根类型<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $casescat->rootid->CellAttributes() ?>><span id="el_rootid">
<select id="x_rootid" name="x_rootid"<?php echo $casescat->rootid->EditAttributes() ?>>
<?php
if (is_array($casescat->rootid->EditValue)) {
	$arwrk = $casescat->rootid->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($casescat->rootid->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $casescat->rootid->CustomMsg ?></td>
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
class ccasescat_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'casescat';

	// Page Object Name
	var $PageObjName = 'casescat_add';

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
	function ccasescat_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["casescat"] = new ccasescat();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
		global $objForm, $gsFormError, $casescat;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $casescat->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $casescat->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$casescat->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $casescat->CurrentAction = "C"; // Copy Record
		  } else {
		    $casescat->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($casescat->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("没有数据"); // No record found
		      $this->Page_Terminate("casescatlist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$casescat->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("添加成功"); // Set up success message
					$sReturnUrl = $casescat->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "casescatview.php")
						$sReturnUrl = $casescat->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$casescat->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $casescat;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $casescat;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $casescat;
		$casescat->catname->setFormValue($objForm->GetValue("x_catname"));
		$casescat->catorder->setFormValue($objForm->GetValue("x_catorder"));
		$casescat->rootid->setFormValue($objForm->GetValue("x_rootid"));
		$casescat->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $casescat;
		$casescat->id->CurrentValue = $casescat->id->FormValue;
		$casescat->catname->CurrentValue = $casescat->catname->FormValue;
		$casescat->catorder->CurrentValue = $casescat->catorder->FormValue;
		$casescat->rootid->CurrentValue = $casescat->rootid->FormValue;
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
		$casescat->rootid->setDbValue($rs->fields('rootid'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $casescat;

		// Call Row_Rendering event
		$casescat->Row_Rendering();

		// Common render codes for all row types
		// catname

		$casescat->catname->CellCssStyle = "";
		$casescat->catname->CellCssClass = "";

		// catorder
		$casescat->catorder->CellCssStyle = "";
		$casescat->catorder->CellCssClass = "";

		// rootid
		$casescat->rootid->CellCssStyle = "";
		$casescat->rootid->CellCssClass = "";
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

			// rootid
			if (strval($casescat->rootid->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `rootname` FROM `casesroot` WHERE `id` = " . ew_AdjustSql($casescat->rootid->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$casescat->rootid->ViewValue = $rswrk->fields('rootname');
					$rswrk->Close();
				} else {
					$casescat->rootid->ViewValue = $casescat->rootid->CurrentValue;
				}
			} else {
				$casescat->rootid->ViewValue = NULL;
			}
			$casescat->rootid->CssStyle = "";
			$casescat->rootid->CssClass = "";
			$casescat->rootid->ViewCustomAttributes = "";

			// catname
			$casescat->catname->HrefValue = "";

			// catorder
			$casescat->catorder->HrefValue = "";

			// rootid
			$casescat->rootid->HrefValue = "";
		} elseif ($casescat->RowType == EW_ROWTYPE_ADD) { // Add row

			// catname
			$casescat->catname->EditCustomAttributes = "";
			$casescat->catname->EditValue = ew_HtmlEncode($casescat->catname->CurrentValue);

			// catorder
			$casescat->catorder->EditCustomAttributes = "";
			$casescat->catorder->EditValue = ew_HtmlEncode($casescat->catorder->CurrentValue);

			// rootid
			$casescat->rootid->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id`, `rootname`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `casesroot`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "请选择"));
			$casescat->rootid->EditValue = $arwrk;
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
		if ($casescat->rootid->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 根类型";
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
		global $conn, $Security, $casescat;
		$rsnew = array();

		// Field catname
		$casescat->catname->SetDbValueDef($casescat->catname->CurrentValue, "");
		$rsnew['catname'] =& $casescat->catname->DbValue;

		// Field catorder
		$casescat->catorder->SetDbValueDef($casescat->catorder->CurrentValue, 0);
		$rsnew['catorder'] =& $casescat->catorder->DbValue;

		// Field rootid
		$casescat->rootid->SetDbValueDef($casescat->rootid->CurrentValue, 0);
		$rsnew['rootid'] =& $casescat->rootid->DbValue;

		// Call Row Inserting event
		$bInsertRow = $casescat->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($casescat->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($casescat->CancelMessage <> "") {
				$this->setMessage($casescat->CancelMessage);
				$casescat->CancelMessage = "";
			} else {
				$this->setMessage("已取消");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$casescat->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $casescat->id->DbValue;

			// Call Row Inserted event
			$casescat->Row_Inserted($rsnew);
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
