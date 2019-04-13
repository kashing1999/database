<?php
//insert new language
function insertLanguage($countrycode,$language,$officiality,$percentage){
	include 'Config.php';
	$sql = "INSERT INTO countrylanguage VALUES ('".$countrycode."','".$language."','".$officiality."','".$percentage."')";

	if($conn->query($sql) == True){
		echo '<script language="javascript">';
		echo 'alert("Language successfully added.");';
		echo '</script>';
		header("refresh:0;");
	}
	else{
		echo '<script language="javascript">';
		echo 'alert("Insertion Fail \nError: \n'.$sql.'\n'.$conn->error.'");';
		echo '</script>';
		header("refresh:0;");
	}
}
//update new language
function updateLanguage($countrycode,$language,$officiality,$percentage){
	include 'Config.php';
	$sql = "UPDATE countrylanguage 
			SET  CountryCode = '".$countrycode."', Language = '".$language."', IsOfficial = '".$officiality."', Percentage = '".$percentage."'
			WHERE CountryCode = '".$countrycode."' AND Language = '".$language."';";

	if($conn->query($sql) == True){
		echo '<script language="javascript">';
		echo 'alert("Language successfully updated.");';
		echo '</script>';
		header("refresh:0;");
	}
	else{
		echo '<script language="javascript">';
		echo 'alert("Update Fail \nError: \n'.$sql.'\n'.$conn->error.'");';
		echo '</script>';
		header("refresh:0;");
	}
}

//chk for country code exist in country table
function ChkCountryCode($Code){
	include 'Config.php';
	$sql = "SELECT code FROM country where code = '".$Code."';";

	$result = $conn -> query($sql);
	$bool = ($result -> num_rows)>0 ? true : false;
	//return true if record found
	return $bool;
}

//chk for primery key duplicate in language table
function ChkPKDuplicateLang($Code,$Language){
	include 'Config.php';
	$sql = "SELECT CountryCode 
			FROM countrylanguage 
			where CountryCode = '".$Code."' AND Language = '".$Language."';";

	$result = $conn -> query($sql);
	$bool = ($result -> num_rows)>0 ? true : false;
	//return true if record found
	return $bool;
}

//search function 25 row per page and pagination
function searchLanguageWithPage($searchtype,$keyword,$officiality){
	include 'Config.php';

	//Process what querry to run
	$sql = $condition = '';
	if($officiality == "both" OR $officiality == "none"){
		if($searchtype == "CountryCode"){
			$condition= 'CountryCode LIKE "%'.$keyword.'%"';
		}elseif($searchtype == "Language"){
			$condition= 'Language LIKE "%'.$keyword.'%"';
		}elseif($searchtype == "Percentage"){
			$condition= ' Percentage LIKE "'.$keyword.'%"';
		}else{
			$condition = 'IsOfficial = "T" OR IsOfficial = "F"';
		}
	}
	elseif($officiality == "true"){
		if($searchtype == "CountryCode"){
			$condition= 'CountryCode LIKE "%'.$keyword.'%" AND IsOfficial = "T"';
		}elseif($searchtype == "Language"){
			$condition= 'Language LIKE "%'.$keyword.'%" AND IsOfficial = "T"';
		}elseif($searchtype == "Percentage"){
			$condition= ' Percentage LIKE "'.$keyword.'%" AND IsOfficial = "T"';
		}else{
			$condition = 'IsOfficial = "T"';
		}
	}elseif($officiality == "false"){
		if($searchtype == "CountryCode"){
			$condition= 'CountryCode LIKE "%'.$keyword.'%" AND IsOfficial = "F"';
		}elseif($searchtype == "Language"){
			$condition= 'Language LIKE "%'.$keyword.'%" AND IsOfficial = "F"';
		}elseif($searchtype == "Percentage"){
			$condition= ' Percentage LIKE "'.$keyword.'%" AND IsOfficial = "F"';
		}else{
			$condition ='IsOfficial = "F"';
		}
	}

	if($searchtype == "" and $keyword == "" and $officiality == ""){
		$sql="SELECT * FROM countrylanguage;";
	}else{
		$sql="SELECT * FROM countrylanguage WHERE ".$condition."";
	}

	
	$result = $conn->query($sql);
	//echo "<script>alert('".$sql."');</script>";

	/*-----Pagination Code-----*/
	//Pagination Variable
	$rowsperpage = 25;
	$totalpage = ceil(($result -> num_rows)/$rowsperpage);

	//set default page
	if(isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])){
		$currentpage = (int)$_GET['currentpage'];
	}else{
		$currentpage = 1;
	}

	if($currentpage > $totalpage){
		$currentpage = $totalpage;
	}
	if($currentpage < 1){
		$currentpage = 1;
	}
	//offset for which row to start
	$offset = ($currentpage -1) * $rowsperpage;

	/*-----End Pagination-----*/

	$pagedSQL = "".$sql." LIMIT ".$offset.",".$rowsperpage.";";
	//echo "<script>alert('".$pagedSQL."');</script>";
	$resultwithpagelimit = $conn->query($pagedSQL);

	if($resultwithpagelimit -> num_rows >0){
		echo "<table class='table table-striped'>";
		echo "<tr>
			<th>Country Code</th>
			<th>Language</th>
			<th>Officiality</th>
			<th>Percentage</th>
			<th></th>
			<th></th>
		</tr>";
		while($row = $resultwithpagelimit->fetch_assoc()){
			echo "<tr>
				<td>".$row['CountryCode']."</td>
				<td>".$row['Language']."</td>
				<td>".$row['IsOfficial']."</td>
				<td>".$row['Percentage']."</td>
				<form  method='post' action='{$_SERVER['PHP_SELF']}'>
				<input type='hidden' name='deleteCCode' value='".$row['CountryCode']."'>
				<input type='hidden' name='deleteLanguage' value='".$row['Language']."'>
				<td><button class='submit-button  btn btn-outline-secondary' type='submit' name='slteditLanguage' value='edit'>edit</td>
				<td><button class='submit-button  btn btn-outline-secondary' type='submit' name='sltdeleteLanguage' value='delete'>delete</td>
								
				</form>
			</tr>";
		}
		echo "</table>";

		/*-----Create pagination Page No Button-----*/
		$range = 1;
		//create url with same get variable
		$url = $_SERVER['REQUEST_URI'];
	
		
		if(!empty($_GET['currentpage'])){
			$url = substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], "&currentpage="));
		}

		if($currentpage > 1){
			echo "<a class='btn btn-default' href = '".$url."&currentpage=1'><<</a>";
			$previouspage = $currentpage -1;
			echo " <a class='btn btn-default' href='".$url."&currentpage=".$previouspage."'><</a>";
		}

		//loop show links to other page
		for($i = ($currentpage - $range); $i < (($currentpage + $range)+1); $i++ ){
			if($i == $currentpage){
				echo "<a class='btn btn-default active' href=''>".$i."</a>";
			}else{
				if(($result -> num_rows) > $rowsperpage){ 		/*use original $result coz ned to know total how many row in this sql*/
					if($i>0){
						echo "<a class='btn btn-default' href='".$url."&currentpage=".$i."'>".$i."</a>";
					}
				}	
			}
		}

		//if not on last page, show forward and last page links  
		if($currentpage != $totalpage){
			$nextpage = $currentpage +1;
			// echo forward link for next page 
		   echo " <a class='btn btn-default' href='".$url."&currentpage=".$nextpage."'>></a>";
		   // echo forward link for lastpage
		   echo " <a class='btn btn-default' href='".$url."&currentpage=".$totalpage."'>>></a>";

		}

		/*-----End pagination Page No Button-----*/
	}else{
		echo "<script>alert('No result is found.');</script>";
	}

}

function srhSpecificLang($ccode,$lang){
	include 'Config.php';
	$code = $language = $Officiality = $percentage = ""; 
	$sql = "SELECT * FROM countrylanguage 
			WHERE CountryCode = '".$ccode."' AND Language = '".$lang."';";
	$result = $conn->query($sql);
	if($row = $result->fetch_assoc()){
		$code = $row["CountryCode"];
		$language = $row["Language"];
		$IsOfficial = $row["IsOfficial"];
		$Percentage = $row["Percentage"];
	}
	return array($code,$language,$IsOfficial,$Percentage);
}

function OfficialityChked($variable,$value){
	if(!empty($variable)){		
		foreach($variable as $key){
			if($key == $value){	
				return true;
			}
		}
	}else{
		return false;
	}
}
//delete language
function deleteLanguage($ccode,$Language){
	include 'Config.php';
	$sql = "DELETE FROM countrylanguage 
			WHERE CountryCode = '".$ccode."' AND Language = '".$Language."';";

	if($conn -> query($sql) == true){
		echo "<script>alert('The record with Country Code = ".$ccode." and Language = ".$Language." has been deleted.');</script>";
	}else{
		echo "<script>alert('Fail to delete the record.');</script>";
	}
}


//search function Ori
function searchLanguage($searchtype,$keyword,$officiality){
	include 'Config.php';

	//Process what querry to run
	$sql = $condition = '';
	if($officiality == "both" OR $officiality == "none"){
		if($searchtype == "CountryCode"){
			$condition= 'CountryCode LIKE "%'.$keyword.'%"';
		}elseif($searchtype == "Language"){
			$condition= 'Language LIKE "%'.$keyword.'%"';
		}elseif($searchtype == "Percentage"){
			$condition= ' Percentage LIKE "'.$keyword.'%"';
		}else{
			$condition = 'IsOfficial = "T" OR IsOfficial = "F"';
		}
	}
	elseif($officiality == "true"){
		if($searchtype == "CountryCode"){
			$condition= 'CountryCode LIKE "%'.$keyword.'%" AND IsOfficial = "T"';
		}elseif($searchtype == "Language"){
			$condition= 'Language LIKE "%'.$keyword.'%" AND IsOfficial = "T"';
		}elseif($searchtype == "Percentage"){
			$condition= ' Percentage LIKE "'.$keyword.'%" AND IsOfficial = "T"';
		}else{
			$condition = 'IsOfficial = "T"';
		}
	}elseif($officiality == "false"){
		if($searchtype == "CountryCode"){
			$condition= 'CountryCode LIKE "%'.$keyword.'%" AND IsOfficial = "F"';
		}elseif($searchtype == "Language"){
			$condition= 'Language LIKE "%'.$keyword.'%" AND IsOfficial = "F"';
		}elseif($searchtype == "Percentage"){
			$condition= ' Percentage LIKE "'.$keyword.'%" AND IsOfficial = "F"';
		}else{
			$condition ='IsOfficial = "F"';
		}
	}

	$sql="SELECT * FROM countrylanguage WHERE ".$condition.";";
	$result = $conn->query($sql);
	echo "<script>alert('".$sql."');</script>";

	if($result -> num_rows >0){
		echo "<table>";
		echo "<tr>
			<th>Country Code</th>
			<th>Language</th>
			<th>Officiality</th>
			<th>Percentage</th>
			<th>Edit Button</th>
			<th>Delete Button</th>
		</tr>";
		while($row = $result->fetch_assoc()){
			echo '<tr>
				<td>'.$row["CountryCode"].'</td>
				<td>'.$row["Language"].'</td>
				<td>'.$row["IsOfficial"].'</td>
				<td>'.$row["Percentage"].'</td>
				<form  method="post" action="language.php">
				<input type="hidden" name="deleteCCode" value="'.$row['CountryCode'].'">
				<input type="hidden" name="deleteLanguage" value="'.$row['Language'].'">
				<td><input type="submit" name="slteditLanguage" value="Edit"></td>
				<td><input type="submit" name="sltdeleteLanguage" value="Delete"></td>
				</form>
			</tr>';
		}
		echo "</table>";
	}else{
		echo "<script>alert('No result is found.');</script>";
	}

}


?>