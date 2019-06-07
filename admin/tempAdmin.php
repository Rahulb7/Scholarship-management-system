
<?php
/*Start a session*/
  session_start();
?>
<!DOCTYPE html>

<html lang="en">

  <head>
      <title>Home</title>

      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="description" content="">
      <meta name="author" content="">


      <!-- Bootstrap Core CSS -->
      <link href="../css/bootstrap.min.css" rel="stylesheet">

      <!-- Custom CSS -->
      <link href="../css/main.css" rel="stylesheet">

  </head>

  <body class = "index">
    <div id = "page-wrapper">

      <!-- Header -->
        <header id = "header" class = "alt">
          <h1 id = "logo"><a href = "javascript:history.back()" class="button special">Back</a></h1>
          <nav id = "nav">
            <ul>
              <li class = "current"><a href = "#">Home</a></li>
              <li class = "submenu">
                <a href = "#">Applications</a>
                <ul>
                  <li><a href = "tempPendingApp.php">Pending Students</a></li>
                  <li><a href = "tempAcceptedApp.php">Accepted Students</a></li>
                  <li><a href = "tempRejectedApp.php">Rejected Students</a></li>
                </ul>
              </li>
              <li class = "submenu">
                <a href = "tempScholarship.php">Scholarships</a>
                <ul>
                  <li><a href = "tempScholarship.php?scholarship=Pending">Pending Scholarships</a></li>
                  <li><a href = "tempScholarship.php?scholarship=Approved">Accepted Scholarships</a></li>
                  <li><a href = "tempScholarship.php?scholarship=Rejected">Rejected Scholarships</a></li>
                </ul>
              </li>
              <li class = "submenu">
                <a href = "">Users</a>
                <ul>
                  <li><a href = "tempAdminShow.php">Admin</a></li>
                  <li><a href = "tempSignatoryShow.php">Signatory</a></li>
                  <li><a href = "tempStudentShow.php">Students</a></li>
                </ul>
              </li>
              <li><a href = "../backend/logout.php" class = "button special">Logout</a></li>
            </ul>
          </nav>
        </header>

      <!-- Banner -->
        <section id = "banner">
          <div class = "inner">
            <header>
              <h2>SMS</h2>
            </header>
            <p>Scholarship Management System<p>
            <footer>
              <ul class = "buttons vertical">
                <li><a href = "#main" class = "button fit scrolly">About</a></li>
              </ul>
            </footer>
          </div>
        </section>

        <article id = "main">
          <header class = "special container">
            <span class = "icon fa-bar-chart-o"></span>
            <h2>Some text here</h2>
            <p>Sed tristique purus vitae volutpat ultrices. Aliquam eu elit eget arcu comteger ut <br>
            fermentum lorem. Lorem ipsum dolor sit amet. Sed tristique purus vitae volutpat ultrices. <br>
            eu elit eget commodo. Sed tristique purus vitae volutpat ultrices. Aliquam eu elit eget <br>
            arcu commodo. </p>

          </header>

          <section class="wrapper style2 container special-alt">
            <div class="row 50%">
              <div class="8u 12u(narrower)">

                <header>
                  <h2>TEXT TEXT TEXT</h2>
                </header>
                <p>Sed tristique purus vitae volutpat ultrices. Aliquam eu elit eget arcu comteger ut fermentum lorem. Lorem ipsum dolor sit amet. Sed tristique purus vitae volutpat ultrices. eu elit eget commodo. Sed tristique purus vitae volutpat ultrices. Aliquam eu elit eget arcu commodo.</p>
                <footer>
                  <ul class="buttons">
                    <li><a href="#" class="button">Find Out More</a></li>
                  </ul>
                </footer>

              </div>
            </div>
          </section>

          <section class="wrapper style3 container special">

            <header class="major">
              <h2>Next look at this <strong>cool stuff</strong></h2>
            </header>

            <div class="row">
              <div class="6u 12u(narrower)">

                <section>
                  <a href="#" class="image featured"><img src="images/pic01.jpg" alt="" /></a>
                  <header>
                    <h3>A Really Fast Train</h3>
                  </header>
                  <p>Sed tristique purus vitae volutpat commodo suscipit amet sed nibh. Proin a ullamcorper sed blandit. Sed tristique purus vitae volutpat commodo suscipit ullamcorper sed blandit lorem ipsum dolore.</p>
                </section>

              </div>

              <div class="6u 12u(narrower)">

                <section>
                  <a href="#" class="image featured"><img src="images/pic02.jpg" alt="" /></a>
                  <header>
                    <h3>An Airport Terminal</h3>
                  </header>
                  <p>Sed tristique purus vitae volutpat commodo suscipit amet sed nibh. Proin a ullamcorper sed blandit. Sed tristique purus vitae volutpat commodo suscipit ullamcorper sed blandit lorem ipsum dolore.</p>
                </section>

              </div>
            </div>

            <div class="row">
              <div class="6u 12u(narrower)">

                <section>
                  <a href="#" class="image featured"><img src="images/pic03.jpg" alt="" /></a>
                  <header>
                    <h3>Hyperspace Travel</h3>
                  </header>
                  <p>Sed tristique purus vitae volutpat commodo suscipit amet sed nibh. Proin a ullamcorper sed blandit. Sed tristique purus vitae volutpat commodo suscipit ullamcorper sed blandit lorem ipsum dolore.</p>
                </section>

              </div>

              <div class="6u 12u(narrower)">

                <section>
                  <a href="#" class="image featured"><img src="images/pic04.jpg" alt="" /></a>
                  <header>
                    <h3>And Another Train</h3>
                  </header>
                  <p>Sed tristique purus vitae volutpat commodo suscipit amet sed nibh. Proin a ullamcorper sed blandit. Sed tristique purus vitae volutpat commodo suscipit ullamcorper sed blandit lorem ipsum dolore.</p>
                </section>

              </div>
            </div>

            <footer class="major">
              <ul class="buttons">
                <li><a href="#" class="button">See More</a></li>
              </ul>
            </footer>

          </section>


        </article>

        <section id="cta">

          <header>
            <h2>Ready to do <strong>something</strong>?</h2>
            <p>Proin a ullamcorper elit, et sagittis turpis integer ut fermentum.</p>
          </header>
          <footer>
            <ul class="buttons">
              <li><a href="#" class="button special">TEXT</a></li>
              <li><a href="#" class="button">TEXT</a></li>
            </ul>
          </footer>

        </section>

      <!-- Footer -->
        <footer id="footer">

          <ul class="icons">
            <li><a href="#" class="icon circle fa-twitter"><span class="label">Twitter</span></a></li>
            <li><a href="#" class="icon circle fa-facebook"><span class="label">Facebook</span></a></li>
            <li><a href="#" class="icon circle fa-google-plus"><span class="label">Google+</span></a></li>
            <li><a href="#" class="icon circle fa-github"><span class="label">Github</span></a></li>
            <li><a href="#" class="icon circle fa-dribbble"><span class="label">Dribbble</span></a></li>
          </ul>

          <ul class="copyright">
            <li>&copy; Untitled</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
          </ul>

        </footer>


    </div>

    <!-- Scripts -->
      <script src="../js/jquery.min.js"></script>
      <script src="../js/jquery.dropotron.min.js"></script>
      <script src="../js/jquery.scrolly.min.js"></script>
      <script src="../js/jquery.scrollgress.min.js"></script>
      <script src="../js/skel.min.js"></script>
      <script src="../js/util.js"></script>
      <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
      <script src="../js/main.js"></script>

  </body>
</html>
