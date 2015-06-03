<?php
/**
 * JUA项目的配置文件
 * @author BinaryKang <bingyingsuolian@163.com>
 */
return array(
	/* 数据库配置 */
    // 'DB_HOST'           => '172.27.1.226', 
    // 'DB_NAME'           => 'juaOL_PHP',
    // 'DB_HOST'           => '103.249.252.165', 
    'DB_HOST'           => '127.0.0.1', 
    'DB_NAME'           => 'juaOL',
    'DB_USER'           => 'root',
    'DB_PWD'            => '',
    'DB_PORT'           => '3306',
    'DB_PREFIX'         => 'jua_',
    /*其他配置*/
    'URL_HTML_SUFFIX'   =>'',
    /*自定义SESSION存储在数据库当中*/
    'SESSION_AUTO_START'=>true, 
    // 'SESSION_TYPE'=>'DB',
    // 
    'TMPL_PARSE_STRING' =>array(
    	'__PUBLIC__'=>__ROOT__.'/'.APP_NAME.'/Resource',
        '__UPLOAD__'=>__ROOT__.'/'.APP_NAME.'/Uploads',
    	),
);
?>