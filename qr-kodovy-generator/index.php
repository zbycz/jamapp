<style>
body {
font-family:Tahoma;
}
</style>
<?php

foreach(file('qr.txt') as $qr){
	$qr = trim($qr);
	
	$qqq = str_replace('http://', '', $qr);
	
	echo "<div style='float:left;text-align:center;'>";
	echo "<img src=show.php?qr=$qr style='width:5cm;height:5cm;'><br>$qqq";
	echo "</div>";

}
