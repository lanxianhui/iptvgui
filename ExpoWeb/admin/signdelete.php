<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "signinfo.php" ?>
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
$sign_delete = new csign_delete();
$Page =& $sign_delete;

// Page init processing
$sign_delete->Page_Init();

// Page main processing
$sign_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var sign_delete = new ew_Page("sign_delete");

// page properties
sign_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = sign_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
sign_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
sign_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
sign_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
sign_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $sign_delete->LoadRecordset();
$sign_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($sign_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$sign_delete->Page_Terminate("signlist.php"); // Return to list
}
?>
<p><span class="phpmaker">删除 表: Sign<br><br>
<a href="<?php echo $sign->getReturnUrl() ?>">返回</a></span></p>
<?php $sign_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="sign">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($sign_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $sign->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">报名ID</td>
		<td valign="top">报名人姓名</td>
		<td valign="top">报名Email</td>
		<td valign="top">报名单位</td>
		<td valign="top">手机号码</td>
		<td valign="top">固定电话</td>
		<td valign="top">所在地址</td>
	</tr>
	</thead>
	<tbody>
<?php
$sign_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$sign_delete->lRecCnt++;

	// Set row properties
	$sign->CssClass = "";
	$sign->CssStyle = "";
	$sign->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$sign_delete->LoadRowValues($rs);

	// Render row
	$sign_delete->RenderRow();
?>
	<tr<?php echo $sign->RowAttributes() ?>>
		<td<?php echo $sign->id->CellAttributes() ?>>
<div<?php echo $sign->id->ViewAttributes() ?>><?php echo $sign->id->ListViewValue() ?></div></td>
		<td<?php echo $sign->username->CellAttributes() ?>>
<div<?php echo $sign->username->ViewAttributes() ?>><?php echo $sign->username->ListViewValue() ?></div></td>
		<td<?php echo $sign->email->CellAttributes() ?>>
<div<?php echo $sign->email->ViewAttributes() ?>><?php echo $sign->email->ListViewValue() ?></div></td>
		<td<?php echo $sign->company->CellAttributes() ?>>
<div<?php echo $sign->company->ViewAttributes() ?>><?php echo $sign->company->ListViewValue() ?></div></td>
		<td<?php echo $sign->mobile->CellAttributes() ?>>
<div<?php echo $sign->mobile->ViewAttributes() ?>><?php echo $sign->mobile->ListViewValue() ?></div></td>
		<td<?php echo $sign->phone->CellAttributes() ?>>
<div<?php echo $sign->phone->ViewAttributes() ?>><?php echo $sign->phone->ListViewValue() ?></div></td>
		<td<?php echo $sign->address->CellAttributes() ?>>
<div<?php echo $sign->address->ViewAttributes() ?>><?php echo $sign->address->ListViewValue() ?></div></td>
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
class csign_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'sign';

	// Page Object Name
	var $PageObjName = 'sign_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $sign;
		if ($sign->UseTokenInUrl) $PageUrl .= "t=" . $sign->TableVar . "&"; // add page token
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
		global $objForm, $sign;
		if ($sign->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($sign->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($sign->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function csign_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["sign"] = new csign();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'sign', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $sign;
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
		global $sign;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$sign->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($sign->id->QueryStringValue))
				$this->Page_Terminate("signlist.php"); // Prevent SQL injection, exit
			$sKey .= $sign->id->QueryStringValue;
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
			$this->Page_Terminate("signlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("signlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in sign class, signinfo.php

		$sign->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$sign->CurrentAction = $_POST["a_delete"];
		} else {
			$sign->CurrentAction = "D"; // Delete record directly
		}
		switch ($sign->CurrentAction) {
			case "D": // Delete
				$sign->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("删除成功"); // Set up success message
					$this->Page_Terminate($sign->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $sign;
		$DeleteRows = TRUE;
		$sWrkFilter = $sign->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in sign class, signinfo.php

		$sign->CurrentFilter = $sWrkFilter;
		$sSql = $sign->SQL();
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
				$DeleteRows = $sign->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($sign->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($sign->CancelMessage <> "") {
				$this->setMessage($sign->CancelMessage);
				$sign->CancelMessage = "";
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
				$sign->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $sign;

		// Call Recordset Selecting event
		$sign->Recordset_Selecting($sign->CurrentFilter);

		// Load list page SQL
		$sSql = $sign->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$sign->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $sign;
		$sFilter = $sign->KeyFilter();

		// Call Row Selecting event
		$sign->Row_Selecting($sFilter);

		// Load sql based on filter
		$sign->CurrentFilter = $sFilter;
		$sSql = $sign->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$sign->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $sign;
		$sign->id->setDbValue($rs->fields('id'));
		$sign->username->setDbValue($rs->fields('username'));
		$sign->email->setDbValue($rs->fields('email'));
		$sign->company->setDbValue($rs->fields('company'));
		$sign->contact->setDbValue($rs->fields('contact'));
		$sign->mobile->setDbValue($rs->fields('mobile'));
		$sign->phone->setDbValue($rs->fields('phone'));
		$sign->address->setDbValue($rs->fields('address'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $sign;

		// Call Row_Rendering event
		$sign->Row_Rendering();

		// Common render codes for all row types
		// id

		$sign->id->CellCssStyle = "";
		$sign->id->CellCssClass = "";

		// username
		$sign->username->CellCssStyle = "";
		$sign->username->CellCssClass = "";

		// email
		$sign->email->CellCssStyle = "";
		$sign->email->CellCssClass = "";

		// company
		$sign->company->CellCssStyle = "";
		$sign->company->CellCssClass = "";

		// mobile
		$sign->mobile->CellCssStyle = "";
		$sign->mobile->CellCssClass = "";

		// phone
		$sign->phone->CellCssStyle = "";
		$sign->phone->CellCssClass = "";

		// address
		$sign->address->CellCssStyle = "";
		$sign->address->CellCssClass = "";
		if ($sign->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$sign->id->ViewValue = $sign->id->CurrentValue;
			$sign->id->CssStyle = "";
			$sign->id->CssClass = "";
			$sign->id->ViewCustomAttributes = "";

			// username
			$sign->username->ViewValue = $sign->username->CurrentValue;
			$sign->username->CssStyle = "";
			$sign->username->CssClass = "";
			$sign->username->ViewCustomAttributes = "";

			// email
			$sign->email->ViewValue = $sign->email->CurrentValue;
			$sign->email->CssStyle = "";
			$sign->email->CssClass = "";
			$sign->email->ViewCustomAttributes = "";

			// company
			$sign->company->ViewValue = $sign->company->CurrentValue;
			$sign->company->CssStyle = "";
			$sign->company->CssClass = "";
			$sign->company->ViewCustomAttributes = "";

			// mobile
			$sign->mobile->ViewValue = $sign->mobile->CurrentValue;
			$sign->mobile->CssStyle = "";
			$sign->mobile->CssClass = "";
			$sign->mobile->ViewCustomAttributes = "";

			// phone
			$sign->phone->ViewValue = $sign->phone->CurrentValue;
			$sign->phone->CssStyle = "";
			$sign->phone->CssClass = "";
			$sign->phone->ViewCustomAttributes = "";

			// address
			$sign->address->ViewValue = $sign->address->CurrentValue;
			$sign->address->CssStyle = "";
			$sign->address->CssClass = "";
			$sign->address->ViewCustomAttributes = "";

			// id
			$sign->id->HrefValue = "";

			// username
			$sign->username->HrefValue = "";

			// email
			$sign->email->HrefValue = "";

			// company
			$sign->company->HrefValue = "";

			// mobile
			$sign->mobile->HrefValue = "";

			// phone
			$sign->phone->HrefValue = "";

			// address
			$sign->address->HrefValue = "";
		}

		// Call Row Rendered event
		$sign->Row_Rendered();
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
