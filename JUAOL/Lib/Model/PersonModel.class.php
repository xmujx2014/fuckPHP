<?php

class PersonModel extends Model{

	protected $fields = array(
		'team',					//队名
		'family_name',			//姓
		'given_name',			//名
		'simple_name',			//简称
		'identity_num',			//ID 身份证号码
		'gender',				//性别
		'groupe',				//所担任的职责
		'category', 			//所处的级别（ex(kg):-60,+100）
		'create_time',			//Person创建时间
		'edit_time',			//Person的最后修改时间

		'img_url',
		'birth',
		'best_result',
		'passport_no',
		'_autoinc_'=>true,		//自动增长
		'_pk'=>'id');

	public function getFields(){
		return $this->fields;
	}
	public function getPersonInfoList($filter = array()){
		$filter['team'] = session('user')['team'];
		return $this->where($filter)->order('id asc')->select();
	}
	
	public function getInfoById($id){
		$person = $this->where(array('id'=>$id))->find();
		return $person;
	}

	public function addPerson($data){
		$data['create_time'] = date('Y-m-d H:i:s');
		$data['edit_time'] = $data['create_time'];
		return $this->add($data);
	}

	public function updatePerson($data)
	{
		$data['edit_time'] = date('Y-m-d H:i:s');
		$this->save($data);
	}

	public function deletePerson($data)
	{
		$this->delete($data['id']);
	}

	public function getImgUrls(){
		$data = $this->field(array('img_url'))->select();
		$result = array();
		$tmp = '';

		foreach ($data as $key => $value) {
			$tmp = explode('juaOL/JUAOL/Resource/img/person_img/', $value['img_url'])[1];
			$tmp != NULL ? array_push($result, $tmp) : '';
		}
		// dump($result);die;
		return $result;
	}


}