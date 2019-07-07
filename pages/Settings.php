<?php 
require('includes/login_functions.inc.php');
if (!(isset($_COOKIE['id']) && isset($_COOKIE['first_name']) && isset($_COOKIE['last_name']))) {
	redirect_user();
}
?>
<!DOCTYPE html>
<html>
<head>
	<link href = "../images/icon.ico" rel = "image icon" type = "image/x-icon">
	<style>	
		.settings-links {
			display: flex;
			width: 100%;
			justify-content: center;
			border: 1px solid black;
			flex-wrap: wrap;
		}

		.settings-links > a, .dark-mode {
			text-align: center;
			display: inline-block;
			border: 10px double orange;
			margin: 20px;
			padding: 5px;
			height: 50px;
			line-height: 50px;
			font-family: 'Roboto', sans-serif;
			text-decoration: none;
			color: rgb(15, 160, 255);
			flex: 1 1 200px;
		}

		a:visited {
			color: rgb(15, 168, 255);
		}

		.switch {
		  position: relative;
		  top: 5px;
		  display: inline-block;
		  width: 60px;
		  height: 34px;
		}

		.switch input { 
		  opacity: 0;
		  width: 0;
		  height: 0;
		}

		.slider {
		  position: absolute;
		  cursor: pointer;
		  top: 2px;
		  left: 0;
		  right: 0;
		  bottom: 0;
		  background-color: #ccc;
		  -webkit-transition: .4s;
		  transition: .4s;
		}

		.slider:before {
		  position: absolute;
		  content: "";
		  height: 26px;
		  width: 26px;
		  left: 4px;
		  bottom: 4px;
		  background-color: white;
		  -webkit-transition: .4s;
		  transition: .4s;
		}

		input:checked + .slider {
		  background-color: #2196F3;
		}

		input:focus + .slider {
		  box-shadow: 0 0 1px #2196F3;
		}

		input:checked + .slider:before {
		  -webkit-transform: translateX(26px);
		  -ms-transform: translateX(26px);
		  transform: translateX(26px);
		}

		/* Rounded sliders */
		.slider {
		  border-radius: 34px;
		}

		.slider:before {
		  border-radius: 50%;
		}

		/* ID styles*/
		#text {
			font-family: sans-serif;
		}
	</style>
	<link href = "../css/settings.css" rel = "stylesheet" type = "text/css">
	<title>Settings</title>
</head>
<body class = "<?php echo isset($_COOKIE['dark']) ? 't--dark' : 't--light'; ?>">
	<h1>Settings</h1>
	<div class = "settings-links">
		<a href = "password">Change password</a>
		<a href = "edit_user?id=<?php echo $_COOKIE['id']; ?>">Edit Information</a>
		<a style = "color: red" href = "delete_user?id=<?php echo $_COOKIE['id']; ?>">Delete Account</a>
		<!-- Rectangular switch -->
		<div class = "dark-mode">
			<label class="switch">
		  		<input type="checkbox" class = "js-change-theme o-menu__item t-menu__item" 
		  		<?php echo isset($_COOKIE['dark']) ? 'checked' : '' ?> >
		  		<span class="slider"></span>
			</label>
			<span id = "text">Dark mode</span>
		</div>
		<a href = "/Settings/tag-notifications">Tag Watching and Ignoring</a>
		<a href = "/Settings/Sign-In-Credentials">Sign In Credentials</a>
		<a href = "/">Home</a>
		<a href = "/Users/<?php echo $_COOKIE['id']; ?>">Back to my profile</a>
	</div>

	<script src = "../scripts/settings.js"></script>
	<script>
		document
		  .querySelector('.js-change-theme')
		  .addEventListener('click', () => {
		    const body = document.querySelector('body');
		  
		    if (body.classList.contains('t--light')) { // When they turn dark mode oFF
		      body.classList.remove('t--light');
		      body.classList.add('t--dark');
		      console.log('dark');
		      document.cookie = "dark=true; path=/";
		    }
		    else { // When they turn dark mode oN
		      body.classList.remove('t--dark');
		      body.classList.add('t--light');
		      console.log('not dark');
			  document.cookie = "dark=; path=/";
		    }

		  })
		;

		document.querySelector('body').className = inDarkMode() ? 't--dark' : 't--light';
		if (inDarkMode()) {
			document.querySelector('div.dark-mode label.switch input.js-change-theme').setAttribute('checked', 'true');		
		} else {
			document.querySelector('div.dark-mode label.switch input.js-change-theme').removeAttribute('checked');
		}

	</script>
</body>
</html>
