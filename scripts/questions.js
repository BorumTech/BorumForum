function setTopic(user_id, topic_id, action) {
	const buttonEl = document.getElementById(action + '-btn');
	let url = '';

	let xhr;
	if (window.XMLHttpRequest){ // code for IE7+, Firefox, Chrome, Opera, Safari
		xhr = new XMLHttpRequest();
	} else { // code for IE6, IE5
		xhr = new ActiveXObject("Microsoft.XMLHTTP");
	}

	if (action == 'follow') {
		url = '/pages/ajax/followtopic.php';
	} else if (action == 'ignore') {
		url = '/pages/ajax/ignoretopic.php';
	}

	const params = `?user_id=${user_id}&topic_id=${topic_id}`;

	xhr.onreadystatechange = function() { // Call a function when the state changes.
		if (xhr.readyState == 4 && xhr.status == 200) {	
			buttonEl.innerHTML = xhr.responseText;
		}
	}

	xhr.open("GET", url + params, true);
	xhr.send();	
}

function answerQuestion(ques_id, answer) {
	/*
	This function
		* Validates the content of the answer to prevent duplicates
		* Performs the query that posts the answer to the question
		* Returns this answer automatically once the "Post your Answer" input button is pressed
	Parameters
		* id (integer), the id of the user who is answering the question
	*/

	const ansBodyEl = document.getElementById('');

	let xhr;
	if (window.XMLHttpRequest){ // code for IE7+, Firefox, Chrome, Opera, Safari
		xhr = new XMLHttpRequest();
	} else { // code for IE6, IE5
		xhr = new ActiveXObject("Microsoft.XMLHTTP");
	}

	const url = '/pages/ajax/answer.php';
	const params = `ques_id=${ques_id}&answer=${answer}`;
	xhr.open("POST", url, true);

	// Send the proper header information along with the request
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

	xhr.onreadystatechange = function() { // Call a function when the state changes.
		if (xhr.readyState == 4 && xhr.status == 200) {	
			if (!getCookie('id')) { // If the user is not logged in
				alert('You cannot post an answer because you are not logged in.');
			} else {
				document.getElementById('question-page-table').querySelector('tbody').innerHTML += xhr.responseText;
			}
		}
	}

	xhr.send(params);
}

