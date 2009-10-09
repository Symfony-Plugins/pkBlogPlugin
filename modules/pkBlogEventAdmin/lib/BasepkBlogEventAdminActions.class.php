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
class BasepkBlogEventAdminActions extends autoPkBlogEventAdminActions
{
  public function executePublish(sfWebRequest $request)
  {
    $event = Doctrine::getTable('pkBlogEvent')->find($request->getParameter('id'));
    
    $this->forward404Unless($event instanceof pkBlogEvent);
    
    $published = ($event->togglePublish()) ? 'published' : 'unpublished';
        
    $event->save();

    $this->getUser()->setFlash('notice', 'This event was '. $published .' successfully.');
 
    $this->redirect('@pk_blog_event_admin_edit?id='. $event->getId());
  }
  
  public function executeMedia(sfWebRequest $request)
  {
    $event = Doctrine::getTable('pkBlogEvent')->find($request->getParameter('id'));
    
    $url = sfConfig::get('app_pkContextCMS_media_site', false)
         . "/media/select?"
         . http_build_query(array(
             'multiple' => true,
             'pkMediaIds' => implode(',', $event->getAttachedMediaIds()),
             'after' => 'pkBlogEventAdmin/attach?id='.$event->getId()
           ));
           
    $this->redirect($url);
  }

	public function executeAttach(sfWebRequest $request)
	{
	  $this->event = $this->getRoute()->getObject();
    $items = pkMediaAPI::getSelectedItems($request, false, false);
    
    if (!$items === false)
    {
      $this->event->setMedia(serialize($items));
    }
    else
    {
      $this->event->setMedia('');
    }
    
    $this->event->save();
    
    $notice = count($items) .' media ';
    $notice .= (count($items) > 1) ? 'items were' : 'item was';
    $notice .= ' attached to your event.';
    
    $this->getUser()->setFlash('notice', $notice);

    return $this->redirect('@pk_blog_event_admin');
	}

  public function executeSaveAndPublish(sfWebRequest $request)
  {
    $result = parent::executeCreate($request);
    
    $this->pk_blog_event->togglePublish();
    
    return $result;
  }

  public function executeBatchPublish(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');
 
    $q = Doctrine_Query::create()
      ->from('pkBlogEvent p')
      ->whereIn('p.id', $ids);
 
    foreach ($q->execute() as $event)
    {
      $event->togglePublish();
      
      $event->save();
    }
 
    $this->getUser()->setFlash('notice', 'The selected events have been published/unpublished successfully.');
 
    $this->redirect('@pk_blog_event_admin');
  }
  
}
