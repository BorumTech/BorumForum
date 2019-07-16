const notificationBellEl = document.getElementById("notification-bell");
const notificationsEl = document.getElementById("notifications");

const handleBellClick = () => {
	if (notificationsEl.style.display == 'none') {
		notificationsEl.style.display = "block";
	} else if (notificationsEl.style.display == 'block') {
		notificationsEl.style.display = "none";
	}

};

notificationBellEl.addEventListener('click', handleBellClick);

