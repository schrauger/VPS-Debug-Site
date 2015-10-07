<?php require_once('config.php'); ?>
<br />
<a href="index.html">Check nginx</a><br />
<a href="index.php">Check PHP</a><br />
<a href="phpfpm.php">Check php5-fpm</a><br />
<a href="hhvm.php">Check hhvm</a><br />
<a href="db.php">Check mysql</a><br />
<br />
<?php
foreach ($servers as $server) {
  echo "<a href='" . $server['url'] . "'>Switch to " . $server['name'] . "</a><br />";
}
?>
