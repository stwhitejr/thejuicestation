<?php
  /**
   */
  require_once('page_view.php');
  class Menu_View extends Page_View {

    private $template_name = 'menu';

    /**
     * Returns menu items
     *
     * @return array
     */
    public function menu() {
      return $this->model->menu;
    }

    /**
     * Content
     *
     * @return string
     */
    public function content() {
      return $this->render_mustache($this->template_name, $this);
    }
  }
?>