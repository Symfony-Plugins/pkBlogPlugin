<?php

/**
 * Base actions for the pkBlogPlugin pkContextCMSBlogEvent module.
 * 
 * @package     pkBlogPlugin
 * @subpackage  pkContextCMSBlogEvent
 * @author      Your name here
 * @version     SVN: $Id: BaseActions.class.php 12628 2008-11-04 14:43:36Z Kris.Wallsmith $
 */
abstract class BasepkContextCMSBlogEventActions extends pkContextCMSBaseActions
{
  public function executeEdit(sfRequest $request)
  {
    $this->editSetup();

    $this->slot->value = $this->getRequestParameter('pk_blog_event_id-' . $this->id);

    return $this->editSave();
  }
  
}
