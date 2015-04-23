<?php
class AdminAction extends Action {
    public function index(){
    	if(session('user') != null){
    		$data['events'] = D('Event')->getEvents();
    		$this->assign($data)->display('admin');
    	}
    	else{
    		$this->error("请登录后在进行操作！");
    	}
    }
}