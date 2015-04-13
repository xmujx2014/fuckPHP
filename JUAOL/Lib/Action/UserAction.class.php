<?php
// 本类由系统自动生成，仅供测试用途
class UserAction extends Action {
    public function index(){
    	$data['personInfo'] = D('Person')->getPersonInfoList();
    	// dump($data['personInfo']);
    	$this->assign($data)->display('user_manage');
    }
    public function addPerson(){
    	// if(IS_POST)
    	// {
    	// 	$ajaxReturnData['code'] = 200;
    	// 	$this->ajaxReturn($ajaxReturnData);
    	// }

    	$person = D("Person");
    	foreach($person->fields as $attr){
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
}