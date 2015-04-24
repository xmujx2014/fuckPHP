<?php
class AdminAction extends Action {
    public function index(){
    	if(session('user') != null){
    		$data['events'] = D('Event')->getEvents();
    		$data['users'] = D('User')->getConfirmUsers();
    		// dump($data['users']);
    		$this->assign($data)->display('admin_main');
    	}
    	else{
    		$this->error("请登录后在进行操作！");
    	}
    }

    public function addEvent(){
    	$event = D("Event");

        foreach($event->getFields() as $attr){
            // echo $attr;s
            $tmp = $_POST[$attr];
            if($tmp != NULL)
                $data[$attr] = $_POST[$attr];
        }

        if($_POST['id'] != '')
        		$data['id'] = $_POST['id'];

    	if($data['id'] == NULL){
            if (false !== $event->addEvent($data)) {
                $this->success('Data insert success!');
            } else {
                $this->error('Data insert error! Please try again!');
            }
	    }
	    else{
	    	if (false !== $event->saveEvent($data)) {
                $this->success('Data update success!');
            } else {
                $this->error('Data updata error! Please try again!');
            }
	    }
    }

    public function getEvent(){
    	if(IS_POST){
    		$id = I('id');

    		$ajaxReturnData['fields'] = D("Event")->getFields();
    		$ajaxReturnData['event'] = D("Event")->getEventByFilter(array('id'=>$id));
    		$ajaxReturnData['code'] = 200;

    		$this->ajaxReturn($ajaxReturnData);
    	}
    }
}