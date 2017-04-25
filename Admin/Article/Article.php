<?php

namespace Admin\Article;

use Pyramid\Component\HttpFoundation\Response;
use Pyramid\Component\HttpFoundation\RedirectResponse;
use Entity;
use Admin;

class Article {
    
    /**
     * 索乐动态
     * @route /admin/article/{type}
     * @access  admin_access
     * @param int $page     当前页数
     * @param int $size     每页显示数量
     * @param int $status   状态
     * @return String
     */
    public static function search($request) {
        $type = $request->route->getParameter('type','news');
        $request->setParameter('conditions',array(
            'type'      => array('value' => $type),
            'status'    => array('value' => $request->get('status',1)),
        ));
        $res = array(
            'status'=> $request->get('status',1),
            'type'  => $type,
            'menus' => Admin\Menu\Menu::getMenu($request->route->get('path'))[0],
            'list'  => Entity\Article\Article::search($request),
        );

        return new Response(theme()->render('article-search.html',$res));  
    }

    /**
     * 添加信息
     * @route /admin/article/add
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
            if (empty($array['title'])) {
                return new Response(json_encode(
                            array('status'=>'error' ,'msg'=>'信息标题必须填写')),'200',
                            array('Content-Type'=>'application/json'));
            }
            if (empty($array['type'])) {
                return new Response(json_encode(
                            array('status'=>'error' ,'msg'=>'请选择栏目')),'200',
                            array('Content-Type'=>'application/json'));
            }
            */
            Entity\Article\Article::insert(entity_request($array));
            return new Response(json_encode(
                            array('status'=>'success' ,'msg'=>'ok','type'=>$array['type'])),'200',
                            array('Content-Type'=>'application/json'));
        }
        else {
        
            $res['menus'] = Admin\Menu\Menu::getMenu($request->route->get('path'))[0]; 
            return new Response(theme()->render('article-add.html',$res));
        }
    }

    /**
     * 信息修改
     * @route /admin/article/edit/{id}
     * @access  admin_access
     * @param int $id
     * @return String
     */
	public static function edit($request) {
        $id = (int)$request->route->getParameter('id');
        $res['article'] = Entity\Article\Article::load(entity_request(array('id'=>$id)));
        if (empty($res['article'])) {
            return new RedirectResponse($request->getUriForPath('/admin/article/news'),'2',
                        '非法操作',array('Content-type'=>'text/html; charset=utf-8'));
        }        
        $res['menus'] = Admin\Menu\Menu::getMenu($request->route->get('path'))[0];
        //print_r($res['article']);exit;
        return new Response(theme()->render('article-edit.html',$res));
    }
   
    /**
     * 信息更新
     * @route /admin/article/update
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
            if (empty($array['title'])) {
                return new Response(json_encode(
                            array('status'=>'error' ,'msg'=>'标题必须填写')),'200',
                            array('Content-Type'=>'application/json'));
            }
            if (empty($array['type'])) {
                return new Response(json_encode(
                            array('status'=>'error' ,'msg'=>'请选择栏目')),'200',
                            array('Content-Type'=>'application/json'));
            }
            */
			Entity\Article\Article::update(entity_request($array));
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
	 * 删除信息
     * @route /admin/article/delete/{id}/{type}
     * @access  admin_access
     * @param int $id
	 * @return redirect
	 */
	public static function delete($request) {       
		$id = (int)$request->route->getParameter('id');
        $type = $request->route->getParameter('type');
		if ($id) {			
            db_update("article")
                ->fields(array('status'=>'0','updated'=>time()))
                ->condition("id",$id)
                ->execute();
            return new RedirectResponse($request->getUriForPath('/admin/article/'.$type),'0','成功');
        }
        else {
            return new RedirectResponse($request->getUriForPath('/admin/article/'.$type),'0',lang('非法操作'));
        }

	}
    
}