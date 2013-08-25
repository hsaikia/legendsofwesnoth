<?php 

//global functions

function getColorRange($rating){
	global $colorscheme;
	foreach($colorscheme as $key => $value){
		if($rating > $key) return $value;
	}
}

function getColoredHandle($handle, $rating){
	return "<a class=\"handle\" href=\"". site_url('user_session/view_profile/'. $handle) . "\" style=\"color:" . getColorRange($rating) . "\">". $handle . "</a>";
}

?>
