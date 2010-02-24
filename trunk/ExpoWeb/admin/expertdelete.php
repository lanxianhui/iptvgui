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
$expert_delete = new cexpert_delete();
$Page =& $expert_delete;

// Page init processing
$expert_delete->Page_Init();

// Page main processing
$expert_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var expert_delete = new ew_Page("expert_delete");

// page properties
expert_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = expert_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
expert_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
expert_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
expert_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
expert_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php

// Load records for display
$rs = $expert_delete->LoadRecordset();
$expert_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($expert_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$expert_delete->Page_Terminate("expertlist.php"); // Return to list
}
?>
<p><span class="phpmaker">ɾ�� ��: Expert<br><br>
<a href="<?php echo $expert->getReturnUrl() ?>">����</a></span></p>
<?php $expert_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="expert">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($expert_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $expert->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">ר��ID</td>
		<td valign="top">ר������</td>
		<td valign="top">ר��ͷ��</td>
	</tr>
	</thead>
	<tbody>
<?php
$expert_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$expert_delete->lRecCnt++;

	// Set row properties
	$expert->CssClass = "";
	$expert->CssStyle = "";
	$expert->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$expert_delete->LoadRowValues($rs);

	// Render row
	$expert_delete->RenderRow();
?>
	<tr<?php echo $expert->RowAttributes() ?>>
		<td<?php echo $expert->id->CellAttributes() ?>>
<div<?php echo $expert->id->ViewAttributes() ?>><?php echo $expert->id->ListViewValue() ?></div></td>
		<td<?php echo $expert->username->CellAttributes() ?>>
<div<?php echo $expert->username->ViewAttributes() ?>><?php echo $expert->username->ListViewValue() ?></div></td>
		<td<?php echo $expert->title->CellAttributes() ?>>
<div<?php echo $expert->title->ViewAttributes() ?>><?php echo $expert->title->ListViewValue() ?></div></td>
	</tr>
<?php
	$rs->MoveNext();
}
$rs->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="   ȷ��ɾ��   ">
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
class cexpert_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'expert';

	// Page Object Name
	var $PageObjName = 'expert_delete';

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
	function cexpert_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["expert"] = new cexpert();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs;
	var $lRecCnt;
	var $arRecKeys = array();

	// Page main processing
	function Page_Main() {
		global $expert;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$expert->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($expert->id->QueryStringValue))
				$this->Page_Terminate("expertlist.php"); // Prevent SQL injection, exit
			$sKey .= $expert->id->QueryStringValue;
		} else {
			$bSingleDelete = FALSE;
		}
		if ($bSingleDelete) {
			$nKeySelected = 1; // Set up key selected count
			$this->arRecKeys[0] = $sKey;
		} else {
			if (isset($_POST["key_m"])) { // Key in form
				$nKeySelected = count($_POST["key_m"]); // Set up key selected count
				$this->arRecKeys = ew_StripSlashes($_POST["key_m"]);
			}
		}
		if ($nKeySelected <= 0)
			$this->Page_Terminate("expertlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("expertlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in expert class, expertinfo.php

		$expert->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$expert->CurrentAction = $_POST["a_delete"];
		} else {
			$expert->CurrentAction = "D"; // Delete record directly
		}
		switch ($expert->CurrentAction) {
			case "D": // Delete
				$expert->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("ɾ���ɹ�"); // Set up success message
					$this->Page_Terminate($expert->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $expert;
		$DeleteRows = TRUE;
		$sWrkFilter = $expert->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in expert class, expertinfo.php

		$expert->CurrentFilter = $sWrkFilter;
		$sSql = $expert->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setMessage("û������"); // No record found
			$rs->Close();
			return FALSE;
		}
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs) $rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $expert->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($expert->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($expert->CancelMessage <> "") {
				$this->setMessage($expert->CancelMessage);
				$expert->CancelMessage = "";
			} else {
				$this->setMessage("��ȡ��");
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call recordset deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$expert->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $expert;

		// Call Recordset Selecting event
		$expert->Recordset_Selecting($expert->CurrentFilter);

		// Load list page SQL
		$sSql = $expert->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$expert->Recordset_Selected($rs);
		return $rs;
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
		// id

		$expert->id->CellCssStyle = "";
		$expert->id->CellCssClass = "";

		// username
		$expert->username->CellCssStyle = "";
		$expert->username->CellCssClass = "";

		// title
		$expert->title->CellCssStyle = "";
		$expert->title->CellCssClass = "";
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

			// id
			$expert->id->HrefValue = "";

			// username
			$expert->username->HrefValue = "";

			// title
			$expert->title->HrefValue = "";
		}

		// Call Row Rendered event
		$expert->Row_Rendered();
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}
}
?>
