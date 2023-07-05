<?php
  setcookie('cookie', $name, time() - 3600 * 24 * 30, "/");
  echo true;
  unset($_COOKIE['cookie']);
?>
