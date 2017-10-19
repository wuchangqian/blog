<?php
return array(
    //db
	'DB_TYPE' => 'mysqli',
    'DB_HOST' => '127.0.0.1',
    'DB_NAME' => 'blog',
    'DB_USER' => 'root',
    'DB_PWD' => 'sa',
    'DB_PORT' => 3306,
    'DB_PREFIX' => 'blog_',
    'DB_CHARSET' => 'utf8',

    //url
    'URL_CASE_INSENSITIVE'  =>  true,
    //other
    'SECRET_KEY' => md5('balunwang'),
    'SESSION_EXP' => 3600,
    'PAGE_LIMIT' => 10,


);