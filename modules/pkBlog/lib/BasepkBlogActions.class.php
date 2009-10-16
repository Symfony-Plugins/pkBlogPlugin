<?php

/**
 * Base actions for the pkBlogPlugin pkBlog module.
 * 
 * @package     pkBlogPlugin
 * @subpackage  pkBlog
 * @author      Your name here
 * @version     SVN: $Id: BaseActions.class.php 12628 2008-11-04 14:43:36Z Kris.Wallsmith $
 */
abstract class BasepkBlogActions extends pkBlogPluginEngineActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $pager = new sfDoctrinePager('pkBlogPost', sfConfig::get('app_pkBlog_max_per_page', 10));
    $pager->setQuery(Doctrine::getTable('pkBlogPost')->buildQuery($request));
    $pager->setPage($this->getRequestParameter('page', 1));
    $pager->init();
    
    $this->pk_blog_posts = $pager;

    $this->buildParams();

    // We want to include a link to the feed with the filters the user has enabled...
    // but it shouldn't be filtering by any of the date information, just tags/categories
    $feedParams = $this->params['pagination'];
    unset($feedParams['year']);
    unset($feedParams['month']);
    unset($feedParams['day']);
        
    pkFeed::addFeed($request, pkUrl::addParams('pkBlogFeed/posts', $feedParams));
  }
  
  public function executeShow(sfWebRequest $request)
  {
    $this->pk_blog_post = Doctrine::getTable('pkBlogPost')->findOneBySlug($this->getRequest()->getParameter('slug'));
    $this->forward404Unless($this->pk_blog_post);

    $this->buildParams();
  }
}
