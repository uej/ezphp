<?php
/**
 * 应用配置
 * 
 * @author lxj
 */
return [
<<<<<<< HEAD
    /* 是否开启调试 */
    'debug'             => TRUE,
    
    /* 数据库配置 */
    'dbType'            => 'mysql',
    'dbDistributede'    => FALSE,                       // 是否开启分布式数据库
    'dbPrefix'          => 'cmf_',                      // 数据库表前缀
    'dbCharset'         => 'utf8',                      // 数据库链接字符集
    
    /* 主数据库 */
    'dbMaster'          => [
        'dbHost'            => '127.0.0.1',
        'dbName'            => 'testphp',
        'dbUser'            => 'root',
        'dbPassword'        => 'root',
        'dbPort'            => 3306,
    ],
    
    /* 从数据库 */
    'dbSlave'           => [
        [
            'dbHost'            => '',
            'dbName'            => '',
            'dbUser'            => '',
            'dbPassword'        => '',
            'dbPort'            => 3306,
        ],
        [
            'dbHost'            => '',
            'dbName'            => '',
            'dbUser'            => '',
            'dbPassword'        => '',
            'dbPort'            => 3306,
        ],
    ],
    
=======
    
    /* 数据库配置 */
    'dbHost'            => '',                          // 数据库地址
    'dbName'            => '',                          // 数据库名
    'dbUser'            => '',                          // 数据库用户名
    'dbPassword'        => '',                          // 数据库密码
    'dbPrefix'          => 'cmf_',                      // 数据库表前缀
    'dbCharset'         => 'utf8',                      // 数据库链接字符集
    
>>>>>>> refs/remotes/origin/1.0.0
    /* 应用配置 */
    'defaultController' => 'index',
    'defaultAction'     => 'index',
    
    'urlRewrite'        => TRUE,
    'urlSuffix'         => '.html',
    
    'sessionAutoStart'  => TRUE,
<<<<<<< HEAD
    'sessionSavePath'   => '',
    'sessionDriver'     => '',
    'sessionExpire'     => 3600,
    
    'redisHost'         => '127.0.0.1',
    'redisPort'         => 6379,
    'redisSessiondb'    => 2,
    'redisSessionPrefix'=> 'example',
    'redisPassword'     => '',
    
    'timeZone'          => 'PRC',                       // 时区
    
    'openGzip'          => FALSE,                        // 是否开启gzip压缩
    
    'templateSuffix'    => '.php',                      // 模板后缀
    
    'errorPage'         => null,
    
=======
    'sessionDriver'     => '',
    'sessionExpire'     => 3600,
    
    'timeZone'          => 'PRC',                       // 时区
    
    'openGzip'          => TRUE,                        // 是否开启gzip压缩
    
    'templateSuffix'    => '.php',                      // 模板后缀
    
>>>>>>> refs/remotes/origin/1.0.0
];


