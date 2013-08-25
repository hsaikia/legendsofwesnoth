<div>
<center><b>The Top 10 (1 v 1)</b>
<hr>
<?php
include_once "globals.php";
echo "<table>";
foreach($top10_profiles as $pro){
	echo "<tr><td>". getColoredHandle($pro->handle, $pro->rating) ."</td><td>". round(100*$pro->rating, 0) . "</td></tr>";
}
echo "</table>";
?>
</center>
</div>
