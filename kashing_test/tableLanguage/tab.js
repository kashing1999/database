function openFunc(evt, funcName){
	var tabcontent, tablink;

	tabcontent = document.getElementById("watermark");
	tabcontent.display = "none";
	
	//make all tab content hidden
	tabcontent = document.getElementsByClassName("tabcontent");
	for (var i = 0; i < tabcontent.length; i++) {
		tabcontent[i].style.display = "none";
	}

	//remove all active class in tablink
	tablink = document.getElementsByClassName("tablink");
	for (var i = 0; i < tablink.length; i++) {
		tablink[i].className = tablink[i].className.replace(" active", "");
	}

	document.getElementById(funcName).style.display = "block";
	evt.currentTarget.className += " active";
}
