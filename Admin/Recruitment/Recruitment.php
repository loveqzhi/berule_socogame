<?php

namespace Admin\Recruitment;

use Pyramid\Component\HttpFoundation\Response;
use Pyramid\Component\HttpFoundation\RedirectResponse;
use Entity;
use Admin;

class Recruitment {
    
    /**
     * 职位列表
     * @route /admin/recruitment/search
     * @access  admin_access
     * @param int $page     当前页数
     * @param int $size     每页显示数量
     * @param int $status   状态
     * @return String
     */
    public static function search($request) {
        //conditions
        $request->setParameter('conditions',array(
            'type'      => array('value' => $request->get('type')),
            'status'    => array('value' => $request->get('status',1)),
        ));
        $res = array(
            'menus' => Admin\Menu\Menu::getMenu($request->route->get('path'))[0],
            'list'  => Entity\Recruitment\Recruitment::search($request),
        );

        return new Response(theme()->render('recruitment-search.html',$res));  
    }

    /**
     * 添加职位
     * @route /admin/recruitment/add
     * @access  admin_access
     * @param  string type     分类
     * @param  string name     职位名称
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
                            array('status'=>'error' ,'msg'=>'职位名称必须填写')),'200',
                            array('Content-Type'=>'application/json'));
            }
            if (empty($array['type'])) {
                return new Response(json_encode(
                            array('status'=>'error' ,'msg'=>'请选择职位分类')),'200',
                            array('Content-Type'=>'application/json'));
            }
            */
            Entity\Recruitment\Recruitment::insert(entity_request($array));
            return new Response(json_encode(
                            array('status'=>'success' ,'msg'=>'ok','type'=>$array['type'])),'200',
                            array('Content-Type'=>'application/json'));
        }
        else {
        
            $res['menus'] = Admin\Menu\Menu::getMenu($request->route->get('path'))[0]; 
            return new Response(theme()->render('recruitment-add.html',$res));
        }
    }

    /**
     * 职位修改
     * @route /admin/recruitment/edit/{id}
     * @access  admin_access
     * @param int $id
     * @return String
     */
	public static function edit($request) {
        $id = (int)$request->route->getParameter('id');
        $res['recruitment'] = Entity\Recruitment\Recruitment::load(entity_request(array('id'=>$id)));
        if (empty($res['recruitment'])) {
            return new RedirectResponse($request->getUriForPath('/admin/recruitment/standalone'),'2',
                        '非法操作',array('Content-type'=>'text/html; charset=utf-8'));
        }        
        $res['menus'] = Admin\Menu\Menu::getMenu($request->route->get('path'))[0];
        //print_r($res['recruitment']);exit;
        return new Response(theme()->render('recruitment-edit.html',$res));
    }
   
    /**
     * 游戏更新
     * @route /admin/recruitment/update
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
                            array('status'=>'error' ,'msg'=>'职位名称必须填写')),'200',
                            array('Content-Type'=>'application/json'));
            }
            if (empty($array['type'])) {
                return new Response(json_encode(
                            array('status'=>'error' ,'msg'=>'请选择职位分类')),'200',
                            array('Content-Type'=>'application/json'));
            }
            */
			Entity\Recruitment\Recruitment::update(entity_request($array));
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
	 * 删除职位
     * @route /admin/recruitment/delete/{id}
     * @access  admin_access
     * @param int $id
	 * @return redirect
	 */
	public static function delete($request) {       
		$id = (int)$request->route->getParameter('id');
		if ($id) {			
            db_update("recruitment")
                ->fields(array('status'=>'0','updated'=>time()))
                ->condition("id",$id)
                ->execute();
            return new RedirectResponse($request->getUriForPath('/admin/recruitment/search'),'0','成功');
        }
        else {
            return new RedirectResponse($request->getUriForPath('/admin/recruitment/search'),'0',lang('非法操作'));
        }

	}
    
    /**
	 * 刷新职位
     * @route /admin/recruitment/flush/{id}
     * @access  admin_access
     * @param int $id
	 * @return redirect
	 */
	public static function positionFlush($request) {       
		$id = (int)$request->route->getParameter('id');
		if ($id) {			
            db_update("recruitment")
                ->fields(array('updated'=>time()))
                ->condition("id",$id)
                ->execute();
            return new RedirectResponse($request->getUriForPath('/admin/recruitment/search'),'0','成功');
        }
        else {
            return new RedirectResponse($request->getUriForPath('/admin/recruitment/search'),'0',lang('非法操作'));
        }

	}
    
}