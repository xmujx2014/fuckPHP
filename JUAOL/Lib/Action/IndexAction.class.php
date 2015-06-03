<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
        $data['username'] = session('username');
        $data['eventName'] = D('Event')->getEventNames();
        if(session('error') != NULL)
            $data['error'] = session('error');
        session(null);
        session('username', $data['username']);
    	$this->assign($data)->show();
    }
    public function login(){
    	$username = $_POST['username'];
    	$passwd = $_POST['passwd'];

        session(null);
        
    	session(array('name'=>'session_id','expire'=>8888));
        session('username', $username);

    	$power = D('User')->loginValidate($username, $passwd);
    	// dump($power);die;
    	if($power == 1)
    		$this->redirect('User/index');
    	else if($power == 0)
    		$this->redirect('Admin/index');
        else if ($power == 2) {
            session('error', 'Please wait admin confirm or connect admin with Email.');
        }
        session('error', 'ERROR: username or password is wrong.');
    	$this->redirect('Index/index');
    }

    public function logout(){
        session('user', NULL);
        $this->redirect('Index/index');
    }
}