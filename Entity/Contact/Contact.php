<?php

/**
 * @ file
 *  
 * @ Contact 信息
 */

namespace Entity\Contact;

use PDO;
use Exception;

entity_register('contact', array(
    'controller' => 'Entity\\Contact\\ContactEntityController',
    'primaryKey' => 'id',
    'baseTable'  => 'contact',
));

class Contact {

    //根据主键读取
    public static function load($request) {
        $id  = (int) $request->getParameter('id');
        $data = entity_load('contact', array($id));
        return reset($data);
    }

    //根据主键读取多个
    public static function loadMulti($request) {
        $ids = $request->getParameter('ids');
        if ($ids && !is_array($ids)) {
            $ids = explode(',', $ids);
        }
        $data = entity_load('contact', $ids);
        return $data;
    }
    
    //新增
    public static function insert($request) {
        $contact = (object) $request->getParameters();
        unset($contact->id);
        $contact->status = 1;
        $contact->created = $contact->updated = time();
        entity_insert('contact', $contact);            
        logger()->info("新增 成功: ".var_export((array)$contact,true));
        return $contact;
    }
    
    //更新
    public static function update($request) {
        $contact = (object) $request->getParameters();
        unset($contact->created);
        $contact->updated = time();
        entity_update('contact', $contact);           
        return $contact;
    }

    //列表
    public static function search($request) {
        $navi   = array('page'=> 1,'size' => 10, 'total'=> 0, 'pages' => 1);
        $page   = (int) $request->getParameter('page', 1);
        $size   = (int) $request->getParameter('size', 10);
        $query  = db_select('contact', 'c')
                        ->extend('Pager')->page($page)->size($size)
                        ->fields('c', array('id'));     
        foreach ($request->getParameter('conditions',array()) as $key=>$val) {
            $flag = isset($val['flag'])? $val['flag'] : '=';
            if (!is_null($val['value'])) {
                $query->condition($key,$val['value'],$flag);
            }
        }
        $query->orderBy('id','DESC');
        $pager = array_merge($navi, $query->fetchPager());
        $ids   = $query->execute()->fetchCol();
        $data  = self::loadMulti(entity_request(array('ids'=>$ids)));

        return array('data'=>$data, 'pager'=>$pager);
    }
    
}
