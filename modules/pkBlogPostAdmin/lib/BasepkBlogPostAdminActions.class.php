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
class BasepkBlogPostAdminActions extends autoPkBlogPostAdminActions
{
  public function executePublish(sfWebRequest $request)
  {
    $post = Doctrine::getTable('pkBlogPost')->find($request->getParameter('id'));
    
    $this->forward404Unless($post instanceof pkBlogPost);
    
    $published = ($post->togglePublish()) ? 'published' : 'unpublished';
        
    $post->save();

    $this->getUser()->setFlash('notice', 'This post was '. $published .' successfully.');
 
    $this->redirect('@pk_blog_post_admin_edit?id='. $post->getId());
  }
  
  public function executeMedia(sfWebRequest $request)
  {
    $post = Doctrine::getTable('pkBlogPost')->find($request->getParameter('id'));
    
    $url = sfConfig::get('app_pkMedia_client_site', false)
         . "/media/select?"
         . http_build_query(array(
             'multiple' => true,
             'pkMediaIds' => implode(',', $post->getAttachedMediaIds()),
             'after' => 'pkBlogPostAdmin/attach?id='.$post->getId()
           ));
           
    $this->redirect($url);
  }

	public function executeAttach(sfWebRequest $request)
	{
	  $this->post = $this->getRoute()->getObject();
    $items = pkMediaAPI::getSelectedItems($request, false, false);
    
    if (!$items === false)
    {
      $this->post->setMedia(serialize($items));
      $count = count($items);
    }
    else
    {
      $this->post->setMedia('');
      $count = 0;
    }
    
    $this->post->save();
    
    $notice = $count .' media ';
    $notice .= ($count > 1 || $count == 0) ? 'items were' : 'item was';
    $notice .= ' attached to your post.';
    
    $this->getUser()->setFlash('notice', $notice);

    return $this->redirect('@pk_blog_post_admin');
	}
  
  public function executeSaveAndPublish(sfWebRequest $request)
  {
    $result = parent::executeCreate($request);
    
    $this->pk_blog_post->togglePublish();
    
    return $result;
  }

  public function executeBatchPublish(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');
 
    $q = Doctrine_Query::create()
      ->from('pkBlogPost p')
      ->whereIn('p.id', $ids);
 
    foreach ($q->execute() as $post)
    {
      $post->togglePublish();
      
      $post->save();
    }
 
    $this->getUser()->setFlash('notice', 'The selected posts have been published/unpublished successfully.');
 
    $this->redirect('@pk_blog_post_admin');
  }
  
}
