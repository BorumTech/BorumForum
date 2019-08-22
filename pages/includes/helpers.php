<?php 

# giveClassActive() is a function that highlights the header name of the current page. The $file is what is used to determine whether to give it the element a class active. The $href determines the location. There can be different when dealing with special symbols. The $show is the text to show.
function giveClassActive($file, $href, $show, $li = true) {
  $shouldbeactive = $_SERVER['REQUEST_URI'] == $href;
  if ($href == null)
    $href = $file;
  echo $li ? '<li class = "' : '';
  echo $shouldbeactive && $li ? 'active' : '';
  echo $li ? '">' : '';
  echo '<a href = "' . $href . '"';
  echo $shouldbeactive && !$li ? ' class = "active"' : '';
  echo '>'. $show . '</a>';
  echo $li ? '</li>' : '';
}

function performTopSearchBarQuery() {
  
}

?>

