<?php # Script 12.1 - login_page.inc.php
// This page prints any errors associated with logging in
// and it creates the entire login page, including the form.
// Include the header:
$page_title = 'Login';
include('includes/header.html');
?>
<script>
document.head.innerHTML += "<meta name=\"google-signin-client_id\" content=\"877530562015-vf5d4011idik1p22qtumpemig5jq2bt6.apps.googleusercontent.com\">";
</script>
<?php
echo "<div class = 'col-sm-6 page-with-form-body'>";
// Print any error messages, if they exist:
if (isset($errors) && !empty($errors)) {
	echo '<h1>Error!</h1>
	<p class="error">The following error(s) occurred:<br>';
	foreach ($errors as $msg) {
		echo " - $msg<br>\n";
	}
	echo '</p><p>Please try again.</p>';
}
// Display the form:
?>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<h1>Login</h1>
<form id = 'login-form' action="" method="post">
	<p class = "form-inputs">Email Address: <input type="email" id="email" name="email" size="20" maxlength="60"> </p>
	<p class = "form-inputs">Password: <input type="password" id="pass" name="pass" size="20" maxlength="20"></p>
	<div class="g-signin2" data-onsuccess="onSignIn"><button>Sign in with Google</button></div>
	<p><a href = "reset_password">Forgot Password?</a></p>
	<p><input type="submit" id = "submit" name="submit" value="Login"></p>
	<a href="#" onclick="signOut();">Sign out</a>
<script>
  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
    });
  }
</script>
</form>
<script>
function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
  console.log('Name: ' + profile.getName());
  console.log('Image URL: ' + profile.getImageUrl());
  console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
}
if (window.opener) {
	document.getElementById('submit').addEventListener('click', function() {
		const email = document.getElementById('email').value;
		let pass = document.getElementById('pass').value;
		fetch('/pages/ajax/encryptpass.php', {
			method: 'POST',
			body: `pass=${pass}`,
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			}
		}).then(response => {
			if (response.status >= 200 && response.status < 300) {
				return response.text();
			}
		}).then(response => {
			window.opener.postMessage([email, response], "http://audio.bforborum.com");
			window.opener.postMessage([email, response], "http://localhost:80");
			console.log(response);
		});
	});

}
</script>

<?php include('includes/footer.html'); ?>
