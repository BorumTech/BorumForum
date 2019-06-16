function setTopic(user_id, topic_id, action) {
	const buttonEl = document.getElementById('follow-btn');
	let url = '';

	let xhr;
	if (window.XMLHttpRequest){ // code for IE7+, Firefox, Chrome, Opera, Safari
		xhr = new XMLHttpRequest();
	} else { // code for IE6, IE5
		xhr = new ActiveXObject("Microsoft.XMLHTTP");
	}

	if (action == 'follow') {
		url = '/pages/ajax/followtopic.php';
	}

	const params = `user_id=${user_id}&topic_id=${topic_id}`;
	xhr.open("POST", url, true);

	// Send the proper header information along with the request
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

	xhr.onreadystatechange = function() { // Call a function when the state changes.
		if (xhr.readyState == 4 && xhr.status == 200) {	

		}
	}

	xhr.send(params);	
}

