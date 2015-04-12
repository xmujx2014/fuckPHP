<?php

class UserModel extends Model{


	protected $fields = array(
		'username',
		'passwd',
		'team_name',
		'tel',
		'email',
		'_autoinc_'=>true,
		'_pk'=>'id'
		);

}