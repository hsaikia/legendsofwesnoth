<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_Game extends CI_Controller {
	
	public function request(){
		if($this->ion_auth->logged_in()){
			$this->load->view('forms/report');
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
	
	// Trueskill rating change calculator code ends
	
	
	public function add_game(){
		//fix ratings of two players
		$this->load->model('profile');
		$Winner = reset($this->profile->get_profile($_POST['winner_handle']));
		$Loser = reset($this->profile->get_profile($_POST['loser_handle']));
		
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
}

?>
