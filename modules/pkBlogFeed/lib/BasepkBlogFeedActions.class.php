<?php

/**
 * Base actions for the pkBlogPlugin pkBlogFeed module.
 * 
 * @package     pkBlogPlugin
 * @subpackage  pkBlogFeed
 * @author      Your name here
 * @version     SVN: $Id: BaseActions.class.php 12628 2008-11-04 14:43:36Z Kris.Wallsmith $
 */
abstract class BasepkBlogFeedActions extends sfActions
{
  public function executePosts(sfWebRequest $request)
  {
    $pager = new sfDoctrinePager('pkBlogPost', sfConfig::get('app_pkBlog_max_per_page', 10));
    $pager->setQuery(Doctrine::getTable('pkBlogPost')->buildQuery($request));
    $pager->setPage($this->getRequestParameter('page', 1));
    $pager->init();
    
    $this->articles = $pager->getResults();
    
    $this->feed = sfFeedPeer::createFromObjects(
	    $this->articles,
	    array(
	      'format'      => 'rss',
	      'title'       => sfConfig::get('app_pkBlog_feed_title'),
	      'link'        => '@pk_blog',
	      'authorEmail' => sfConfig::get('app_pkBlog_feed_author_email'),
	      'authorName'  => sfConfig::get('app_pkBlog_feed_author_name'),
	      'routeName'   => '@pk_blog_post',
	      'methods'     => array('description' => 'getBody')
	    )
	  );
	  
	  $this->setTemplate('feed');
  }
}
