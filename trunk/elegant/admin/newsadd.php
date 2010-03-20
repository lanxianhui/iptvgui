<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "newsinfo.php" ?>
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
$news_add = new cnews_add();
$Page =& $news_add;

// Page init processing
$news_add->Page_Init();

// Page main processing
$news_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var news_add = new ew_Page("news_add");

// page properties
news_add.PageID = "add"; // page ID
var EW_PAGE_ID = news_add.PageID; // for backward compatibility

// extend page with ValidateForm function
news_add.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_newstitle"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 新闻标题");
		elm = fobj.elements["x" + infix + "_catid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 新闻类型");
		elm = fobj.elements["x" + infix + "_newsdesc"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 新闻内容");
		elm = fobj.elements["x" + infix + "_pubtime"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 发布时间");
		elm = fobj.elements["x" + infix + "_pubtime"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "错误的日期格式, 格式 = yyyy/mm/dd - 发布时间");
		elm = fobj.elements["x" + infix + "_newsimg"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, "不允许上传的文件类型");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
news_add.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
news_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
news_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">添加到 表: News<br><br>
<a href="<?php echo $news->getReturnUrl() ?>">返回</a></span></p>
<?php $news_add->ShowMessage() ?>
<form name="fnewsadd" id="fnewsadd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data">
<p>
<input type="hidden" name="t" id="t" value="news">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($news->newstitle->Visible) { // newstitle ?>
	<tr<?php echo $news->newstitle->RowAttributes ?>>
		<td class="ewTableHeader">新闻标题<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $news->newstitle->CellAttributes() ?>><span id="el_newstitle">
<input type="text" name="x_newstitle" id="x_newstitle" size="30" maxlength="200" value="<?php echo $news->newstitle->EditValue ?>"<?php echo $news->newstitle->EditAttributes() ?>>
</span><?php echo $news->newstitle->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($news->catid->Visible) { // catid ?>
	<tr<?php echo $news->catid->RowAttributes ?>>
		<td class="ewTableHeader">新闻类型<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $news->catid->CellAttributes() ?>><span id="el_catid">
<select id="x_catid" name="x_catid"<?php echo $news->catid->EditAttributes() ?>>
<?php
if (is_array($news->catid->EditValue)) {
	$arwrk = $news->catid->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($news->catid->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $news->catid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($news->newsdesc->Visible) { // newsdesc ?>
	<tr<?php echo $news->newsdesc->RowAttributes ?>>
		<td class="ewTableHeader">新闻内容<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $news->newsdesc->CellAttributes() ?>><span id="el_newsdesc">
<textarea name="x_newsdesc" id="x_newsdesc" cols="35" rows="4"<?php echo $news->newsdesc->EditAttributes() ?>><?php echo $news->newsdesc->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_newsdesc", function() {
	var sBasePath = 'fckeditor/';
	var oFCKeditor = new FCKeditor('x_newsdesc', 35*_width_multiplier, 4*_height_multiplier);
	oFCKeditor.BasePath = sBasePath;
	oFCKeditor.ReplaceTextarea();
	this.active = true;
}));
-->
</script>
</span><?php echo $news->newsdesc->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($news->pubtime->Visible) { // pubtime ?>
	<tr<?php echo $news->pubtime->RowAttributes ?>>
		<td class="ewTableHeader">发布时间<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $news->pubtime->CellAttributes() ?>><span id="el_pubtime">
<input type="text" name="x_pubtime" id="x_pubtime" value="<?php echo $news->pubtime->EditValue ?>"<?php echo $news->pubtime->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_pubtime" name="cal_x_pubtime" alt="选择日期" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_pubtime", // ID of the input field
	ifFormat : "%Y/%m/%d", // the date format
	button : "cal_x_pubtime" // ID of the button
});
</script>
</span><?php echo $news->pubtime->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($news->newsimg->Visible) { // newsimg ?>
	<tr<?php echo $news->newsimg->RowAttributes ?>>
		<td class="ewTableHeader">新闻图片</td>
		<td<?php echo $news->newsimg->CellAttributes() ?>><span id="el_newsimg">
<input type="file" name="x_newsimg" id="x_newsimg"<?php echo $news->newsimg->EditAttributes() ?>>
</div>
</span><?php echo $news->newsimg->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="button" name="btnAction" id="btnAction" value="    添加    " onclick="ew_SubmitForm(news_add, this.form);">
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
class cnews_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'news';

	// Page Object Name
	var $PageObjName = 'news_add';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $news;
		if ($news->UseTokenInUrl) $PageUrl .= "t=" . $news->TableVar . "&"; // add page token
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
		global $objForm, $news;
		if ($news->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($news->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($news->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cnews_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["news"] = new cnews();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'news', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $news;

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
		global $objForm, $gsFormError, $news;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $news->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $news->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->GetUploadFiles(); // Get upload files
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$news->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $news->CurrentAction = "C"; // Copy Record
		  } else {
		    $news->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($news->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("没有数据"); // No record found
		      $this->Page_Terminate("newslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$news->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("添加成功"); // Set up success message
					$sReturnUrl = $news->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$news->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $news;

		// Get upload data
			if ($news->newsimg->Upload->UploadFile()) {

				// No action required
			} else {
				echo $news->newsimg->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load default values
	function LoadDefaultValues() {
		global $news;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $news;
		$news->newstitle->setFormValue($objForm->GetValue("x_newstitle"));
		$news->catid->setFormValue($objForm->GetValue("x_catid"));
		$news->newsdesc->setFormValue($objForm->GetValue("x_newsdesc"));
		$news->pubtime->setFormValue($objForm->GetValue("x_pubtime"));
		$news->pubtime->CurrentValue = ew_UnFormatDateTime($news->pubtime->CurrentValue, 5);
		$news->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $news;
		$news->id->CurrentValue = $news->id->FormValue;
		$news->newstitle->CurrentValue = $news->newstitle->FormValue;
		$news->catid->CurrentValue = $news->catid->FormValue;
		$news->newsdesc->CurrentValue = $news->newsdesc->FormValue;
		$news->pubtime->CurrentValue = $news->pubtime->FormValue;
		$news->pubtime->CurrentValue = ew_UnFormatDateTime($news->pubtime->CurrentValue, 5);
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $news;
		$sFilter = $news->KeyFilter();

		// Call Row Selecting event
		$news->Row_Selecting($sFilter);

		// Load sql based on filter
		$news->CurrentFilter = $sFilter;
		$sSql = $news->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$news->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $news;
		$news->id->setDbValue($rs->fields('id'));
		$news->newstitle->setDbValue($rs->fields('newstitle'));
		$news->catid->setDbValue($rs->fields('catid'));
		$news->newsdesc->setDbValue($rs->fields('newsdesc'));
		$news->pubtime->setDbValue($rs->fields('pubtime'));
		$news->newsimg->Upload->DbValue = $rs->fields('newsimg');
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $news;

		// Call Row_Rendering event
		$news->Row_Rendering();

		// Common render codes for all row types
		// newstitle

		$news->newstitle->CellCssStyle = "";
		$news->newstitle->CellCssClass = "";

		// catid
		$news->catid->CellCssStyle = "";
		$news->catid->CellCssClass = "";

		// newsdesc
		$news->newsdesc->CellCssStyle = "";
		$news->newsdesc->CellCssClass = "";

		// pubtime
		$news->pubtime->CellCssStyle = "";
		$news->pubtime->CellCssClass = "";

		// newsimg
		$news->newsimg->CellCssStyle = "";
		$news->newsimg->CellCssClass = "";
		if ($news->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$news->id->ViewValue = $news->id->CurrentValue;
			$news->id->CssStyle = "";
			$news->id->CssClass = "";
			$news->id->ViewCustomAttributes = "";

			// newstitle
			$news->newstitle->ViewValue = $news->newstitle->CurrentValue;
			$news->newstitle->CssStyle = "";
			$news->newstitle->CssClass = "";
			$news->newstitle->ViewCustomAttributes = "";

			// catid
			if (strval($news->catid->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `catname` FROM `newscat` WHERE `id` = " . ew_AdjustSql($news->catid->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$news->catid->ViewValue = $rswrk->fields('catname');
					$rswrk->Close();
				} else {
					$news->catid->ViewValue = $news->catid->CurrentValue;
				}
			} else {
				$news->catid->ViewValue = NULL;
			}
			$news->catid->CssStyle = "";
			$news->catid->CssClass = "";
			$news->catid->ViewCustomAttributes = "";

			// newsdesc
			$news->newsdesc->ViewValue = $news->newsdesc->CurrentValue;
			$news->newsdesc->CssStyle = "";
			$news->newsdesc->CssClass = "";
			$news->newsdesc->ViewCustomAttributes = "";

			// pubtime
			$news->pubtime->ViewValue = $news->pubtime->CurrentValue;
			$news->pubtime->ViewValue = ew_FormatDateTime($news->pubtime->ViewValue, 5);
			$news->pubtime->CssStyle = "";
			$news->pubtime->CssClass = "";
			$news->pubtime->ViewCustomAttributes = "";

			// newsimg
			if (!is_null($news->newsimg->Upload->DbValue)) {
				$news->newsimg->ViewValue = $news->newsimg->Upload->DbValue;
				$news->newsimg->ImageAlt = "";
			} else {
				$news->newsimg->ViewValue = "";
			}
			$news->newsimg->CssStyle = "";
			$news->newsimg->CssClass = "";
			$news->newsimg->ViewCustomAttributes = "";

			// newstitle
			$news->newstitle->HrefValue = "";

			// catid
			$news->catid->HrefValue = "";

			// newsdesc
			$news->newsdesc->HrefValue = "";

			// pubtime
			$news->pubtime->HrefValue = "";

			// newsimg
			$news->newsimg->HrefValue = "";
		} elseif ($news->RowType == EW_ROWTYPE_ADD) { // Add row

			// newstitle
			$news->newstitle->EditCustomAttributes = "";
			$news->newstitle->EditValue = ew_HtmlEncode($news->newstitle->CurrentValue);

			// catid
			$news->catid->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id`, `catname`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `newscat`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "请选择"));
			$news->catid->EditValue = $arwrk;

			// newsdesc
			$news->newsdesc->EditCustomAttributes = "";
			$news->newsdesc->EditValue = ew_HtmlEncode($news->newsdesc->CurrentValue);

			// pubtime
			$news->pubtime->EditCustomAttributes = "";
			$news->pubtime->EditValue = ew_HtmlEncode(ew_FormatDateTime($news->pubtime->CurrentValue, 5));

			// newsimg
			$news->newsimg->EditCustomAttributes = "";
			if (!is_null($news->newsimg->Upload->DbValue)) {
				$news->newsimg->EditValue = $news->newsimg->Upload->DbValue;
				$news->newsimg->ImageAlt = "";
			} else {
				$news->newsimg->EditValue = "";
			}
		}

		// Call Row Rendered event
		$news->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $news;

		// Initialize
		$gsFormError = "";
		if (!ew_CheckFileType($news->newsimg->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "不允许上传的文件类型";
		}
		if ($news->newsimg->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($news->newsimg->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "文件大小超过限制 (%s 字节)");
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($news->newstitle->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 新闻标题";
		}
		if ($news->catid->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 新闻类型";
		}
		if ($news->newsdesc->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 新闻内容";
		}
		if ($news->pubtime->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 发布时间";
		}
		if (!ew_CheckDate($news->pubtime->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "错误的日期格式, 格式 = yyyy/mm/dd - 发布时间";
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
		global $conn, $Security, $news;
		$rsnew = array();

		// Field newstitle
		$news->newstitle->SetDbValueDef($news->newstitle->CurrentValue, NULL);
		$rsnew['newstitle'] =& $news->newstitle->DbValue;

		// Field catid
		$news->catid->SetDbValueDef($news->catid->CurrentValue, NULL);
		$rsnew['catid'] =& $news->catid->DbValue;

		// Field newsdesc
		$news->newsdesc->SetDbValueDef($news->newsdesc->CurrentValue, NULL);
		$rsnew['newsdesc'] =& $news->newsdesc->DbValue;

		// Field pubtime
		$news->pubtime->SetDbValueDef(ew_UnFormatDateTime($news->pubtime->CurrentValue, 5), NULL);
		$rsnew['pubtime'] =& $news->pubtime->DbValue;

		// Field newsimg
		$news->newsimg->Upload->SaveToSession(); // Save file value to Session
		if (is_null($news->newsimg->Upload->Value)) {
			$rsnew['newsimg'] = NULL;
		} else {
			$rsnew['newsimg'] = ew_UploadFileNameEx(ew_UploadPathEx(True, EW_UPLOAD_DEST_PATH), $news->newsimg->Upload->FileName);
		}

		// Call Row Inserting event
		$bInsertRow = $news->Row_Inserting($rsnew);
		if ($bInsertRow) {

			// Field newsimg
			if (!is_null($news->newsimg->Upload->Value)) {
				$news->newsimg->Upload->SaveToFile(EW_UPLOAD_DEST_PATH, $rsnew['newsimg'], FALSE);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($news->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($news->CancelMessage <> "") {
				$this->setMessage($news->CancelMessage);
				$news->CancelMessage = "";
			} else {
				$this->setMessage("已取消");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$news->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $news->id->DbValue;

			// Call Row Inserted event
			$news->Row_Inserted($rsnew);
		}

		// Field newsimg
		$news->newsimg->Upload->RemoveFromSession(); // Remove file value from Session
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
