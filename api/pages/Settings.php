<?php
session_start();

if (!(isset($_SESSION['id']))) {
	require('includes/login_functions.inc.php');
	redirect_user();
}

$page_title = "Settings - Borum";
include_once("includes/header.html");

?>
<div class = "col-sm-10" id = 'settings-body'>
	<h1>Settings</h1>
	<div class = "flex-box">
		<a href = "password">Change password</a>
		<a href = "edit_user?id=<?php echo $_SESSION['id']; ?>">Edit Information</a>
		<!-- Rectangular switch -->
		<div class = "dark-mode">
			<label class="switch">
		  		<input type="checkbox" class = "js-change-theme o-menu__item t-menu__item"
		  		<?php echo isset($_COOKIE['dark']) && $_COOKIE['dark'] == '1' ? 'checked' : '' ?> >
		  		<span class="slider"></span>
			</label>
			<span id = "text">Dark mode</span>
		</div>
		<a href = "/Settings/tag-notifications">Tag Watching and Ignoring</a>
		<a href = "/Settings/Sign-In-Credentials">Sign In Credentials</a>
		<a style = "color: red" href = "delete_user?id=<?php echo $_SESSION['id']; ?>">Delete Account</a>
	</div>

	<script src = "../scripts/settings.js"></script>
	<script>
		document
		  .querySelector('.js-change-theme')
		  .addEventListener('click', () => {
		    const body = document.querySelector('body');
			const twitterImgEl = document.querySelector('ul.social-media a.twitter img');

		    if (body.classList.contains('t--light')) { // When they turn dark mode on
		      body.classList.remove('t--light');
		      body.classList.add('t--dark');
		      twitterImgEl.src = 'http://cdn.bforborum.com/images/Twitter_Social_Icon_Circle_Black.svg';
		      console.log('dark');
		      document.cookie = "dark=1; path=/";
					changeTheme(<?php echo $_SESSION['id']; ?>);
		    }
		    else { // When they turn dark mode off
		      body.classList.remove('t--dark');
		      body.classList.add('t--light');
		      twitterImgEl.src = 'http://cdn.bforborum.com/images/Twitter_Social_Icon_Circle_White.svg';
		      console.log('not dark');
			  	document.cookie = "dark=0; path=/";
					changeTheme(<?php echo $_SESSION['id']; ?>)
		    }

		  })
		;

		if (inDarkMode()) {
			document.querySelector('div.dark-mode label.switch input.js-change-theme').setAttribute('checked', 'true');
		} else {
			document.querySelector('div.dark-mode label.switch input.js-change-theme').removeAttribute('checked');
		}

	</script>
<?php
include('includes/footer.html'); ?>
