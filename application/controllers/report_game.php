<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_Game extends CI_Controller {
	
	public function request(){
		if($this->ion_auth->logged_in()){
			$this->load->view('forms/report');
		}else
			$this->load->view('guest');
	}
	
	public function request2v2(){
		if($this->ion_auth->logged_in()){
			$this->load->view('forms/report2v2');
		}else
			$this->load->view('guest');
	}
	
		// Trueskill rating change calculator
	
	private function ts_v_func($x){
        // this is given by exp(x)/phi(x)
        $x2 = $x * $x;
        $a = $x * $x2 / 3;
        $b = $a * $x2 / 5;
        $c = $b * $x2 / 7;
        $d = $c * $x2 / 9;
        return 1.0/(sqrt(1.570796)*exp($x2/2.0) + $x + $a + $b + $c + $d);
	}
	
	private function ts_w_func($x){
        return $this->ts_v_func($x)*($this->ts_v_func($x) + $x);
	}
	
	private function CalcTrueskillChanges($wmean, $wsigma, $lmean, $lsigma){
		$c2 = 2 * TS_DEF_BETA * TS_DEF_BETA + $wsigma * $wsigma + $lsigma * $lsigma;
        $c = sqrt($c2);

        $vv = $this->ts_v_func(($wmean - $lmean)/$c);
		
		//start - dynamic factor added
		$wsigma = $wsigma + TS_DEF_TAU * TS_DEF_TAU;
		$lsigma = $lsigma + TS_DEF_TAU * TS_DEF_TAU;
		//end
		
        $res['winnerMean'] = $wmean + $wsigma * $wsigma * $vv / $c;
        $res['loserMean'] = $lmean - $lsigma * $lsigma * $vv / $c;
		
        $ww = $this->ts_w_func(($wmean - $lmean)/$c);
        $res['winnerSigma'] = $wsigma * sqrt(1 - $wsigma * $wsigma * $ww/$c2);
        $res['loserSigma']  = $lsigma * sqrt(1 - $lsigma * $lsigma * $ww/$c2);
		return $res;
	}
	
	private function CalcTrueskillChanges2v2($wmean1, $wsigma1, $wmean2, $wsigma2, $lmean1, $lsigma1, $lmean2, $lsigma2){
		
		$wsigma_S = $wsigma1 + $wsigma2;
		$lsigma_S = $lsigma1 + $lsigma2;
		$c2 = 2 * TS_DEF_BETA * TS_DEF_BETA + $wsigma_S * $wsigma_S + $lsigma_S * $lsigma_S;
        $c = sqrt($c2);

		$wmean_S = $wmean1 + $wmean2;
		$lmean_S = $lmean1 + $lmean2;
        $vv = $this->ts_v_func(($wmean_S - $lmean_S)/$c);
		
		//start - dynamic factor added
		$wsigma1 = $wsigma1 + TS_DEF_TAU * TS_DEF_TAU;
		$lsigma1 = $lsigma1 + TS_DEF_TAU * TS_DEF_TAU;
		$wsigma2 = $wsigma2 + TS_DEF_TAU * TS_DEF_TAU;
		$lsigma2 = $lsigma2 + TS_DEF_TAU * TS_DEF_TAU;
		//end
		
        $res['winnerMean1'] = $wmean1 + $wsigma1 * $wsigma1 * $vv / $c;
        $res['loserMean1'] = $lmean1 - $lsigma1 * $lsigma1 * $vv / $c;
        $res['winnerMean2'] = $wmean2 + $wsigma2 * $wsigma2 * $vv / $c;
        $res['loserMean2'] = $lmean2 - $lsigma2 * $lsigma2 * $vv / $c;
		
        $ww = $this->ts_w_func(($wmean_S - $lmean_S)/$c);
        $res['winnerSigma1'] = $wsigma1 * sqrt(1 - $wsigma1 * $wsigma1 * $ww/$c2);
        $res['loserSigma1']  = $lsigma1 * sqrt(1 - $lsigma1 * $lsigma1 * $ww/$c2);
        $res['winnerSigma2'] = $wsigma2 * sqrt(1 - $wsigma2 * $wsigma2 * $ww/$c2);
        $res['loserSigma2']  = $lsigma2 * sqrt(1 - $lsigma2 * $lsigma2 * $ww/$c2);
		return $res;
	}
	
	// Trueskill rating change calculator code ends
	
	public function is_valid_handle($handle){
		if($handle == $this->ion_auth->user()->row()->username){
			$this->form_validation->set_message('is_valid_handle', 'You cannot report against yourself!');
			return FALSE;
		}
		
		$this->db->where('handle', $handle);
		$this->db->from('profiles');
		$count = $this->db->count_all_results();
		if($count == 0){
			$this->form_validation->set_message('is_valid_handle', 'The opponent handle does not exist!');
			return FALSE;
		} 
		return TRUE;
	}
	
	public function add_game(){
		//fix ratings of two players
		$this->load->model('profile');
		$Winner = reset($this->profile->get_profile($_POST['winner_handle']));
		$Loser = reset($this->profile->get_profile($_POST['loser_handle']));
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error"><b>', '</b></div>');
		$this->form_validation->set_rules('loser_handle', 'Opponent', 'trim|required|callback_is_valid_handle');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('forms/report');
			return;
		}
		
		
		$newRatings = $this->CalcTrueskillChanges($Winner->mean, $Winner->volatility, $Loser->mean, $Loser->volatility);
		$wdata['mean'] = $newRatings['winnerMean'];
		$wdata['volatility'] = $newRatings['winnerSigma'];
		$wdata['rating'] = $wdata['mean'] - 3*$wdata['volatility'];
		$ldata['mean'] = $newRatings['loserMean'];
		$ldata['volatility'] = $newRatings['loserSigma'];
		$ldata['rating'] = $ldata['mean'] - 3*$ldata['volatility'];
		
		//modify their entries in db_profiles
		$this->profile->modify_profile($Winner->handle, $wdata);
		$this->profile->modify_profile($Loser->handle, $ldata);
		
		//add game to db_games
		$this->load->model('games');
		$this->games->add_game($wdata['rating'], $ldata['rating']);
		$this->load->view('reporting_success');
	}
	
	public function are_all_unique($a, $b, $c, $d){
		if($a == $b || $a == $c || $a == $d || $b == $c || $b == $d || $c == $d)
			return false;
		return true;
	}
	
	public function add_game_2v2(){
		$this->load->model('profile');
		$w1 = reset($this->profile->get_profile($_POST['winner_handle1']));
		$w2 = reset($this->profile->get_profile($_POST['winner_handle2']));
		$l1 = reset($this->profile->get_profile($_POST['loser_handle1']));
		$l2 = reset($this->profile->get_profile($_POST['loser_handle2']));
		
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error"><b>', '</b></div>');
		$this->form_validation->set_rules('winner_handle2', 'Partner', 'trim|required|callback_is_valid_handle');
		$this->form_validation->set_rules('loser_handle1', 'Opponent1', 'trim|required|callback_is_valid_handle');
		$this->form_validation->set_rules('loser_handle2', 'Opponent2', 'trim|required|callback_is_valid_handle');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('forms/report2v2');
			return;
		}
		if($this->are_all_unique($w1, $w2, $l1, $l2) == FALSE) {
			//TODO : have to display an error message somehow
			//$this->form_validation->set_message('is_valid_handle', 'You entered one player more than once!');
			$this->load->view('forms/report2v2');
			return;
		}
		$newRatings = $this->CalcTrueskillChanges2v2($w1->mean2v2, $w1->volatility2v2, $w2->mean2v2, $w2->volatility2v2, $l1->mean2v2, $l1->volatility2v2, $l2->mean2v2, $l2->volatility2v2);
		$wdata1['mean2v2'] = $newRatings['winnerMean1'];
		$wdata1['volatility2v2'] = $newRatings['winnerSigma1'];
		$wdata1['rating2v2'] = $wdata1['mean2v2'] - 3*$wdata1['volatility2v2'];
		$wdata2['mean2v2'] = $newRatings['winnerMean2'];
		$wdata2['volatility2v2'] = $newRatings['winnerSigma2'];
		$wdata2['rating2v2'] = $wdata2['mean2v2'] - 3*$wdata2['volatility2v2'];
		$ldata1['mean2v2'] = $newRatings['loserMean1'];
		$ldata1['volatility2v2'] = $newRatings['loserSigma1'];
		$ldata1['rating2v2'] = $ldata1['mean2v2'] - 3*$ldata1['volatility2v2'];
		$ldata2['mean2v2'] = $newRatings['loserMean2'];
		$ldata2['volatility2v2'] = $newRatings['loserSigma2'];
		$ldata2['rating2v2'] = $ldata2['mean2v2'] - 3*$ldata2['volatility2v2'];
		
		//modify their entries in db_profiles
		$this->profile->modify_profile($w1->handle, $wdata1);
		$this->profile->modify_profile($l1->handle, $ldata1);
		$this->profile->modify_profile($w2->handle, $wdata2);
		$this->profile->modify_profile($l2->handle, $ldata2);
		
		//add game to db_games
		$this->load->model('games2v2');
		$this->games2v2->add_game($wdata1['rating2v2'], $wdata2['rating2v2'], $ldata1['rating2v2'], $ldata2['rating2v2']);
		$this->load->view('reporting_success');
		
		
	}
	
}

?>
