<?php
var_dump($_POST);
if (isset($_POST['posttest'])) {
  echo 'post is activated';
} else if (isset($_GET['gettest'])) {
  echo 'get is activated';
} else {
  echo 'nothing';
}
?>