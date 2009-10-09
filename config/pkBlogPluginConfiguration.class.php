<?php

/**
 * pkBlogPlugin configuration.
 * 
 * @package     pkBlogPlugin
 * @subpackage  config
 * @author      Your name here
 * @version     SVN: $Id: PluginConfiguration.class.php 12675 2008-11-06 08:07:42Z Kris.Wallsmith $
 */
class pkBlogPluginConfiguration extends sfPluginConfiguration
{
  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    // Register an event so we can add our buttons to the set of global CMS back end admin buttons
    // that appear when the apostrophe is clicked. 
    $this->dispatcher->connect('pkContextCMS.getGlobalButtons', array('pkBlogPluginTools', 
      'getGlobalButtons'));
  }
}
