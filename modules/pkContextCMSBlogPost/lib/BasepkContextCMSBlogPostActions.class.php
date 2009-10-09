<?php

/**
 * Base actions for the pkBlogPlugin pkContextCMSBlogPost module.
 * 
 * @package     pkBlogPlugin
 * @subpackage  pkContextCMSBlogPost
 * @author      Your name here
 * @version     SVN: $Id: BaseActions.class.php 12628 2008-11-04 14:43:36Z Kris.Wallsmith $
 */
abstract class BasepkContextCMSBlogPostActions extends pkContextCMSBaseActions
{
  public function executeEdit(sfRequest $request)
  {
    $this->editSetup();

    $this->slot->value = $this->getRequestParameter('pk_blog_post_id-' . $this->id);

    return $this->editSave();
  }
  
}
