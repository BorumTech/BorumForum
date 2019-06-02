function deleteSubmission() {
	
}

function editBio(id) {
	/*
	This function accomplishes two tasks
		* Outputs the current bio in a textarea through asynchronous programming
		* Updates the new bio to the database and outputs the new bio in an output element through asynchronous programming
	It uses conditionals to determine which task it must accomplish
	This function takes one
		* id (integer), the id of the user who is changing his or her bio
	*/

	let func = "select";

	const bioEl = document.getElementById('bio');
	const isOutput = bioEl.tagName == 'OUTPUT';
	const isTextarea = bioEl.tagName == 'TEXTAREA';
	func = isTextarea ? "update" : "select";

	let xhr;
	if (window.XMLHttpRequest){ // code for IE7+, Firefox, Chrome, Opera, Safari
		xhr = new XMLHttpRequest();
	} else { // code for IE6, IE5
		xhr = new ActiveXObject("Microsoft.XMLHTTP");
	}

	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && xhr.status == 200) {	
			bioEl.nextElementSibling.value = isOutput ? "Save" : "Edit Bio";	

			const outputN = `<output id="bio">${xhr.responseText}</output>`;
			const textareaN = `<textarea id="bio">${xhr.responseText}</textarea>`;
			
			bioEl.outerHTML = isTextarea ? outputN : textareaN;
		}
	}

	xhr.open("GET", '/pages/ajax/bio.php?id=' + id + '&func=' + func, true);
	xhr.send();
}

