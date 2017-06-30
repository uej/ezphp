<?php
/**
 * 应用配置
 * 
 * @author lxj
 */
return [
    
    /* 数据库配置 */
    'dbHost'            => '',                          // 数据库地址
    'dbName'            => '',                          // 数据库名
    'dbUser'            => '',                          // 数据库用户名
    'dbPassword'        => '',                          // 数据库密码
    'dbPrefix'          => 'cmf_',                      // 数据库表前缀
    'dbCharset'         => 'utf8',                      // 数据库链接字符集
    
    /* 应用配置 */
    'defaultController' => 'index',
    'defaultAction'     => 'index',
    
    'urlRewrite'        => TRUE,
    'urlSuffix'         => '.html',
    
    'sessionAutoStart'  => TRUE,
    'sessionDriver'     => '',
    'sessionExpire'     => 3600,
    
    'timeZone'          => 'PRC',                       // 时区
    
    'openGzip'          => TRUE,                        // 是否开启gzip压缩
    
    'templateSuffix'    => '.php',                      // 模板后缀
    
];


