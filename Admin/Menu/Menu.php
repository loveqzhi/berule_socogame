<?php 

/**
 * @ file menu
 * @ 返回用户可见权限菜单
 * @ return authentication menu
 */
namespace Admin\Menu;
use Entity;

class Menu { 
    /**
     * 获取菜单
     * @route
     * @access 
     * @param 
     * @return array 
     */
    public static function getMenu($route) {
        $path = '/' . $route;
        $menus = self::setMenus();
        $admin = Entity\Admin\Admin::load(entity_request(array('id'=>session()->get('admin')->id)));
        foreach ($menus as $k=>$v) {
            if(strpos($path,dirname($v['href']))!==false) {
                $menus[$k]['active'] = true;
            }
            foreach($v['childs'] as $kk => $vv) {
                if (!isset($admin->permissions[$vv['href']])) {
                    unset($menus[$k]['childs'][$kk]);
                }
            }
            
            if (empty($menus[$k]['childs']))
                unset($menus[$k]);

        }
        //print_r($menus);exit;
        foreach ($menus as $k => $v) {
			if($v['active'] == true) {
				foreach ($v['childs'] as $kk => $vv) {
					if ($vv['href'] == $path || strpos($path,$vv['href'])!==false) {
						$menus[$k]['childs'][$kk]['active'] = true;						
					}
				}
                return array($menus, $menus[$k]);
			}
        }
        $route = dirname($route);
        if ($route == '.' || $route == '/' || $route == '\\') {
            return array($menus, array());
        } else {
            return self::getMenu($route);
        }
    }
    /**
     * 设置路由
     * @route 
     * @access 
     * @param 
     * @return array 
     */
    public static function setMenus(){
        return array(
                '1' => array(
                    'name'   => '索乐动态',
                    'href'   => '/admin/article/news',
                    'icon'   => 'fa-newspaper-o',
                    'active' => false,
                    'childs' => array(
                        array(
                            'name'   => '新闻动态',
                            'href'   => '/admin/article/news',
                            'icon'   => 'fa-user',
                            'active' => false,
                        ),
						array(
                            'name'   => '品牌资讯',
                            'href'   => '/admin/article/game',
                            'icon'   => 'fa-pencil',
                            'active' => false,
                        ),
					),
				),
                '2' => array(
                    'name'   => '游戏产品',
                    'href'   => '/admin/game/standalone',
                    'icon'   => 'fa-gamepad',
                    'active' => false,
                    'childs' => array(
                        array(
                            'name'   => '单机游戏',
                            'href'   => '/admin/game/standalone',
                            'icon'   => 'fa-user',
                            'active' => false,
                        ),
						array(
                            'name'   => '手机网游',
                            'href'   => '/admin/game/online',
                            'icon'   => 'fa-pencil',
                            'active' => false,
                        ),
                        array(
                            'name'   => '网页游戏',
                            'href'   => '/admin/game/webgame',
                            'icon'   => 'fa-pencil',
                            'active' => false,
                        ),
					),
				),
                '3' => array(
                    'name'   => '文化产品',
                    'href'   => '/admin/culture/cartoon',
                    'icon'   => 'fa-cubes',
                    'active' => false,
                    'childs' => array(                       
                        array(
                            'name'   => '动画产品',
                            'href'   => '/admin/culture/cartoon',
                            'icon'   => 'fa-user',
                            'active' => false,
                        ),
						array(
                            'name'   => '音乐作品',
                            'href'   => '/admin/culture/music',
                            'icon'   => 'fa-pencil',
                            'active' => false,
                        ),
                        array(
                            'name'   => '图书绘本',
                            'href'   => '/admin/culture/caricature',
                            'icon'   => 'fa-user',
                            'active' => false,
                        ),
						array(
                            'name'   => '更多产品',
                            'href'   => '/admin/culture/other',
                            'icon'   => 'fa-pencil',
                            'active' => false,
                        ),
                        array(
                            'name'   => '游戏产品',
                            'href'   => '/admin/culture/game/search',
                            'icon'   => 'fa-pencil',
                            'active' => false,
                        ),
					),
				),
                '4' => array(
                    'name'   => '招贤纳士',
                    'href'   => '/admin/recruitment/search',
                    'icon'   => 'fa-paw',
                    'active' => false,
                    'childs' => array(
                        array(
                            'name'   => '在招岗位',
                            'href'   => '/admin/recruitment/search',
                            'icon'   => 'fa-user',
                            'active' => false,
                        ),
                        /*
						array(
                            'name'   => '人才理念',
                            'href'   => '/admin/recruitment/talents',
                            'icon'   => 'fa-pencil',
                            'active' => false,
                        ),
                        */
					),
				),
                '5' => array(
                    'name'   => '联系我们',
                    'href'   => '/admin/contact/search',
                    'icon'   => 'fa-phone',
                    'active' => false,
                    'childs' => array(
                        array(
                            'name'   => '商务合作',
                            'href'   => '/admin/contact/search',
                            'icon'   => 'fa-user',
                            'active' => false,
                        ),
 
					),
				),
                '6' => array(
                    'name'   => '图片管理',
                    'href'   => '/admin/picture/home',
                    'icon'   => 'fa-file-image-o',
                    'active' => false,
                    'childs' => array(
                        array(
                            'name'   => '首页横幅',
                            'href'   => '/admin/picture/home',
                            'icon'   => 'fa-user',
                            'active' => false,
                        ),
                        array(
                            'name'   => '集团成员',
                            'href'   => '/admin/picture/member',
                            'icon'   => 'fa-user',
                            'active' => false,
                        ),
                        array(
                            'name'   => '新闻栏目',
                            'href'   => '/admin/picture/news',
                            'icon'   => 'fa-pencil',
                            'active' => false,
                        ),
                        array(
                            'name'   => '游戏产品',
                            'href'   => '/admin/picture/game',
                            'icon'   => 'fa-pencil',
                            'active' => false,
                        ),
                        array(
                            'name'   => '文化产品',
                            'href'   => '/admin/picture/culture',
                            'icon'   => 'fa-pencil',
                            'active' => false,
                        ),
                        array(
                            'name'   => '合作品牌',
                            'href'   => '/admin/picture/partner',
                            'icon'   => 'fa-pencil',
                            'active' => false,
                        ),
                        array(
                            'name'   => '员工风采',
                            'href'   => '/admin/picture/staff',
                            'icon'   => 'fa-user',
                            'active' => false,
                        ),
 
					),
				),
                '98' => array(
                    'name'   => '管理员管理',
                    'href'   => '/admin/user/search',
                    'icon'   => 'fa-users',
                    'active' => false,
                    'childs' => array(
                        array(
                            'name'   => '用户列表',
                            'href'   => '/admin/user/search',
                            'icon'   => 'fa-user',
                            'active' => false,
                        ),
						array(
                            'name'   => '新增用户',
                            'href'   => '/admin/user/add',
                            'icon'   => 'fa-pencil',
                            'active' => false,
                        ),
					),
				),
                '99' => array(
                    'name'   => '角色管理',
                    'href'   => '/admin/role/search',
                    'icon'   => 'fa-wrench',
                    'active' => false,
                    'childs' => array(                       
                        array(
                            'name'   => '角色列表',
                            'href'   => '/admin/role/search',
                            'icon'   => 'fa-reorder',
                            'active' => false,
                        ),
						array(
                            'name'   => '添加角色',
                            'href'   => '/admin/role/add',
                            'icon'   => 'fa-pencil',
                            'active' => false,
                        ),
                    ),
                ),
        
        );
    }
}