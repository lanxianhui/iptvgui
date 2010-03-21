<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "casesinfo.php" ?>
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
$cases_add = new ccases_add();
$Page =& $cases_add;

// Page init processing
$cases_add->Page_Init();

// Page main processing
$cases_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var cases_add = new ew_Page("cases_add");

// page properties
cases_add.PageID = "add"; // page ID
var EW_PAGE_ID = cases_add.PageID; // for backward compatibility

// extend page with ValidateForm function
cases_add.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_casedesc"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 案例描述");
		elm = fobj.elements["x" + infix + "_rootid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 根类型");
		elm = fobj.elements["x" + infix + "_catid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 案例类型");
		elm = fobj.elements["x" + infix + "_casepic1"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, "不允许上传的文件类型");
		elm = fobj.elements["x" + infix + "_casepic2"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, "不允许上传的文件类型");
		elm = fobj.elements["x" + infix + "_casepic3"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, "不允许上传的文件类型");
		elm = fobj.elements["x" + infix + "_casepic4"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, "不允许上传的文件类型");
		elm = fobj.elements["x" + infix + "_casepic5"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, "不允许上传的文件类型");
		elm = fobj.elements["x" + infix + "_casepic6"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, "不允许上传的文件类型");
		elm = fobj.elements["x" + infix + "_casepic7"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, "不允许上传的文件类型");
		elm = fobj.elements["x" + infix + "_casepic8"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, "不允许上传的文件类型");
		elm = fobj.elements["x" + infix + "_casepic9"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, "不允许上传的文件类型");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
cases_add.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
cases_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
cases_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
cases_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">添加到 表: Cases<br><br>
<a href="<?php echo $cases->getReturnUrl() ?>">返回</a></span></p>
<?php $cases_add->ShowMessage() ?>
<form name="fcasesadd" id="fcasesadd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data">
<p>
<input type="hidden" name="t" id="t" value="cases">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($cases->casetitle->Visible) { // casetitle ?>
	<tr<?php echo $cases->casetitle->RowAttributes ?>>
		<td class="ewTableHeader">案例标题<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $cases->casetitle->CellAttributes() ?>><span id="el_casetitle">
<input type="text" name="x_casetitle" id="x_casetitle" size="30" maxlength="200" value="<?php echo $cases->casetitle->EditValue ?>"<?php echo $cases->casetitle->EditAttributes() ?>>
</span><?php echo $cases->casetitle->CustomMsg ?></td>
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
<?php if ($cases->rootid->Visible) { // rootid ?>
	<tr<?php echo $cases->rootid->RowAttributes ?>>
		<td class="ewTableHeader">根类型<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $cases->rootid->CellAttributes() ?>><span id="el_rootid">
<select id="x_rootid" name="x_rootid" onchange="ew_UpdateOpt('x_catid','x_rootid',cases_add.ar_x_catid);"<?php echo $cases->rootid->EditAttributes() ?>>
<?php
if (is_array($cases->rootid->EditValue)) {
	$arwrk = $cases->rootid->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($cases->rootid->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $cases->rootid->CustomMsg ?></td>
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
<?php
$jswrk = "";
if (is_array($cases->catid->EditValue)) {
	$arwrk = $cases->catid->EditValue;
	$arwrkcnt = count($arwrk);
	for ($rowcntwrk = 1; $rowcntwrk < $arwrkcnt; $rowcntwrk++) {
		if ($jswrk <> "") $jswrk .= ",";
		$jswrk .= "['" . ew_JsEncode($arwrk[$rowcntwrk][0]) . "',"; // Value
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][1]) . "',"; // Display field 1
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][2]) . "',"; // Display field 2
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][3]) . "']"; // Filter field
	}
}
?>
<script type="text/javascript">
<!--
cases_add.ar_x_catid = [<?php echo $jswrk ?>];

//-->
</script>
</span><?php echo $cases->catid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cases->casepic1->Visible) { // casepic1 ?>
	<tr<?php echo $cases->casepic1->RowAttributes ?>>
		<td class="ewTableHeader">案例图片1</td>
		<td<?php echo $cases->casepic1->CellAttributes() ?>><span id="el_casepic1">
<input type="file" name="x_casepic1" id="x_casepic1"<?php echo $cases->casepic1->EditAttributes() ?>>
</div>
</span><?php echo $cases->casepic1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cases->casepic2->Visible) { // casepic2 ?>
	<tr<?php echo $cases->casepic2->RowAttributes ?>>
		<td class="ewTableHeader">案例图片2</td>
		<td<?php echo $cases->casepic2->CellAttributes() ?>><span id="el_casepic2">
<input type="file" name="x_casepic2" id="x_casepic2"<?php echo $cases->casepic2->EditAttributes() ?>>
</div>
</span><?php echo $cases->casepic2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cases->casepic3->Visible) { // casepic3 ?>
	<tr<?php echo $cases->casepic3->RowAttributes ?>>
		<td class="ewTableHeader">案例图片3</td>
		<td<?php echo $cases->casepic3->CellAttributes() ?>><span id="el_casepic3">
<input type="file" name="x_casepic3" id="x_casepic3"<?php echo $cases->casepic3->EditAttributes() ?>>
</div>
</span><?php echo $cases->casepic3->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cases->casepic4->Visible) { // casepic4 ?>
	<tr<?php echo $cases->casepic4->RowAttributes ?>>
		<td class="ewTableHeader">案例图片4</td>
		<td<?php echo $cases->casepic4->CellAttributes() ?>><span id="el_casepic4">
<input type="file" name="x_casepic4" id="x_casepic4"<?php echo $cases->casepic4->EditAttributes() ?>>
</div>
</span><?php echo $cases->casepic4->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cases->casepic5->Visible) { // casepic5 ?>
	<tr<?php echo $cases->casepic5->RowAttributes ?>>
		<td class="ewTableHeader">案例图片5</td>
		<td<?php echo $cases->casepic5->CellAttributes() ?>><span id="el_casepic5">
<input type="file" name="x_casepic5" id="x_casepic5"<?php echo $cases->casepic5->EditAttributes() ?>>
</div>
</span><?php echo $cases->casepic5->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cases->casepic6->Visible) { // casepic6 ?>
	<tr<?php echo $cases->casepic6->RowAttributes ?>>
		<td class="ewTableHeader">案例图片6</td>
		<td<?php echo $cases->casepic6->CellAttributes() ?>><span id="el_casepic6">
<input type="file" name="x_casepic6" id="x_casepic6"<?php echo $cases->casepic6->EditAttributes() ?>>
</div>
</span><?php echo $cases->casepic6->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cases->casepic7->Visible) { // casepic7 ?>
	<tr<?php echo $cases->casepic7->RowAttributes ?>>
		<td class="ewTableHeader">案例图片7</td>
		<td<?php echo $cases->casepic7->CellAttributes() ?>><span id="el_casepic7">
<input type="file" name="x_casepic7" id="x_casepic7"<?php echo $cases->casepic7->EditAttributes() ?>>
</div>
</span><?php echo $cases->casepic7->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cases->casepic8->Visible) { // casepic8 ?>
	<tr<?php echo $cases->casepic8->RowAttributes ?>>
		<td class="ewTableHeader">案例图片8</td>
		<td<?php echo $cases->casepic8->CellAttributes() ?>><span id="el_casepic8">
<input type="file" name="x_casepic8" id="x_casepic8"<?php echo $cases->casepic8->EditAttributes() ?>>
</div>
</span><?php echo $cases->casepic8->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cases->casepic9->Visible) { // casepic9 ?>
	<tr<?php echo $cases->casepic9->RowAttributes ?>>
		<td class="ewTableHeader">案例图片9</td>
		<td<?php echo $cases->casepic9->CellAttributes() ?>><span id="el_casepic9">
<input type="file" name="x_casepic9" id="x_casepic9"<?php echo $cases->casepic9->EditAttributes() ?>>
</div>
</span><?php echo $cases->casepic9->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="button" name="btnAction" id="btnAction" value="    添加    " onclick="ew_SubmitForm(cases_add, this.form);">
</form>
<script language="JavaScript">
<!--
ew_UpdateOpts([['x_catid','x_rootid',cases_add.ar_x_catid]]);

//-->
</script>
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
class ccases_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'cases';

	// Page Object Name
	var $PageObjName = 'cases_add';

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
	function ccases_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["cases"] = new ccases();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
		global $objForm, $gsFormError, $cases;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $cases->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $cases->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->GetUploadFiles(); // Get upload files
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$cases->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $cases->CurrentAction = "C"; // Copy Record
		  } else {
		    $cases->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($cases->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("没有数据"); // No record found
		      $this->Page_Terminate("caseslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$cases->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("添加成功"); // Set up success message
					$sReturnUrl = $cases->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "casesview.php")
						$sReturnUrl = $cases->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$cases->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $cases;

		// Get upload data
			if ($cases->casepic1->Upload->UploadFile()) {

				// No action required
			} else {
				echo $cases->casepic1->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			if ($cases->casepic2->Upload->UploadFile()) {

				// No action required
			} else {
				echo $cases->casepic2->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			if ($cases->casepic3->Upload->UploadFile()) {

				// No action required
			} else {
				echo $cases->casepic3->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			if ($cases->casepic4->Upload->UploadFile()) {

				// No action required
			} else {
				echo $cases->casepic4->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			if ($cases->casepic5->Upload->UploadFile()) {

				// No action required
			} else {
				echo $cases->casepic5->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			if ($cases->casepic6->Upload->UploadFile()) {

				// No action required
			} else {
				echo $cases->casepic6->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			if ($cases->casepic7->Upload->UploadFile()) {

				// No action required
			} else {
				echo $cases->casepic7->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			if ($cases->casepic8->Upload->UploadFile()) {

				// No action required
			} else {
				echo $cases->casepic8->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			if ($cases->casepic9->Upload->UploadFile()) {

				// No action required
			} else {
				echo $cases->casepic9->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load default values
	function LoadDefaultValues() {
		global $cases;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $cases;
		$cases->casetitle->setFormValue($objForm->GetValue("x_casetitle"));
		$cases->casedesc->setFormValue($objForm->GetValue("x_casedesc"));
		$cases->rootid->setFormValue($objForm->GetValue("x_rootid"));
		$cases->catid->setFormValue($objForm->GetValue("x_catid"));
		$cases->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $cases;
		$cases->id->CurrentValue = $cases->id->FormValue;
		$cases->casetitle->CurrentValue = $cases->casetitle->FormValue;
		$cases->casedesc->CurrentValue = $cases->casedesc->FormValue;
		$cases->rootid->CurrentValue = $cases->rootid->FormValue;
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
		$cases->casedesc->setDbValue($rs->fields('casedesc'));
		$cases->rootid->setDbValue($rs->fields('rootid'));
		$cases->catid->setDbValue($rs->fields('catid'));
		$cases->casepic1->Upload->DbValue = $rs->fields('casepic1');
		$cases->casepic2->Upload->DbValue = $rs->fields('casepic2');
		$cases->casepic3->Upload->DbValue = $rs->fields('casepic3');
		$cases->casepic4->Upload->DbValue = $rs->fields('casepic4');
		$cases->casepic5->Upload->DbValue = $rs->fields('casepic5');
		$cases->casepic6->Upload->DbValue = $rs->fields('casepic6');
		$cases->casepic7->Upload->DbValue = $rs->fields('casepic7');
		$cases->casepic8->Upload->DbValue = $rs->fields('casepic8');
		$cases->casepic9->Upload->DbValue = $rs->fields('casepic9');
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $cases;

		// Call Row_Rendering event
		$cases->Row_Rendering();

		// Common render codes for all row types
		// casetitle

		$cases->casetitle->CellCssStyle = "";
		$cases->casetitle->CellCssClass = "";

		// casedesc
		$cases->casedesc->CellCssStyle = "";
		$cases->casedesc->CellCssClass = "";

		// rootid
		$cases->rootid->CellCssStyle = "";
		$cases->rootid->CellCssClass = "";

		// catid
		$cases->catid->CellCssStyle = "";
		$cases->catid->CellCssClass = "";

		// casepic1
		$cases->casepic1->CellCssStyle = "";
		$cases->casepic1->CellCssClass = "";

		// casepic2
		$cases->casepic2->CellCssStyle = "";
		$cases->casepic2->CellCssClass = "";

		// casepic3
		$cases->casepic3->CellCssStyle = "";
		$cases->casepic3->CellCssClass = "";

		// casepic4
		$cases->casepic4->CellCssStyle = "";
		$cases->casepic4->CellCssClass = "";

		// casepic5
		$cases->casepic5->CellCssStyle = "";
		$cases->casepic5->CellCssClass = "";

		// casepic6
		$cases->casepic6->CellCssStyle = "";
		$cases->casepic6->CellCssClass = "";

		// casepic7
		$cases->casepic7->CellCssStyle = "";
		$cases->casepic7->CellCssClass = "";

		// casepic8
		$cases->casepic8->CellCssStyle = "";
		$cases->casepic8->CellCssClass = "";

		// casepic9
		$cases->casepic9->CellCssStyle = "";
		$cases->casepic9->CellCssClass = "";
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

			// casedesc
			$cases->casedesc->ViewValue = $cases->casedesc->CurrentValue;
			$cases->casedesc->CssStyle = "";
			$cases->casedesc->CssClass = "";
			$cases->casedesc->ViewCustomAttributes = "";

			// rootid
			if (strval($cases->rootid->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `rootname` FROM `casesroot` WHERE `id` = " . ew_AdjustSql($cases->rootid->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$cases->rootid->ViewValue = $rswrk->fields('rootname');
					$rswrk->Close();
				} else {
					$cases->rootid->ViewValue = $cases->rootid->CurrentValue;
				}
			} else {
				$cases->rootid->ViewValue = NULL;
			}
			$cases->rootid->CssStyle = "";
			$cases->rootid->CssClass = "";
			$cases->rootid->ViewCustomAttributes = "";

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

			// casepic1
			if (!is_null($cases->casepic1->Upload->DbValue)) {
				$cases->casepic1->ViewValue = $cases->casepic1->Upload->DbValue;
				$cases->casepic1->ImageAlt = "";
			} else {
				$cases->casepic1->ViewValue = "";
			}
			$cases->casepic1->CssStyle = "";
			$cases->casepic1->CssClass = "";
			$cases->casepic1->ViewCustomAttributes = "";

			// casepic2
			if (!is_null($cases->casepic2->Upload->DbValue)) {
				$cases->casepic2->ViewValue = $cases->casepic2->Upload->DbValue;
				$cases->casepic2->ImageAlt = "";
			} else {
				$cases->casepic2->ViewValue = "";
			}
			$cases->casepic2->CssStyle = "";
			$cases->casepic2->CssClass = "";
			$cases->casepic2->ViewCustomAttributes = "";

			// casepic3
			if (!is_null($cases->casepic3->Upload->DbValue)) {
				$cases->casepic3->ViewValue = $cases->casepic3->Upload->DbValue;
				$cases->casepic3->ImageAlt = "";
			} else {
				$cases->casepic3->ViewValue = "";
			}
			$cases->casepic3->CssStyle = "";
			$cases->casepic3->CssClass = "";
			$cases->casepic3->ViewCustomAttributes = "";

			// casepic4
			if (!is_null($cases->casepic4->Upload->DbValue)) {
				$cases->casepic4->ViewValue = $cases->casepic4->Upload->DbValue;
				$cases->casepic4->ImageAlt = "";
			} else {
				$cases->casepic4->ViewValue = "";
			}
			$cases->casepic4->CssStyle = "";
			$cases->casepic4->CssClass = "";
			$cases->casepic4->ViewCustomAttributes = "";

			// casepic5
			if (!is_null($cases->casepic5->Upload->DbValue)) {
				$cases->casepic5->ViewValue = $cases->casepic5->Upload->DbValue;
				$cases->casepic5->ImageAlt = "";
			} else {
				$cases->casepic5->ViewValue = "";
			}
			$cases->casepic5->CssStyle = "";
			$cases->casepic5->CssClass = "";
			$cases->casepic5->ViewCustomAttributes = "";

			// casepic6
			if (!is_null($cases->casepic6->Upload->DbValue)) {
				$cases->casepic6->ViewValue = $cases->casepic6->Upload->DbValue;
				$cases->casepic6->ImageAlt = "";
			} else {
				$cases->casepic6->ViewValue = "";
			}
			$cases->casepic6->CssStyle = "";
			$cases->casepic6->CssClass = "";
			$cases->casepic6->ViewCustomAttributes = "";

			// casepic7
			if (!is_null($cases->casepic7->Upload->DbValue)) {
				$cases->casepic7->ViewValue = $cases->casepic7->Upload->DbValue;
				$cases->casepic7->ImageAlt = "";
			} else {
				$cases->casepic7->ViewValue = "";
			}
			$cases->casepic7->CssStyle = "";
			$cases->casepic7->CssClass = "";
			$cases->casepic7->ViewCustomAttributes = "";

			// casepic8
			if (!is_null($cases->casepic8->Upload->DbValue)) {
				$cases->casepic8->ViewValue = $cases->casepic8->Upload->DbValue;
				$cases->casepic8->ImageAlt = "";
			} else {
				$cases->casepic8->ViewValue = "";
			}
			$cases->casepic8->CssStyle = "";
			$cases->casepic8->CssClass = "";
			$cases->casepic8->ViewCustomAttributes = "";

			// casepic9
			if (!is_null($cases->casepic9->Upload->DbValue)) {
				$cases->casepic9->ViewValue = $cases->casepic9->Upload->DbValue;
				$cases->casepic9->ImageAlt = "";
			} else {
				$cases->casepic9->ViewValue = "";
			}
			$cases->casepic9->CssStyle = "";
			$cases->casepic9->CssClass = "";
			$cases->casepic9->ViewCustomAttributes = "";

			// casetitle
			$cases->casetitle->HrefValue = "";

			// casedesc
			$cases->casedesc->HrefValue = "";

			// rootid
			$cases->rootid->HrefValue = "";

			// catid
			$cases->catid->HrefValue = "";

			// casepic1
			$cases->casepic1->HrefValue = "";

			// casepic2
			$cases->casepic2->HrefValue = "";

			// casepic3
			$cases->casepic3->HrefValue = "";

			// casepic4
			$cases->casepic4->HrefValue = "";

			// casepic5
			$cases->casepic5->HrefValue = "";

			// casepic6
			$cases->casepic6->HrefValue = "";

			// casepic7
			$cases->casepic7->HrefValue = "";

			// casepic8
			$cases->casepic8->HrefValue = "";

			// casepic9
			$cases->casepic9->HrefValue = "";
		} elseif ($cases->RowType == EW_ROWTYPE_ADD) { // Add row

			// casetitle
			$cases->casetitle->EditCustomAttributes = "";
			$cases->casetitle->EditValue = ew_HtmlEncode($cases->casetitle->CurrentValue);

			// casedesc
			$cases->casedesc->EditCustomAttributes = "";
			$cases->casedesc->EditValue = ew_HtmlEncode($cases->casedesc->CurrentValue);

			// rootid
			$cases->rootid->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id`, `rootname`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `casesroot`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "请选择"));
			$cases->rootid->EditValue = $arwrk;

			// catid
			$cases->catid->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id`, `catname`, '' AS Disp2Fld, `rootid` FROM `casescat`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "请选择", ""));
			$cases->catid->EditValue = $arwrk;

			// casepic1
			$cases->casepic1->EditCustomAttributes = "";
			if (!is_null($cases->casepic1->Upload->DbValue)) {
				$cases->casepic1->EditValue = $cases->casepic1->Upload->DbValue;
				$cases->casepic1->ImageAlt = "";
			} else {
				$cases->casepic1->EditValue = "";
			}

			// casepic2
			$cases->casepic2->EditCustomAttributes = "";
			if (!is_null($cases->casepic2->Upload->DbValue)) {
				$cases->casepic2->EditValue = $cases->casepic2->Upload->DbValue;
				$cases->casepic2->ImageAlt = "";
			} else {
				$cases->casepic2->EditValue = "";
			}

			// casepic3
			$cases->casepic3->EditCustomAttributes = "";
			if (!is_null($cases->casepic3->Upload->DbValue)) {
				$cases->casepic3->EditValue = $cases->casepic3->Upload->DbValue;
				$cases->casepic3->ImageAlt = "";
			} else {
				$cases->casepic3->EditValue = "";
			}

			// casepic4
			$cases->casepic4->EditCustomAttributes = "";
			if (!is_null($cases->casepic4->Upload->DbValue)) {
				$cases->casepic4->EditValue = $cases->casepic4->Upload->DbValue;
				$cases->casepic4->ImageAlt = "";
			} else {
				$cases->casepic4->EditValue = "";
			}

			// casepic5
			$cases->casepic5->EditCustomAttributes = "";
			if (!is_null($cases->casepic5->Upload->DbValue)) {
				$cases->casepic5->EditValue = $cases->casepic5->Upload->DbValue;
				$cases->casepic5->ImageAlt = "";
			} else {
				$cases->casepic5->EditValue = "";
			}

			// casepic6
			$cases->casepic6->EditCustomAttributes = "";
			if (!is_null($cases->casepic6->Upload->DbValue)) {
				$cases->casepic6->EditValue = $cases->casepic6->Upload->DbValue;
				$cases->casepic6->ImageAlt = "";
			} else {
				$cases->casepic6->EditValue = "";
			}

			// casepic7
			$cases->casepic7->EditCustomAttributes = "";
			if (!is_null($cases->casepic7->Upload->DbValue)) {
				$cases->casepic7->EditValue = $cases->casepic7->Upload->DbValue;
				$cases->casepic7->ImageAlt = "";
			} else {
				$cases->casepic7->EditValue = "";
			}

			// casepic8
			$cases->casepic8->EditCustomAttributes = "";
			if (!is_null($cases->casepic8->Upload->DbValue)) {
				$cases->casepic8->EditValue = $cases->casepic8->Upload->DbValue;
				$cases->casepic8->ImageAlt = "";
			} else {
				$cases->casepic8->EditValue = "";
			}

			// casepic9
			$cases->casepic9->EditCustomAttributes = "";
			if (!is_null($cases->casepic9->Upload->DbValue)) {
				$cases->casepic9->EditValue = $cases->casepic9->Upload->DbValue;
				$cases->casepic9->ImageAlt = "";
			} else {
				$cases->casepic9->EditValue = "";
			}
		}

		// Call Row Rendered event
		$cases->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $cases;

		// Initialize
		$gsFormError = "";
		if (!ew_CheckFileType($cases->casepic1->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "不允许上传的文件类型";
		}
		if ($cases->casepic1->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($cases->casepic1->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "文件大小超过限制 (%s 字节)");
		}
		if (!ew_CheckFileType($cases->casepic2->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "不允许上传的文件类型";
		}
		if ($cases->casepic2->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($cases->casepic2->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "文件大小超过限制 (%s 字节)");
		}
		if (!ew_CheckFileType($cases->casepic3->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "不允许上传的文件类型";
		}
		if ($cases->casepic3->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($cases->casepic3->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "文件大小超过限制 (%s 字节)");
		}
		if (!ew_CheckFileType($cases->casepic4->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "不允许上传的文件类型";
		}
		if ($cases->casepic4->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($cases->casepic4->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "文件大小超过限制 (%s 字节)");
		}
		if (!ew_CheckFileType($cases->casepic5->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "不允许上传的文件类型";
		}
		if ($cases->casepic5->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($cases->casepic5->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "文件大小超过限制 (%s 字节)");
		}
		if (!ew_CheckFileType($cases->casepic6->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "不允许上传的文件类型";
		}
		if ($cases->casepic6->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($cases->casepic6->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "文件大小超过限制 (%s 字节)");
		}
		if (!ew_CheckFileType($cases->casepic7->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "不允许上传的文件类型";
		}
		if ($cases->casepic7->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($cases->casepic7->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "文件大小超过限制 (%s 字节)");
		}
		if (!ew_CheckFileType($cases->casepic8->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "不允许上传的文件类型";
		}
		if ($cases->casepic8->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($cases->casepic8->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "文件大小超过限制 (%s 字节)");
		}
		if (!ew_CheckFileType($cases->casepic9->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "不允许上传的文件类型";
		}
		if ($cases->casepic9->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($cases->casepic9->Upload->FileSize > EW_MAX_FILE_SIZE)
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
		if ($cases->rootid->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 根类型";
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

	// Add record
	function AddRow() {
		global $conn, $Security, $cases;
		$rsnew = array();

		// Field casetitle
		$cases->casetitle->SetDbValueDef($cases->casetitle->CurrentValue, "");
		$rsnew['casetitle'] =& $cases->casetitle->DbValue;

		// Field casedesc
		$cases->casedesc->SetDbValueDef($cases->casedesc->CurrentValue, "");
		$rsnew['casedesc'] =& $cases->casedesc->DbValue;

		// Field rootid
		$cases->rootid->SetDbValueDef($cases->rootid->CurrentValue, 0);
		$rsnew['rootid'] =& $cases->rootid->DbValue;

		// Field catid
		$cases->catid->SetDbValueDef($cases->catid->CurrentValue, 0);
		$rsnew['catid'] =& $cases->catid->DbValue;

		// Field casepic1
		$cases->casepic1->Upload->SaveToSession(); // Save file value to Session
		if (is_null($cases->casepic1->Upload->Value)) {
			$rsnew['casepic1'] = NULL;
		} else {
			$rsnew['casepic1'] = ew_UploadFileNameEx(ew_UploadPathEx(True, EW_UPLOAD_DEST_PATH), $cases->casepic1->Upload->FileName);
		}

		// Field casepic2
		$cases->casepic2->Upload->SaveToSession(); // Save file value to Session
		if (is_null($cases->casepic2->Upload->Value)) {
			$rsnew['casepic2'] = NULL;
		} else {
			$rsnew['casepic2'] = ew_UploadFileNameEx(ew_UploadPathEx(True, EW_UPLOAD_DEST_PATH), $cases->casepic2->Upload->FileName);
		}

		// Field casepic3
		$cases->casepic3->Upload->SaveToSession(); // Save file value to Session
		if (is_null($cases->casepic3->Upload->Value)) {
			$rsnew['casepic3'] = NULL;
		} else {
			$rsnew['casepic3'] = ew_UploadFileNameEx(ew_UploadPathEx(True, EW_UPLOAD_DEST_PATH), $cases->casepic3->Upload->FileName);
		}

		// Field casepic4
		$cases->casepic4->Upload->SaveToSession(); // Save file value to Session
		if (is_null($cases->casepic4->Upload->Value)) {
			$rsnew['casepic4'] = NULL;
		} else {
			$rsnew['casepic4'] = ew_UploadFileNameEx(ew_UploadPathEx(True, EW_UPLOAD_DEST_PATH), $cases->casepic4->Upload->FileName);
		}

		// Field casepic5
		$cases->casepic5->Upload->SaveToSession(); // Save file value to Session
		if (is_null($cases->casepic5->Upload->Value)) {
			$rsnew['casepic5'] = NULL;
		} else {
			$rsnew['casepic5'] = ew_UploadFileNameEx(ew_UploadPathEx(True, EW_UPLOAD_DEST_PATH), $cases->casepic5->Upload->FileName);
		}

		// Field casepic6
		$cases->casepic6->Upload->SaveToSession(); // Save file value to Session
		if (is_null($cases->casepic6->Upload->Value)) {
			$rsnew['casepic6'] = NULL;
		} else {
			$rsnew['casepic6'] = ew_UploadFileNameEx(ew_UploadPathEx(True, EW_UPLOAD_DEST_PATH), $cases->casepic6->Upload->FileName);
		}

		// Field casepic7
		$cases->casepic7->Upload->SaveToSession(); // Save file value to Session
		if (is_null($cases->casepic7->Upload->Value)) {
			$rsnew['casepic7'] = NULL;
		} else {
			$rsnew['casepic7'] = ew_UploadFileNameEx(ew_UploadPathEx(True, EW_UPLOAD_DEST_PATH), $cases->casepic7->Upload->FileName);
		}

		// Field casepic8
		$cases->casepic8->Upload->SaveToSession(); // Save file value to Session
		if (is_null($cases->casepic8->Upload->Value)) {
			$rsnew['casepic8'] = NULL;
		} else {
			$rsnew['casepic8'] = ew_UploadFileNameEx(ew_UploadPathEx(True, EW_UPLOAD_DEST_PATH), $cases->casepic8->Upload->FileName);
		}

		// Field casepic9
		$cases->casepic9->Upload->SaveToSession(); // Save file value to Session
		if (is_null($cases->casepic9->Upload->Value)) {
			$rsnew['casepic9'] = NULL;
		} else {
			$rsnew['casepic9'] = ew_UploadFileNameEx(ew_UploadPathEx(True, EW_UPLOAD_DEST_PATH), $cases->casepic9->Upload->FileName);
		}

		// Call Row Inserting event
		$bInsertRow = $cases->Row_Inserting($rsnew);
		if ($bInsertRow) {

			// Field casepic1
			if (!is_null($cases->casepic1->Upload->Value)) {
				$cases->casepic1->Upload->SaveToFile(EW_UPLOAD_DEST_PATH, $rsnew['casepic1'], FALSE);
			}

			// Field casepic2
			if (!is_null($cases->casepic2->Upload->Value)) {
				$cases->casepic2->Upload->SaveToFile(EW_UPLOAD_DEST_PATH, $rsnew['casepic2'], FALSE);
			}

			// Field casepic3
			if (!is_null($cases->casepic3->Upload->Value)) {
				$cases->casepic3->Upload->SaveToFile(EW_UPLOAD_DEST_PATH, $rsnew['casepic3'], FALSE);
			}

			// Field casepic4
			if (!is_null($cases->casepic4->Upload->Value)) {
				$cases->casepic4->Upload->SaveToFile(EW_UPLOAD_DEST_PATH, $rsnew['casepic4'], FALSE);
			}

			// Field casepic5
			if (!is_null($cases->casepic5->Upload->Value)) {
				$cases->casepic5->Upload->SaveToFile(EW_UPLOAD_DEST_PATH, $rsnew['casepic5'], FALSE);
			}

			// Field casepic6
			if (!is_null($cases->casepic6->Upload->Value)) {
				$cases->casepic6->Upload->SaveToFile(EW_UPLOAD_DEST_PATH, $rsnew['casepic6'], FALSE);
			}

			// Field casepic7
			if (!is_null($cases->casepic7->Upload->Value)) {
				$cases->casepic7->Upload->SaveToFile(EW_UPLOAD_DEST_PATH, $rsnew['casepic7'], FALSE);
			}

			// Field casepic8
			if (!is_null($cases->casepic8->Upload->Value)) {
				$cases->casepic8->Upload->SaveToFile(EW_UPLOAD_DEST_PATH, $rsnew['casepic8'], FALSE);
			}

			// Field casepic9
			if (!is_null($cases->casepic9->Upload->Value)) {
				$cases->casepic9->Upload->SaveToFile(EW_UPLOAD_DEST_PATH, $rsnew['casepic9'], FALSE);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($cases->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($cases->CancelMessage <> "") {
				$this->setMessage($cases->CancelMessage);
				$cases->CancelMessage = "";
			} else {
				$this->setMessage("已取消");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$cases->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $cases->id->DbValue;

			// Call Row Inserted event
			$cases->Row_Inserted($rsnew);
		}

		// Field casepic1
		$cases->casepic1->Upload->RemoveFromSession(); // Remove file value from Session

		// Field casepic2
		$cases->casepic2->Upload->RemoveFromSession(); // Remove file value from Session

		// Field casepic3
		$cases->casepic3->Upload->RemoveFromSession(); // Remove file value from Session

		// Field casepic4
		$cases->casepic4->Upload->RemoveFromSession(); // Remove file value from Session

		// Field casepic5
		$cases->casepic5->Upload->RemoveFromSession(); // Remove file value from Session

		// Field casepic6
		$cases->casepic6->Upload->RemoveFromSession(); // Remove file value from Session

		// Field casepic7
		$cases->casepic7->Upload->RemoveFromSession(); // Remove file value from Session

		// Field casepic8
		$cases->casepic8->Upload->RemoveFromSession(); // Remove file value from Session

		// Field casepic9
		$cases->casepic9->Upload->RemoveFromSession(); // Remove file value from Session
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
