<?php
  /**
   * Page data querying and manipulation
   */
  class Menu_Model extends Pages_Model {

    // Public Variables
    public $menu;

    function __construct() {
    }

    function get_menu_items() {
      $db = Db::getInstance();
      $errorCode = '';
      try {
        $statement = $db->exec('SELECT * FROM tblMenuItems');
      } catch(Exception $e) {
        error_log($e);
        return;
      }
        error_log($db->fetchAll());
      return $this->menu = $db->fetchAll();
    }

  }
?>