<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "servicecatinfo.php" ?>
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
$servicecat_delete = new cservicecat_delete();
$Page =& $servicecat_delete;

// Page init processing
$servicecat_delete->Page_Init();

// Page main processing
$servicecat_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var servicecat_delete = new ew_Page("servicecat_delete");

// page properties
servicecat_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = servicecat_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
servicecat_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
servicecat_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
servicecat_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
servicecat_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $servicecat_delete->LoadRecordset();
$servicecat_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($servicecat_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$servicecat_delete->Page_Terminate("servicecatlist.php"); // Return to list
}
?>
<p><span class="phpmaker">删除 表: Servicecat<br><br>
<a href="<?php echo $servicecat->getReturnUrl() ?>">返回</a></span></p>
<?php $servicecat_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="servicecat">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($servicecat_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $servicecat->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">类型ID</td>
		<td valign="top">类型名字</td>
		<td valign="top">所属根类型</td>
		<td valign="top">类型排序</td>
	</tr>
	</thead>
	<tbody>
<?php
$servicecat_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$servicecat_delete->lRecCnt++;

	// Set row properties
	$servicecat->CssClass = "";
	$servicecat->CssStyle = "";
	$servicecat->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$servicecat_delete->LoadRowValues($rs);

	// Render row
	$servicecat_delete->RenderRow();
?>
	<tr<?php echo $servicecat->RowAttributes() ?>>
		<td<?php echo $servicecat->id->CellAttributes() ?>>
<div<?php echo $servicecat->id->ViewAttributes() ?>><?php echo $servicecat->id->ListViewValue() ?></div></td>
		<td<?php echo $servicecat->catname->CellAttributes() ?>>
<div<?php echo $servicecat->catname->ViewAttributes() ?>><?php echo $servicecat->catname->ListViewValue() ?></div></td>
		<td<?php echo $servicecat->rootid->CellAttributes() ?>>
<div<?php echo $servicecat->rootid->ViewAttributes() ?>><?php echo $servicecat->rootid->ListViewValue() ?></div></td>
		<td<?php echo $servicecat->catorder->CellAttributes() ?>>
<div<?php echo $servicecat->catorder->ViewAttributes() ?>><?php echo $servicecat->catorder->ListViewValue() ?></div></td>
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
class cservicecat_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'servicecat';

	// Page Object Name
	var $PageObjName = 'servicecat_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $servicecat;
		if ($servicecat->UseTokenInUrl) $PageUrl .= "t=" . $servicecat->TableVar . "&"; // add page token
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
		global $objForm, $servicecat;
		if ($servicecat->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($servicecat->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($servicecat->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cservicecat_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["servicecat"] = new cservicecat();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'servicecat', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $servicecat;
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
		global $servicecat;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$servicecat->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($servicecat->id->QueryStringValue))
				$this->Page_Terminate("servicecatlist.php"); // Prevent SQL injection, exit
			$sKey .= $servicecat->id->QueryStringValue;
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
			$this->Page_Terminate("servicecatlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("servicecatlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in servicecat class, servicecatinfo.php

		$servicecat->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$servicecat->CurrentAction = $_POST["a_delete"];
		} else {
			$servicecat->CurrentAction = "D"; // Delete record directly
		}
		switch ($servicecat->CurrentAction) {
			case "D": // Delete
				$servicecat->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("删除成功"); // Set up success message
					$this->Page_Terminate($servicecat->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $servicecat;
		$DeleteRows = TRUE;
		$sWrkFilter = $servicecat->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in servicecat class, servicecatinfo.php

		$servicecat->CurrentFilter = $sWrkFilter;
		$sSql = $servicecat->SQL();
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
				$DeleteRows = $servicecat->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($servicecat->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($servicecat->CancelMessage <> "") {
				$this->setMessage($servicecat->CancelMessage);
				$servicecat->CancelMessage = "";
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
				$servicecat->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $servicecat;

		// Call Recordset Selecting event
		$servicecat->Recordset_Selecting($servicecat->CurrentFilter);

		// Load list page SQL
		$sSql = $servicecat->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$servicecat->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $servicecat;
		$sFilter = $servicecat->KeyFilter();

		// Call Row Selecting event
		$servicecat->Row_Selecting($sFilter);

		// Load sql based on filter
		$servicecat->CurrentFilter = $sFilter;
		$sSql = $servicecat->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$servicecat->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $servicecat;
		$servicecat->id->setDbValue($rs->fields('id'));
		$servicecat->catname->setDbValue($rs->fields('catname'));
		$servicecat->rootid->setDbValue($rs->fields('rootid'));
		$servicecat->catdesc->setDbValue($rs->fields('catdesc'));
		$servicecat->catorder->setDbValue($rs->fields('catorder'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $servicecat;

		// Call Row_Rendering event
		$servicecat->Row_Rendering();

		// Common render codes for all row types
		// id

		$servicecat->id->CellCssStyle = "";
		$servicecat->id->CellCssClass = "";

		// catname
		$servicecat->catname->CellCssStyle = "";
		$servicecat->catname->CellCssClass = "";

		// rootid
		$servicecat->rootid->CellCssStyle = "";
		$servicecat->rootid->CellCssClass = "";

		// catorder
		$servicecat->catorder->CellCssStyle = "";
		$servicecat->catorder->CellCssClass = "";
		if ($servicecat->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$servicecat->id->ViewValue = $servicecat->id->CurrentValue;
			$servicecat->id->CssStyle = "";
			$servicecat->id->CssClass = "";
			$servicecat->id->ViewCustomAttributes = "";

			// catname
			$servicecat->catname->ViewValue = $servicecat->catname->CurrentValue;
			$servicecat->catname->CssStyle = "";
			$servicecat->catname->CssClass = "";
			$servicecat->catname->ViewCustomAttributes = "";

			// rootid
			$servicecat->rootid->ViewValue = $servicecat->rootid->CurrentValue;
			$servicecat->rootid->CssStyle = "";
			$servicecat->rootid->CssClass = "";
			$servicecat->rootid->ViewCustomAttributes = "";

			// catorder
			$servicecat->catorder->ViewValue = $servicecat->catorder->CurrentValue;
			$servicecat->catorder->CssStyle = "";
			$servicecat->catorder->CssClass = "";
			$servicecat->catorder->ViewCustomAttributes = "";

			// id
			$servicecat->id->HrefValue = "";

			// catname
			$servicecat->catname->HrefValue = "";

			// rootid
			$servicecat->rootid->HrefValue = "";

			// catorder
			$servicecat->catorder->HrefValue = "";
		}

		// Call Row Rendered event
		$servicecat->Row_Rendered();
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
