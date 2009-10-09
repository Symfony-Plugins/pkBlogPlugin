<?php

/**
 * Base actions for the pkBlogPlugin pkContextCMSCalendar module.
 * 
 * @package     pkBlogPlugin
 * @subpackage  pkContextCMSCalendar
 * @author      Your name here
 * @version     SVN: $Id: BaseActions.class.php 12628 2008-11-04 14:43:36Z Kris.Wallsmith $
 */
abstract class BasepkContextCMSCalendarActions extends pkContextCMSBaseActions
{
  /**
   * Tags will be chose with a multiple select form element, but 
   * we simply need to save them in a comma-delimited string. This string
   * can be used to retrieve Events through the Taggable behavior stuff.
   */
  public function executeEdit(sfRequest $request)
  {
    $this->editSetup();
    $this->slot->value = implode(', ', $this->getRequestParameter('tags-' . $this->id));
    return $this->editSave();
  }

  /**
   * Executes day action
   *
   */
  public function executeDay()
  {
    $this->setup();

    return $this->renderComponent('pkContextCMSCalendar', 'normalView');
  }
}
