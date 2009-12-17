<?php

/**
 * Base actions for the pkBlogPlugin pkCalendar module.
 * 
 * @package     pkBlogPlugin
 * @subpackage  pkCalendar
 * @author      Your name here
 * @version     SVN: $Id: BaseActions.class.php 12628 2008-11-04 14:43:36Z Kris.Wallsmith $
 */
abstract class BasepkCalendarActions extends pkBlogPluginEngineActions
{
   public function executeIndex(sfWebRequest $request)
   {
     $this->buildParams();

     $pager = new sfDoctrinePager('pkBlogEvent', sfConfig::get('app_pkCalendar_max_per_page', 10));
     $pager->setQuery(Doctrine::getTable('pkBlogEvent')->buildQuery($request));
     $pager->setPage($this->getRequestParameter('page', 1));
     $pager->init();

     $this->pk_blog_events = $pager;
   }

   public function executeShow(sfWebRequest $request)
   {
     $this->pk_blog_event = Doctrine::getTable('pkBlogEvent')->findOneBySlug($this->getRequest()->getParameter('slug'));
     $this->forward404Unless($this->pk_blog_event);

     $this->buildParams();
   }
}
