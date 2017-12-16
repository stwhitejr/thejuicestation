<?php
  /**
   * Page data querying and manipulation
   */
  class Pages_Model {

    // Public Variables
    public $page_title = 'The Juice Station';
    public $navigation = [
      ['name' => 'home', 'url' => '/', 'id' => PAGE_ID_HOME],
      ['name' => 'about', 'url' => '/about', 'id' => PAGE_ID_ABOUT],
      ['name' => 'menu', 'url' => '/healthy-menu', 'id' => PAGE_ID_MENU],
      ['name' => 'cleanses', 'url' => '/juice-cleanse', 'id' => PAGE_ID_CLEANSES],
      ['name' => 'delivery&nbsp;service', 'url' => '/juice-deliveries', 'id' => PAGE_ID_DELIVERY_SERVICE],
      ['name' => 'location', 'url' => '#location', 'id' => PAGE_ID_LOCATION]
    ];
    public $css_files;
    public $page_id;

    function __construct($page_id = null) {
      $this->page_id = $page_id;
    }

    function email_signup($email) {
      $message = '';
      $ref = $_SERVER['HTTP_REFERER'];
      $ipAddress = $_SERVER['REMOTE_ADDR'];
      $userAgent = $_SERVER['HTTP_USER_AGENT'];

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
      return $message;
    }
  }
?>