<?php

namespace Admin\Culture;

use Pyramid\Component\HttpFoundation\Response;
use Pyramid\Component\HttpFoundation\RedirectResponse;
use Entity;
use Admin;

class Culture {
    
    /**
     * 文化品牌
     * @route /admin/culture/{type}
     * @access  admin_access
     * @param int $page     当前页数
     * @param int $size     每页显示数量
     * @param int $status   状态
     * @return String
     */
    public static function search($request) {
        $type = $request->route->getParameter('type','cartoon');
        $request->setParameter('conditions',array(
            'type'      => array('value' => $type),
            'status'    => array('value' => $request->get('status',1)),
        ));
        $res = array(
            'status'=> $request->get('status',1),
            'type'  => $type,
            'menus' => Admin\Menu\Menu::getMenu($request->route->get('path'))[0],
            'list'  => Entity\Culture\Culture::search($request),
        );

        return new Response(theme()->render('culture-search.html',$res));  
    }

    /**
     * 添加 文化品牌
     * @route /admin/culture/{type}/add
     * @access  admin_access
     * @param  string type     分类
     * @param  string subtype  子分类
     * @param  string name     标题
     * @param  string source   链接
     * @return String
     */
    public static function add ($request) {
        $type = $request->route->getParameter('type','cartoon');
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
                            array('status'=>'error' ,'msg'=>'作品链接必须填写')),'200',
                            array('Content-Type'=>'application/json'));
            }
            */
            if (empty($array['source'])) {
                $array['source'] = '#';
            }
            Entity\Culture\Culture::insert(entity_request($array));
            return new Response(json_encode(
                            array('status'=>'success' ,'msg'=>'ok','type'=>$array['type'])),'200',
                            array('Content-Type'=>'application/json'));
        }
        else {
        
            $res['menus'] = Admin\Menu\Menu::getMenu($request->route->get('path'))[0]; 
            return new Response(theme()->render('culture-'.$type.'-add.html',$res));
        }
    }

    /**
     * 游戏修改
     * @route /admin/culture/edit/{id}
     * @access  admin_access
     * @param int $id
     * @return String
     */
	public static function edit($request) {
        $id = (int)$request->route->getParameter('id');
        $res['culture'] = Entity\Culture\Culture::load(entity_request(array('id'=>$id)));
        if (empty($res['culture'])) {
            return new RedirectResponse($request->getUriForPath('/admin/culture/cartoon'),'2',
                        '非法操作',array('Content-type'=>'text/html; charset=utf-8'));
        }        
        $res['menus'] = Admin\Menu\Menu::getMenu($request->route->get('path'))[0];
        //print_r($res['culture']);exit;
        return new Response(theme()->render('culture-'.$res['culture']->type.'-edit.html',$res));
    }
   
    /**
     * 游戏更新
     * @route /admin/culture/update
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
                            array('status'=>'error' ,'msg'=>'名称必须填写')),'200',
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
                            array('status'=>'error' ,'msg'=>'作品链接必须填写')),'200',
                            array('Content-Type'=>'application/json'));
            }
            */
            if (empty($array['source'])) {
                $array['source'] = '#';
            }
			Entity\Culture\Culture::update(entity_request($array));
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
	 * 删除
     * @route /admin/culture/delete/{id}/{type}
     * @access  admin_access
     * @param int $id
	 * @return redirect
	 */
	public static function delete($request) {       
		$id = (int)$request->route->getParameter('id');
        $type = $request->route->getParameter('type');
		if ($id) {			
            db_update("culture")
                ->fields(array('status'=>'0','updated'=>time()))
                ->condition("id",$id)
                ->execute();
            return new RedirectResponse($request->getUriForPath('/admin/culture/'.$type),'0','成功');
        }
        else {
            return new RedirectResponse($request->getUriForPath('/admin/culture/'.$type),'0',lang('非法操作'));
        }

	}
    
}