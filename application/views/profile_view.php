<?php $this->load->view('title.php'); ?> 
<?php include_once "globals.php"; ?>
<script>
$(function () {
        $('#graph').highcharts({
            title: {
                text: 'Rating graph',
                x: -20 //center
            },
            subtitle: {
                text: 'Trueskill standard parameters used',
                x: -20
            },
            xAxis: {
				
                title:{
					text: 'Timeline'
				}
            },
            yAxis: {
                title: {
                    text: 'Rating'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: ' points'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: '<?php echo $profile->handle;?>',
                data: [
                <?php
                $i = 0;
                $rgames = array_reverse($games);
                foreach($rgames as $game){
					if($i != 0)
						echo ",";
					if($profile->handle == $game->handle_p1)
						echo "[" . round(100*$game->rating_p1, 0) . "]";
					else
						echo "[" . round(100*$game->rating_p2, 0) . "]";
					$i = $i + 1;
				}
                ?>
                ]
            }]
        });
    });
    
</script>
	<?php 
		global $faction;
		foreach($faction as $key => $value){
			$wins[$key] = 0;
			$loss[$key] = 0;
		}
		$overall_wins = 0;
		$overall_losses = 0;
		foreach($games as $game){
			if($game->winner == "P1"){
				if($game->handle_p1 == $profile->handle){
					++$wins[$game->faction_p1];		
					++$overall_wins;
				} else {
					++$loss[$game->faction_p2];		
					++$overall_losses;
				}
			} else {
				if($game->handle_p2 == $profile->handle){
					++$wins[$game->faction_p2];		
					++$overall_wins;
				} else {
					++$loss[$game->faction_p1];		
					++$overall_losses;
				}
			}
		}
	?>
<body>
	<center>
<div id="main">
<div id="header">
<?php include "logo.php"; ?> 
<?php include "main_menu.php"; ?>
</div>
<div id="cont" class="content">
<div id="pro_top">
<table>
<tr>
<td class="pro_head" style="text-align:left;"><?php echo getColoredHandle($profile->handle, $profile->rating); ?>(<img src="<?php echo base_url() . $profile->country;?>" width="48"/>)</td>
<td><a class="menulink" href="<?php echo site_url('user_session/view_profile_2v2/'. $profile->handle); ?>">2 v 2</a></td>
<td class="pro_head" style="text-align:right;">Rating <?php echo round(100*$profile->rating, 0); ?></td>
</tr>
</table>
<hr>
<table>
<tr>
<td class="pro_head" style="text-align:left;"><img class="avatar" src="<?php echo base_url() . $profile->avatar;?>"/></td>
<?php if($profile->quote != "") echo "<td class=\"pro_quote\">\"" . $profile->quote . "\"</td>"; ?>
<td class="pro_head" style="text-align:right;font-size:210px;"><?php echo $rank ?></td>
</tr>
</table>
<hr>
<div id="graph"></div>
<hr>
<div id="faction_stats">
<table>
<tr><td width="60%">

<table height="340">
<?php 
	global $faction;
	$i = 0;
	foreach($faction as $key => $value){
		if($i == 0)
			echo "<tr>";
		if($i == 3)
			echo "</tr><tr>";
		echo "<td><div><center><canvas id=". $key ." width=\"130\" height=\"130\"></canvas><br><br>". $value . " " . $wins[$key]. " Win(s) and " . $loss[$key] ." Loss(es). </center></div></td>";
		++$i;
	}
	echo "</tr>";
?>	
</table>

</td><td width="40%">
<div><center><canvas id="overall" width="280" height="280"></canvas><br><br>Overall <?php echo $overall_wins?> Wins and <?php echo $overall_losses?> Losses. </center></div>
</td></tr>
</table>
</div>
<hr>
<div>
	<h3>Recent Games</h3>
<table style="width:800px;">
<?php include "game_list.php"; ?>
</table>
</div>
<hr>
</div>	
	<table>
<tr><td class="label" >Member since</td><td class="field"><?php echo $profile->join_date; ?></td></tr>
</table>
</div>
</div>
	</center>
</body>
<?php $this->load->view('footer.php'); ?> 
<script>

<?php 
	global $faction;
	foreach($faction as $key => $value){
		echo "var data = [{value : ". $wins[$key] . ", color:\"#008500\"}, {value: " . $loss[$key] . " , color:\"#a60400\"},];";
		echo "var myPie = new Chart(document.getElementById(\"". $key . "\").getContext(\"2d\")).Pie(data);";
	}
?>

var pieData = [
{
	value: <?php echo $overall_wins;?>,
	color:"#008500"
},
{
	value : <?php echo $overall_losses;?>,
	color : "#a60400"
},

];

var myPie = new Chart(document.getElementById("overall").getContext("2d")).Pie(pieData);


</script>
