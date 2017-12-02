<?php
  // Check if localhost
  if ($_SERVER['REMOTE_ADDR'] === '127.0.0.1') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $is_dev = true;
    // if ($_GET['compile_sass'] = true) {
      var_dump(shell_exec('cd ../ && npm run sass 2>&1'));
    // }
  } else {
    set_include_path('/public_html/dev');
    $is_dev = false;
  }
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
    if (!$is_dev) {
      require_once('coming_soon.php');
    } else {
?>
    <!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
          <?=$view->page_title()?>
        </title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet" />
        <link href="includes/css/home.css" type="text/css" rel="stylesheet" />
      </head>
      <body>
        <div class="Wrap">
          <header class="Header">
            <div class="Logo">
              <img src="includes/images/logo.svg" alt="The Juice Station" class="Logo-img" />
            </div>
            <nav class="Nav">
              <?=$view->navigation()?>
            </nav>
          </header>
          <div class="Content">
            <section class="Hero">
              <div class="Hero-contentBox">
                <h1 class="Hero-header">this is my header</h1>
                <p class="Hero-copy u-Row--small">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempor, nunc eu commodo pellentesque, nunc ipsum rutrum massa, ac dictum augue orci et lorem. Donec volutpat, justo non convallis facilisis, velit dolor molestie quam, ut maximus dolor est sed nisl. Curabitur non ornare velit.
                </p>
                <button class="Hero-cta">this is my cta</button>
              </div>
            </section>
            <section class="MenuHero">
              <h1 class="MenuHero-header">
                the simpliest of ingredients
              </h1>
              <div class="MenuHero-contentBox u-FlexBox">
                <div class="u-Col u-InnerPadding">
                  <img src="includes/images/home/spinach_vert.svg" />
                  <p>item</p>
                </div>
                <div class="u-Col u-InnerPadding">
                  <img src="includes/images/home/spinach_vert.svg" />
                  <p>item</p>
                </div>
                <div class="u-Col u-InnerPadding">
                  <img src="includes/images/home/spinach_vert.svg" />
                  <p>item</p>
                </div>
                <div class="u-Col u-InnerPadding">
                  <img src="includes/images/home/spinach_vert.svg" />
                  <p>item</p>
                </div>
              </div>
              <button class="MenuHero-cta">view menu</button>
            </section>
            <section class="CleanseHero">
              <div class="CleanseHero-contentBox">
                <h1 class="CleanseHero-header">
                  cleanses
                </h1>
                <p class="CleanseHero-copy u-Row--medium">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempor, nunc eu commodo pellentesque, nunc ipsum rutrum massa, ac dictum augue orci et lorem. Donec volutpat, justo non convallis facilisis, velit dolor molestie quam, ut maximus dolor est sed nisl. Curabitur non ornare velit.
                </p>
                <button class="CleanseHero-cta">learn more</button>
              </div>
              <div class="CleanseHero-decor">
                <img src="includes/images/home/lemon.svg" />
              </div>
            </section>
            <section class="DeliveryHero">
              <div class="DeliveryHero-decor">
                <img src="includes/images/home/delivery.jpg" />
              </div>
              <div class="DeliveryHero-contentBox">
                <h1 class="DeliveryHero-header">
                  deliveries
                </h1>
                <p class="DeliveryHero-copy u-Row--medium">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempor, nunc eu commodo pellentesque, nunc ipsum rutrum massa, ac dictum augue orci et lorem. Donec volutpat, justo non convallis facilisis, velit dolor molestie quam, ut maximus dolor est sed nisl. Curabitur non ornare velit.
                </p>
                <button class="DeliveryHero-cta">learn more</button>
              </div>
            </section>
          </div>
          <footer class="Footer">
            <div class="u-FlexBox u-NoMobileFlex">
              <section class="u-Col u-InnerPadding">
                <h2 class="Footer-header">
                  sign up for our newsletter
                </h2>
                <p class="Footer-copy">
                  Get updates on events, coupons, and more!
                </p>
                <form class="u-FlexBox">
                  <input type="text" name="email_signup" placeholder="Enter your email address" class="Footer-emailSignup u-Col--large" />
                  <button type="submit" class="Footer-emailSubmit u-Col">sign up</button>
                </form>
              </section>
              <section class="u-Col u-ColMargin u-InnerPadding">
                <div class="u-FlexBox">
                  <div class="u-Col">
                    <h2 class="Footer-header">
                      follow us!
                    </h2>
                    <p class="Footer-copy">
                      @thejuicestationma
                    </p>
                    <a href="facebook url"><img src="images/facebook_logo.png" /></a>
                    <a href="instagram url"><img src="images/instagram_logo.png" /></a>
                  </div>
                  <div class="u-Col u-ColMargin">
                    images
                  </div>
                </div>
              </section>
            </div>
            <section class="Footer-nav">
              <?=$view->navigation()?>
            </section>
            <section class="Footer-close u-InnerPaddings">
              <p class="u-Row--small">
                801 Washington St
              </p>
              <p class="Footer-copyright">
                Copyright
              </p>
            </section>
          </footer>
        </div>
      </body>
    </html>
<?php
    }
  } else {
    echo $controller->ajax_content;
  }
?>