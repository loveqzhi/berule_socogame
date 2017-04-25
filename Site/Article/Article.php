<?php
/**
 * @ file article.php
 * @ update 20150122
 */
namespace Site\Article;

use Pyramid\Component\HttpFoundation\Response;
use Pyramid\Component\HttpFoundation\RedirectResponse;
use Entity;
use Site;

class Article {

    /**
     * 新闻动态
     * @route /news
     * @access
     * @param  int  size 
     * @param  int  page
     * @return string 
     */
    public static function news($request) {
    
        //conditions
        //$request->setParameter('size',2);
        $request->setParameter('conditions',array(
            'type'     => array('value' => 'news'),
            'status'   => array('value' => 1),
        ));
        $request->setParameter('orderBys', array('timeline'=>array('value'=>'DESC')));
        $res['list']    = Entity\Article\Article::search($request);
        $res['sidebar'] = Site\Index\Index::getSidebar('索乐动态',$request);
        return new Response(theme()->render('news.html',$res));
    }
    
    /**
     * 新闻动态 详情
     * @route /news/show/{id}
     * @access
     * @param  int  id   新闻ID
     * @return string 
     */
    public static function newsDetail($request) {
        $id = (int) $request->route->getParameter('id');
        $article = Entity\Article\Article::load(entity_request(array('id'=>$id)));
        if (empty($article) || $article->status == 0) {
            return new Response(true,404);
        }
		$article->content = preg_replace_callback(
                        '|<img[^>]+style[^>]+>|is',
                        function($matches){ return str_replace('style','_style',$matches[0]); },
                        str_replace(array('white-space: nowrap;','white-space: normal;'), '', $article->content)
                       );
        $res['article'] = $article;
        $res['sidebar'] = Site\Index\Index::getSidebar('索乐动态',$request);
        return new Response(theme()->render('news-detail.html',$res));
    }
    
    /**
     * 游戏资讯
     * @route /game
     * @access
     * @param  int  size 
     * @param  int  page
     * @return string 
     */
    public static function game($request) {
        $request->setParameter('conditions',array(
            'type'   => array('value' => 'game'),
            'status' => array('value' => 1),
        ));
        $request->setParameter('orderBys', array('timeline'=>array('value'=>'DESC')));
        $res['list']    = Entity\Article\Article::search($request);
        $res['sidebar'] = Site\Index\Index::getSidebar('索乐动态',$request);
        return new Response(theme()->render('game.html',$res));
    }
    
    /**
     * 游戏资讯 详情
     * @route /game/show/{id}
     * @access
     * @param  int  id   新闻ID
     * @return string 
     */
    public static function gameDetail($request) {
        $id = (int) $request->route->getParameter('id');
        $article = Entity\Article\Article::load(entity_request(array('id'=>$id)));
        if (empty($article) || $article->status == 0) {
            return new Response(true,404);
        }
        $res['article'] = $article;
        $res['sidebar'] = Site\Index\Index::getSidebar('索乐动态',$request);
        return new Response(theme()->render('news-detail.html',$res));
    }

    

}