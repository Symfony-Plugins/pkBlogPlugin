<?php

require_once dirname(__FILE__).'/pkBlogPostAdminGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/pkBlogPostAdminGeneratorHelper.class.php';

/**
 * pkBlogPostAdmin actions.
 *
 * @package    pkBlogPlugin
 * @subpackage pkBlogPostAdmin
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class BasepkBlogPostAdminComponents extends sfComponents
{
  public function executeTagList(sfRequest $request)
  {
    $this->tags = TagTable::getAllTagNameWithCount(null, array('model' => 'pkBlogPost', 'sort_by_popularity' => true, 'limit' => 10));

    if (!$this->pk_blog_post = Doctrine::getTable('pkBlogPost')->find($request->getParameter('id')))
    {
      $this->pk_blog_post = new pkBlogPost();
    }
  }
}
