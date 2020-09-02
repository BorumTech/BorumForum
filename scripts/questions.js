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
		response = JSON.parse(response);
		if (response.ok) {
			document.querySelector('.user-profile-container').insertAdjacentHTML('afterend', response.data);
			document.querySelector('#comment-body').value = "";
		}
	});
}

/*
	This function
		* Validates the content of the answer to prevent duplicates
		* Performs the query that posts the answer to the question
		* Returns this answer automatically once the "Post your Answer" input button is pressed
	Parameters
		* id (integer), the id of the user who is answering the question
*/
function answerQuestion(ques_id, answer, counter) {
	
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

/**
 * Turns the comment body <span> element into a <textarea>
 * Changes the Edit button text to Save
 * @param {number} id 
 */
function allowCommentEdit(id) {
	const commentContainer = document.getElementById('comment-' + id);

	// Gets the <span> element before the comment container, which contains the edit button
	const editButton = commentContainer.querySelector('.edit-button');
	// Get the last <span> in the comment container, which is the content of the comment
	let commentEl = commentContainer.getElementsByClassName('comment-body')[0];

	const cancelButton = createCancelButton();
	editButton.parentElement.appendChild(cancelButton);

	commentEl.outerHTML = "<textarea class='comment-body' cols='50'>" + commentEl.innerHTML + "</textarea>";
	commentEl = commentContainer.querySelector('textarea.comment-body');
	
	editButton.value = "Save";
	editButton.disabled = true;
	editButton.onclick = editComment;

	commentEl.addEventListener('keyup', function(e) {
		if (e.target.value == e.target.innerHTML) {
			editButton.setAttribute('disabled', true);
		} else {
			editButton.removeAttribute('disabled');
		} 
	});

	/**
	 * Event handler for making AJAX request to editcomment.php
	 * Updates the comment in the database
	 * Changes textarea back to span in the DOM
	 */
	async function editComment(e) {
		const newText = commentEl.value;
		// Send request
		const response = await ajaxPostMethod('editcomment.php', `id=${id}&new_text=${newText}`);	

		if (response['ok']) 
			restoreComment({target: {value: "Save"}});
	}

	/**
	 * Turns the textarea comment body back into a span
	 * Uses logic to check whether comment edit is cancelled or submitted
	 * @param {Event} e 
	 */
	function restoreComment(e) {
		let restoredText;
		if (e.target.value == "Cancel") {
			restoredText = commentEl.innerHTML;
		} else if (e.target.value == "Save") {
			restoredText = commentEl.value;
		}

		commentEl.outerHTML = "<span class='comment-body'>" + restoredText + "</span>";
		editButton.value = "Edit";
		editButton.removeAttribute('disabled');
		editButton.onclick = () => allowCommentEdit(id);
		editButton.parentElement.removeChild(cancelButton);
	}

	/**
	 * Creates a cancel button
	 * @returns HTMLInputElement the cancel button
	 */
	function createCancelButton() {
		const cancelButton = document.createElement('input');
		cancelButton.type = "button";
		cancelButton.value = "Cancel";
		cancelButton.onclick = restoreComment;
		return cancelButton;
	}
}



/**
 * Deletes the comment whose delete button the user pressed
 * Makes AJAX request to deletecomment.php
 * @param {number} id 
 */
async function deleteComment(id) {
	const response = await ajaxPostMethod('deletecomment.php', `id=${id}`);

	if (response['ok']) {
		const commentEl = document.getElementById('comment-' + id)
		commentEl.parentElement.removeChild(commentEl);
	}
}

/**
 * Helper method for making AJAX POST requests to ajax folder
 * @param {string} url the name of the file, preceded by any subdirectories within the ajax folder
 * @param {string} params the query parameters, serialized in key=value pair format
 * @param {Function} resolve the function to call if the fetch Promise is resolved
 * @returns {Promise} the response data in the form of a Promise
 */
async function ajaxPostMethod(url, params) {
	try {
		const response = await fetch(`/pages/ajax/${url}`, {
			method: 'POST',
			body: params,
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			}
		})
		
		if (response.status == 200) {
			const responseText = await response.text();
			return JSON.parse(responseText);
		}
	} catch (e) {
		console.log(e);
		alert("An error occured.");
		return Promise.reject(301);
	}
}
