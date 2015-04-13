<?php
/**
 * JUA项目的配置文件
 * @author BinaryKang <bingyingsuolian@163.com>
 */
return array(
	/* 数据库配置 */
    'DB_HOST'           => '172.27.1.226',                            // 服务器地址
    'DB_NAME'           => 'juaOL_PHP',                                       // 数据库名
    'DB_USER'           => 'root',                                    // 用户名
    'DB_PWD'            => 'root',                                // 密码
    'DB_PORT'           => '3306',                                      // 端口
    'DB_PREFIX'         => 'jua_',                                      // 数据库表前缀
    /*其他配置*/
    'URL_HTML_SUFFIX'   =>'',                                           // 伪静态后缀名，默认为html
    /*自定义SESSION存储在数据库当中*/
    'SESSION_AUTO_START'=>true,                                         // 定义是否自动开启SESSION，默认开启
    // 'SESSION_TYPE'=>'DB',                                            // 自定义SESSION数据库存储，默认以文件存储

    'TMPL_PARSE_STRING' =>array(
    	'__PUBLIC__'=>__ROOT__.'/'.APP_NAME.'/Resource',
    	),
);
?>