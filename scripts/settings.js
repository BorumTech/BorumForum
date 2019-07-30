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

function inDarkMode() {
  return getCookie('dark') == '1';
}

function changeTheme(id) {
  var xmlhttp;
  if (window.XMLHttpRequest){ // code for IE7+, Firefox, Chrome, Opera, Safari
   xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  const page = "/pages/ajax/dark.php";
  xmlhttp.open("GET", page + "?id=" + id, true);
  xmlhttp.send();
}

if (inDarkMode()) {
  document.querySelector('body').className = 't--dark';
}

