<?php
  /**
   * This is page specific content.
   * @todo let's make this a mustache template or something
   */
  require_once('page_view.php');
  class Home_View extends Page_View {

    private $template_name = 'home';


    /**
     * Email signup sucess/failure message
     *
     * @return boolean
     */
    public function email_signup_message() {
      return $this->model->email_signup_message;
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