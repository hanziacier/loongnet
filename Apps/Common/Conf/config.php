<?php

return  array(
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  $_SERVER['MYSQLDB_HOST'].','.$_SERVER['MYSQLDB_HOST'], // 数据库服务器地址
    'DB_NAME'               =>  $_SERVER['MYSQLDB_NAME'],          // 数据库名
    'DB_USER'               =>  $_SERVER['MYSQLDB_USER'],      // 用户名
    'DB_PWD'                =>  $_SERVER['MYSQLDB_PASSWORD'],          // 密码
    'DB_PORT'               =>  $_SERVER['MYSQLDB_PORT'],        // 端口
    'DB_PREFIX'             =>  '',    // 数据库表前缀
    'DB_CHARSET' => 'utf8', // 数据库编码默认采用utf8
    'DB_DEPLOY_TYPE' => 1, // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
    'DB_RW_SEPARATE' => true, // 数据库读写是否分离 主从式有效
    'DB_MASTER_NUM' => 1, // 读写分离后 主服务器数量

    'LOAD_EXT_CONFIG' => 'alias', // 加载扩展配置文件


);
