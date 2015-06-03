<?php
class AdminAction extends Action {
    public function index(){
    	if(session('user') != null){
    		$data['events'] = D('Event')->getEventList();
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
    public function removeEvent(){
        $id = I('id');
        $returnData['ret'] = D('Event')->removeEvent($id);
        $this->ajaxReturn($returnData);
    }

    public function downloadFile($file){
        
        // $file = 'PersonData/'.I('file');
        // exit($file);
        // $file = 
        // $file = 'PersonData/Asian Senior Judo Championships 2015-2015-06-03 16:35:20.txt';

        if(is_file($file)){
            $length = filesize($file);
            $type = mime_content_type($file);
            $showname =  ltrim(strrchr($file,'/'),'/');
            header("Content-Description: File Transfer");
            header('Content-type: ' . $type);
            header('Content-Length:' . $length);
             if (preg_match('/MSIE/', $_SERVER['HTTP_USER_AGENT'])) { //for IE
                 header('Content-Disposition: attachment; filename="' . rawurlencode($showname) . '"');
             } else {
                 header('Content-Disposition: attachment; filename="' . $showname . '"');
             }
             readfile($file);
             exit;
        } else {
             exit('Delete');
        }
    }
    public function downloadData(){
        $id = I('id');
        $persons = D('UserEvent')->getPersonIds($id);
        $personData = D('Person')->getPersonForJUA($persons['id']);

        foreach ($personData as $key => $value) {
            $personData[$key]['category'] = $persons['cat'][$value['id']];
            unset($personData[$key]['id']);
        }
        // $returnData['personData'] = $personData;
        $filename = D('Event')->getEventName($id)['name'].'-'.date('Y-m-d H:i:s').'.txt';
        $path = 'PersonData/'.$filename;
        // $returnData['name'] = $filename;
        file_put_contents($path, serialize($personData));
        
        $returnData['fileName'] = $filename;
        $returnData['url'] = U('Admin/downloadFile?file='.$path);

        $this->downloadFile($path);

        // $this->ajaxReturn($returnData);
        // $this->redirect('Admin/downloadFile', array('file'=>$filename));
    }
}