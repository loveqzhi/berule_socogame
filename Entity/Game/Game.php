<?php

/**
 * @ file
 *  
 * @ Game 信息
 */

namespace Entity\Game;

use PDO;
use Exception;

entity_register('game', array(
    'controller' => 'Entity\\Game\\GameEntityController',
    'primaryKey' => 'id',
    'baseTable'  => 'game',
));

class Game {

    //根据主键读取
    public static function load($request) {
        $id  = (int) $request->getParameter('id');
        $data = entity_load('game', array($id));
        return reset($data);
    }

    //根据主键读取多个
    public static function loadMulti($request) {
        $ids = $request->getParameter('ids');
        if ($ids && !is_array($ids)) {
            $ids = explode(',', $ids);
        }
        $data = entity_load('game', $ids);
        return $data;
    }
    
    //新增
    public static function insert($request) {
        $game = (object) $request->getParameters();
        unset($game->id);
        $game->status = 1;
        $game->created = $game->updated = time();
        entity_insert('game', $game);            
        logger()->info("新增 成功: ".var_export((array)$game,true));
        return $game;
    }
    
    //更新
    public static function update($request) {
        $game = (object) $request->getParameters();
        unset($game->created);
        $game->updated = time();
        entity_update('game', $game);           
        return $game;
    }

    //列表
    public static function search($request) {
        $navi   = array('page'=> 1,'size' => 10, 'total'=> 0, 'pages' => 1);
        $page   = (int) $request->getParameter('page', 1);
        $size   = (int) $request->getParameter('size', 10);
        $query  = db_select('game', 'g')
                        ->extend('Pager')->page($page)->size($size)
                        ->fields('g', array('id'));     
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
