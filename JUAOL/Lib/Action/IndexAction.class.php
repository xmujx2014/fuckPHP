<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
    	$this->assign($data)->show();
    }
    public function login(){
    	$username = $_POST['username'];
    	$passwd = $_POST['passwd'];

    	session(array('name'=>'session_id','expire'=>8888));

    	$power = D('User')->loginValidate($username, $passwd);
    	// dump($power);die;
    	if(!$power)
    		$this->redirect('User/index');
    	else if($power == 1)
    		$this->redirect('Admin/index');
    	$this->redirect('Index/index');
    }
}