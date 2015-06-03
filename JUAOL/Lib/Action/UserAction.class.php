<?php
// header("Content-Type:text/html; charset=UTF-8");
import('ORG.Net.UploadFile');

class UserAction extends Action {
    public function index(){
        if(session('user') != null){
        	$data['personInfo'] = D('Person')->getPersonInfoList();
        	$data['user'] = D('User')->getCurrentUserInfo();
        	$data['groupe'] = array(
        		'Competitor',
                'Catering',
        		'Judoka',
        		'Coach',
        		'Team-Official',
        		'Referee',
        		'Doctor',
        		'Medic',
        		'Physiotherapist',
        		'President',
        		'Vice-President',
        		'General Secretary',
        		'Delegate',
        		'LJF Staff',
        		'VIP',
        		'VVIP',
        		'Head of Organisation'
        		);
            // $data['eventName'] = D('Event')->getEventNames();
           
            $data['events'] = D('Event')->getEventList();
            foreach ($data['events'] as $key => $value) {
                // code...
                $data['events'][$key]['join'] = D('UserEvent')->isExist($value['id']);
            }

            // dump($data['events']);
        	$this->assign($data)->display('user_main');
        }
        else{
            $this->error("Please Login！");
        }
    }

    public function addPerson(){
        if(session('user') != null){

        	$upload = new UploadFile();
        	$upload->maxSize = 3145728 ;// 设置附件上传大小
    		$upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型

    		$upload->savePath = './PersonImg/';
            $upload->uploadReplace = true;

    		
    		// dump($info);die;
        	$person = D("Person");

        	foreach($person->getFields() as $attr){
        		// echo $attr;s
        		$tmp = $_POST[$attr];
        		if($tmp != NULL)
     	   			$data[$attr] = $_POST[$attr];
        	}
        	if($_POST['id'] != '')
        		$data['id'] = $_POST['id'];

            $data['team'] = session('user')['team'];  

            $upload->saveRule = $data['team'].'_'.$data['family_name'].$data['given_name'];

        	if($upload->upload()) {
    			$info =  $upload->getUploadFileInfo();
                $data['img_url'] = '/juaOL/PersonImg/'.$info[0]['savename'];
    		}
    		// dump($person->fields);
    		// dump($info[0]['savename']);
    		// $person->create();
    		// dump($data);die;
    		
    		if($data['id'] == NULL){
                if (false !== $person->addPerson($data)) {
                    $this->success('Data insert success!');
                } else {
                    $this->error('Data insert error! Please try again!');
                }
    	    }
    	    else{
    	    	if (false !== $person->updatePerson($data)) {
                    $this->success('Data update success!');
                } else {
                    $this->error('Data updata error! Please try again!');
                }
    	    }
        }
        else{
            $this->error("Please Login!");
        }
        
    }

    public function getInfo(){
    	if(IS_POST){
    		$id = I('id');
    		$ajaxReturnData['person'] = D("Person")->getInfoById($id);
    		$ajaxReturnData['code'] = 200;

    		$this->ajaxReturn($ajaxReturnData);
    	}
    }

    public function cleanImg(){
    	D('Person')->getImgUrls();
    	$this->success("图片清理成功");
    }

    public function accountInfo(){
        $user = D("User");

        foreach($user->getFields() as $attr){
            // echo $attr;s
            $tmp = $_POST[$attr];
            if($tmp != NULL)
                $data[$attr] = $_POST[$attr];
        }
        $mcat = '';
        $fcat = '';
        for ($i=1; $i < 7; $i++) { 
            $mcat = $mcat.$_POST['m-choose-'.$i].',';
            $fcat = $fcat.$_POST['f-choose-'.$i].',';
        }
        $mcat = $mcat.$_POST['m-choose-7'].';';
        $fcat = $fcat.$_POST['f-choose-7'];

        $cat = $mcat.$fcat;

        $data['category_info'] = $cat;

        if (false !== $user->updateUser($data)) {
            $this->success('Data update success!');
        } else {
            $this->error('Data updata error! Please try again!');
        }
    }
    public function getUserEventInfo(){
        if(IS_POST){
            $id = I('id');
            $data['cat']['mcat'] = D('Event')->getMCat($id);
            $data['cat']['fcat'] = D('Event')->getFCat($id);

            $userEvent = D('UserEvent')->getInfoById($id);
            $data['data'] = $userEvent;
            $this->ajaxReturn($data);
        }
    }

    public function submitUserEventInfo(){
        if(IS_POST){
            $data['category_info'] = I('category_info');
            $data['event_id'] = I('event_id');
            $data['men_team'] = I('men_team');
            $data['women_team'] = I('women_team');
            $data['person_ids'] = I('person_ids');

            $returnData = array(
                'code'=>200,
                'ret'=>'',
                'err'=>''
                );
            if(D('UserEvent')->isExist($data['event_id'])){
                $data['id'] = D('UserEvent')->getIdByEventId($data['event_id'])['id'];
                D('UserEvent')->save($data);
            }
            else{
                D('UserEvent')->addUserEvent($data);
            }
            $returnData['ret'] = $data;

            $this->ajaxReturn($returnData);
        }
    }

    public function passwdChange(){
        $oldPasswd = $_POST['oldPasswd'];
        if(D('User')->loginValidate(session('user')['username'], $oldPasswd) != 2){
            $user = D('User');
            $data['passwd'] = md5($_POST['newPasswd']);
            if($user->updateUser($data)){
                $this->success("Password change success!");
            }
            else
                $this->error("Password change faild! Please try again!");
        }
        else
            $this->error('You password is wrong! Please input you correct password!');
    }

    public function userConfirm(){
        if(IS_POST){
            $id = I('id');
            $operate = I('operate');

            $data['code'] = 200;
            $data['ret'] = '';

            $user['id'] = $id;
            if($operate == 'ok'){
                $user['power'] = 1;
                D('User')->save($user);
            }
            else if($operate == 'remove'){
                D('User')->where('id='.$id)->delete();
            }
            $data['code'] = 404;
            $this->ajaxReturn($data);
        }
    }

    public function register(){
        $user = D("User");

        foreach($user->getFields() as $attr){
            $tmp = $_POST[$attr];
            if($tmp != NULL)
                $data[$attr] = $_POST[$attr];
        }
        if (false !== $user->addUser($data)) {
            $this->success('Data update success!');
        } else {
            $this->error('Data updata error! Please try again!');
        }
    }

    public function getCatInfo(){
        if(GET){
            $eventId = $_GET['eventId'];
            $data['eventId'] = $eventId;
            $data['m-cat'] = D('Event')->getMCat($eventId);
            $data['f-cat'] = D('Event')->getFCat($eventId);

            $this->ajaxReturn($data);
        }
    }

    public function saveUserCat(){
        if(POST){
            
        }
    }

    public function removePerson(){
        $id = I('id');
        $returnData['ret'] = D('Person')->deletePerson($id);
        $this->ajaxReturn($returnData);
    }
    public function removeUserEvent(){
        $id = I('id');
        $returnData['ret'] = D('UserEvent')->deleteUserEvent($id);
        $this->ajaxReturn($returnData);
    }

}