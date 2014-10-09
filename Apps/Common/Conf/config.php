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

    'LOAD_EXT_CONFIG' => 'alias', // 加载扩展配置文件

);
