<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class PluginpkBlogPost extends BasepkBlogPost
{
  public function getPermalink()
  {
    sfContext::getInstance()->getConfiguration()->loadHelpers('Url');
    return url_for('pk_blog_post', $this, false);
  }
}