<?php

/**
 * Base Components for the pkBlogPlugin pkCalendar module.
 * 
 * @package     pkBlogPlugin
 * @subpackage  pkCalendar
 * @author      Your name here
 * @version     SVN: $Id: BaseComponents.class.php 12628 2008-11-04 14:43:36Z Kris.Wallsmith $
 */
abstract class BasepkCalendarComponents extends sfComponents
{
  public function executeTagSidebar($request)
  {
    if ($this->getRequestParameter('tag'))
    {
      $this->tag = TagTable::findOrCreateByTagname($this->getRequestParameter('tag'));
    }
    
    $this->popular = TagTable::getAllTagNameWithCount(null, array('model' => 'pkBlogEvent', 'sort_by_popularity' => true, 'limit' => 10));

    $this->tags = TagTable::getAllTagNameWithCount(null, array('model' => 'pkBlogEvent'));
    
    $this->categories = Doctrine::getTable('pkBlogCategory')
      ->createQuery('c')
      ->orderBy('c.name')
      ->execute();
  }
}
