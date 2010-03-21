<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "teaminfo.php" ?>
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
$team_add = new cteam_add();
$Page =& $team_add;

// Page init processing
$team_add->Page_Init();

// Page main processing
$team_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var team_add = new ew_Page("team_add");

// page properties
team_add.PageID = "add"; // page ID
var EW_PAGE_ID = team_add.PageID; // for backward compatibility

// extend page with ValidateForm function
team_add.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "必填项 - 成员ID");
		elm = fobj.elements["x" + infix + "_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "错误的 Integer - 成员ID");
		elm = fobj.elements["x" + infix + "_teampic"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, "不允许上传的文件类型");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
team_add.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
team_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
team_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
team_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">添加到 表: Team<br><br>
<a href="<?php echo $team->getReturnUrl() ?>">返回</a></span></p>
<?php $team_add->ShowMessage() ?>
<form name="fteamadd" id="fteamadd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data">
<p>
<input type="hidden" name="t" id="t" value="team">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($team->id->Visible) { // id ?>
	<tr<?php echo $team->id->RowAttributes ?>>
		<td class="ewTableHeader">成员ID<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $team->id->CellAttributes() ?>><span id="el_id"></span><?php echo $team->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($team->teamname->Visible) { // teamname ?>
	<tr<?php echo $team->teamname->RowAttributes ?>>
		<td class="ewTableHeader">成员名称</td>
		<td<?php echo $team->teamname->CellAttributes() ?>><span id="el_teamname">
<input type="text" name="x_teamname" id="x_teamname" size="30" maxlength="200" value="<?php echo $team->teamname->EditValue ?>"<?php echo $team->teamname->EditAttributes() ?>>
</span><?php echo $team->teamname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($team->teampic->Visible) { // teampic ?>
	<tr<?php echo $team->teampic->RowAttributes ?>>
		<td class="ewTableHeader">成员图片</td>
		<td<?php echo $team->teampic->CellAttributes() ?>><span id="el_teampic">
<input type="file" name="x_teampic" id="x_teampic"<?php echo $team->teampic->EditAttributes() ?>>
</div>
</span><?php echo $team->teampic->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($team->teamjobs->Visible) { // teamjobs ?>
	<tr<?php echo $team->teamjobs->RowAttributes ?>>
		<td class="ewTableHeader">成员职位</td>
		<td<?php echo $team->teamjobs->CellAttributes() ?>><span id="el_teamjobs">
<input type="text" name="x_teamjobs" id="x_teamjobs" size="30" maxlength="200" value="<?php echo $team->teamjobs->EditValue ?>"<?php echo $team->teamjobs->EditAttributes() ?>>
</span><?php echo $team->teamjobs->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($team->teamdesc->Visible) { // teamdesc ?>
	<tr<?php echo $team->teamdesc->RowAttributes ?>>
		<td class="ewTableHeader">成员描述</td>
		<td<?php echo $team->teamdesc->CellAttributes() ?>><span id="el_teamdesc">
<textarea name="x_teamdesc" id="x_teamdesc" cols="35" rows="4"<?php echo $team->teamdesc->EditAttributes() ?>><?php echo $team->teamdesc->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_teamdesc", function() {
	var sBasePath = 'fckeditor/';
	var oFCKeditor = new FCKeditor('x_teamdesc', 35*_width_multiplier, 4*_height_multiplier);
	oFCKeditor.BasePath = sBasePath;
	oFCKeditor.ReplaceTextarea();
	this.active = true;
}));
-->
</script>
</span><?php echo $team->teamdesc->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="button" name="btnAction" id="btnAction" value="    添加    " onclick="ew_SubmitForm(team_add, this.form);">
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
class cteam_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'team';

	// Page Object Name
	var $PageObjName = 'team_add';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $team;
		if ($team->UseTokenInUrl) $PageUrl .= "t=" . $team->TableVar . "&"; // add page token
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
		global $objForm, $team;
		if ($team->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($team->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($team->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cteam_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["team"] = new cteam();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'team', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $team;
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
		global $objForm, $gsFormError, $team;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $team->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $team->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->GetUploadFiles(); // Get upload files
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$team->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $team->CurrentAction = "C"; // Copy Record
		  } else {
		    $team->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($team->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("没有数据"); // No record found
		      $this->Page_Terminate("teamlist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$team->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("添加成功"); // Set up success message
					$sReturnUrl = $team->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "teamview.php")
						$sReturnUrl = $team->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$team->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $team;

		// Get upload data
			if ($team->teampic->Upload->UploadFile()) {

				// No action required
			} else {
				echo $team->teampic->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load default values
	function LoadDefaultValues() {
		global $team;
		$team->id->CurrentValue = 0;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $team;
		$team->id->setFormValue($objForm->GetValue("x_id"));
		$team->teamname->setFormValue($objForm->GetValue("x_teamname"));
		$team->teamjobs->setFormValue($objForm->GetValue("x_teamjobs"));
		$team->teamdesc->setFormValue($objForm->GetValue("x_teamdesc"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $team;
		$team->id->CurrentValue = $team->id->FormValue;
		$team->teamname->CurrentValue = $team->teamname->FormValue;
		$team->teamjobs->CurrentValue = $team->teamjobs->FormValue;
		$team->teamdesc->CurrentValue = $team->teamdesc->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $team;
		$sFilter = $team->KeyFilter();

		// Call Row Selecting event
		$team->Row_Selecting($sFilter);

		// Load sql based on filter
		$team->CurrentFilter = $sFilter;
		$sSql = $team->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$team->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $team;
		$team->id->setDbValue($rs->fields('id'));
		$team->teamname->setDbValue($rs->fields('teamname'));
		$team->teampic->Upload->DbValue = $rs->fields('teampic');
		$team->teamjobs->setDbValue($rs->fields('teamjobs'));
		$team->teamdesc->setDbValue($rs->fields('teamdesc'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $team;

		// Call Row_Rendering event
		$team->Row_Rendering();

		// Common render codes for all row types
		// id

		$team->id->CellCssStyle = "";
		$team->id->CellCssClass = "";

		// teamname
		$team->teamname->CellCssStyle = "";
		$team->teamname->CellCssClass = "";

		// teampic
		$team->teampic->CellCssStyle = "";
		$team->teampic->CellCssClass = "";

		// teamjobs
		$team->teamjobs->CellCssStyle = "";
		$team->teamjobs->CellCssClass = "";

		// teamdesc
		$team->teamdesc->CellCssStyle = "";
		$team->teamdesc->CellCssClass = "";
		if ($team->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$team->id->ViewValue = $team->id->CurrentValue;
			$team->id->CssStyle = "";
			$team->id->CssClass = "";
			$team->id->ViewCustomAttributes = "";

			// teamname
			$team->teamname->ViewValue = $team->teamname->CurrentValue;
			$team->teamname->CssStyle = "";
			$team->teamname->CssClass = "";
			$team->teamname->ViewCustomAttributes = "";

			// teampic
			if (!is_null($team->teampic->Upload->DbValue)) {
				$team->teampic->ViewValue = $team->teampic->Upload->DbValue;
				$team->teampic->ImageAlt = "";
			} else {
				$team->teampic->ViewValue = "";
			}
			$team->teampic->CssStyle = "";
			$team->teampic->CssClass = "";
			$team->teampic->ViewCustomAttributes = "";

			// teamjobs
			$team->teamjobs->ViewValue = $team->teamjobs->CurrentValue;
			$team->teamjobs->CssStyle = "";
			$team->teamjobs->CssClass = "";
			$team->teamjobs->ViewCustomAttributes = "";

			// teamdesc
			$team->teamdesc->ViewValue = $team->teamdesc->CurrentValue;
			$team->teamdesc->CssStyle = "";
			$team->teamdesc->CssClass = "";
			$team->teamdesc->ViewCustomAttributes = "";

			// id
			$team->id->HrefValue = "";

			// teamname
			$team->teamname->HrefValue = "";

			// teampic
			$team->teampic->HrefValue = "";

			// teamjobs
			$team->teamjobs->HrefValue = "";

			// teamdesc
			$team->teamdesc->HrefValue = "";
		} elseif ($team->RowType == EW_ROWTYPE_ADD) { // Add row

			// id
			// teamname

			$team->teamname->EditCustomAttributes = "";
			$team->teamname->EditValue = ew_HtmlEncode($team->teamname->CurrentValue);

			// teampic
			$team->teampic->EditCustomAttributes = "";
			if (!is_null($team->teampic->Upload->DbValue)) {
				$team->teampic->EditValue = $team->teampic->Upload->DbValue;
				$team->teampic->ImageAlt = "";
			} else {
				$team->teampic->EditValue = "";
			}

			// teamjobs
			$team->teamjobs->EditCustomAttributes = "";
			$team->teamjobs->EditValue = ew_HtmlEncode($team->teamjobs->CurrentValue);

			// teamdesc
			$team->teamdesc->EditCustomAttributes = "";
			$team->teamdesc->EditValue = ew_HtmlEncode($team->teamdesc->CurrentValue);
		}

		// Call Row Rendered event
		$team->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $team;

		// Initialize
		$gsFormError = "";
		if (!ew_CheckFileType($team->teampic->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "不允许上传的文件类型";
		}
		if ($team->teampic->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($team->teampic->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "文件大小超过限制 (%s 字节)");
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($team->id->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "必填项 - 成员ID";
		}
		if (!ew_CheckInteger($team->id->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "错误的 Integer - 成员ID";
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
		global $conn, $Security, $team;
		$rsnew = array();

		// Field id
		// Field teamname

		$team->teamname->SetDbValueDef($team->teamname->CurrentValue, NULL);
		$rsnew['teamname'] =& $team->teamname->DbValue;

		// Field teampic
		$team->teampic->Upload->SaveToSession(); // Save file value to Session
		if (is_null($team->teampic->Upload->Value)) {
			$rsnew['teampic'] = NULL;
		} else {
			$rsnew['teampic'] = ew_UploadFileNameEx(ew_UploadPathEx(True, EW_UPLOAD_DEST_PATH), $team->teampic->Upload->FileName);
		}

		// Field teamjobs
		$team->teamjobs->SetDbValueDef($team->teamjobs->CurrentValue, NULL);
		$rsnew['teamjobs'] =& $team->teamjobs->DbValue;

		// Field teamdesc
		$team->teamdesc->SetDbValueDef($team->teamdesc->CurrentValue, NULL);
		$rsnew['teamdesc'] =& $team->teamdesc->DbValue;

		// Call Row Inserting event
		$bInsertRow = $team->Row_Inserting($rsnew);
		if ($bInsertRow) {

			// Field teampic
			if (!is_null($team->teampic->Upload->Value)) {
				$team->teampic->Upload->SaveToFile(EW_UPLOAD_DEST_PATH, $rsnew['teampic'], FALSE);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($team->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($team->CancelMessage <> "") {
				$this->setMessage($team->CancelMessage);
				$team->CancelMessage = "";
			} else {
				$this->setMessage("已取消");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$team->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $team->id->DbValue;

			// Call Row Inserted event
			$team->Row_Inserted($rsnew);
		}

		// Field teampic
		$team->teampic->Upload->RemoveFromSession(); // Remove file value from Session
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
