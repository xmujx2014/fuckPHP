<?php

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
		'_autoinc_'=>true,
		'_pk'=>'id'
		);

	public function loginValidate($username = '', $passwd = ''){
		$user = $this->field(array('id', 'username', 'passwd', 'power'))->where(array('username'=>$username))->find();
		
		// dump($passwd);
		// dump(md5($passwd));die;
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

	public function getCurrentUserInfo(){
		$user = $this->where(array('id'=>session('user')['id']))->find();
		unset($user['passwd']);
		unset($user['power']);
		return $user;
	}

	public function getConfirmUsers($filter = array()){
		$users = $this->where($filter)->field(array('id', 'username', 'federation', 'tel', 'email'))->where(array('power'=>2))->select();
		return $users;
	}
}