function deleteSubmission() {
	
}

function editBio(id, bio) {
	/*
	This function accomplishes two tasks
		* Outputs the current bio in a textarea through asynchronous programming
		* Updates the new bio to the database and outputs the new bio in an output element through asynchronous programming
	It uses conditionals to determine which task it must accomplish
	This function takes one
		* id (integer), the id of the user who is changing his or her bio
	*/

	const bioEl = document.getElementById('bio');
	const isOutput = bioEl.tagName == 'OUTPUT';
	const isTextarea = bioEl.tagName == 'TEXTAREA';
	const func = isTextarea ? "update" : "select";

	let xhr;
	if (window.XMLHttpRequest){ // code for IE7+, Firefox, Chrome, Opera, Safari
		xhr = new XMLHttpRequest();
	} else { // code for IE6, IE5
		xhr = new ActiveXObject("Microsoft.XMLHTTP");
	}

	const url = '/pages/ajax/bio.php';
	const params = `id=${id}&func=${func}&bio=${bio}`;
	xhr.open("POST", url, true);

	// Send the proper header information along with the request
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

	xhr.onreadystatechange = function() { // Call a function when the state changes.
		if (xhr.readyState == 4 && xhr.status == 200) {	
			bioEl.nextElementSibling.value = isOutput ? "Save" : "Edit Bio";	

			const outputN = `<output id="bio">${xhr.responseText}</output>`;
			const textareaN = `<textarea id="bio">${xhr.responseText}</textarea>`;

			bioEl.outerHTML = isTextarea ? outputN : textareaN;
		}
	}

	xhr.send(params);

}

