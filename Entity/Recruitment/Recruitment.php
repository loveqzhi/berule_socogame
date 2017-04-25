<?php

/**
 * @ file
 *  
 * @ Recruitment 信息
 */

namespace Entity\Recruitment;

use PDO;
use Exception;

entity_register('recruitment', array(
    'controller' => 'Entity\\Recruitment\\RecruitmentEntityController',
    'primaryKey' => 'id',
    'baseTable'  => 'recruitment',
));

class Recruitment {

    //根据主键读取
    public static function load($request) {
        $id  = (int) $request->getParameter('id');
        $data = entity_load('recruitment', array($id));
        return reset($data);
    }

    //根据主键读取多个
    public static function loadMulti($request) {
        $ids = $request->getParameter('ids');
        if ($ids && !is_array($ids)) {
            $ids = explode(',', $ids);
        }
        $data = entity_load('recruitment', $ids);
        return $data;
    }
    
    //新增
    public static function insert($request) {
        $recruitment = (object) $request->getParameters();
        unset($recruitment->id);
        $recruitment->status = 1;
        $recruitment->created = $recruitment->updated = time();
        entity_insert('recruitment', $recruitment);            
        logger()->info("新增 成功: ".var_export((array)$recruitment,true));
        return $recruitment;
    }
    
    //更新
    public static function update($request) {
        $recruitment = (object) $request->getParameters();
        unset($recruitment->created);
        $recruitment->updated = time();
        entity_update('recruitment', $recruitment);           
        return $recruitment;
    }

    //列表
    public static function search($request) {
        $navi   = array('page'=> 1,'size' => 10, 'total'=> 0, 'pages' => 1);
        $page   = (int) $request->getParameter('page', 1);
        $size   = (int) $request->getParameter('size', 10);
        $query  = db_select('recruitment', 'r')
                        ->extend('Pager')->page($page)->size($size)
                        ->fields('r', array('id'));     
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
