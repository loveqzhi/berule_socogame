<?php

namespace Admin\Game;

use Pyramid\Component\HttpFoundation\Response;
use Pyramid\Component\HttpFoundation\RedirectResponse;
use Entity;
use Admin;

class Game {
    
    /**
     * 集团游戏
     * @route /admin/culture/game/search
     * @access  admin_access
     * @param int $page     当前页数
     * @param int $size     每页显示数量
     * @param int $status   状态
     * @return String
     */
    public static function search($request) {

        $request->setParameter('conditions',array(
            'status'    => array('value' => $request->get('status',1)),
        ));
        $res = array(
            'status'=> $request->get('status',1),
            'menus' => Admin\Menu\Menu::getMenu($request->route->get('path'))[0],
            'list'  => Entity\Game\Game::search($request),
        );

        return new Response(theme()->render('game-search.html',$res));
    }

    /**
     * 添加游戏
     * @route /admin/culture/game/add
     * @access  admin_access
     * @param  string type     分类
     * @param  string title    标题
     * @param  string summary  摘要
     * @param  string content  正文
     * @return String
     */
    public static function add ($request) {     
        $post_data = $request->post->getParameters();           
        if ($post_data) {
            $array = $post_data;
            $array['adminid'] = session()->get('admin')->id;
            /*
            if (empty($array['name'])) {
                return new Response(json_encode(
                            array('status'=>'error' ,'msg'=>'游戏名称必须填写')),'200',
                            array('Content-Type'=>'application/json'));
            }
            if (empty($array['type'])) {
                return new Response(json_encode(
                            array('status'=>'error' ,'msg'=>'请选择栏目')),'200',
                            array('Content-Type'=>'application/json'));
            }
            if (empty($array['preview'])) {
                return new Response(json_encode(
                            array('status'=>'error' ,'msg'=>'请上传预览图')),'200',
                            array('Content-Type'=>'application/json'));
            }
            */
            /*
            if (empty($array['source'])) {
                return new Response(json_encode(
                            array('status'=>'error' ,'msg'=>'游戏链接必须填写')),'200',
                            array('Content-Type'=>'application/json'));
            }
            */
            if (empty($array['source'])) {
                $array['source'] = '#';
            }
            Entity\Game\Game::insert(entity_request($array));
            return new Response(json_encode(
                            array('status'=>'success' ,'msg'=>'ok','type'=>$array['type'])),'200',
                            array('Content-Type'=>'application/json'));
        }
        else {
        
            $res['menus'] = Admin\Menu\Menu::getMenu($request->route->get('path'))[0]; 
            return new Response(theme()->render('game-add.html',$res));
        }
    }

    /**
     * 游戏修改
     * @route /admin/culture/game/edit/{id}
     * @access  admin_access
     * @param int $id
     * @return String
     */
	public static function edit($request) {
        $id = (int)$request->route->getParameter('id');
        $res['game'] = Entity\Game\Game::load(entity_request(array('id'=>$id)));
        if (empty($res['game'])) {
            return new RedirectResponse($request->getUriForPath('/admin/culture/game/search'),'2',
                        '非法操作',array('Content-type'=>'text/html; charset=utf-8'));
        }        
        $res['menus'] = Admin\Menu\Menu::getMenu($request->route->get('path'))[0];
        //print_r($res['game']);exit;
        return new Response(theme()->render('game-edit.html',$res));
    }
   
    /**
     * 游戏更新
     * @route /admin/culture/game/update
     * @access  admin_access
     * @param array $request
     * @return json
     */
	public static function update($request) {
		$post_data = $request->getParameters();
		if (!empty($post_data['id'])) {
            $array = $post_data;
            $array['id']   = (int)$post_data['id'];
            $array['adminid'] = session()->get('admin')->id;
            /*
            if (empty($array['name'])) {
                return new Response(json_encode(
                            array('status'=>'error' ,'msg'=>'游戏名称必须填写')),'200',
                            array('Content-Type'=>'application/json'));
            }
            if (empty($array['type'])) {
                return new Response(json_encode(
                            array('status'=>'error' ,'msg'=>'请选择栏目')),'200',
                            array('Content-Type'=>'application/json'));
            }
            if (empty($array['preview'])) {
                return new Response(json_encode(
                            array('status'=>'error' ,'msg'=>'请上传预览图')),'200',
                            array('Content-Type'=>'application/json'));
            }
            */
            /*
            if (empty($array['source'])) {
                return new Response(json_encode(
                            array('status'=>'error' ,'msg'=>'游戏链接必须填写')),'200',
                            array('Content-Type'=>'application/json'));
            }
            */
            if (empty($array['source'])) {
                $array['source'] = '#';
            }
			Entity\Game\Game::update(entity_request($array));
            return new Response(json_encode(
                        array('status'=>'success','msg'=>'ok')),'200',
                        array('Content-Type'=>'application/json'));
		}
        else {
            return new Response(json_encode(
                            array('status'=>'error' ,'msg'=>'非法操作')),'200',
                            array('Content-Type'=>'application/json'));
        }
	}
    /**
	 * 删除游戏
     * @route /admin/culture/game/delete/{id}
     * @access  admin_access
     * @param int $id
	 * @return redirect
	 */
	public static function delete($request) {       
		$id = (int)$request->route->getParameter('id');
		if ($id) {			
            db_update("game")
                ->fields(array('status'=>'0','updated'=>time()))
                ->condition("id",$id)
                ->execute();
            return new RedirectResponse($request->getUriForPath('/admin/culture/game/search'),'0','成功');
        }
        else {
            return new RedirectResponse($request->getUriForPath('/admin/culture/game/search'),'0',lang('非法操作'));
        }

	}
    
}