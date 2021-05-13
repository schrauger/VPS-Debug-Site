<?php require_once('config.php'); ?>

<!-- <span class="output running"><i class="material-icons">done</i>nginx is running.</span> -->

<!-- Uncomment this and/or use style class for errors! -->
<!-- <span class="output broken"><i class="material-icons">warning</i>nginx warning!</span> -->

<section>

	<section><a href="index.html"><i class="material-icons">dns</i>Check nginx</a></section>
	<section><a href="index.php"><i class="material-icons">dns</i>Check PHP</a></section>
	<section><a href="disk.php"><i class="material-icons">dns</i>Check Disk Space</a></section>
	<!--<section><a href="phpfpm.php"><i class="material-icons">dns</i>Check php7.4-fpm</a></section>-->
	<!--<section><a href="hhvm.php"><i class="material-icons">dns</i>Check hhvm</a></section>-->
	<section><a href="db.php"><i class="material-icons">dns</i>Check mysql</a></section>

</section>

<?php
/*
foreach ($servers as $server) {
  echo "<a href='" . $server['url'] . "'>Switch to " . $server['name'] . "</a><br />";
}
*/?>
