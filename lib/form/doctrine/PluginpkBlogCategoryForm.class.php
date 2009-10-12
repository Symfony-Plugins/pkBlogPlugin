<?php

/**
 * PluginpkBlogCategory form.
 *
 * @package    form
 * @subpackage pkBlogCategory
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
abstract class PluginpkBlogCategoryForm extends BasepkBlogCategoryForm
{
  public function setup()
  {
    parent::setup();

    unset(
      $this['created_at'],
      $this['updated_at']
    );

	  $this->widgetSchema['description'] = new sfWidgetFormRichTextarea(array('editor' => 'fck', 'height' => '200', 'width' => '360'));
  }
}