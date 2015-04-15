<?php
// 本类由系统自动生成，仅供测试用途
class UserAction extends Action {
    public function index(){
    	$data['personInfo'] = D('Person')->getPersonInfoList();
    	$data['team'] = session('user')['team'];
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

    	$person = D("Person");
    	foreach($person->getFields() as $attr){
    		// echo $attr;s
    		$tmp = $_POST[$attr];
    		if($tmp != NULL)
 	   			$data[$attr] = $_POST[$attr];
    	}
		// dump($person->fields);
		// dump($data);die;
    	if ($person->create()) {
            if (false !== $person->addPerson($data)) {
                $this->success('数据添加成功！');
            } else {
                $this->error('数据写入错误');
            }
        } else {
            // 字段验证错误
            $this->error($person->getError());
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
}