<?php
  set_include_path('/public_html/dev');
  require_once('connection.php');
  require_once('helpers.php');

  if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action     = $_GET['action'];
  } else {
    $controller = 'pages';
    $action     = 'home';
  }

  // list of allowed controllers
  $controllers = array('pages' => ['home', 'email_signup', 'error']);

  // change the action to the error page if we're requesting something not allowed
  if (!array_key_exists($controller, $controllers) || !in_array($action, $controllers[$controller])) {
    $controller = 'pages';
    $action = 'error';
  }

  // require the file that matches the controller name
  require_once('controllers/' . $controller . '_controller.php');

  // create a new instance of the needed controller
  switch($controller) {
    case 'pages':
      $controller = new Pages_Controller();
    break;
  }

  // call the action
  $controller->{ $action }();

  // get the output of the view
  $view = $controller->view;

  // Only return the base HTML if this isn't an ajax request
  if (!$controller->ajax_content) {
?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $view->page_title() ?></title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet" />
    <link href="includes/css/coming_soon.css" type="text/css" rel="stylesheet" />
  </head>
  <body>
    <div class="Wrap">
      <section>
        <img src="includes/images/logo.svg" alt="The Juice Station" class="Logo" />
        <h1>Website and New Pembroke Location Coming Soon!</h1>
        <p class="Intro">
          We're happy to announce The Juice Station will be opening it's first location at
          <emphasis>801&nbsp;Washington&nbsp;St, Pembroke,&nbsp;MA</emphasis> in January 2018!
        </p>
        <p class="Intro">
          We're hard at work getting the website and new location up and running but here's a sneak peak at just some of the services we'll have to offer. Also, don't forgot to sign up below for updates on our opening date!
        </p>
      </section>
      <section>
        <div class="flex">
          <div class="flex_col">
            <ul>
              <li>Fresh Juices</li>
              <li>Fresh Juices</li>
              <li>Fresh Juices</li>
              <li>Fresh Juices</li>
              <li>Fresh Juices</li>
            </ul>
          </div>
          <div class="flex_col">
            <ul>
              <li>Fresh Juices</li>
              <li>Fresh Juices</li>
              <li>Fresh Juices</li>
              <li>Fresh Juices</li>
              <li>Fresh Juices</li>
            </ul>
          </div>
        </div>
      </section>
      <section>
        <p id="js-signup-text">
          Sign up to recieve updates on the opening of The Juice Station!
        </p>
        <form>
          <input type="text" name="email" id="js-signup-email" placeholder="Enter email address" />
          <button type="submit" id="js-signup-submit">Submit</button>
        </form>
      </section>
    </div>
    <script type="text/javascript" src="includes/js/coming_soon.js"></script>
  </body>
  </html>
<?php
  } else {
    echo $controller->ajax_content;
  }
?>