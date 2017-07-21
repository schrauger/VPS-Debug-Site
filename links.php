<?php require_once('config.php'); ?>
<h1>Is the VPS Broken?</h1>

<span>nginx running</span>

<section>

	<section><a href="index.html">Check nginx</a></section>
	<section><a href="index.php">Check PHP</a></section>
	<section><a href="phpfpm.php">Check php5-fpm</a></section>
	<section><a href="hhvm.php">Check hhvm</a></section>
	<section><a href="db.php">Check mysql</a></section>

</section>

<nav>
	<section><a href="//vps1.address.com">Switch to VPS1</a></section>
	<section><a href="//vps2.address.com">Switch to VPS2</a></section>
</nav>
<?php
foreach ($servers as $server) {
  echo "<a href='" . $server['url'] . "'>Switch to " . $server['name'] . "</a><br />";
}
?>
