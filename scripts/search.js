function loadUserSearch(q) {
	let xhr;
	if (window.XMLHttpRequest){ // code for IE7+, Firefox, Chrome, Opera, Safari
		xhr = new XMLHttpRequest();
	} else { // code for IE6, IE5
		xhr = new ActiveXObject("Microsoft.XMLHTTP");
	}

	const url = '/pages/ajax/searches/searchusers.php';
	const params = '?q=' + q;
	
	xhr.onreadystatechange= function() {
		if (xhr.readyState == 4 && xhr.status == 200) {	
			document.getElementById('users-body').innerHTML = xhr.responseText;
		}
	}

	xhr.open("GET", url + params, true);
	xhr.send();	
}

function appendViewUsersQuery() {
	window.location.href = "/view_users?q=" + document.getElementById('site-search').value;
}