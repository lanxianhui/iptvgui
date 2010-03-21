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
$casescat_delete = new ccasescat_delete();
$Page =& $casescat_delete;

// Page init processing
$casescat_delete->Page_Init();

// Page main processing
$casescat_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var casescat_delete = new ew_Page("casescat_delete");

// page properties
casescat_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = casescat_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
casescat_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
casescat_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
casescat_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
casescat_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $casescat_delete->LoadRecordset();
$casescat_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($casescat_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$casescat_delete->Page_Terminate("casescatlist.php"); // Return to list
}
?>
<p><span class="phpmaker">删除 表: Casescat<br><br>
<a href="<?php echo $casescat->getReturnUrl() ?>">返回</a></span></p>
<?php $casescat_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="casescat">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($casescat_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $casescat->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">类型ID</td>
		<td valign="top">类型名称</td>
		<td valign="top">类型排序</td>
		<td valign="top">根类型</td>
	</tr>
	</thead>
	<tbody>
<?php
$casescat_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$casescat_delete->lRecCnt++;

	// Set row properties
	$casescat->CssClass = "";
	$casescat->CssStyle = "";
	$casescat->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$casescat_delete->LoadRowValues($rs);

	// Render row
	$casescat_delete->RenderRow();
?>
	<tr<?php echo $casescat->RowAttributes() ?>>
		<td<?php echo $casescat->id->CellAttributes() ?>>
<div<?php echo $casescat->id->ViewAttributes() ?>><?php echo $casescat->id->ListViewValue() ?></div></td>
		<td<?php echo $casescat->catname->CellAttributes() ?>>
<div<?php echo $casescat->catname->ViewAttributes() ?>><?php echo $casescat->catname->ListViewValue() ?></div></td>
		<td<?php echo $casescat->catorder->CellAttributes() ?>>
<div<?php echo $casescat->catorder->ViewAttributes() ?>><?php echo $casescat->catorder->ListViewValue() ?></div></td>
		<td<?php echo $casescat->rootid->CellAttributes() ?>>
<div<?php echo $casescat->rootid->ViewAttributes() ?>><?php echo $casescat->rootid->ListViewValue() ?></div></td>
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
<input type="submit" name="Action" id="Action" value="   确认删除   ">
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
class ccasescat_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'casescat';

	// Page Object Name
	var $PageObjName = 'casescat_delete';

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
	function ccasescat_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["casescat"] = new ccasescat();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs;
	var $lRecCnt;
	var $arRecKeys = array();

	// Page main processing
	function Page_Main() {
		global $casescat;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$casescat->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($casescat->id->QueryStringValue))
				$this->Page_Terminate("casescatlist.php"); // Prevent SQL injection, exit
			$sKey .= $casescat->id->QueryStringValue;
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
			$this->Page_Terminate("casescatlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("casescatlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in casescat class, casescatinfo.php

		$casescat->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$casescat->CurrentAction = $_POST["a_delete"];
		} else {
			$casescat->CurrentAction = "D"; // Delete record directly
		}
		switch ($casescat->CurrentAction) {
			case "D": // Delete
				$casescat->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("删除成功"); // Set up success message
					$this->Page_Terminate($casescat->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $casescat;
		$DeleteRows = TRUE;
		$sWrkFilter = $casescat->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in casescat class, casescatinfo.php

		$casescat->CurrentFilter = $sWrkFilter;
		$sSql = $casescat->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setMessage("没有数据"); // No record found
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
				$DeleteRows = $casescat->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($casescat->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($casescat->CancelMessage <> "") {
				$this->setMessage($casescat->CancelMessage);
				$casescat->CancelMessage = "";
			} else {
				$this->setMessage("已取消");
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
				$casescat->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $casescat;

		// Call Recordset Selecting event
		$casescat->Recordset_Selecting($casescat->CurrentFilter);

		// Load list page SQL
		$sSql = $casescat->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$casescat->Recordset_Selected($rs);
		return $rs;
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
		// id

		$casescat->id->CellCssStyle = "";
		$casescat->id->CellCssClass = "";

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

			// id
			$casescat->id->HrefValue = "";

			// catname
			$casescat->catname->HrefValue = "";

			// catorder
			$casescat->catorder->HrefValue = "";

			// rootid
			$casescat->rootid->HrefValue = "";
		}

		// Call Row Rendered event
		$casescat->Row_Rendered();
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
