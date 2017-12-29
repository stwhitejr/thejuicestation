<?php
  /**
   */
  require_once('page_view.php');
  class About_View extends Page_View {

    private $template_name = 'about';
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