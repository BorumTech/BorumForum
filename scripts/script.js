function deleteSubmission() {
	
}

function editBio(id) {
	/*
	This function accomplishes three tasks
	* Outputs the current bio in a textarea through asynchronous programming
	* Updates the new bio to the database
	* Outputs the new bio in an output element through asynchronous programming
	*/
	// Output the current bio in a textarea
	let xhr;
	if (window.XMLHttpRequest){ // code for IE7+, Firefox, Chrome, Opera, Safari
		xhr = new XMLHttpRequest();
	} else { // code for IE6, IE5
		xhr = new ActiveXObject("Microsoft.XMLHTTP");
	}

	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && xhr.status == 200) {
			document.getElementById('bio').outerHTML = `<textarea id = 'bio'>${xhr.responseText}</textarea>`;	
		}
	}

	xhr.open("GET", '/pages/ajax/bio.php?id=' + id, true);
	xhr.send();
}

