<?php

/**
 * Base actions for the pkBlogPlugin pkCalendar module.
 * 
 * @package     pkBlogPlugin
 * @subpackage  pkCalendar
 * @author      Your name here
 * @version     SVN: $Id: BaseActions.class.php 12628 2008-11-04 14:43:36Z Kris.Wallsmith $
 */
abstract class BasepkCalendarActions extends pkContextCMSEngineActions
{
   /**
    * Executes today action
    *
    * Forwards to the index action with today's date as request params.
    */
   public function executeToday(sfWebRequest $request)
   {
     $request->setParameter('day', date('d'));
     $request->setParameter('month', date('m'));
     $request->setParameter('year', date('Y'));

     $this->forward('pkCalendar', 'index');
   }

  /**
   * Executes index action
   *
   * @param sfRequest $request A request object
   */
   public function executeIndex(sfWebRequest $request)
   {
     $this->buildParams();

     $pager = new sfDoctrinePager('pkBlogEvent', sfConfig::get('app_pkCalendar_max_per_page', 10));
     $pager->setQuery($this->buildQuery());
     $pager->setPage($this->getRequestParameter('page', 1));
     $pager->init();

     $this->events = $pager;

 		 pkFeed::addFeed($request, pkUrl::addParams('pkCalendar/index?format=rss', $this->params['pagination']));
   }

   public function executeShow(sfWebRequest $request)
   {
 		 $this->event = $this->getRoute()->getObject();
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

   public function buildParams()
   {
     $this->params = array();

     // get the requested date and set our parameters for building pagination links
     $this->params['pagination']['year'] = $this->getRequestParameter('year');

     $this->params['pagination']['month'] = $this->getRequestParameter('month');
     $this->params['pagination']['day']   = $this->getRequestParameter('day');

     $this->date = strtotime($this->getRequestParameter('year', date('Y')) . '-'
                 . $this->getRequestParameter('month', date('m')) . '-'
                 . $this->getRequestParameter('day', date('d')));

     $this->forward404Unless($this->date);

     $this->dateRange = '';
     // set our parameters for building links that browse date ranges
     if ($this->getRequestParameter('day'))
     {
       $this->next = strtotime('tomorrow', $this->date);
       $this->params['next'] = array('year' => date('Y', $this->next), 'month' => date('m', $this->next), 'day' => date('d', $this->next));

       $this->prev = strtotime('yesterday', $this->date);
       $this->params['prev'] = array('year' => date('Y', $this->prev), 'month' => date('m', $this->prev), 'day' => date('d', $this->prev));

       $this->dateRange = 'day';
     }
     else if ($this->getRequestParameter('month'))
     {
       $this->next = strtotime('next month', $this->date);
       $this->params['next'] = array('year' => date('Y', $this->next), 'month' => date('m', $this->next));

       $this->prev = strtotime('last month', $this->date);
       $this->params['prev'] = array('year' => date('Y', $this->prev), 'month' => date('m', $this->prev));

       $this->dateRange = 'month';
     }
     else
     {
       $this->next = strtotime('next year', $this->date);
       $this->params['next'] = array('year' => date('Y', $this->next));

       $this->prev = strtotime('last year', $this->date);
       $this->params['prev'] = array('year' => date('Y', $this->prev));

       if ($this->getRequestParameter('year'))
       {
         $this->dateRange = 'year';
       }
     }

     // set our parameters for building links that set the date ranges
     $this->params['day'] = array('year' => date('Y', $this->date), 'month' => date('m', $this->date), 'day' => date('d', $this->date));
     $this->params['month'] = array('year' => date('Y', $this->date), 'month' => date('m', $this->date));
     $this->params['year'] = array('year' => date('Y', $this->date));

     // if there are tags present in the request, we need to add them to our date params
     if ($this->getRequestParameter('tags'))
     {
       foreach ($this->params as &$params)
       {
         $params['tags'] = $this->getRequestParameter('tags');
       }
     }

     // set an array for building links to tags (it should already have tags in this one)
     $this->params['tags'] = $this->params['pagination'];
     unset($this->params['tags']['tags']);

     // if there is a search request, we need to add it to our date params
     if ($this->getRequestParameter('search'))
     {
       foreach ($this->params as &$params)
       {
         $params['search'] = $this->getRequestParameter('search');
       }
     }

     // set an array for building search action (we don't want it to have the query in there)
     $this->params['search'] = $this->params['pagination'];
     unset($this->params['search']['search']);

     // TBB: reasonable time horizons to keep Google Appliance from spinning off into 2050.
     // If this is a problem, make sure you still apply it when the useragent is dukecrawler.
     // Take care to kill BOTH buttons if they somehow wind up in the distant past or
     // far future. No going for long walkies
     $year = date('Y');
     if (($this->params['next']['year'] < ($year - 3)) || ($this->params['next']['year'] > ($year + 2)))
     {
       unset($this->params['next']);
     }
     if (($this->params['prev']['year'] < ($year - 3)) || ($this->params['prev']['year'] > ($year + 2)))
     {
       unset($this->params['prev']);
     } 
   }
}
