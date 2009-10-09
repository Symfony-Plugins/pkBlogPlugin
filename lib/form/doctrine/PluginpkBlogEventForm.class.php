<?php

/**
 * PluginpkBlogEvent form.
 *
 * @package    form
 * @subpackage pkBlogEvent
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
abstract class PluginpkBlogEventForm extends BasepkBlogEventForm
{
  public function configure()
  {
    unset(
      $this['created_at'],
      $this['updated_at'],
      $this['slug'],
      $this['type'],
      $this['version'],
      $this['published_at'],
      $this['media']
    );

    if (!$this->getObject()->isNew())
    {
      unset($this['published']);
    }

    $this->widgetSchema['author_id'] = new sfWidgetFormInputHidden();
    $this->setDefault('author_id', sfContext::getInstance()->getUser()->getGuardUser()->getId());

    $this->widgetSchema['excerpt'] = new sfWidgetFormRichTextarea(array('editor' => 'fck', 'height' => '200', 'width' => '360',  ));
	  $this->widgetSchema['body']  = new sfWidgetFormRichTextarea(array('editor' => 'fck', 'height' => '400', 'width' => '360',  ));
    
    $this->widgetSchema['category_id']->setLabel('Category');
    
    $this->widgetSchema['start_date'] = new sfWidgetFormJQueryDate();
    $this->widgetSchema['end_date'] = new sfWidgetFormJQueryDate();
    
    $this->widgetSchema['tags'] = new sfWidgetFormInput(array('default' => implode(', ', $this->getObject()->getTags())), array('class' => 'tag-input', 'autocomplete' => 'off'));
		$this->validatorSchema['tags'] = new sfValidatorString(array('required' => false));
  }

	public function doSave($con = null)
	{
	  $tags = $this->values['tags'];
    $tags = preg_replace('/\s\s+/', ' ', $tags);
    $tags = str_replace(', ', ',', $tags);

		$this->object->setTags($tags);
    
		parent::doSave($con);
	}
}