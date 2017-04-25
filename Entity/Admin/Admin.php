<?php

/**
 * @ file
 *  
 * @ Admin 管理员Entity
 */

namespace Entity\Admin;

entity_register('admin', array(
    'controller' => 'Entity\\Admin\\AdminEntityController',
    'primaryKey' => 'id',
    'baseTable'  => 'admin',
));

class Admin {

    //根据主键读取
    public static function load($request) {
        $id  = (int) $request->getParameter('id');
        $data = entity_load('admin', array($id));
        return reset($data);
    }

    //根据主键读取多个
    public static function loadMulti($request) {
        $ids = $request->getParameter('ids');
        if ($ids && !is_array($ids)) {
            $ids = explode(',', $ids);
        }
        $data = entity_load('admin', $ids);
        return $data;
    }

    //根据Uuid读取
    public static function loadByUuid($request) {
        $uuid = $request->getParameter('uuid');
        $data  = entity_load('admin', array(), array('uuid'=>$uuid));
        return reset($data);
    }
    
    //根据username读取
    public static function loadByUsername($request) {
        $username = $request->getParameter('username');
        $data  = entity_load('admin', array(), array('username'=>$username));
        return reset($data);
    }
    
    //新增
    public static function insert($request) {
        $admin = (object) $request->getParameters();
        unset($admin->id);
        $admin->uuid = uuid();
        $admin->status = 1;
        $admin->created = $admin->updated = $admin->accessed = time();
        $admin->nickname = $admin->username;
        $admin->password = pyramid_password_hash($admin->password);
        entity_insert('admin', $admin);
        logger()->info("register a admin success: ".var_export((array)$admin,true));
        return $admin;
    }
    
    //修改
    public static function update($request) {
        $admin = (object) $request->getParameters();
        unset($admin->adminname, $admin->created);
        if (!empty($admin->password)) {
            $admin->password = pyramid_password_hash($admin->password);
        }
        entity_update('admin', $admin);
        return $admin;
    }

    //用户列表
    public static function search($request) {
        $navi   = array('page'=> 1,'size' => 15, 'total'=> 0, 'pages' => 1);
        $page   = (int) $request->getParameter('page', 1);
        $size   = (int) $request->getParameter('size', 15);
        $query  = db_select('admin', 'u')
                        ->extend('Pager')->page($page)->size($size)
                        ->fields('u', array('id'));
                        
        foreach ($request->getParameter('conditions',array()) as $key=>$val) {
            $flag = isset($val['flag'])? $val['flag'] : '=';
            if (!is_null($val['value'])) {
                $query->condition($key,$val['value'],$flag);
            }
        }
        foreach ($request->getParameter('orderBys',array()) as $key=>$val) {
            if (!is_null($val['value'])) {
                $query->orderBy($key,$val['value']);
            }
        }
        $query->orderBy('id', 'DESC');
        $ids     = $query->execute()->fetchCol();
        $pager    = array_merge($navi,$query->fetchPager());
        $data     = self::loadMulti(entity_request(array('ids'=>$ids)));

        return array('data'=>$data, 'pager'=>$pager);
    }
    
    //根据id获取username
    public static function loadUserNameById($id) {
        return self::load(entity_request(array('id'=>$id)))->username;
    }
}