<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
	//Codeigniter : Write Less Do More
	$this->load->model('Menuaccess_model', 'access');
  }

  public function check_login(){
    if($this->session->userdata('id_admin') && $this->session->userdata('am_i_login') == 'yes_i_am_admin'){
      return true;
    }else{
      return false;
    }
  }

  public function checkMenu($menuName, $authorityId){
    $result = $this->access->checkAuthority($authorityId,$menuName);
    return $result;
  }
	
  public function check_login_user(){
	if($this->session->userdata('id_user') && $this->session->userdata('am_i_login') == 'yes_i_am_user'){
      return true;
    }else{
      return false;
    }
  }

  function generate_token($name='cococodetoken',$characters=5){
		$token = $this->generateCode($characters);
		$hash = password_hash($token, PASSWORD_DEFAULT);
		$this->session->set_userdata($name,$hash);
		return $hash;
	}
	
	function generateCode($characters) {
		/* list all possible characters, similar looking characters and vowels have been removed */
		$possible = 'abcdeghkmnopqruvwxyz2345689';
		$code = '';
		$i = 0;
		while ($i < $characters) { 
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
		return $code;
	}

	function generateSlug($string,$table,$where){
		$slug = slug($string);
		$this->db->where($where);
		$data = $this->db->get($table);
		$total = $data->num_rows();

		if($total > 0){
			$total += 1;
			$res = "$slug-".$total;
		}else{
			$res = $slug;
		}

		return $res;
	}

	public function explainText($text,$type){
		$this->encryption->initialize(
				array(
						'driver' => 'mcrypt',
						'cipher' => 'aes-128',
						'mode' => 'cbc'
				)
		);

		if($type == 'decrypt'){
				$res = $this->encryption->decrypt($text);
		}else{
				$res = $this->encryption->encrypt($text);
		}

		return $res;
	}
}
