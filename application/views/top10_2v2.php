<div class="top10">
<center>The 2 v 2 Top 10 
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
