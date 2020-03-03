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

function confirmDeletion() {
	document.getElementById('delete-confirmation').style.display = "table";
}

function deleteTopic(topic_id) {
	fetch(`/pages/ajax/deletetopic.php?topic_id=${topic_id}`, {method: 'get'}).then(response => {
		if (response.status >= 200 && response.status < 300) {
			return response.text();
		}
	}).then(response => {
		document.getElementById('delete-topic-btn').style.display = 'none';
		document.getElementById('delete-confirmation').innerHTML = response;
		console.log(response);
	}).then(response => {
		setTimeout(function() {
			console.log("Redirection timer on");
			window.location.href = '/Topics';
		}, 1000);
	});
}

function addComment(body, msg_id, usr_id) {
	fetch('/pages/ajax/insertcomment.php', {
		method: 'POST',
		body: `body=${body}&msg_id=${msg_id}&usr_id=${usr_id}`,
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded'
		}
	}).then(response => {
		if (response.status >= 200 && response.status == 200) {
			return response.text();
		}
	}).then(response => {
		document.querySelector('.user-profile-container').insertAdjacentHTML('afterend', response);
		document.querySelector('#comment-body').textContent = "";
	});
}

function answerQuestion(ques_id, answer, counter) {
	/*
	This function
		* Validates the content of the answer to prevent duplicates
		* Performs the query that posts the answer to the question
		* Returns this answer automatically once the "Post your Answer" input button is pressed
	Parameters
		* id (integer), the id of the user who is answering the question
	*/

	let xhr;
	if (window.XMLHttpRequest){ // code for IE7+, Firefox, Chrome, Opera, Safari
		xhr = new XMLHttpRequest();
	} else { // code for IE6, IE5
		xhr = new ActiveXObject("Microsoft.XMLHTTP");
	}

	const url = '/pages/ajax/answer.php';
	const params = `ques_id=${ques_id}&answer=${answer}&counter=${counter}`;
	xhr.open("POST", url, true);

	// Send the proper header information along with the request
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

	xhr.onreadystatechange = function() { // Call a function when the state changes.
		if (xhr.readyState == 4 && xhr.status == 200) {
			document.getElementById('question-page-table').querySelector('tbody').innerHTML += xhr.responseText;
			document.getElementById('your-answer-ta').value = "";
      $([document.documentElement, document.body]).animate({
	        scrollTop: $('#upc-' + (counter - 1)).offset().top
      }, 1000);
		}
	}

	xhr.send(params);
}
