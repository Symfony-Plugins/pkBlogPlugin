<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PluginpkBlogEventTable extends pkBlogItemTable
{
    /**
   * Builds the query for blog posts and events based on the request parameters.
   * 
   * @param Doctrine_Query $q
   * @param string $tableName This is going to be either pkBlogPost or pkBlogEvent
   * @return Doctrrin_Query $q
   */
  public function buildQuery(sfWebRequest $request, $tableName = 'pkBlogEvent')
  {
    if ($request->getParameter('tag'))
    {
      $q = PluginTagTable::getObjectTaggedWithQuery($tableName, $request->getParameter('tag'), null, array('nb_common_tag' => 1));
    }
    else
    {
      $q = Doctrine_Query::create()->from($tableName.' a');
    }
    
    if ($request->getParameter('search'))
    {
      $q = Doctrine::getTable($tableName)->addSearchQuery($q, $request->getParameter('search'));
    }
        
    $q = Doctrine::getTable($tableName)->addDateRangeQuery($request, $q);
        
    $rootAlias = $q->getRootAlias();

    if ($request->getParameter('cat'))
    {
      $q->innerJoin($rootAlias.'.Category c WITH c.slug = ? ', $request->getParameter('cat'));
    }
    
    $q->addWhere($q->getRootAlias().'.published = ?', true);

    $q->orderBy($rootAlias.'.start_date asc');
    
    return $q;
  }
  
  public function addDateRangeQuery(sfWebRequest $request, Doctrine_Query $q = null)
  {
    if (!$q)
    {
      $q = $this->createQuery('e');
    }

    $rootAlias = $q->getRootAlias();

    $q->addWhere($rootAlias.'.start_date > ?', $request->getParameter('year', date('Y')).'-'.$request->getParameter('month', 1).'-'.$request->getParameter('day', 1).' 0:00:00')
      ->addWhere($rootAlias.'.start_date < ?', $request->getParameter('year', date('Y')).'-'.$request->getParameter('month', 12).'-'.$request->getParameter('day', 31).' 23:59:59');
    
    return $q;
  }
  
  public function addUpcomingEventsQuery(Doctrine_Query $q = null)
  {
    if (!$q)
    {
      $q = $this->createQuery('e');
    }
    
    $rootAlias = $q->getRootAlias();
    
    $q->addWhere($rootAlias.'.published = ?', true)
      ->addWhere($rootAlias.'.start_date > ?', date('Y-m-d'))
      ->orderBy($rootAlias.'.start_date, '. $rootAlias .'.start_time');
    
    return $q;
  }

  public function getLuceneIndex()
  {
    return pkZendSearch::getLuceneIndex($this);
  }
   
  public function getLuceneIndexFile()
  {
    return pkZendSearch::getLuceneIndexFile($this);
  }

  public function searchLucene($luceneQuery)
  {
    return pkZendSearch::searchLucene($this, $luceneQuery);
  }

  public function searchLuceneWithScores($luceneQuery)
  {
    return pkZendSearch::searchLuceneWithScores($this, $luceneQuery);
  }
  
  public function rebuildLuceneIndex()
  {
    return pkZendSearch::rebuildLuceneIndex($this);
  }
  
  public function optimizeLuceneIndex()
  {
    return pkZendSearch::optimizeLuceneIndex($this);
  }
  
  public function addSearchQuery(Doctrine_Query $q = null, $luceneQuery)
  {
    return pkZendSearch::addSearchQuery($this, $q, $luceneQuery, null);
  }

  public function addSearchQueryWithScores(Doctrine_Query $q = null, $luceneQuery, &$scores)
  {
    return pkZendSearch::addSearchQueryWithScores($this, $q, $luceneQuery, null, $scores);
  }
}
