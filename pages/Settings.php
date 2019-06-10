<!DOCTYPE html>
<html>
<head>
	<style>
		a, .dark-mode {
			display: block;
			border: 10px double orange;
			width: 200px;
			text-align: center;
			font-family: 'Roboto', sans-serif;
			text-decoration: none;
			margin-bottom: 30px;
			padding: 5px;
		}

		a:visited {
			color: blue;
		}

		.switch {
		  position: relative;
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
		  top: 0;
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

		/* Dark and light mode*/
		/* light theme */
		.t--light {
		  background-color: hsl(0, 0%, 99.99%);
		  color: hsl(0, 0%, 5%);
		}

		/* dark theme */
		.t--dark {
		  background-color: hsl(0, 0%, 15%);
		  color: hsl(0, 0%, 95%);
		  
		  /* font hack for dark themes */
		  -webkit-font-smoothing: antialiased !important;
		  text-shadow: 1px 1px 1px rgba(0,0,0,0.004);
		  -webkit-text-stroke: 1px transparent;
		}

	</style>
	<title>Settings</title>
</head>
<body class = "t--light">
	<h1>Settings</h1>
	<a href = "password">Change password</a>
	<a href = "edit_user?id=<?php echo $_COOKIE['id']; ?>">Edit Information</a>
	<a style = "color: red" href = "delete_user?id=<?php echo $_COOKIE['id']; ?>">Delete Account</a>
	<!-- Rectangular switch -->
	<div class = "dark-mode">
		<label class="switch">
	  		<input type="checkbox" class = "js-change-theme o-menu__item t-menu__item">
	  		<span class="slider"></span>
		</label>
		<span id = "text">Dark mode</span>
	</div>
	<script>
		function getCookie(cname) {
		  var name = cname + "=";
		  var decodedCookie = decodeURIComponent(document.cookie);
		  var ca = decodedCookie.split(';');
		  for(var i = 0; i <ca.length; i++) {
		    var c = ca[i];
		    while (c.charAt(0) == ' ') {
		      c = c.substring(1);
		    }
		    if (c.indexOf(name) == 0) {
		      return c.substring(name.length, c.length);
		    }
		  }
		  return "";
		}

		document
		  .querySelector('.js-change-theme')
		  .addEventListener('click', () => {
		    const body = document.querySelector('body');
		  
		    if (body.classList.contains('t--light')) {
		      body.classList.remove('t--light');
		      body.classList.add('t--dark');
		    }
		    else {
		      body.classList.remove('t--dark');
		      body.classList.add('t--light');
		    }
		  })
		;


	</script>
</body>
</html>
