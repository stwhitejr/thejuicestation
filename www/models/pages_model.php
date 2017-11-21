<?php
  class Pages_Model {
    public $page_data = [];

    function __construct() {
    }

    function coming_soon_signup($email) {
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