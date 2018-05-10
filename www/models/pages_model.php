<?php
  /**
   * Page data querying and manipulation
   */
  class Pages_Model {

    // Public Variables
    public $page_title = 'The Juice Station';
    public $navigation = [
      ['name' => 'home', 'url' => '/?prod=1', 'id' => PAGE_ID_HOME],
      ['name' => 'about', 'url' => '/about', 'id' => PAGE_ID_ABOUT],
      ['name' => 'menu', 'url' => '/menu', 'id' => PAGE_ID_MENU],
      ['name' => 'cleanses', 'url' => '/cleanses', 'id' => PAGE_ID_CLEANSES],
      ['name' => 'delivery&nbsp;service', 'url' => '/deliveries', 'id' => PAGE_ID_DELIVERY_SERVICE],
      ['name' => 'location', 'url' => '#location', 'id' => PAGE_ID_LOCATION]
    ];
    public $css_files = [];
    public $js_files = [];
    public $page_id;
    public $delivery_request;
    public $email_signup_message;
    public $instagram_images;

    function __construct() {
      // Instagram API
      // Request access
      // https://api.instagram.com/oauth/authorize/?client_id=405d81f3f04f4088b7d6d2559409bdc2&redirect_uri=http://thejuicestation.net/instagram&response_type=code&scope=public_content
      // $apiData = array(
      //   'client_id'       => '405d81f3f04f4088b7d6d2559409bdc2',
      //   'client_secret'   => '1c584c4f80a8487c9a1dc497dc1eda11',
      //   'grant_type'      => 'authorization_code',
      //   'redirect_uri'    => 'http://thejuicestation.net/instagram',
      //   'code'            => 'b17b1343e91642cea8b088e5eebbb144'
      // );

      // // Get access token
      // $apiHost = 'https://api.instagram.com/oauth/access_token';

      // $ch = curl_init();
      // curl_setopt($ch, CURLOPT_URL, $apiHost);
      // curl_setopt($ch, CURLOPT_POST, count($apiData));
      // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($apiData));
      // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
      // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      // $jsonData = curl_exec($ch);
      // curl_close($ch);
      // ini_set('display_errors', 1);
      // var_dump($jsonData);
      // $user = json_decode($jsonData); 

      // var_dump($user->access_token);

      if (isset($_COOKIE['js_insta'])) {
        $instagram_latest_image = $_COOKIE['js_insta'];
      } else {
        $instagram_access_token = '6684809353.405d81f.67420e2d9e6f4857bed428d2cc586e13';
        // Get instagram url 
        $instagram_data = json_decode(file_get_contents('https://api.instagram.com/v1/users/self/media/recent/?access_token=' . $instagram_access_token));
        $instagram_latest_image = $instagram_data->data[0]->images->standard_resolution->url;
        // Set instagram cookie
        setcookie('js_insta', $instagram_latest_image, time() + 86400, '/');
      }
      if ($instagram_latest_image) {
        $this->instagram_image = $instagram_latest_image;
      }
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

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <thejuicestation@thejuicestation.net>';
        $email_message = '
          Contact Information from Website Form: <br/>
          Name: ' . $name . '<br/> Address: ' . $address . '<br/> Town: ' . $town . '<br/> Zip: ' . $zip . '<br/> Email: ' . $email . '<br/> Phone: ' . $phone . '<br/> Request: ' . $request . '<br/> Frequency: ' . $frequency;
        mail('stwhitejr@gmail.com', 'Juice Station Delivery Service Request', $email_message, $headers);
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