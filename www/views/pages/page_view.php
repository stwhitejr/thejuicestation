<?php
  /**
   * This contains all base level page items. Nothing page specific should be here
   */
  set_include_path('/www');
  require_once('vendor/mustache/src/Mustache/Autoloader.php');
  Mustache_Autoloader::register();

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

    /**
     * JS Files
     *
     * @return array
     */
    public function js_files() {
      return $this->model->js_files;
    }

    /**
     * Render Content
     *
     * @return string
     */
    public function render_mustache($template_name = null, $data = []) {
      $m = new Mustache_Engine(array(
        'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/mustache'),
      ));
      return $m->render($template_name . '_view', $data);
    }
  }
?>