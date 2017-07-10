<?php
/**
 * 应用配置
 * 
 * @author lxj
 */
return [
    
    /* 数据库配置 */
    'dbType'            => 'mysql',
    'dbDistributede'    => FALSE,                           // 是否开启分布式数据库
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
    
    /* 应用配置 */
    'defaultController' => 'index',
    'defaultAction'     => 'index',
    
    'urlRewrite'        => TRUE,
    'urlSuffix'         => '.html',
    
    'sessionAutoStart'  => TRUE,
    'sessionSavePath'   => '',
    'sessionDriver'     => '',
    'sessionExpire'     => 3600,
    
    'timeZone'          => 'PRC',                       // 时区
    
    'openGzip'          => TRUE,                        // 是否开启gzip压缩
    
    'templateSuffix'    => '.php',                      // 模板后缀
    
];


