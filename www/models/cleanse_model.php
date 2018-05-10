<?php
  /**
   * Page data querying and manipulation
   */
  class Cleanse_Model extends Pages_Model {

    // Public Variables
    public $cleanse_items;

    function __construct() {
      parent::__construct();
    }

    function get_cleanse_items() {
      $db = Db::getInstance();
      $errorCode = '';
      // Get Cleanse Items
      try {
        $query_cleanse_items = $db->query('
          SELECT * FROM tblCleanseItems as ci
          INNER JOIN tblCleanseIngredients as cing on ci.CleID = cing.CleIngredCleID
          INNER JOIN tblMenuItems as mi on cing.CleIngredMiID = mi.MiID
          ');
      } catch(Exception $e) {
        error_log($e);
        return;
      }
      $results_cleanse_items = $query_cleanse_items->fetchAll();

      $cleanses = [];
      $cleanse_data = [];
      foreach ($results_cleanse_items as $result => $row) {
        if (!in_array($row['CleID'], $cleanses)) {
          $cleanses[] = $row['CleID'];
        }
      }
      foreach ($cleanses as $cleanse) {
        $cleanse_items = [];
        $cleanse_name;
        $cleanse_price;
        foreach ($results_cleanse_items as $result => $row) {
          if ($row['CleID'] === $cleanse) {
            $cleanse_name = $row['CleName'];
            $cleanse_price = $row['ClePrice'];
            switch ($row['MiCatID']) {
              case 1:
                $menu_item_name = '2oz ' . $row['MiName'];
                break;
              case 2:
                $menu_item_name = '16oz ' . $row['MiName'];
                break;
              default:
                $menu_item_name = $row['MiName'];
                break;
            }
            $cleanse_items[] = ['name' => $menu_item_name, 'CatID' => $row['MiCatID'], 'ingredients' => $row['MiIngred']];
          }
        }
        $cleanse_data[] = ['name' => $cleanse_name, 'price' => $cleanse_price, 'items' => $cleanse_items];
      }
      return $this->cleanse_items = $cleanse_data;
    }

  }
?>