<?php

const SESSION_PREFIX = 'socogame#berule';

//配置: session
$sessions = array(
    'prefix' => 'socogame_',
);

//配置: 数据库
$databases = array(
    'default' => array(
        'host'      => '127.0.0.1',
        'port'      => 3306,
        'database'  => 'socogame2016',
        'username'  => 'root',
        'password'  => '123456',
        'prefix'    => '',
    ),
);

//配置: 日志记录
$loggers = array(    
    'default' => array(
        'class' => 'Pyramid\Component\Logger\FileLogger',
        'level' => 'debug',
        'file' => 'cache/logs/socogame_default',
    ),
);

//配置: 模板引擎
$engines = array(
    'default' => array(
        'engine'      => 'Pyramid\Component\Templating\PhpEngine',
        'loader'      => 'Pyramid\Component\Templating\Php\Loader',
        'environment' => 'Pyramid\Component\Templating\Php\Environment',
        'loaderArgs'  => array(),
        'envArgs'     => array(/*'cache'=>'/opt/wwwroot/pay.berule.com/Cache/Theme'*/),
    ),
);

//设置session存储路径
session_save_path("cache/sess");

//配置：response status
$response_status = array(
    '200'   => 'OK',
    '10000' => '服务维护中',
    '10001' => '请填写完整信息',
    '10002' => '密码输入有误',
    '10003' => '该用户不存在',
    '10004' => '请输入用户名',
);

config()->set('status',$response_status);

//配置栏目
$catalog = array(
    '关于索乐' => array(
        'corpinfo'  => array('name'=>'公司简介'),
        'progress' => array('name'=>'发展历程'),
        'investment' => array('name'=>'投资者关系'),
        'enterprise' => array('name'=>'企业文化'),
        'staff' => array('name'=>'员工风采'),
    ),
    '索乐动态' => array(
        'news' => array('name'=>'新闻动态',),
        'game' => array('name'=>'品牌资讯',),
    ),
    '品牌介绍' => array(
        //'brand'   => array('name' => '自有品牌'),
        //'partner' => array('name' => '合作品牌'),
    ),
    '游戏产品' => array(
        'standalone' => array('name'=>'单机游戏',),
        'online'  => array('name'=>'手机网游',),
        'webgame'  => array('name'=>'网页游戏',),
    ),
    '文化产品' => array(
        'socogame'=> array(
            'name'  => '游戏产品',
        ),
        'cartoon' => array(
            'name' =>'动画产品', 
        ),
        'music'   => array(
            'name' => '音乐作品',
        ),
        'caricature' => array(
            'name' => '图书绘本',
            'child' => array(
                '1' => array('name' => '绘本'),
                '2' => array('name' => '漫画'),
                '3' => array('name' => '图书'),
            ),
        ),
        'other' =>  array(
            'name' => '更多产品',
            'child' => array(
                '1' => array('name' => '表情'),
                '2' => array('name' => '输入法'),
                '3' => array('name' => '壁纸'),
                '4' => array('name' => '周边产品'),
                '5' => array('name' => '消费品授权'),
                '6' => array('name' => '商业巡展'),
            ),
        ),
    ),
    '招贤纳士' => array(
        'talents' => array('name'=>'人才理念',),
        'recruit'  => array('name'=>'在招岗位',),
    ),
    '联系我们' => array(
        'company' => array('name'=>'公司地址',),
        'business'  => array('name'=>'商务合作',),
    ),
);
config()->set('catalog',$catalog);

//栏目英文对照
$catalogen = array(
    '关于索乐' => array('en'=>'ABOUT SOCO',),
    '索乐动态' => array('en'=>'SOCO INFORMATION','active'=>''),
    '品牌介绍' => array('en'=>'BRAND INTRODUCTION','active'=>''),
    '游戏产品' => array('en'=>'SOCO GAMES','active'=>''),
    '文化产品' => array('en'=>'BRAND CULTURE','active'=>''),
    '招贤纳士' => array('en'=>'RECRUITMENT','active'=>''),
    '联系我们' => array('en'=>'CONTACT US','active'=>''),
);
config()->set('catalogen',$catalogen);
//配置游戏分类
$mode = array(
    '1' => '手机游戏',
    '2' => '手机游戏',
    '3' => '网页游戏',
);
config()->set('mode',$mode);

//配置职位分类
$position = array(
    '1' => '程序类',
    '2' => '策划类',
    '3' => '美术类',
    '4' => '运营类',
    '5' => '综合类',
);

config()->set('position',$position);
