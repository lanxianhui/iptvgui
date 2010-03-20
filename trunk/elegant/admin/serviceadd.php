<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "serviceinfo.php" ?>
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
$service_add = new cservice_add();
$Page =& $service_add;

// Page init processing
$service_add->Page_Init();

// Page main processing
$service_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var service_add = new ew_Page("service_add");

// page properties
service_add.PageID = "add"; // page ID
var EW_PAGE_ID = service_add.PageID; // for backward compatibility

// extend page with ValidateForm function
service_add.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_servicename"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 服务名");
		elm = fobj.elements["x" + infix + "_pubtime"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 发布时间");
		elm = fobj.elements["x" + infix + "_pubtime"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "错误的日期格式, 格式 = yyyy/mm/dd - 发布时间");
		elm = fobj.elements["x" + infix + "_servicedesc"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 服务描述");
		elm = fobj.elements["x" + infix + "_rootid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 根类型");
		elm = fobj.elements["x" + infix + "_rootid"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "错误的 Integer - 根类型");
		elm = fobj.elements["x" + infix + "_catid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 服务类型");
		elm = fobj.elements["x" + infix + "_servicepic"];
		aelm = fobj.elements["a" + infix + "_servicepic"];
		var chk_servicepic = (aelm && aelm[0])?(aelm[2].checked):true;
		if (elm && chk_servicepic && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 服务图片");
		elm = fobj.elements["x" + infix + "_servicepic"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, "不允许上传的文件类型");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
service_add.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
service_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
service_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
service_add.ValidateRequired = false; // no JavaScript validation
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
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker">添加到 表: Service<br><br>
<a href="<?php echo $service->getReturnUrl() ?>">返回</a></span></p>
<?php $service_add->ShowMessage() ?>
<form name="fserviceadd" id="fserviceadd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data">
<p>
<input type="hidden" name="t" id="t" value="service">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($service->servicename->Visible) { // servicename ?>
	<tr<?php echo $service->servicename->RowAttributes ?>>
		<td class="ewTableHeader">服务名<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $service->servicename->CellAttributes() ?>><span id="el_servicename">
<input type="text" name="x_servicename" id="x_servicename" size="30" maxlength="200" value="<?php echo $service->servicename->EditValue ?>"<?php echo $service->servicename->EditAttributes() ?>>
</span><?php echo $service->servicename->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($service->pubtime->Visible) { // pubtime ?>
	<tr<?php echo $service->pubtime->RowAttributes ?>>
		<td class="ewTableHeader">发布时间<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $service->pubtime->CellAttributes() ?>><span id="el_pubtime">
<input type="text" name="x_pubtime" id="x_pubtime" value="<?php echo $service->pubtime->EditValue ?>"<?php echo $service->pubtime->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_pubtime" name="cal_x_pubtime" alt="选择日期" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_pubtime", // ID of the input field
	ifFormat : "%Y/%m/%d", // the date format
	button : "cal_x_pubtime" // ID of the button
});
</script>
</span><?php echo $service->pubtime->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($service->servicedesc->Visible) { // servicedesc ?>
	<tr<?php echo $service->servicedesc->RowAttributes ?>>
		<td class="ewTableHeader">服务描述<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $service->servicedesc->CellAttributes() ?>><span id="el_servicedesc">
<textarea name="x_servicedesc" id="x_servicedesc" cols="35" rows="4"<?php echo $service->servicedesc->EditAttributes() ?>><?php echo $service->servicedesc->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_servicedesc", function() {
	var sBasePath = 'fckeditor/';
	var oFCKeditor = new FCKeditor('x_servicedesc', 35*_width_multiplier, 4*_height_multiplier);
	oFCKeditor.BasePath = sBasePath;
	oFCKeditor.ReplaceTextarea();
	this.active = true;
}));
-->
</script>
</span><?php echo $service->servicedesc->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($service->rootid->Visible) { // rootid ?>
	<tr<?php echo $service->rootid->RowAttributes ?>>
		<td class="ewTableHeader">根类型<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $service->rootid->CellAttributes() ?>><span id="el_rootid">
<input type="text" name="x_rootid" id="x_rootid" size="30" value="<?php echo $service->rootid->EditValue ?>"<?php echo $service->rootid->EditAttributes() ?>>
</span><?php echo $service->rootid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($service->catid->Visible) { // catid ?>
	<tr<?php echo $service->catid->RowAttributes ?>>
		<td class="ewTableHeader">服务类型<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $service->catid->CellAttributes() ?>><span id="el_catid">
<select id="x_catid" name="x_catid"<?php echo $service->catid->EditAttributes() ?>>
<?php
if (is_array($service->catid->EditValue)) {
	$arwrk = $service->catid->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($service->catid->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $service->catid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($service->servicepic->Visible) { // servicepic ?>
	<tr<?php echo $service->servicepic->RowAttributes ?>>
		<td class="ewTableHeader">服务图片<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $service->servicepic->CellAttributes() ?>><span id="el_servicepic">
<input type="file" name="x_servicepic" id="x_servicepic"<?php echo $service->servicepic->EditAttributes() ?>>
</div>
</span><?php echo $service->servicepic->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="button" name="btnAction" id="btnAction" value="    添加    " onclick="ew_SubmitForm(service_add, this.form);">
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
class cservice_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'service';

	// Page Object Name
	var $PageObjName = 'service_add';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $service;
		if ($service->UseTokenInUrl) $PageUrl .= "t=" . $service->TableVar . "&"; // add page token
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
		global $objForm, $service;
		if ($service->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($service->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($service->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cservice_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["service"] = new cservice();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'service', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $service;
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
		global $objForm, $gsFormError, $service;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $service->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $service->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->GetUploadFiles(); // Get upload files
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$service->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $service->CurrentAction = "C"; // Copy Record
		  } else {
		    $service->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($service->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("没有数据"); // No record found
		      $this->Page_Terminate("servicelist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$service->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("添加成功"); // Set up success message
					$sReturnUrl = $service->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "serviceview.php")
						$sReturnUrl = $service->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$service->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $service;

		// Get upload data
			if ($service->servicepic->Upload->UploadFile()) {

				// No action required
			} else {
				echo $service->servicepic->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load default values
	function LoadDefaultValues() {
		global $service;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $service;
		$service->servicename->setFormValue($objForm->GetValue("x_servicename"));
		$service->pubtime->setFormValue($objForm->GetValue("x_pubtime"));
		$service->pubtime->CurrentValue = ew_UnFormatDateTime($service->pubtime->CurrentValue, 5);
		$service->servicedesc->setFormValue($objForm->GetValue("x_servicedesc"));
		$service->rootid->setFormValue($objForm->GetValue("x_rootid"));
		$service->catid->setFormValue($objForm->GetValue("x_catid"));
		$service->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $service;
		$service->id->CurrentValue = $service->id->FormValue;
		$service->servicename->CurrentValue = $service->servicename->FormValue;
		$service->pubtime->CurrentValue = $service->pubtime->FormValue;
		$service->pubtime->CurrentValue = ew_UnFormatDateTime($service->pubtime->CurrentValue, 5);
		$service->servicedesc->CurrentValue = $service->servicedesc->FormValue;
		$service->rootid->CurrentValue = $service->rootid->FormValue;
		$service->catid->CurrentValue = $service->catid->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $service;
		$sFilter = $service->KeyFilter();

		// Call Row Selecting event
		$service->Row_Selecting($sFilter);

		// Load sql based on filter
		$service->CurrentFilter = $sFilter;
		$sSql = $service->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$service->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $service;
		$service->id->setDbValue($rs->fields('id'));
		$service->servicename->setDbValue($rs->fields('servicename'));
		$service->pubtime->setDbValue($rs->fields('pubtime'));
		$service->servicedesc->setDbValue($rs->fields('servicedesc'));
		$service->rootid->setDbValue($rs->fields('rootid'));
		$service->catid->setDbValue($rs->fields('catid'));
		$service->servicepic->Upload->DbValue = $rs->fields('servicepic');
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $service;

		// Call Row_Rendering event
		$service->Row_Rendering();

		// Common render codes for all row types
		// servicename

		$service->servicename->CellCssStyle = "";
		$service->servicename->CellCssClass = "";

		// pubtime
		$service->pubtime->CellCssStyle = "";
		$service->pubtime->CellCssClass = "";

		// servicedesc
		$service->servicedesc->CellCssStyle = "";
		$service->servicedesc->CellCssClass = "";

		// rootid
		$service->rootid->CellCssStyle = "";
		$service->rootid->CellCssClass = "";

		// catid
		$service->catid->CellCssStyle = "";
		$service->catid->CellCssClass = "";

		// servicepic
		$service->servicepic->CellCssStyle = "";
		$service->servicepic->CellCssClass = "";
		if ($service->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$service->id->ViewValue = $service->id->CurrentValue;
			$service->id->CssStyle = "";
			$service->id->CssClass = "";
			$service->id->ViewCustomAttributes = "";

			// servicename
			$service->servicename->ViewValue = $service->servicename->CurrentValue;
			$service->servicename->CssStyle = "";
			$service->servicename->CssClass = "";
			$service->servicename->ViewCustomAttributes = "";

			// pubtime
			$service->pubtime->ViewValue = $service->pubtime->CurrentValue;
			$service->pubtime->ViewValue = ew_FormatDateTime($service->pubtime->ViewValue, 5);
			$service->pubtime->CssStyle = "";
			$service->pubtime->CssClass = "";
			$service->pubtime->ViewCustomAttributes = "";

			// servicedesc
			$service->servicedesc->ViewValue = $service->servicedesc->CurrentValue;
			$service->servicedesc->CssStyle = "";
			$service->servicedesc->CssClass = "";
			$service->servicedesc->ViewCustomAttributes = "";

			// rootid
			$service->rootid->ViewValue = $service->rootid->CurrentValue;
			$service->rootid->CssStyle = "";
			$service->rootid->CssClass = "";
			$service->rootid->ViewCustomAttributes = "";

			// catid
			if (strval($service->catid->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `catname` FROM `servicecat` WHERE `id` = " . ew_AdjustSql($service->catid->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$service->catid->ViewValue = $rswrk->fields('catname');
					$rswrk->Close();
				} else {
					$service->catid->ViewValue = $service->catid->CurrentValue;
				}
			} else {
				$service->catid->ViewValue = NULL;
			}
			$service->catid->CssStyle = "";
			$service->catid->CssClass = "";
			$service->catid->ViewCustomAttributes = "";

			// servicepic
			if (!is_null($service->servicepic->Upload->DbValue)) {
				$service->servicepic->ViewValue = $service->servicepic->Upload->DbValue;
				$service->servicepic->ImageAlt = "";
			} else {
				$service->servicepic->ViewValue = "";
			}
			$service->servicepic->CssStyle = "";
			$service->servicepic->CssClass = "";
			$service->servicepic->ViewCustomAttributes = "";

			// servicename
			$service->servicename->HrefValue = "";

			// pubtime
			$service->pubtime->HrefValue = "";

			// servicedesc
			$service->servicedesc->HrefValue = "";

			// rootid
			$service->rootid->HrefValue = "";

			// catid
			$service->catid->HrefValue = "";

			// servicepic
			$service->servicepic->HrefValue = "";
		} elseif ($service->RowType == EW_ROWTYPE_ADD) { // Add row

			// servicename
			$service->servicename->EditCustomAttributes = "";
			$service->servicename->EditValue = ew_HtmlEncode($service->servicename->CurrentValue);

			// pubtime
			$service->pubtime->EditCustomAttributes = "";
			$service->pubtime->EditValue = ew_HtmlEncode(ew_FormatDateTime($service->pubtime->CurrentValue, 5));

			// servicedesc
			$service->servicedesc->EditCustomAttributes = "";
			$service->servicedesc->EditValue = ew_HtmlEncode($service->servicedesc->CurrentValue);

			// rootid
			$service->rootid->EditCustomAttributes = "";
			$service->rootid->EditValue = ew_HtmlEncode($service->rootid->CurrentValue);

			// catid
			$service->catid->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id`, `catname`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `servicecat`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "请选择"));
			$service->catid->EditValue = $arwrk;

			// servicepic
			$service->servicepic->EditCustomAttributes = "";
			if (!is_null($service->servicepic->Upload->DbValue)) {
				$service->servicepic->EditValue = $service->servicepic->Upload->DbValue;
				$service->servicepic->ImageAlt = "";
			} else {
				$service->servicepic->EditValue = "";
			}
		}

		// Call Row Rendered event
		$service->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $service;

		// Initialize
		$gsFormError = "";
		if (!ew_CheckFileType($service->servicepic->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "不允许上传的文件类型";
		}
		if ($service->servicepic->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($service->servicepic->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "文件大小超过限制 (%s 字节)");
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($service->servicename->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 服务名";
		}
		if ($service->pubtime->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 发布时间";
		}
		if (!ew_CheckDate($service->pubtime->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "错误的日期格式, 格式 = yyyy/mm/dd - 发布时间";
		}
		if ($service->servicedesc->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 服务描述";
		}
		if ($service->rootid->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 根类型";
		}
		if (!ew_CheckInteger($service->rootid->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "错误的 Integer - 根类型";
		}
		if ($service->catid->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 服务类型";
		}
		if (is_null($service->servicepic->Upload->Value)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 服务图片";
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
		global $conn, $Security, $service;
		$rsnew = array();

		// Field servicename
		$service->servicename->SetDbValueDef($service->servicename->CurrentValue, "");
		$rsnew['servicename'] =& $service->servicename->DbValue;

		// Field pubtime
		$service->pubtime->SetDbValueDef(ew_UnFormatDateTime($service->pubtime->CurrentValue, 5), ew_CurrentDate());
		$rsnew['pubtime'] =& $service->pubtime->DbValue;

		// Field servicedesc
		$service->servicedesc->SetDbValueDef($service->servicedesc->CurrentValue, "");
		$rsnew['servicedesc'] =& $service->servicedesc->DbValue;

		// Field rootid
		$service->rootid->SetDbValueDef($service->rootid->CurrentValue, 0);
		$rsnew['rootid'] =& $service->rootid->DbValue;

		// Field catid
		$service->catid->SetDbValueDef($service->catid->CurrentValue, 0);
		$rsnew['catid'] =& $service->catid->DbValue;

		// Field servicepic
		$service->servicepic->Upload->SaveToSession(); // Save file value to Session
		if (is_null($service->servicepic->Upload->Value)) {
			$rsnew['servicepic'] = NULL;
		} else {
			$rsnew['servicepic'] = ew_UploadFileNameEx(ew_UploadPathEx(True, EW_UPLOAD_DEST_PATH), $service->servicepic->Upload->FileName);
		}

		// Call Row Inserting event
		$bInsertRow = $service->Row_Inserting($rsnew);
		if ($bInsertRow) {

			// Field servicepic
			if (!is_null($service->servicepic->Upload->Value)) {
				$service->servicepic->Upload->SaveToFile(EW_UPLOAD_DEST_PATH, $rsnew['servicepic'], FALSE);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($service->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($service->CancelMessage <> "") {
				$this->setMessage($service->CancelMessage);
				$service->CancelMessage = "";
			} else {
				$this->setMessage("已取消");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$service->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $service->id->DbValue;

			// Call Row Inserted event
			$service->Row_Inserted($rsnew);
		}

		// Field servicepic
		$service->servicepic->Upload->RemoveFromSession(); // Remove file value from Session
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
