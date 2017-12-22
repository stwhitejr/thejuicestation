<?php
  /**
   * This is page specific content.
   * @todo let's make this a mustache template or something
   */
  require_once('page_view.php');
  class About_View extends Page_View {

    /**
     * Content
     *
     * @return string
     */
    public function content() {
      return '
        <section class="Hero">
          <div class="Hero-contentBox">
            <div class="Hero-innerContentBox">
              sub page
            </div>
          </div>
        </section>
      ';
    }
  }
?>