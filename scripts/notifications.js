const notificationBellEl = document.getElementById("notification-bell");
const notificationsEl = document.getElementById("notifications");

const handleBellClick = () => {
	if (notificationsEl.style.display == 'none') {
		notificationsEl.style.display = "block";
		notificationBellEl.style.backgroundColor = "lightgrey";
	} else if (notificationsEl.style.display == 'block') {
		notificationsEl.style.display = "none";
	}

};

if (notificationBellEl && notificationsEl)
	notificationBellEl.addEventListener('click', handleBellClick);

