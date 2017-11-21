<?php
  function get_view_path($view) {
    return 'views/' . $view . '_view.php';
  }

  // function render_content($path, $data) {
  //   ob_start();
  //   include($path);
  //   $var=ob_get_contents();
  //   ob_end_clean();
  //   return $var;
  // }
?>