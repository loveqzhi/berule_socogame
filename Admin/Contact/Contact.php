<?php

namespace Admin\Contact;

use Pyramid\Component\HttpFoundation\Response;
use Pyramid\Component\HttpFoundation\RedirectResponse;
use Entity;
use Admin;

class Contact {
    
    /**
     * 列表
     * @route /admin/contact/search
     * @access  admin_access
     * @param int $page     当前页数
     * @param int $size     每页显示数量
     * @param int $status   状态
     * @return String
     */
    public static function search($request) {
        //conditions
        $request->setParameter('conditions',array(
            'status'    => array('value' => $request->get('status',1)),
        ));
        $res = array(
            'menus' => Admin\Menu\Menu::getMenu($request->route->get('path'))[0],
            'list'  => Entity\Contact\Contact::search($request),
        );

        return new Response(theme()->render('contact-search.html',$res));  
    }

    /**
     * 添加联系人
     * @route /admin/contact/add
     * @access  admin_access
     * @param  string name     职位名称
     * @param  string email    电子邮件
     * @param  string department   部门
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
                            array('status'=>'error' ,'msg'=>'联系人姓名必须填写')),'200',
                            array('Content-Type'=>'application/json'));
            }
            if (empty($array['email'])) {
                return new Response(json_encode(
                            array('status'=>'error' ,'msg'=>'邮箱必须填写')),'200',
                            array('Content-Type'=>'application/json'));
            }
            if (empty($array['department'])) {
                return new Response(json_encode(
                            array('status'=>'error' ,'msg'=>'部门必须填写')),'200',
                            array('Content-Type'=>'application/json'));
            }
            */
            Entity\Contact\Contact::insert(entity_request($array));
            return new Response(json_encode(
                            array('status'=>'success' ,'msg'=>'ok','type'=>$array['type'])),'200',
                            array('Content-Type'=>'application/json'));
        }
        else {
        
            $res['menus'] = Admin\Menu\Menu::getMenu($request->route->get('path'))[0]; 
            return new Response(theme()->render('contact-add.html',$res));
        }
    }

    /**
     * 修改
     * @route /admin/contact/edit/{id}
     * @access  admin_access
     * @param int $id
     * @return String
     */
	public static function edit($request) {
        $id = (int)$request->route->getParameter('id');
        $res['contact'] = Entity\Contact\Contact::load(entity_request(array('id'=>$id)));
        if (empty($res['contact'])) {
            return new RedirectResponse($request->getUriForPath('/admin/contact/search'),'2',
                        '非法操作',array('Content-type'=>'text/html; charset=utf-8'));
        }        
        $res['menus'] = Admin\Menu\Menu::getMenu($request->route->get('path'))[0];
        //print_r($res['contact']);exit;
        return new Response(theme()->render('contact-edit.html',$res));
    }
   
    /**
     * 更新
     * @route /admin/contact/update
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
                            array('status'=>'error' ,'msg'=>'联系人姓名必须填写')),'200',
                            array('Content-Type'=>'application/json'));
            }
            if (empty($array['email'])) {
                return new Response(json_encode(
                            array('status'=>'error' ,'msg'=>'邮箱必须填写')),'200',
                            array('Content-Type'=>'application/json'));
            }
            if (empty($array['department'])) {
                return new Response(json_encode(
                            array('status'=>'error' ,'msg'=>'部门必须填写')),'200',
                            array('Content-Type'=>'application/json'));
            }
            */
			Entity\Contact\Contact::update(entity_request($array));
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
     * @route /admin/contact/delete/{id}
     * @access  admin_access
     * @param int $id
	 * @return redirect
	 */
	public static function delete($request) {       
		$id = (int)$request->route->getParameter('id');
		if ($id) {			
            db_update("contact")
                ->fields(array('status'=>'0','updated'=>time()))
                ->condition("id",$id)
                ->execute();
            return new RedirectResponse($request->getUriForPath('/admin/contact/search'),'0','成功');
        }
        else {
            return new RedirectResponse($request->getUriForPath('/admin/contact/search'),'0',lang('非法操作'));
        }

	}
    
}