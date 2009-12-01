<?php

/**
 * Base actions for the pkBlogPlugin pkContextCMSBlogEvent module.
 * 
 * @package     pkBlogPlugin
 * @subpackage  pkContextCMSBlogEvent
 * @author      Your name here
 * @version     SVN: $Id: BaseComponents.class.php 12628 2008-11-04 14:43:36Z Kris.Wallsmith $
 */
abstract class BasepkContextCMSBlogEventComponents extends pkContextCMSBaseComponents
{
  public function executeEditView()
  {
    $this->setup();
    
    $q = Doctrine::getTable('pkBlogEvent')
      ->createQuery('e')
      ->orderBy('e.title');
    
    $this->pk_blog_events = array();
    foreach ($q->execute() as $event)
    {
      $this->pk_blog_events[$event->getId()] = $event->getTitle();
    }
  }

  public function executeNormalView()
  {
    $this->setup();

    $this->pk_blog_event = Doctrine::getTable('pkBlogEvent')->find($this->slot->value);
  }
}
