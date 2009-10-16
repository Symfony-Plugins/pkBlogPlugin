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
     $pager->setQuery($this->buildQuery());
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

   public function buildQuery()
   {
     if ($this->getRequestParameter('tags'))
     {
       $q = TagTable::getObjectTaggedWithQuery('pkBlogEvent', $this->getRequestParameter('tags'));
     }
     else
     {
       $q = Doctrine_Query::create()->from('pkBlogEvent a');
     }

     if ($this->getRequestParameter('search'))
     {
       $q = Doctrine::getTable('pkBlogEvent')->addSearchQuery($q, $this->getRequestParameter('search'));
     }

     $rootAlias = $q->getRootAlias();

     $q->addWhere($rootAlias.'.start_date > ?', $this->getRequestParameter('year', date('Y')).'-'.$this->getRequestParameter('month', 1).'-'.$this->getRequestParameter('day', 1).' 0:00:00')
       ->addWhere($rootAlias.'.start_date < ?', $this->getRequestParameter('year', date('Y')).'-'.$this->getRequestParameter('month', 12).'-'.$this->getRequestParameter('day', 31).' 23:59:59');

     $q->addWhere($q->getRootAlias().'.published = ?', true);

     $q->orderBy($rootAlias.'.start_date asc');

     return $q;
   }
}
