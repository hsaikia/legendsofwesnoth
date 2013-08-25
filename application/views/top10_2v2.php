<div>
<center><b>The Top 10 (2 v 2)</b>
<hr>
<?php
include_once "globals.php";
echo "<table>";
foreach($top10_profiles_2v2 as $pro){
	echo "<tr><td>". getColoredHandle($pro->handle, $pro->rating2v2) ."</td><td>". round(100*$pro->rating2v2, 0) . "</td></tr>";
}
echo "</table>";
?>
</center>
</div>
