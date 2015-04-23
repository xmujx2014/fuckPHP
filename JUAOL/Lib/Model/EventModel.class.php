<?php

class EventModel extends Model{


	protected $fields = array(
		'organizer',
		'hosted_by',
		'date',
		'mcate',
		'fcate',
		'_autoinc_'=>true,
		'_pk'=>'id'
		);
	public function getFields(){
		return $this->fields;
	}
	public function getEvents(){
		return $this->select();
	}
}