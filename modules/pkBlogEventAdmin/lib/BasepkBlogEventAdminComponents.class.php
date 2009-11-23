<?php

require_once dirname(__FILE__).'/pkBlogEventAdminGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/pkBlogEventAdminGeneratorHelper.class.php';

/**
 * pkBlogEventAdmin actions.
 *
 * @package    pkBlogPlugin
 * @subpackage pkBlogEventAdmin
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class BasepkBlogEventAdminComponents extends sfComponents
{
  public function executeTagList(sfRequest $request)
  {
    $this->tags = TagTable::getAllTagNameWithCount(null, array('model' => 'pkBlogEvent', 'sort_by_popularity' => true, 'limit' => 10));

    if (!$this->pk_blog_event = Doctrine::getTable('pkBlogEvent')->find($request->getParameter('id')))
    {
      $this->pk_blog_event = new pkBlogEvent();
    }
  }
}
