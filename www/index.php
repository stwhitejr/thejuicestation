<?php
  // Constants
  const CONTROLLER_ID_PAGES = 01;
  // Check if localhost
  if ($_SERVER['REMOTE_ADDR'] === '127.0.0.1') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $is_dev = true;
    // Compile sass
    shell_exec('cd ../ && npm run sass');
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
  $controllers = array('pages' => ['home', 'about', 'cleanses', 'menu', 'deliveries', 'error']);

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
  if (!$view->is_ajax) {
    //@TODO Remove this
    if (!$is_dev && $action === 'home') {
      require_once('coming_soon.php');
    } else {
?>
    <!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=max-device-width, initial-scale=1.0">
        <title>
          <?=$view->page_title()?>
        </title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Pacifico" rel="stylesheet">
        <?php foreach ($view->css_files() as $css_file) {?>
          <link href="includes/css/<?=$css_file?>.css" type="text/css" rel="stylesheet" />
        <?php } ?>
      </head>
      <body>
        <div class="Wrap">
          <header class="Header" id="js-header">
            <div class="Logo">
              <a href="/?prod=1"><img src="includes/images/logo.svg" alt="The Juice Station" class="Logo-img" /></a>
            </div>
            <nav class="Nav" id="js-nav">
              <?=$view->navigation()?>
            </nav>
            <img src="includes/images/home/mobilenav.svg" class="Header-mobileNav" id="js-mobile-nav" />
          </header>
          <div class="Content">
            <?=$view->content() ?>
            <section class="LocationHero" id="location">
              <h1 class="LocationHero-header">
                our location
              </h1>
              <div class="LocationHero-contentBox">
                <div class="LocationHero-innerBox">
                  <h4 class="LocationHero-innerHeader">
                    address:
                  </h4>
                  <p>
                    808 Washington St<br/>
                    Pembroke, MA 02359
                  </p>
                </div>
                <div class="LocationHero-innerBox">
                  <h4 class="LocationHero-innerHeader">
                    email:
                  </h4>
                  <p>
                    myjuicestation@gmail.com
                  </p>
                </div>
                <div class="LocationHero-innerBox">
                  <h4 class="LocationHero-innerHeader">
                    phone:
                  </h4>
                  <p>
                    1-474-866-2363
                  </p>
                </div>
              </div>
            </section>
          </div>
          <footer class="Footer">
            <div class="u-FlexBox u-NoMobileFlex">
              <section class="u-Col u-InnerPadding">
                <h2 class="Footer-header">
                  sign up for our newsletter
                </h2>
                <p class="Footer-copy" id="js-email-signup-text">
                  Get updates on events, coupons, and more!
                </p>
                <form class="u-FlexBox" id="js-email-signup-form">
                  <input type="email" name="email_signup" placeholder="Enter your email address" class="Footer-emailSignup u-Col--large" id="js-email-signup-field" />
                  <button type="submit" class="Footer-emailSubmit u-Col" id="js-email-signup">sign up</button>
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
                    <a href="http://www.facebook.com/thejuicestationma" target="_blank"><img src="includes/images/facebook.svg" class="Footer-socialIcon" /></a>
                    <a href="https://www.instagram.com/thejuicestationma/" target="_blank"><img src="includes/images/instagram.svg" class="Footer-socialIcon" /></a>
                  </div>
                  <div class="u-Col--medium u-ColMargin">
                    <a href="https://www.instagram.com/thejuicestationma/" target="_blank"><img src="<?=$view->get_instagram_image_url()?>" class="Footer-instagramThumb" /></a>
                  </div>
                </div>
              </section>
            </div>
            <section class="Footer-nav">
              <?=$view->navigation()?>
            </section>
            <section class="Footer-close u-InnerPaddings">
              Copyright 2018 The Juice Station
            </section>
          </footer>
        </div>
        <script type="text/javascript" src="includes/js/global.js"></script>
        <?php foreach ($view->js_files() as $js_file) {?>
          <script type="text/javascript" src="includes/js/<?=$js_file?>.js"></script>
        <?php } ?>
      </body>
    </html>
<?php
    }
  } else {
    // Ajax
    echo $view->content();
  }
?>