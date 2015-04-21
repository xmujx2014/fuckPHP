<?php

import('ORG.Net.UploadFile');

class UserAction extends Action {
    public function index(){
    	$data['personInfo'] = D('Person')->getPersonInfoList();
    	$data['team'] = session('user')['team'];
        $data['username'] = session('user')['username'];
    	$data['groupe'] = array(
    		'Catering',
    		'Competitor',
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
    	$this->assign($data)->display('user_manage');
    }
    public function addPerson(){

    	$upload = new UploadFile();
    	$upload->maxSize = 3145728 ;// 设置附件上传大小
		$upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型

		$upload->savePath = './JUAOL/Resource/img/person_img/';
		$upload->saveRule = time().'_'.mt_rand();

		
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

    	if($upload->upload()) {
			$info =  $upload->getUploadFileInfo();
            $data['img_url'] = C('TMPL_PARSE_STRING')['__PUBLIC__'].'/img/person_img/'.$info[0]['savename'];
		}
		// dump($person->fields);
		// dump($info[0]['savename']);
		// $person->create();
		// dump($data);die;
		
		if($data['id'] == ''){
            if (false !== $person->addPerson($data)) {
                $this->success('数据添加成功！');
            } else {
                $this->error('数据写入错误');
            }
	    }
	    else{
	    	if (false !== $person->updatePerson($data)) {
                $this->success('数据更新成功！');
            } else {
                $this->error('数据写入错误');
            }
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
}