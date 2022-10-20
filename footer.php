
<nav>
	<?php
	foreach ($servers as $server) {
		echo "<section><a href='" . $server['url'] . "'>Switch to " . $server['name'] . "</a></section>";
	}
	?>
</nav>

<?php echo "Your IP detected: " . $_SERVER['REMOTE_ADDR']; ?>

<footer>
	<a href="#top"><i class="material-icons">publish</i>Return to Top</a>
	A wonderful creation brought to life by Stephen Schruager and made colorful by Matthew Vaccaro &copy; <?php echo date('Y'); ?>
</footer>

</body>
</html>
