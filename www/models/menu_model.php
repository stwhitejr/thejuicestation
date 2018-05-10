<?php
  /**
   * Page data querying and manipulation
   */
  class Menu_Model extends Pages_Model {

    // Public Variables
    public $menu;

    function __construct() {
      parent::__construct();
    }

    function get_menu_items() {
      $db = Db::getInstance();
      $errorCode = '';
      // Get Menu Items
      try {
        $query_menu_items = $db->query('
          SELECT * FROM tblMenuItems as mi
          INNER JOIN tblMenuCategories as mc on mi.MiCatID = mc.CatID
          ORDER BY mi.MiID ASC
          ');
      } catch(Exception $e) {
        error_log($e);
        return;
      }
      $results_menu_items = $query_menu_items->fetchAll();

      $categories = [];
      $menu_data = [];
      foreach ($results_menu_items as $result => $value) {
        if ($value['CatID'] && !in_array($value['CatID'], $categories)) {
          $categories[] = $value['CatID'];
        }
      }
      foreach ($categories as $category) {
        $menu_items = [];
        $cat_name;
        $price_by_size_cat_id;
        $show_price_by_size = false;
        $price_by_size_array = [];
        foreach ($results_menu_items as $result => $value) {
          if ($value['CatID'] === $category) {
            // Set the category name at the item level so $categories can stay a 1 dimensional array with just IDs
            $cat_name = $value['CatName'];
            // Check if we have any items that are priced by size
            if ($value['MiPriceBySize']) {
              $show_price_by_size = true;
              $price_by_size_cat_id = $value['MiCatID'];
            }
            $menu_items[] = ['name' => $value['MiName'], 'ingredients' => $value['MiIngred'], 'price' => $value['MiPrice']];
          }
        }
        if ($show_price_by_size) {
          // Get Price By Size
          try {
            $query_price_by_size = $db->prepare('
              SELECT PrSzSize, PrSzPrice FROM tblMenuPriceBySize
              WHERE PrSzCatID = :cat_id
              ');
            $query_price_by_size->bindParam(':cat_id', $price_by_size_cat_id, PDO::PARAM_INT);
            $query_price_by_size->execute();
          } catch(Exception $e) {
            error_log($e);
            return;
          }
          $results_price_by_size = $query_price_by_size->fetchAll();
          $i = 1;
          foreach ($results_price_by_size as $key => $row) {
            $is_last = false;
            if (count($results_price_by_size) === ($i)) {
              $is_last = true;
            }
            $price_by_size_array[] = ['size' => $row['PrSzSize'], 'price' => $row['PrSzPrice'], 'is_last' => $is_last];
            $i++;
          }
        }
        $menu_data[] = ['category' => $cat_name, 'items' => $menu_items, 'show_price_by_size' => $show_price_by_size, 'price_by_size_data' => $price_by_size_array];
      }
      return $this->menu = $menu_data;
    }

  }
?>