<?php

class UserEventModel extends Model{

	protected $fields = array(
		'user_id',
		'event_id',
		'category_info',
		'men_team',
		'women_team',
		'create_date',
		'person_ids',
		'_autoinc_'=>true,
		'_pk'=>'id'
		);

	public function getFields(){
		return $this->fields;
	}

	public function addUserEvent($data){
		$data['create_date'] = date('Y-m-d H:i:s');
		$data['user_id'] = session('user')['id'];
		// dump($data);
		return $this->add($data);
	}
	public function update($data){

		return $this->save($data);
	}
	public function deleteUserEvent($eventId)
	{
		return $this->where(array('user_id'=>session('user')['id'], 'event_id'=>$eventId))->delete();
	}

	public function getInfoById($eventId){
		$info = $this->where(array('user_id'=>session('user')['id'], 'event_id'=>$eventId))->find();
		// dump($info);
		if($info != NULL){

			$cutCat = explode(';', $info['category_info']);
			$tmp['mcat'] = explode(',', $cutCat[0]);
			$tmp['fcat'] = explode(',', $cutCat[1]);

			// dump($cutCat);
			for ($i=0; $i < 7; $i++) { 
				$info['cat'][$i]['mcat'] = intval($tmp['mcat'][$i]);
				$info['cat'][$i]['fcat'] = intval($tmp['fcat'][$i]);
			}
			$info['persons'] = explode(',', $info['person_ids']);
			foreach ($info['persons'] as $key => $value) {
				$info['persons'][$key] = explode(':', $value);
			}
		}
		// dump($info);
		return $info;
	}

	public function isExist($eventId){
		return $this->where(array('user_id'=>session('user')['id'], 'event_id'=>$eventId))->count();
	}

	public function getIdByEventId($eventId){
		return $this->field(array('id'))->where(array('user_id'=>session('user')['id'], 'event_id'=>$eventId))->find();
	}

	public function getCountByEventId($eventId){
		return $this->where(array('event_id'=>$eventId))->count();
	}
	public function getPersonIds($eventId){
		$personIds = array();
		$personIds['id'] = array();
		$personIds['cat'] = array();
		$idstr = $this->where(array('event_id'=>$eventId))->select();
		foreach ($idstr as $key => $value) {
			$tmp = explode(',', $value['person_ids']);
			// dump($tmp);
			foreach ($tmp as $key1 => $value1) {
				$tmpId= explode(':', $value1);
				// dump($tmpId);
				array_push($personIds['id'], $tmpId[0]);
				$personIds['cat'][$tmpId[0]] = $tmpId[1];
			}
		}
		return $personIds;
	}
}