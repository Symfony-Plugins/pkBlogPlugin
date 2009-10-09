<?php

/**
 * Base actions for the pkBlogPlugin pkBlog module.
 * 
 * @package     pkBlogPlugin
 * @subpackage  pkBlog
 * @author      Your name here
 * @version     SVN: $Id: BaseActions.class.php 12628 2008-11-04 14:43:36Z Kris.Wallsmith $
 */
abstract class BasepkBlogActions extends pkContextCMSEngineActions
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
    
    $this->forward('pkBlog', 'index');
  }
  
  public function executeIndex(sfWebRequest $request)
  {
    $pager = new sfDoctrinePager('pkBlogPost', sfConfig::get('app_pkBlog_max_per_page', 10));
    $pager->setQuery(Doctrine::getTable('pkBlogPost')->buildQuery($request));
    $pager->setPage($this->getRequestParameter('page', 1));
    $pager->init();
    
    $this->pk_blog_posts = $pager;

    $this->buildParams();

    $feedParams = $this->params['pagination'];
    unset($feedParams['year']);
    unset($feedParams['month']);
    unset($feedParams['day']);
        
    pkFeed::addFeed($request, pkUrl::addParams('pkBlogFeed/posts', $feedParams));
  }
  
  public function executeShow(sfWebRequest $request)
  {
    $this->pk_blog_post = Doctrine::getTable('pkBlogPost')->findOneBySlug($this->getRequest()->getParameter('slug'));

    $this->buildParams();
  }
  
  public function buildParams()
  {
    $this->params = array();

    // set our parameters for building pagination links
    $this->params['pagination']['year']  = $this->getRequestParameter('year');
    $this->params['pagination']['month'] = $this->getRequestParameter('month');
    $this->params['pagination']['day']   = $this->getRequestParameter('day');
    
    $date = strtotime($this->getRequestParameter('year', date('Y')).'-'.$this->getRequestParameter('month', date('m')).'-'.$this->getRequestParameter('day', date('d')));
    
    $this->dateRange = '';
    // set our parameters for building links that browse date ranges
    if ($this->getRequestParameter('day'))
    {
      $next = strtotime('tomorrow', $date);
      $this->params['next'] = array('year' => date('Y', $next), 'month' => date('m', $next), 'day' => date('d', $next));
      
      $prev = strtotime('yesterday', $date);
      $this->params['prev'] = array('year' => date('Y', $prev), 'month' => date('m', $prev), 'day' => date('d', $prev));
      
      $this->dateRange = 'day';
    }
    else if ($this->getRequestParameter('month'))
    {
      $next = strtotime('next month', $date);
      $this->params['next'] = array('year' => date('Y', $next), 'month' => date('m', $next));
      
      $prev = strtotime('last month', $date);
      $this->params['prev'] = array('year' => date('Y', $prev), 'month' => date('m', $prev));

      $this->dateRange = 'month';
    }
    else
    {
      $next = strtotime('next year', $date);
      $this->params['next'] = array('year' => date('Y', $next));
      
      $prev = strtotime('last year', $date);
      $this->params['prev'] = array('year' => date('Y', $prev));

      if ($this->getRequestParameter('year'))
      {
        $this->dateRange = 'year';
      }
    }
    
    // set our parameters for building links that set the date ranges
    $this->params['day'] = array('year' => date('Y', $date), 'month' => date('m', $date), 'day' => date('d', $date));
    $this->params['month'] = array('year' => date('Y', $date), 'month' => date('m', $date));
    $this->params['year'] = array('year' => date('Y', $date));
    $this->params['nodate'] = array();
    
    $this->addFilterParams('cat');
    $this->addFilterParams('tag');
    $this->addFilterParams('search');
  }
  
  public function addFilterParams($name)
  {
    // if there is a filter request, we need to add it to our date params
    if ($this->getRequestParameter($name))
    {
      foreach ($this->params as &$params)
      {
        $params[$name] = $this->getRequestParameter($name);
      }
    }
    
    // set an array for building a link to this filter (we don't want it to already have the filter in there)
    $this->params[$name] = $this->params['pagination'];
    unset($this->params[$name][$name]);
  }
}
