<?php

class EventModel extends Model{


	protected $fields = array(
		'type',				//赛事类型
		'name',				//赛事名称
		'short_name',		//赛事名称缩写
		'country',			//国家
		'city',				//城市
		'date_from',		//开始日期
		'date_to',			//结束日期
		'par_type',			//参与者类型（个人或团体）
		'age_group',		//年龄组
		'gender',			//性别
		'mcate',			//男运动员公斤级
		'fcate',			//女运动员公斤级
		'system',			//赛事系统
		'mat_no',			//场地数
		'time',				//每场比赛时长
		'ref_no',			//每场比赛裁判数
		'activated',		//赛事是否激活
		'small_str',		//小数目选手比赛系统的字符串，如bo3;rrfob2;rr;rr分别表示2、3、4和5名选手参赛的级别的抽签规则
		'seed_no',			//种子选手数目
		'_autoinc_'=>true,	//自动增长
		'_pk'=>'id'			//赛事ID
		);
}