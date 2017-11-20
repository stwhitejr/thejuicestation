<?php
  // require_once('connection.php');
  require_once('helpers.php');

  if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action     = $_GET['action'];
  } else {
    $controller = 'pages';
    $action     = 'index';
  }

  function call($controller, $action) {
    // require the file that matches the controller name
    require_once('./controllers/' . $controller . '_controller.php');

    // // create a new instance of the needed controller
    switch($controller) {
      case 'pages':
        $controller = new Pages_Controller();
      break;
    }

    // call the action
    $controller->{ $action }();
  }

  // list of allowed controllers
  $controllers = array('pages' => ['index', 'about', 'error']);

  // check that the requested controller and action are both allowed
  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      call('pages', 'error');
    }
  } else {
    call('pages', 'error');
  }
?>