<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "imagesinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$images_add = new cimages_add();
$Page =& $images_add;

// Page init
$images_add->Page_Init();

// Page main
$images_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var images_add = new ew_Page("images_add");

// page properties
images_add.PageID = "add"; // page ID
images_add.FormID = "fimagesadd"; // form ID
var EW_PAGE_ID = images_add.PageID; // for backward compatibility

// extend page with ValidateForm function
images_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_reg_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($images->reg_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_reg_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($images->reg_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_name"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($images->name->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}

	// Process detail page
	var detailpage = (fobj.detailpage) ? fobj.detailpage.value : "";
	if (detailpage != "") {
		return eval(detailpage+".ValidateForm(fobj)");
	}
	return true;
}

// extend page with Form_CustomValidate function
images_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
images_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
images_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $images_add->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $images->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $images->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$images_add->ShowMessage();
?>
<form name="fimagesadd" id="fimagesadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return images_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="images">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($images->reg_id->Visible) { // reg_id ?>
	<tr id="r_reg_id"<?php echo $images->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $images->reg_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $images->reg_id->CellAttributes() ?>><span id="el_reg_id">
<input type="text" name="x_reg_id" id="x_reg_id" size="30" value="<?php echo $images->reg_id->EditValue ?>"<?php echo $images->reg_id->EditAttributes() ?>>
</span><?php echo $images->reg_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($images->name->Visible) { // name ?>
	<tr id="r_name"<?php echo $images->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $images->name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $images->name->CellAttributes() ?>><span id="el_name">
<textarea name="x_name" id="x_name" cols="35" rows="4"<?php echo $images->name->EditAttributes() ?>><?php echo $images->name->EditValue ?></textarea>
</span><?php echo $images->name->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$images_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include_once "footer.php" ?>
<?php
$images_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cimages_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'images';

	// Page object name
	var $PageObjName = 'images_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $images;
		if ($images->UseTokenInUrl) $PageUrl .= "t=" . $images->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			echo "<p class=\"ewMessage\">" . $sMessage . "</p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			echo "<p class=\"ewSuccessMessage\">" . $sSuccessMessage . "</p>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			echo "<p class=\"ewErrorMessage\">" . $sErrorMessage . "</p>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p class=\"phpmaker\">" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Fotoer exists, display
			echo "<p class=\"phpmaker\">" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $images;
		if ($images->UseTokenInUrl) {
			if ($objForm)
				return ($images->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($images->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cimages_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (images)
		if (!isset($GLOBALS["images"])) {
			$GLOBALS["images"] = new cimages();
			$GLOBALS["Table"] =& $GLOBALS["images"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'images', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $images;

		// Create form object
		$objForm = new cFormObj();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		$this->Page_Redirecting($url);
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $Priv = 0;
	var $OldRecordset;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $images;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$images->CurrentAction = $_POST["a_add"]; // Get form action
			$this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$images->CurrentAction = "I"; // Form error, reset action
				$images->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$bCopy = TRUE;
			if (@$_GET["reg_id"] != "") {
				$images->reg_id->setQueryStringValue($_GET["reg_id"]);
				$images->setKey("reg_id", $images->reg_id->CurrentValue); // Set up key
			} else {
				$images->setKey("reg_id", ""); // Clear key
				$bCopy = FALSE;
			}
			if ($bCopy) {
				$images->CurrentAction = "C"; // Copy record
			} else {
				$images->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($images->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("imageslist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$images->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $images->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "imagesview.php")
						$sReturnUrl = $images->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$images->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$images->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $images;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $images;
		$images->reg_id->CurrentValue = NULL;
		$images->reg_id->OldValue = $images->reg_id->CurrentValue;
		$images->name->CurrentValue = NULL;
		$images->name->OldValue = $images->name->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $images;
		if (!$images->reg_id->FldIsDetailKey) {
			$images->reg_id->setFormValue($objForm->GetValue("x_reg_id"));
		}
		if (!$images->name->FldIsDetailKey) {
			$images->name->setFormValue($objForm->GetValue("x_name"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $images;
		$this->LoadOldRecord();
		$images->reg_id->CurrentValue = $images->reg_id->FormValue;
		$images->name->CurrentValue = $images->name->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $images;
		$sFilter = $images->KeyFilter();

		// Call Row Selecting event
		$images->Row_Selecting($sFilter);

		// Load SQL based on filter
		$images->CurrentFilter = $sFilter;
		$sSql = $images->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$images->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $images;
		if (!$rs || $rs->EOF) return;
		$images->reg_id->setDbValue($rs->fields('reg_id'));
		$images->name->setDbValue($rs->fields('name'));
	}

	// Load old record
	function LoadOldRecord() {
		global $images;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($images->getKey("reg_id")) <> "")
			$images->reg_id->CurrentValue = $images->getKey("reg_id"); // reg_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$images->CurrentFilter = $images->KeyFilter();
			$sSql = $images->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return TRUE;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $images;

		// Initialize URLs
		// Call Row_Rendering event

		$images->Row_Rendering();

		// Common render codes for all row types
		// reg_id
		// name

		if ($images->RowType == EW_ROWTYPE_VIEW) { // View row

			// reg_id
			$images->reg_id->ViewValue = $images->reg_id->CurrentValue;
			$images->reg_id->ViewCustomAttributes = "";

			// name
			$images->name->ViewValue = $images->name->CurrentValue;
			$images->name->ViewCustomAttributes = "";

			// reg_id
			$images->reg_id->LinkCustomAttributes = "";
			$images->reg_id->HrefValue = "";
			$images->reg_id->TooltipValue = "";

			// name
			$images->name->LinkCustomAttributes = "";
			$images->name->HrefValue = "";
			$images->name->TooltipValue = "";
		} elseif ($images->RowType == EW_ROWTYPE_ADD) { // Add row

			// reg_id
			$images->reg_id->EditCustomAttributes = "";
			$images->reg_id->EditValue = ew_HtmlEncode($images->reg_id->CurrentValue);

			// name
			$images->name->EditCustomAttributes = "";
			$images->name->EditValue = ew_HtmlEncode($images->name->CurrentValue);

			// Edit refer script
			// reg_id

			$images->reg_id->HrefValue = "";

			// name
			$images->name->HrefValue = "";
		}
		if ($images->RowType == EW_ROWTYPE_ADD ||
			$images->RowType == EW_ROWTYPE_EDIT ||
			$images->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$images->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($images->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$images->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $images;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($images->reg_id->FormValue) && $images->reg_id->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $images->reg_id->FldCaption());
		}
		if (!ew_CheckInteger($images->reg_id->FormValue)) {
			ew_AddMessage($gsFormError, $images->reg_id->FldErrMsg());
		}
		if (!is_null($images->name->FormValue) && $images->name->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $images->name->FldCaption());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $images;

		// Check if key value entered
		if ($images->reg_id->CurrentValue == "" && $images->reg_id->getSessionValue() == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $images->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $images->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setFailureMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// reg_id
		$images->reg_id->SetDbValueDef($rsnew, $images->reg_id->CurrentValue, 0, FALSE);

		// name
		$images->name->SetDbValueDef($rsnew, $images->name->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $images->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($images->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($images->CancelMessage <> "") {
				$this->setFailureMessage($images->CancelMessage);
				$images->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$images->Row_Inserted($rs, $rsnew);
		}
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

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
