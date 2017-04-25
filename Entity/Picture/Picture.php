<?php

/**
 * @ file
 *  
 * @ Picture 信息
 */

namespace Entity\Picture;

use PDO;
use Exception;

entity_register('picture', array(
    'controller' => 'Entity\\Picture\\PictureEntityController',
    'primaryKey' => 'id',
    'baseTable'  => 'picture',
));

class Picture {

    //根据主键读取
    public static function load($request) {
        $id  = (int) $request->getParameter('id');
        $data = entity_load('picture', array($id));
        return reset($data);
    }

    //根据主键读取多个
    public static function loadMulti($request) {
        $ids = $request->getParameter('ids');
        if ($ids && !is_array($ids)) {
            $ids = explode(',', $ids);
        }
        $data = entity_load('picture', $ids);
        return $data;
    }
    
    //新增
    public static function insert($request) {
        $picture = (object) $request->getParameters();
        unset($picture->id);
        $picture->status = 1;
        $picture->created = $picture->updated = time();
        entity_insert('picture', $picture);            
        logger()->info("新增 成功: ".var_export((array)$picture,true));
        return $picture;
    }
    
    //更新
    public static function update($request) {
        $picture = (object) $request->getParameters();
        unset($picture->created);
        $picture->updated = time();
        entity_update('picture', $picture);           
        return $picture;
    }

    //列表
    public static function search($request) {
        $navi   = array('page'=> 1,'size' => 10, 'total'=> 0, 'pages' => 1);
        $page   = (int) $request->getParameter('page', 1);
        $size   = (int) $request->getParameter('size', 10);
        $query  = db_select('picture', 'c')
                        ->extend('Pager')->page($page)->size($size)
                        ->fields('c', array('id'));     
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
     
        $query->orderBy('id','DESC');
        $pager = array_merge($navi, $query->fetchPager());
        $ids   = $query->execute()->fetchCol();
        $data  = self::loadMulti(entity_request(array('ids'=>$ids)));

        return array('data'=>$data, 'pager'=>$pager);
    }
    
}
