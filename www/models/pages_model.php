<?php
  class Pages_Model {
    public $page_data = [];

    function __construct($page) {
      // query database with $page
      // for each result map results to our variables
      $this->page_data['title'] = 'about title';
      $this->page_data['description'] = 'about desc';
      $this->page_data['image'] = 'about image';
      return $this->page_data;
    }
  }
?>