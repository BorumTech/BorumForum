<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Borum Weather</title>
    <link href = "http://www.bforborum.com/images/icon.ico" rel = "shortcut icon" type = "image/x-icon">
    <link rel="stylesheet" type="text/css" href="public/reset.css" />
    <link rel="stylesheet" type="text/css" href="public/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro|Work+Sans" rel="stylesheet">
  </head>
  <body>
    
    <main>
      <header>
        <img class="logo" src="http://www.bforborum.com/images/icon.png" alt="logo" height="100"/>
        <span>orum Weather</span>
      </header>
      <h1>Where do you want to land?</h1>
      <form autocomplete="off">
        <input type="text" id="city">
        <button id="button" type="submit">Submit</button>
      </form>
    </main>
    <div class="container">
    <div id="destination">

    </div>
    <div class="sectiontitle">
      <h2>WEATHER</h2>
    </div>
    <section id="weather">

        <div class="weather" id="weather1">

        </div>
        <div class="weather" id="weather2">

        </div>
        <div class="weather" id="weather3">

        </div>
        <div class="weather" id="weather4">

        </div>
      	<div class="weather" id="weather5">
      	</div>

    </section>
    <div class="sectiontitle">
      <h2>TOP ATTRACTIONS</h2>
    </div>
    <section id="venues">
      <div class="venue" id="venue1">

      </div>
      <div class="venue" id="venue2">

      </div>
      <div class="venue" id="venue3">

      </div>
      <div class="venue" id = "venue4">
        
      </div>
    </section>
    <footer>
    </footer>

  </div>
    <script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
    <script src="public/helpers.js"></script>
    <script src="public/main.js"></script>
  </body>
</html>