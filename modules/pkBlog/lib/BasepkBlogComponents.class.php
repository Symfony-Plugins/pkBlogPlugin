<?php

/**
 * Base actions for the pkBlogPlugin pkBlog module.
 * 
 * @package     pkBlogPlugin
 * @subpackage  pkBlog
 * @author      Your name here
 * @version     SVN: $Id: BaseComponents.class.php 12628 2008-11-04 14:43:36Z Kris.Wallsmith $
 */
abstract class BasepkBlogComponents extends sfComponents
{
  public function executeRecentPosts()
  {
    $q = Doctrine::getTable('pkBlogPost')
      ->createQuery('p')
      ->addWhere('p.published = ?', true)
      ->orderBy('p.published_at')
      ->limit(5);
    
    $this->pk_blog_posts = $q->execute();
  }

  public function executeTagSidebar($request)
  {
    if ($this->getRequestParameter('tag'))
    {
      $this->tag = TagTable::findOrCreateByTagname($this->getRequestParameter('tag'));
    }
    
    $this->popular = TagTable::getAllTagNameWithCount(null, array('model' => 'pkBlogPost', 'sort_by_popularity' => true, 'limit' => 10));

    $this->tags = TagTable::getAllTagNameWithCount(null, array('model' => 'pkBlogPost'));
    
    $this->categories = Doctrine::getTable('pkBlogCategory')
      ->createQuery('c')
      ->orderBy('c.name')
      ->execute();
  }
}
