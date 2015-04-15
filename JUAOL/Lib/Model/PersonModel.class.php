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
		'seeding',				//如果是运动员，是否是种子选手
		'failed',				//称重是否失败
		'category_id',			//外键关联
		'event_id',				//event外关联
		'ranking',				//排名
		'type',					//类型，team或者individual
		'team_id',				//团队赛中person关联team的外键
		'seed_rank',			//种子选手排名

		'img_url',
		'birth',
		'best_result',
		'number_of_officials',
		'number_of_competitiors',
		'federation',
		'passport_no',
		'tel',
		'email',
		'adress',
		'_autoinc_'=>true,		//自动增长
		'_pk'=>'id');

	public function getFields(){
		return $this->fields;
	}
	public function getPersonInfoList($filter = array()){
		return $this->where($finalFilter)->order('id asc')->select();
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


}