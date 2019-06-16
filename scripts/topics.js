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

