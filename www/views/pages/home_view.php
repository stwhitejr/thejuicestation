<?php
  class Home_View {

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
        $output .= '<a href="' . $nav["url"] . '" class="Nav-item ' . ($nav["id"] === $this->model->page_id ? "Nav-item--active" : "") . '">' . $nav["name"] . '</a>';
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
     * @todo this can probably be converted to a generic page_view
     *
     */

    /**
     * @todo Either return some sort of static content filename that we can simply
     * require on the index page. ex require_once($view->static_content_file());
     * or use mustache templates and render one here. Using the mustache templates
     * will allow us to pass any of this data to the template if we wanted to.
     *
     */
  }
?>