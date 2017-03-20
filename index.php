<!DOCTYPE HTML>
<html>
  <head>
    <title>CNOTES</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
      <!-- Template stylesheet-->
    <link rel="stylesheet" href="assets/css/main.css" />
    <!-- Custom stylesheet-->
      <link rel="stylesheet" href="assets/css/style.css">
  </head>

  <body class="loading">
    <div id="wrapper">
      <div id="bg"></div>
      <div id="overlay"></div>
      <div id="main">

        <!-- Header -->
          <header id="header">
            <h1>CNOTE</h1>
            <div class="flex_text text-slider">
                      <ul class="slides">
                          <li>Cloud Note</li>
                          <li>Cloud Your Note</li>
                          <li>Make it simple</li>
                      </ul>
                    </div>
                    <div class="btn-container">
                <a href="masuk.php" class="btn btn-default featured">MASUK</a>
                <a href="daftar.php" class="btn btn-default">DAFTAR</a>
              </div>
          </header>
        <!-- ./Header -->

        <!-- Footer -->
          <footer id="footer">
            <span class="copyright">Made with <img src="assets/css/images/love.png"/> by <a href="http://github.com/rkndika">M Reki Andika </a>.</span>
          </footer>
        <!-- ./Footer -->

      </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/jquery.flexslider-min.js"></script>
      <script src="assets/js/script.js"></script>
    <script>
      window.onload = function() { document.body.className = ''; }
      window.ontouchmove = function() { return false; }
      window.onorientationchange = function() { document.body.scrollTop = 0; }
    </script>
  </body>
</html>
