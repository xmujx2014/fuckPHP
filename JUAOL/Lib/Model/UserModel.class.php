<?php
// header("Content-Type:text/html; charset=UTF-8");
class UserModel extends Model{


	protected $fields = array(
		'username',
		'passwd',
		'power',
		'team',
		'tel',
		'email',
		'eventName',
		'number_of_officials',
		'number_of_competitiors',
		'federation',
		'adress',
		'fax',
		'men_team',
		'women_team',
		'create_date',
		'category_info',
		'_autoinc_'=>true,
		'_pk'=>'id'
		);

	public function loginValidate($username = '', $passwd = ''){
		$user = $this->field(array('id', 'username', 'passwd', 'power'))->where(array('username'=>$username))->find();
		
		if($user !== NULL && $user['passwd'] == md5($passwd)){
			$data['id'] = $user['id'];
			$data['username'] = $user['username'];
			session('user', $data);
			return $user['power'];
		}
		return -1;
	}

	public function getFields(){
		return $this->fields;
	}

	public function updateUser($data){
		$data['id'] = session('user')['id'];
		return $this->save($data);
	}

	public function addUser($data){
		$data['passwd'] = md5($data['passwd']);
		$data['create_date'] = date('Y-m-d H:i:s');

		return $this->add($data);
	}

	public function getCurrentUserInfo(){
		$user = $this->where(array('id'=>session('user')['id']))->find();
		unset($user['passwd']);
		unset($user['power']);

		// $cutCat = strstr($user['category_info'], ';');
		// dump($cutCat);
		for ($i=0; $i < 7; $i++) { 
			$user['cat'][$i + 1]['mcat'] = intval($user['category_info'][$i]);
			$user['cat'][$i + 1]['fcat'] = intval($user['category_info'][$i + 8]);
		}

		// $user['mcat'] = substr(',', $cutCat[0]);
		// $user['fcat'] = substr(',', $cutCat[1]);

		// dump($user);die;


		return $user;
	}

	public function getConfirmUsers($filter = array()){
		$users = $this->where($filter)->field(array('id', 'username', 'federation', 'tel', 'email', 'create_date'))->where(array('power'=>2))->select();
		return $users;
	}
}