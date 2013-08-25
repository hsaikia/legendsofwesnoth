<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Legends of Wesnoth - A Trueskill Ladder</title>
	<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/css/forms.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>
<script src="<?php echo base_url(); ?>assets/js/Chart.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$(function() {
		$( "#opp_handle" ).autocomplete({
			source: function(request, response) {
				$.ajax({ url: "<?php echo site_url('user_session/get_handles'); ?>",
				data: { term: $("#opp_handle").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		minLength: 2
		});
		
		$( "#partner_handle" ).autocomplete({
			source: function(request, response) {
				$.ajax({ url: "<?php echo site_url('user_session/get_handles'); ?>",
				data: { term: $("#partner_handle").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		minLength: 2
		});
		
				$( "#opp_handle1" ).autocomplete({
			source: function(request, response) {
				$.ajax({ url: "<?php echo site_url('user_session/get_handles'); ?>",
				data: { term: $("#opp_handle1").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		minLength: 2
		});
		
				$( "#opp_handle2" ).autocomplete({
			source: function(request, response) {
				$.ajax({ url: "<?php echo site_url('user_session/get_handles'); ?>",
				data: { term: $("#opp_handle2").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		minLength: 2
		});
	});
});
</script>
</head>

