<!DOCTYPE html>
<head>
  <meta charset="utf-8">

  <!-- Use the .htaccess and remove these lines to avoid edge case issues.
  More info: h5bp.com/b/378 -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>UP Programming Guild Rankings</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile viewport optimized: j.mp/bplateviewport -->
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <link rel="stylesheet" href="css/bootstrap.css">

  <script type="text/javascript" src="js/libs/jquery-1.7.1.js"></script>
  <script type="text/javascript" src="js/bootstrap-button.js"></script>
  <script type="text/javascript" src="js/libs/es5-shim.js"></script>
  <script type="text/javascript" src="js/libs/underscore.js"></script>
  <script type="text/javascript" src="js/libs/humane.js"></script>
  <script type="text/javascript" src="js/libs/soyutils.js"></script>
  <script type="text/javascript" src="js/site/templates.js"></script>
  <script type="text/javsacript">
    <?php
    require_once 'config.php';
    $dbh = new PDO($db_info, $db_user, $db_password, array(
      PDO::ATTR_PERSISTENT => true
    ));

    $stmt = $dbh->prepare("SELECT name, uva_id, euler_id, euler_solved FROM ranks");
    if ($stmt->execute()) {
      echo 'userJSON = '. json_encode($stmt->fetchAll()) . ';';
    }

    $dbh = null;
    ?>
  </script>
  <script type="text/javascript" src="js/site/main.js"></script>
</head>

<body>
  <!-- Error messages -->
  <div class="errors">
    <div class="alert alert-block alert-error error" id="generic-ajax-error">
      <p>Error encountered while retrieving user statistics.
      Please try again later.</p>
    </div>
  </div>
  <header class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <a class="brand" href="#">UP Programming Guild Rankings</a>
      <div class="pull-right">
          <div class="progress">
            <div class="bar" id="progress-bar"></div>
            <div id="progress-text">0%</div>
          </div>
        <button class="btn" type="button" id="refresh-rankings"
            data-loading-text="Loading rankings...">
          <i class="icon-refresh"></i> Refresh rankings</button>
      </div>
    </div>
  </div>
  </header>
  <div id="main" role="main" class="container">
    <div class="content">
      <div class="row">
        <table class="span12 table table-striped" id="users">
          <thead>
            <tr>
              <th rowspan="2">Name</th>
              <th colspan="8">UVa</th>
              <th colspan="3">Project Euler</th>
            </tr>
            <tr>
              <th>Global Rank</th>
              <th>Local Rank</th>
              <th>ID</th>
              <th>Username</th>
              <th>Solved</th>
              <th>Submissions</th>
              <th>Tried</th>
              <th>Last Submission</th>
              <th>Local Rank</th>
              <th>Username</th>
              <th>Solved</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
    <footer>
    <p>&copy; Copyright 2012 UP Programming Guild</p>
    </footer>
  </div>

  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
  chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7 ]>
  <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
  <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->
</body>
</html>
