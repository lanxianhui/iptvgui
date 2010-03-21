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
$cases_delete = new ccases_delete();
$Page =& $cases_delete;

// Page init processing
$cases_delete->Page_Init();

// Page main processing
$cases_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var cases_delete = new ew_Page("cases_delete");

// page properties
cases_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = cases_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
cases_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
cases_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
cases_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
cases_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $cases_delete->LoadRecordset();
$cases_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($cases_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$cases_delete->Page_Terminate("caseslist.php"); // Return to list
}
?>
<p><span class="phpmaker">删除 表: Cases<br><br>
<a href="<?php echo $cases->getReturnUrl() ?>">返回</a></span></p>
<?php $cases_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="cases">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($cases_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $cases->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">案例ID</td>
		<td valign="top">案例标题</td>
		<td valign="top">根类型</td>
		<td valign="top">案例类型</td>
	</tr>
	</thead>
	<tbody>
<?php
$cases_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$cases_delete->lRecCnt++;

	// Set row properties
	$cases->CssClass = "";
	$cases->CssStyle = "";
	$cases->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$cases_delete->LoadRowValues($rs);

	// Render row
	$cases_delete->RenderRow();
?>
	<tr<?php echo $cases->RowAttributes() ?>>
		<td<?php echo $cases->id->CellAttributes() ?>>
<div<?php echo $cases->id->ViewAttributes() ?>><?php echo $cases->id->ListViewValue() ?></div></td>
		<td<?php echo $cases->casetitle->CellAttributes() ?>>
<div<?php echo $cases->casetitle->ViewAttributes() ?>><?php echo $cases->casetitle->ListViewValue() ?></div></td>
		<td<?php echo $cases->rootid->CellAttributes() ?>>
<div<?php echo $cases->rootid->ViewAttributes() ?>><?php echo $cases->rootid->ListViewValue() ?></div></td>
		<td<?php echo $cases->catid->CellAttributes() ?>>
<div<?php echo $cases->catid->ViewAttributes() ?>><?php echo $cases->catid->ListViewValue() ?></div></td>
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
class ccases_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'cases';

	// Page Object Name
	var $PageObjName = 'cases_delete';

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
	function ccases_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["cases"] = new ccases();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs;
	var $lRecCnt;
	var $arRecKeys = array();

	// Page main processing
	function Page_Main() {
		global $cases;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$cases->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($cases->id->QueryStringValue))
				$this->Page_Terminate("caseslist.php"); // Prevent SQL injection, exit
			$sKey .= $cases->id->QueryStringValue;
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
			$this->Page_Terminate("caseslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("caseslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in cases class, casesinfo.php

		$cases->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$cases->CurrentAction = $_POST["a_delete"];
		} else {
			$cases->CurrentAction = "D"; // Delete record directly
		}
		switch ($cases->CurrentAction) {
			case "D": // Delete
				$cases->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("删除成功"); // Set up success message
					$this->Page_Terminate($cases->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $cases;
		$DeleteRows = TRUE;
		$sWrkFilter = $cases->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in cases class, casesinfo.php

		$cases->CurrentFilter = $sWrkFilter;
		$sSql = $cases->SQL();
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
				$DeleteRows = $cases->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($cases->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($cases->CancelMessage <> "") {
				$this->setMessage($cases->CancelMessage);
				$cases->CancelMessage = "";
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
				$cases->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $cases;

		// Call Recordset Selecting event
		$cases->Recordset_Selecting($cases->CurrentFilter);

		// Load list page SQL
		$sSql = $cases->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$cases->Recordset_Selected($rs);
		return $rs;
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
		// id

		$cases->id->CellCssStyle = "";
		$cases->id->CellCssClass = "";

		// casetitle
		$cases->casetitle->CellCssStyle = "";
		$cases->casetitle->CellCssClass = "";

		// rootid
		$cases->rootid->CellCssStyle = "";
		$cases->rootid->CellCssClass = "";

		// catid
		$cases->catid->CellCssStyle = "";
		$cases->catid->CellCssClass = "";
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

			// id
			$cases->id->HrefValue = "";

			// casetitle
			$cases->casetitle->HrefValue = "";

			// rootid
			$cases->rootid->HrefValue = "";

			// catid
			$cases->catid->HrefValue = "";
		}

		// Call Row Rendered event
		$cases->Row_Rendered();
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
