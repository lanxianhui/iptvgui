<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "friendlinkinfo.php" ?>
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
$friendlink_add = new cfriendlink_add();
$Page =& $friendlink_add;

// Page init processing
$friendlink_add->Page_Init();

// Page main processing
$friendlink_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var friendlink_add = new ew_Page("friendlink_add");

// page properties
friendlink_add.PageID = "add"; // page ID
var EW_PAGE_ID = friendlink_add.PageID; // for backward compatibility

// extend page with ValidateForm function
friendlink_add.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_linkname"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 链接名");
		elm = fobj.elements["x" + infix + "_linkaddress"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 链接地址");
		elm = fobj.elements["x" + infix + "_linkorder"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 连接排序");
		elm = fobj.elements["x" + infix + "_linkorder"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "错误的 Integer - 连接排序");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
friendlink_add.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
friendlink_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
friendlink_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
friendlink_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">添加到 表: Friendlink<br><br>
<a href="<?php echo $friendlink->getReturnUrl() ?>">返回</a></span></p>
<?php $friendlink_add->ShowMessage() ?>
<form name="ffriendlinkadd" id="ffriendlinkadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return friendlink_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="friendlink">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($friendlink->linkname->Visible) { // linkname ?>
	<tr<?php echo $friendlink->linkname->RowAttributes ?>>
		<td class="ewTableHeader">链接名<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $friendlink->linkname->CellAttributes() ?>><span id="el_linkname">
<input type="text" name="x_linkname" id="x_linkname" size="30" maxlength="200" value="<?php echo $friendlink->linkname->EditValue ?>"<?php echo $friendlink->linkname->EditAttributes() ?>>
</span><?php echo $friendlink->linkname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($friendlink->linkaddress->Visible) { // linkaddress ?>
	<tr<?php echo $friendlink->linkaddress->RowAttributes ?>>
		<td class="ewTableHeader">链接地址<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $friendlink->linkaddress->CellAttributes() ?>><span id="el_linkaddress">
<textarea name="x_linkaddress" id="x_linkaddress" cols="35" rows="4"<?php echo $friendlink->linkaddress->EditAttributes() ?>><?php echo $friendlink->linkaddress->EditValue ?></textarea>
</span><?php echo $friendlink->linkaddress->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($friendlink->linkorder->Visible) { // linkorder ?>
	<tr<?php echo $friendlink->linkorder->RowAttributes ?>>
		<td class="ewTableHeader">连接排序<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $friendlink->linkorder->CellAttributes() ?>><span id="el_linkorder">
<input type="text" name="x_linkorder" id="x_linkorder" size="30" value="<?php echo $friendlink->linkorder->EditValue ?>"<?php echo $friendlink->linkorder->EditAttributes() ?>>
</span><?php echo $friendlink->linkorder->CustomMsg ?></td>
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
class cfriendlink_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'friendlink';

	// Page Object Name
	var $PageObjName = 'friendlink_add';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $friendlink;
		if ($friendlink->UseTokenInUrl) $PageUrl .= "t=" . $friendlink->TableVar . "&"; // add page token
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
		global $objForm, $friendlink;
		if ($friendlink->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($friendlink->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($friendlink->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cfriendlink_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["friendlink"] = new cfriendlink();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'friendlink', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $friendlink;
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
		global $objForm, $gsFormError, $friendlink;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $friendlink->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $friendlink->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$friendlink->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $friendlink->CurrentAction = "C"; // Copy Record
		  } else {
		    $friendlink->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($friendlink->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("没有数据"); // No record found
		      $this->Page_Terminate("friendlinklist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$friendlink->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("添加成功"); // Set up success message
					$sReturnUrl = $friendlink->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "friendlinkview.php")
						$sReturnUrl = $friendlink->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$friendlink->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $friendlink;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $friendlink;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $friendlink;
		$friendlink->linkname->setFormValue($objForm->GetValue("x_linkname"));
		$friendlink->linkaddress->setFormValue($objForm->GetValue("x_linkaddress"));
		$friendlink->linkorder->setFormValue($objForm->GetValue("x_linkorder"));
		$friendlink->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $friendlink;
		$friendlink->id->CurrentValue = $friendlink->id->FormValue;
		$friendlink->linkname->CurrentValue = $friendlink->linkname->FormValue;
		$friendlink->linkaddress->CurrentValue = $friendlink->linkaddress->FormValue;
		$friendlink->linkorder->CurrentValue = $friendlink->linkorder->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $friendlink;
		$sFilter = $friendlink->KeyFilter();

		// Call Row Selecting event
		$friendlink->Row_Selecting($sFilter);

		// Load sql based on filter
		$friendlink->CurrentFilter = $sFilter;
		$sSql = $friendlink->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$friendlink->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $friendlink;
		$friendlink->id->setDbValue($rs->fields('id'));
		$friendlink->linkname->setDbValue($rs->fields('linkname'));
		$friendlink->linkaddress->setDbValue($rs->fields('linkaddress'));
		$friendlink->linkorder->setDbValue($rs->fields('linkorder'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $friendlink;

		// Call Row_Rendering event
		$friendlink->Row_Rendering();

		// Common render codes for all row types
		// linkname

		$friendlink->linkname->CellCssStyle = "";
		$friendlink->linkname->CellCssClass = "";

		// linkaddress
		$friendlink->linkaddress->CellCssStyle = "";
		$friendlink->linkaddress->CellCssClass = "";

		// linkorder
		$friendlink->linkorder->CellCssStyle = "";
		$friendlink->linkorder->CellCssClass = "";
		if ($friendlink->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$friendlink->id->ViewValue = $friendlink->id->CurrentValue;
			$friendlink->id->CssStyle = "";
			$friendlink->id->CssClass = "";
			$friendlink->id->ViewCustomAttributes = "";

			// linkname
			$friendlink->linkname->ViewValue = $friendlink->linkname->CurrentValue;
			$friendlink->linkname->CssStyle = "";
			$friendlink->linkname->CssClass = "";
			$friendlink->linkname->ViewCustomAttributes = "";

			// linkaddress
			$friendlink->linkaddress->ViewValue = $friendlink->linkaddress->CurrentValue;
			$friendlink->linkaddress->CssStyle = "";
			$friendlink->linkaddress->CssClass = "";
			$friendlink->linkaddress->ViewCustomAttributes = "";

			// linkorder
			$friendlink->linkorder->ViewValue = $friendlink->linkorder->CurrentValue;
			$friendlink->linkorder->CssStyle = "";
			$friendlink->linkorder->CssClass = "";
			$friendlink->linkorder->ViewCustomAttributes = "";

			// linkname
			$friendlink->linkname->HrefValue = "";

			// linkaddress
			$friendlink->linkaddress->HrefValue = "";

			// linkorder
			$friendlink->linkorder->HrefValue = "";
		} elseif ($friendlink->RowType == EW_ROWTYPE_ADD) { // Add row

			// linkname
			$friendlink->linkname->EditCustomAttributes = "";
			$friendlink->linkname->EditValue = ew_HtmlEncode($friendlink->linkname->CurrentValue);

			// linkaddress
			$friendlink->linkaddress->EditCustomAttributes = "";
			$friendlink->linkaddress->EditValue = ew_HtmlEncode($friendlink->linkaddress->CurrentValue);

			// linkorder
			$friendlink->linkorder->EditCustomAttributes = "";
			$friendlink->linkorder->EditValue = ew_HtmlEncode($friendlink->linkorder->CurrentValue);
		}

		// Call Row Rendered event
		$friendlink->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $friendlink;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($friendlink->linkname->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 链接名";
		}
		if ($friendlink->linkaddress->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 链接地址";
		}
		if ($friendlink->linkorder->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 连接排序";
		}
		if (!ew_CheckInteger($friendlink->linkorder->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "错误的 Integer - 连接排序";
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
		global $conn, $Security, $friendlink;
		$rsnew = array();

		// Field linkname
		$friendlink->linkname->SetDbValueDef($friendlink->linkname->CurrentValue, NULL);
		$rsnew['linkname'] =& $friendlink->linkname->DbValue;

		// Field linkaddress
		$friendlink->linkaddress->SetDbValueDef($friendlink->linkaddress->CurrentValue, NULL);
		$rsnew['linkaddress'] =& $friendlink->linkaddress->DbValue;

		// Field linkorder
		$friendlink->linkorder->SetDbValueDef($friendlink->linkorder->CurrentValue, NULL);
		$rsnew['linkorder'] =& $friendlink->linkorder->DbValue;

		// Call Row Inserting event
		$bInsertRow = $friendlink->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($friendlink->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($friendlink->CancelMessage <> "") {
				$this->setMessage($friendlink->CancelMessage);
				$friendlink->CancelMessage = "";
			} else {
				$this->setMessage("已取消");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$friendlink->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $friendlink->id->DbValue;

			// Call Row Inserted event
			$friendlink->Row_Inserted($rsnew);
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
