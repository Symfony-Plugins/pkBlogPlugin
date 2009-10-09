<?php

/**
 * Base actions for the pkBlogPlugin pkContextCMSBlogPost module.
 * 
 * @package     pkBlogPlugin
 * @subpackage  pkContextCMSBlogPost
 * @author      Your name here
 * @version     SVN: $Id: BaseComponents.class.php 12628 2008-11-04 14:43:36Z Kris.Wallsmith $
 */
abstract class BasepkContextCMSBlogPostComponents extends pkContextCMSBaseComponents
{
  public function executeEditView()
  {
    $this->setup();
    
    $q = Doctrine::getTable('pkBlogPost')
      ->createQuery('p')
      ->orderBy('p.title');
    
    $this->pk_blog_posts = array();
    foreach ($q->execute() as $post)
    {
      $this->pk_blog_posts[$post->getId()] = $post->getTitle();
    }
  }

  public function executeNormalView()
  {
    $this->setup();

    $this->pk_blog_post = Doctrine::getTable('pkBlogPost')->find($this->slot->value);
  }
}
