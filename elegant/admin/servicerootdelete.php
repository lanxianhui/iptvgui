<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "servicerootinfo.php" ?>
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
$serviceroot_delete = new cserviceroot_delete();
$Page =& $serviceroot_delete;

// Page init processing
$serviceroot_delete->Page_Init();

// Page main processing
$serviceroot_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var serviceroot_delete = new ew_Page("serviceroot_delete");

// page properties
serviceroot_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = serviceroot_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
serviceroot_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
serviceroot_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
serviceroot_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $serviceroot_delete->LoadRecordset();
$serviceroot_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($serviceroot_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$serviceroot_delete->Page_Terminate("servicerootlist.php"); // Return to list
}
?>
<p><span class="phpmaker">删除 表: Serviceroot<br><br>
<a href="<?php echo $serviceroot->getReturnUrl() ?>">返回</a></span></p>
<?php $serviceroot_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="serviceroot">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($serviceroot_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $serviceroot->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id</td>
		<td valign="top">Rootname</td>
		<td valign="top">Rootorder</td>
	</tr>
	</thead>
	<tbody>
<?php
$serviceroot_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$serviceroot_delete->lRecCnt++;

	// Set row properties
	$serviceroot->CssClass = "";
	$serviceroot->CssStyle = "";
	$serviceroot->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$serviceroot_delete->LoadRowValues($rs);

	// Render row
	$serviceroot_delete->RenderRow();
?>
	<tr<?php echo $serviceroot->RowAttributes() ?>>
		<td<?php echo $serviceroot->id->CellAttributes() ?>>
<div<?php echo $serviceroot->id->ViewAttributes() ?>><?php echo $serviceroot->id->ListViewValue() ?></div></td>
		<td<?php echo $serviceroot->rootname->CellAttributes() ?>>
<div<?php echo $serviceroot->rootname->ViewAttributes() ?>><?php echo $serviceroot->rootname->ListViewValue() ?></div></td>
		<td<?php echo $serviceroot->rootorder->CellAttributes() ?>>
<div<?php echo $serviceroot->rootorder->ViewAttributes() ?>><?php echo $serviceroot->rootorder->ListViewValue() ?></div></td>
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
class cserviceroot_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'serviceroot';

	// Page Object Name
	var $PageObjName = 'serviceroot_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $serviceroot;
		if ($serviceroot->UseTokenInUrl) $PageUrl .= "t=" . $serviceroot->TableVar . "&"; // add page token
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
		global $objForm, $serviceroot;
		if ($serviceroot->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($serviceroot->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($serviceroot->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cserviceroot_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["serviceroot"] = new cserviceroot();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'serviceroot', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $serviceroot;

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
		global $serviceroot;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$serviceroot->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($serviceroot->id->QueryStringValue))
				$this->Page_Terminate("servicerootlist.php"); // Prevent SQL injection, exit
			$sKey .= $serviceroot->id->QueryStringValue;
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
			$this->Page_Terminate("servicerootlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("servicerootlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in serviceroot class, servicerootinfo.php

		$serviceroot->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$serviceroot->CurrentAction = $_POST["a_delete"];
		} else {
			$serviceroot->CurrentAction = "I"; // Display record
		}
		switch ($serviceroot->CurrentAction) {
			case "D": // Delete
				$serviceroot->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("删除成功"); // Set up success message
					$this->Page_Terminate($serviceroot->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $serviceroot;
		$DeleteRows = TRUE;
		$sWrkFilter = $serviceroot->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in serviceroot class, servicerootinfo.php

		$serviceroot->CurrentFilter = $sWrkFilter;
		$sSql = $serviceroot->SQL();
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
				$DeleteRows = $serviceroot->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($serviceroot->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($serviceroot->CancelMessage <> "") {
				$this->setMessage($serviceroot->CancelMessage);
				$serviceroot->CancelMessage = "";
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
				$serviceroot->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $serviceroot;

		// Call Recordset Selecting event
		$serviceroot->Recordset_Selecting($serviceroot->CurrentFilter);

		// Load list page SQL
		$sSql = $serviceroot->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$serviceroot->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $serviceroot;
		$sFilter = $serviceroot->KeyFilter();

		// Call Row Selecting event
		$serviceroot->Row_Selecting($sFilter);

		// Load sql based on filter
		$serviceroot->CurrentFilter = $sFilter;
		$sSql = $serviceroot->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$serviceroot->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $serviceroot;
		$serviceroot->id->setDbValue($rs->fields('id'));
		$serviceroot->rootname->setDbValue($rs->fields('rootname'));
		$serviceroot->rootorder->setDbValue($rs->fields('rootorder'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $serviceroot;

		// Call Row_Rendering event
		$serviceroot->Row_Rendering();

		// Common render codes for all row types
		// id

		$serviceroot->id->CellCssStyle = "";
		$serviceroot->id->CellCssClass = "";

		// rootname
		$serviceroot->rootname->CellCssStyle = "";
		$serviceroot->rootname->CellCssClass = "";

		// rootorder
		$serviceroot->rootorder->CellCssStyle = "";
		$serviceroot->rootorder->CellCssClass = "";
		if ($serviceroot->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$serviceroot->id->ViewValue = $serviceroot->id->CurrentValue;
			$serviceroot->id->CssStyle = "";
			$serviceroot->id->CssClass = "";
			$serviceroot->id->ViewCustomAttributes = "";

			// rootname
			$serviceroot->rootname->ViewValue = $serviceroot->rootname->CurrentValue;
			$serviceroot->rootname->CssStyle = "";
			$serviceroot->rootname->CssClass = "";
			$serviceroot->rootname->ViewCustomAttributes = "";

			// rootorder
			$serviceroot->rootorder->ViewValue = $serviceroot->rootorder->CurrentValue;
			$serviceroot->rootorder->CssStyle = "";
			$serviceroot->rootorder->CssClass = "";
			$serviceroot->rootorder->ViewCustomAttributes = "";

			// id
			$serviceroot->id->HrefValue = "";

			// rootname
			$serviceroot->rootname->HrefValue = "";

			// rootorder
			$serviceroot->rootorder->HrefValue = "";
		}

		// Call Row Rendered event
		$serviceroot->Row_Rendered();
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
