<?php
include 'Config.php';
include 'countrylanguagequery.php';


//Form Variable for insert
$countrylanguage_CountryCode = $countrylanguage_Language = $countrylanguage_IsOfficial = $countrylanguage_Percentage = "";
//ready state variable
$CountryCode_ready = $Language_ready = $IsOfficial_ready = $Percentage_ready = "";
//error msg variable
$ErrCountryCode = $ErrLanguage = $ErrIsOfficial = $ErrPercentage = "";

//Form Variable for search;
$keyword = $searchtype = $officiality = "";
$ErrSearch = "";

//Variable for update function
$updateState = false;

//Msg Variable
$CautionMsg = "CAUTION: Percentage entered will be automatically round off to single decimal place.";

if(isset($_POST['btnupdate'])){
	$updateState = true;
}

//Form Validation for insert
if(isset($_POST['btninsert']) or isset($_POST['btnupdate'])){
	//chk country code input
	if(empty($_POST['CountryCode'])){
		$ErrCountryCode = "* Country Code is required.";
	}else if(strlen($_POST['CountryCode']) != 3){
		$ErrCountryCode = "* Country Code must be 3 characters ONLY.";
	}else{
		if(!preg_match('/^[a-zA-z0-9]+$/', $_POST['CountryCode'])){
			$ErrCountryCode = '* Special Characters are NOT allowed.';
		}else{
			if(ChkCountryCode($_POST['CountryCode']) == false){
				$ErrCountryCode = '* The Country Code is not found in the database.';
			}else{
				$countrylanguage_CountryCode = strtoupper($_POST['CountryCode']);
				$CountryCode_ready = true;
			}
			
		}
	}
		//chk language input
	if(empty($_POST['Language'])){
		$ErrLanguage = "* Language is required.";
	}else{
		if(!preg_match('/^[a-zA-z0-9]+$/', $_POST['Language'])){
			$ErrLanguage = '* Special Characters are NOT allowed.';
		}else{
			$countrylanguage_Language = $_POST['Language'];
			$Language_ready = true;
		}
	}
	//chk officiality input
	if(empty($_POST['rdnOfficiality'])){
		$ErrIsOfficial = "* Officiality is required.";
	}else{
		if($_POST['rdnOfficiality'] == "True"){
			$countrylanguage_IsOfficial = 'T';
		}else{
			$countrylanguage_IsOfficial = 'F';
		}
		$IsOfficial_ready = true;
	}

	if(empty($_POST['Percentage'])){
		$ErrPercentage = "* Percentage is required.";
	}else{
		if(is_numeric( $_POST['Percentage']) ==  false){
			$ErrPercentage = '* Alphabet AND Special Characters are NOT allowed.';
		}else{
			if($_POST['Percentage'] > 100 ){
				$ErrPercentage = '* Value cannot be more than 100.';
			}else{
				/*$temp = explode(".", $_POST['Percentage']);
				if(Strlen($temp[1])>1){
					$ErrPercentage = '* CANNOT be more than 1 decimal.';
				}else{*/
					$countrylanguage_Percentage= $_POST['Percentage'];
					$Percentage_ready = true;
				//}
			}	
		}
	}
	
	//if all variable correct insert
	if($CountryCode_ready and $Language_ready and $IsOfficial_ready and $Percentage_ready and $updateState == true){
		//chk if new data value is same as old data
		$LangDetail = srhSpecificLang($countrylanguage_CountryCode,$countrylanguage_Language);
		if(($countrylanguage_CountryCode == $LangDetail[0] and $countrylanguage_Language == $LangDetail[1] and $countrylanguage_IsOfficial = $LangDetail[2] and $countrylanguage_Percentage == $LangDetail[3]) == true){
			echo "<script>alert('All values are the same. No update is performed.');</script>";
			header("refresh:0;");
		}
		else{
			updateLanguage($countrylanguage_CountryCode,$countrylanguage_Language,$countrylanguage_IsOfficial,$countrylanguage_Percentage);
		}
		
	}
	elseif($CountryCode_ready and $Language_ready and $IsOfficial_ready and $Percentage_ready == true){
		//chk for primery key already exist in database
		if(ChkPKDuplicateLang($countrylanguage_CountryCode,$countrylanguage_Language) == true){
			echo "<script>alert('Data with the SAME Country Code and Language already exists. Data NOT inserted.');</script>";
		}
		else{
			insertLanguage($countrylanguage_CountryCode,$countrylanguage_Language,$countrylanguage_IsOfficial,$countrylanguage_Percentage);
		}
	}
}

//Form Validation for search
if(isset($_GET['btnsearch']) or isset($_GET['currentpage'])){
	if(empty($_GET['keyword']) == True AND empty($_GET['chkValue']) == True){
		$ErrSearch = "<br>Please enter a keyword or select a choice";
	}else{
		//chk which officiality is pick
		if(empty($_GET['chkValue'])){
			$officiality = "none";
		}
		elseif(OfficialityChked($_GET['chkValue'],'True')AND OfficialityChked($_GET['chkValue'],'False')){
			$officiality = "both";
		}
		elseif(OfficialityChked($_GET['chkValue'],'True')){
			$officiality = "true";		
		}
		elseif(OfficialityChked($_GET['chkValue'],'False')){
			$officiality = "false";		
		}

		$keyword = (empty($_GET['keyword'])?"":$_GET['keyword']);	//if keyword not entered than empty
		$searchtype = (empty($_GET['SearchBase'])?"":$_GET['SearchBase']); //if searchbase not selected than empty
	}
}

if(isset($_POST["slteditLanguage"])){
	$updateState = true;
	$LangDetail = srhSpecificLang($_POST["deleteCCode"],$_POST["deleteLanguage"]);
	$countrylanguage_CountryCode = $LangDetail[0];
	$countrylanguage_Language = $LangDetail[1];
	$countrylanguage_IsOfficial = $LangDetail[2];
	$countrylanguage_Percentage = $LangDetail[3];
	$CautionMsg = "CAUTION: Percentage will be rounded off automatically to a single decimal place.<br> 
					Editing of Country Code or Language is forbidden as they are PRIMARY KEYS.<br>
					If primary keys need to be edited, please delete the record and insert new values.";
}

if(isset($_POST["sltdeleteLanguage"])){
	deleteLanguage($_POST["deleteCCode"],$_POST["deleteLanguage"]);
}

mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="tab.css">
		<link rel="stylesheet" type="text/css" href="language.css">
		<script type="text/javascript" src="tab.js"></script>
		<script type="text/javascript" src="language.js"></script>

	</head>

	<body>
		<?php include '../mynavbar.php';?>
		<!--tab link-->
		<div class="tab" style="display: none;">
			<button id = "btnSearch" class = "tablink" onclick="openFunc(event,'tabSearch')">Search</button>
			<button id = "btnInsertion" class = "tablink" onclick="openFunc(event,'tabInsertion')">Add Record</button>	
		</div>

		<div class = "container tabcontentcontainer">
			<div id="watermark"  class = "row tabcontent"><center>No Function Is Selected</center></div>

			<!--tab Search Content-->
			<div id="tabSearch" class = "container tabcontent">
			<h1 class="display-4">Language</h1><hr>
				<div class="container containerForm">
					<form autocomplete = "off" method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<p>Search By:</p>
						<div class="row">
							<div class="col-md-5 col-sm-12">
								<div id="rdndiv">
									
									<input type="radio" name="SearchBase" value="CountryCode" onclick="SearchOption('Keyword')"><label>Country Code &nbsp;</label>
									<input type="radio" name="SearchBase" value="Language" onclick="SearchOption('Keyword')"><label>Language &nbsp;</label>
									<input type="radio" name="SearchBase" value="Percentage" onclick="SearchOption('Keyword')"><label>Percentage</label>
								</div>
								<div id="KeywordSearch"  class = "searchMethod">
									<label>Keyword: </label>
									<input class="srhtxtbox" type="text" name="keyword" disabled="true">
									<span style="color:red;"><?php echo $ErrSearch;?></span>
								</div>
							</div>
							<div class="col-md-2 col-sm-12">
								<p>--OR--</p>
							</div>
							<div class="col-md-5 col-sm-12">
								<div id="OfficialitySearch"  class = "searchMethod">
									<input id="chkbxActive" type="checkbox" onclick="SearchOption('Officiality')"><label>Officiality</label>
									<input class="submit-button btn btn-outline-secondary" id = "SearchButton" type="submit" value="Search" name="btnsearch">

									<br>
									<input class="chkbxOption" type="checkbox" name="chkValue[]" value="True" disabled="true"><label>True</label>
									<input class="chkbxOption" type="checkbox" name="chkValue[]" value="False" disabled="true"><label>False</label>	

								</div>
							</div>
						</div>
							

						
					</form>	
				</div>
				
				<!-----Table Result----->
				<div id="containerSearchResult">
					<?php
						if(isset($_GET['btnsearch']) or isset($_GET['currentpage'])){
							echo '<script>simulateClickTab("Search");</script>';
							if(empty($_GET['keyword']) == False OR empty($_GET['chkValue']) == False){
								searchLanguageWithPage($searchtype,$keyword,$officiality);
							}
						}
					?>
				</div>
				
			</div>
			<!--End:tab Search Content-->

			<!--tab Insert Content-->
			<div id="tabInsertion" class="container tabcontent">
				<div class="row">
					<div class="col-sm-12">
						<h2 class="display-4 InsFormEle">Insert New Language</h2>
						<h2 class="display-4 UpdateFormEle" style="display:none">Update Language</h2>
						<hr>
					</div>
				</div>
				
				<!--Insertion Form-->
				<div id="InsertFormContainer" class="container">
				<!--h1 class="display-4">Insert into Language</h1><hr>-->
					<form autocomplete = "off" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<div>
							<label>Country Code :</label>
							<div>
								<input class="form-control PKey"   type="text" name="CountryCode" value="<?php echo $countrylanguage_CountryCode?>">
								<br>
							</div>
							<div>
								<span style='color:red'><?php echo $ErrCountryCode;?></span>
							</div>
						</div>

						<div>
							<label>Language :</label>
							<div>
								<input class="form-control PKey" type="text" name="Language" value="<?php echo $countrylanguage_Language;?>">
								<br>
							</div>
							<div>
								<span style='color:red'><?php echo $ErrLanguage;?></span>
							</div>
						</div>

						<div>
							<label>Officiality :</label>
							<div>
								<input id="rdnInsOfficialT" type="radio" name="rdnOfficiality" value="True">
								<label>True</label>
							</div>
							<div>
								<input id="rdnInsOfficialF" type="radio" name="rdnOfficiality" value="False">
								<label>False</label>
							</div>
							<div>
								<span style='color:red'><?php echo $ErrIsOfficial;?></span>
							</div>
						</div>

						<div>
							<label>Percentage :</label>
							<div>
								<input type="text" class="form-control" name="Percentage" value="<?php echo $countrylanguage_Percentage;?>">
							</div>
							<div>
								<span style='color:red'><?php echo $ErrPercentage;?></span>
							</div>
						</div>
						<div>
							<p style='color:#B2B2B2'><?php echo $CautionMsg;?></p>
						</div>
						<input class="submit-button btn btn-outline-secondary InsFormEle" type="submit" value="Insert" name="btninsert">
						<input class="submit-button btn btn-outline-secondary UpdateFormEle" type="submit" value="Update" name="btnupdate" style="display:none">
					</form>
				</div>
			</div>
		</div>
		<!--End:tab Insert Content-->
		

		
	</body>
</html>
<?php
	if(!empty($_POST['rdnOfficiality'])){
		echo"<script>
				activeRdnOfficiality('".$countrylanguage_IsOfficial."');
			</script>";
	}

	if($updateState == true){
		echo"<script>
				activeRdnOfficiality('".$countrylanguage_IsOfficial."');
				displayUpdateElement();
				disablePKEdit();
			</script>";
	}
	
	if(isset($_POST['btninsert']) or isset($_POST['btnupdate']) or isset($_POST["slteditLanguage"])){
		echo '<script>simulateClickTab("Insert");</script>';
	}

	if (isset($_POST['btnOpenLSearchPage'])) {
		echo "<script>openFunc(event,'tabSearch');</script>";
	}

	if (isset($_POST['btnOpenLAddRecordPage'])) {
		echo "<script>openFunc(event,'tabInsertion');</script>";
	}
	
?>