<?php
  /**
   * Page data querying and manipulation
   */
  class Pages_Model {

    // Public Variables
    public $page_title = 'The Juice Station';
    public $navigation = [
      ['name' => 'home', 'url' => '/?prod=1', 'id' => PAGE_ID_HOME],
      ['name' => 'about', 'url' => '/?controller=pages&action=about', 'id' => PAGE_ID_ABOUT],
      ['name' => 'menu', 'url' => '/?controller=pages&action=menu', 'id' => PAGE_ID_MENU],
      ['name' => 'cleanses', 'url' => '/?controller=pages&action=cleanses', 'id' => PAGE_ID_CLEANSES],
      ['name' => 'delivery&nbsp;service', 'url' => '/?controller=pages&action=deliveries', 'id' => PAGE_ID_DELIVERY_SERVICE],
      ['name' => 'location', 'url' => '#location', 'id' => PAGE_ID_LOCATION]
    ];
    public $css_files = [];
    public $js_files = [];
    public $page_id;
    public $delivery_request;
    public $email_signup_message;

    function __construct($page_id = null) {
      $this->page_id = $page_id;
    }

    function delivery_request(){
      $name = $_POST['name'];
      $address = $_POST['address'];
      $town = $_POST['town'];
      $zip = $_POST['zip'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $request = $_POST['request'];
      $frequency = $_POST['frequency'];

      $error_messages = [];

      if (strlen($name) < 1) {
        $error_messages[] = 'You must enter your name.';
      }
      if (strlen($address) < 1) {
        $error_messages[] = 'You must enter your address.';
      }
      if (strlen($town) < 1) {
        $error_messages[] = 'You must enter your town.';
      }
      if (strlen($zip) < 5) {
        $error_messages[] = 'You must enter a valid zip code.';
      }
      if ($email === '' || !strpos($email, '@') || !strpos($email, '.')) {
        $error_messages[] = 'You must enter a valid email address.';
      }
      if ($error_messages) {
        $error_messages = implode('<br/>', $error_messages);
        $this->delivery_request = ['error_messages' => $error_messages];
      } else {
        $db = Db::getInstance();
        $errorCode = '';
        try {
          $insert = $db->exec('INSERT INTO tblDeliveryRequest VALUES ("' . $name . '", "' . $address . '", "' . $town . '", "' . $zip . '", "' . $email . '", "' . $phone . '", "' . $request . '", "' . $frequency . '")');
        } catch(Exception $e) {
          error_log($e);
          $this->delivery_request = ['error_messages' => 'Sorry we\'re having technical difficulties. Please contact us directly using the phone number or email address below.'];
          return;
        }
        $this->delivery_request = ['success' => 1];
      }
    }

    function email_signup($email) {
      $message = '';
      $ref = $_SERVER['HTTP_REFERER'];
      $ipAddress = $_SERVER['REMOTE_ADDR'];
      $userAgent = $_SERVER['HTTP_USER_AGENT'];

      if ($email === '' || !strpos($email, '@') || !strpos($email, '.')) {
        $message = 'You must enter a valid email address.';
      } else {
        $db = Db::getInstance();
        $errorCode = '';
        try {
          $signUp = $db->exec('INSERT INTO tblComingSoon VALUES ("' . $email . '", "' . $ipAddress . '", "' . $ref . '", "' . $userAgent . '")');
        } catch(Exception $e) {
          error_log($e);
          $errorCode = $db->errorCode();
        }
        switch ($errorCode) {
          case 23000:
            $message = 'We already have this email address. Thanks for signing up!';
            break;
          case '':
            $message = 'You\'ve successfully signed up for updates!';
            break;
          default:
            $message = 'We\'re having some technical difficulties. Please try back another time.';
            break;
        }
      }

      return $this->email_signup_message = $message;
    }

  }
?>