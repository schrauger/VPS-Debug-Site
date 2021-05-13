<?php include('head.php'); ?>

<span class="output running"><i class="material-icons">done</i><?php

echo "disk: ";

$free = disk_free_space('/');
$free_string = round($free/(1024*1024*1024),2) . "GB";
$total = disk_total_space('/');
$total_string = round($total/(1024*1024*1024),2) . "GB";
$used = $total - $free;
$used_string = round($used/(1024*1024*1024),2) . "GB";
$percent = ($used/$total)*100;
$percent_string = round($percent,2) . "%";
//echo "<span class='used'>"round(($used/(1024*1024*1024)),2) . "GB / " . round(($total/(1024*1024*1024)),2) . "GB = " . round($percent,2) . "% used";
echo "
<span class='used'>{$used_string}</span>
<span class='divider'>/</span>
<span class='total'>{$total_string}</span>
<span class='percentage'>{$percentage_string} used</span>
";
?></span>

<?php include('links.php'); ?>

<?php include('footer.php'); ?>
