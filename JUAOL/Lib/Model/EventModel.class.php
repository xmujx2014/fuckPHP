<?php

class EventModel extends Model{

	protected $fields = array(
		'name',
		'organizer',
		'hosted_by',
		'date',
		'mcate',
		'fcate',
		'venue',
		'email',
		'city',
		'_autoinc_'=>true,
		'_pk'=>'id'
		);
	public function getFields(){
		return $this->fields;
	}

	public function getEvents(){
		return $this->select();
	}

	public function saveEvent($data){
		$data["mcate"] = $this->changeComma($data["mcate"]);
		$data["fcate"] = $this->changeComma($data["fcate"]);
		return $this->save($data);
	}

	public function addEvent($data){
		// dump($data);die;
		return $this->add($data);
	}

	public function getEventByFilter($filter = array()){
		return $this->where($filter)->find();
	}

	public function getMCat($id){
		return $this->handleCat($this->field(array('mcate'))->where(array('id'=>$id))->find()['mcate']);
	}

	public function getFCat($id){
		return $this->handleCat($this->field(array('fcate'))->where(array('id'=>$id))->find()['fcate']);
	}

	public function getEventList(){
		$events = $this->select();
		foreach ($events as $key => $value) {
			$events[$key]['mcate'] = explode(',', $value['mcate']);
			$events[$key]['fcate'] = explode(',' ,$value['fcate']);
		}
		return $events;
	}

	public function getEventNames(){
		return $this->field(array('id' ,'name'))->select();
	}



	//=====================================
	//utils function

	private function handleCat($cat){
		// dump($cat);
		if($cat == NULL || $cat == "")
			return NULL;
		return explode(',', $cat);
	}
	private function changeComma($str){
		if(strpos('，', $str) == false)
			return $str;
		else
			return str_replace('，', ',', $str);
	}
}