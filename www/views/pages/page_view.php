<?php
  /**
   * This contains all base level page items. Nothing page specific should be here
   */
  class Page_View {

    private $model;

    public function __construct($model) {
      $this->model = $model;
    }

    /**
     * Navigation
     *
     * @return string
     */
    public function navigation() {
      $navigation = $this->model->navigation;
      $output = '';
      foreach ($navigation as $nav) {
        $output .= '<a href="' . $nav["url"] . '" class="Nav-item ' . ($nav["id"] === $this->model->page_id ? "Nav-item--active " : "") . ($nav["id"] === PAGE_ID_LOCATION ? "js-nav-location" : "") . '">' . $nav["name"] . '</a>';
      }
      return $output;
    }

    /**
     * Page Title
     *
     * @return string
     */
    public function page_title() {
      return $this->model->page_title;
    }

    /**
     * CSS Files
     *
     * @return array
     */
    public function css_files() {
      return $this->model->css_files;
    }
  }
?>