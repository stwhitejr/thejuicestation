<?php
  class Home_View {

    private $model;

    public function __construct($model) {
      $this->model = $model;
    }

    /**
     * Header
     *
     * @return string
     */
    public function header() {
      $navigation = $this->model->navigation;
      $output;
      foreach ($navigation as $nav) {
        $output .= '<a>' . $nav . '</a>';
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
     * @todo I think a base view would come in handy here. It would take care of all
     * the persistent stuff like header, footer, page_title, etc
     * If you needed to tweak anything in the base view you could do so using the construct
     * Or better yet maybe you only need a base page view. We probably don't need anything
     * specific to the page modified here. The model should have all the unique data for
     * the specific page since we'll be pulling from a DB with arguments
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