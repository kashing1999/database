$(document).ready(function(){
	$("#btnSearch").click(function(){
		$( "#InsertFormContainer" ).load( "language.php #InsertFormContainer" );
		displayInsertElement();
	});

	$("#btnInsertion").click(function(){
		if($(".UpdateFormEle").css("display") == "block"){
			$( "#InsertFormContainer" ).load( "language.php #InsertFormContainer" );
			displayInsertElement();
		}
	});
});

function SearchOption(inputType){
	var searchMethod;

	if(inputType == 'Keyword'){
		searchMethod = document.getElementsByClassName("srhtxtbox");
		//chk for input type name SearchBase is checked
		if(document.querySelector("input[name='SearchBase']:checked").checked == true){
			for(var i = 0; i < searchMethod.length; i++){
				searchMethod[i].disabled = false;
			}	
		}else{
			for(var i = 0; i < searchMethod.length; i++){
				searchMethod[i].disabled = true;
			}
		}
	}


	if(inputType == "Officiality"){
		searchMethod = document.getElementsByClassName("chkbxOption");
		//chk if checkbocx is checked
		if(document.getElementById("chkbxActive").checked == true){
			for(var i = 0; i < searchMethod.length; i++){
					searchMethod[i].disabled = false;
			}
		}else{
			for(var i = 0; i < searchMethod.length; i++){
					searchMethod[i].disabled = true;
			}
		}	
	}	
}

function activeRdnOfficiality(value){
	if(value == 'T'){
		var rdnbtn = document.getElementById("rdnInsOfficialT");
	}
	else{
		var rdnbtn = document.getElementById("rdnInsOfficialF");
	}
	rdnbtn.checked = true;
}

function displayUpdateElement(){
	var element = document.getElementsByClassName("InsFormEle");

	for (var i = 0; i < element.length; i++) {
		element[i].style.display="none";
	}
	element = document.getElementsByClassName("UpdateFormEle");
	for (var i = 0; i < element.length; i++) {
		element[i].style.display="block";
	}
}

function displayInsertElement(){
	var element = document.getElementsByClassName("UpdateFormEle");

	for (var i = 0; i < element.length; i++) {
		element[i].style.display="none";
	}
	element = document.getElementsByClassName("InsFormEle");
	for (var i = 0; i < element.length; i++) {
		element[i].style.display="block";
	}
}

function disablePKEdit(){
	var element = document.getElementsByClassName("PKey");
	for (var i = 0; i < element.length; i++) {
		element[i].readOnly= true;
		element[i].style.background = "#E9E9E9";
		element[i].style.color = "#9D9D9D";
	}

}

function simulateClickTab(tabname){
	if(tabname == "Search"){
		document.getElementById("btnSearch").click();
	}
	else if(tabname == "Insert"){
		document.getElementById("btnInsertion").click();
	}	
}