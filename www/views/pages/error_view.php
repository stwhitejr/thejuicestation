<?php
  /**
   * This is page specific content.
   * @todo let's make this a mustache template or something
   */
  require_once('page_view.php');
  class Error_View extends Page_View {

    /**
     * Content
     *
     * @return string
     */
    public function content() {
      return '
        <section class="Error">
          <h1>Sorry this page doesn\'t exist</h1>
          <h3>But here&rsquo;s an avocado!</h3>
          <img src="includes/images/error/avocado.svg" class="Error-img" />
        </section>
      ';
    }
  }
?>