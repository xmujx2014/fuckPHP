<?php

class EventModel extends Model{


	protected $fields = array(
		'organizer',
		'hosted_by',
		'date',
		'mcate',
		'fcate',
		'venue',
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
		// dump($data);die;
		return $this->save($data);
	}
	public function addEvent($data){
		// dump($data);die;
		return $this->add($data);
	}
	public function getEventByFilter($filter = array()){
		return $this->where($filter)->find();
	}
}