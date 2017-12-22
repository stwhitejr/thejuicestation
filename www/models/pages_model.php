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
      ['name' => 'menu', 'url' => '/menu', 'id' => PAGE_ID_MENU],
      ['name' => 'cleanses', 'url' => '/cleanses', 'id' => PAGE_ID_CLEANSES],
      ['name' => 'delivery&nbsp;service', 'url' => '/deliveries', 'id' => PAGE_ID_DELIVERY_SERVICE],
      ['name' => 'location', 'url' => '#location', 'id' => PAGE_ID_LOCATION]
    ];
    public $css_files = [];
    public $js_files = [];
    public $page_id;

    function __construct($page_id = null) {
      $this->page_id = $page_id;
    }

  }
?>