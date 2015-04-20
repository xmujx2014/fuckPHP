<?php

class UserModel extends Model{


	protected $fields = array(
		'username',
		'passwd',
		'power',
		'team_name',
		'tel',
		'email',
		'_autoinc_'=>true,
		'_pk'=>'id'
		);

	public function loginValidate($username = '', $passwd = ''){
		$user = $this->where(array('username'=>$username))->find();
		session('user', $user);
		// dump($passwd);
		// dump(md5($passwd));die;
		if($user !== NULL && $user['passwd'] == md5($passwd)){
			return $user['power'];
		}
		return 2;
	}


}