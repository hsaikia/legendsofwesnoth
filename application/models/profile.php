<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Model {
	var $handle = "";
	var $email = "";
	var $mean = 25;
	var $volatility = 8.333333;
	var $mean2v2 = 25;
	var $volatility2v2 = 8.333333;
	var $join_date = "";
	var $avatar = "";
	var $gender = "";
	var $country = "WO";
	var $quote = "";
	
	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_rank($rating){
		$this->db->where('rating > ', $rating);
		$this->db->from('profiles');
		return $this->db->count_all_results() + 1;
	}
	
	function get_rank_2v2($rating){
		$this->db->where('rating2v2 > ', $rating);
		$this->db->from('profiles');
		return $this->db->count_all_results() + 1;
	}
    
    function get_profile($_handle){
		$query = $this->db->get_where('profiles', array('handle' => $_handle));
		return $query->result();
	}
	
	function get_profiles(){
		$this->db->order_by("rating", "desc");
		$query = $this->db->get('profiles');
		return $query->result();
	}
	
	function get_top10(){
		$this->db->limit(10);
		$this->db->order_by("rating", "desc");
		$query = $this->db->get('profiles');
		return $query->result();
	}
	
	function get_top10_2v2(){
		$this->db->limit(10);
		$this->db->order_by("rating2v2", "desc");
		$query = $this->db->get('profiles');
		return $query->result();
	}
	
	function get_handles($partial_handle){
		$this->db->select('handle'); 
        $this->db->from('profiles');
        $this->db->like('handle', $partial_handle);
        $this->db->limit('10');
        $query = $this->db->get();
        return $query->result();
	}
	
	function modify_profile($handle, $data){
		$this->db->update('profiles', $data, array('handle' => $handle));
	}
	function add_profile(){
		$this->handle = $_POST['handle'];
		$this->email = $_POST['email'];
		$this->join_date = date('Y-m-d H:i:s');
		$this->avatar = "/assets/images/avatars/" . $_POST['avatar'] . ".png";
		$this->gender = $_POST['gender'];
		$this->country = "/assets/images/flags/" . $_POST['country'] . ".png";
		$this->quote = $_POST['quote'];
        $this->db->insert('profiles', $this);
	}
}
?>
