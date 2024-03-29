<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PluginpkBlogPostTable extends Doctrine_Table
{
  public function buildQuery(sfWebRequest $request, $tableName = 'pkBlogPost')
  {    
    return Doctrine::getTable('pkBlogItem')->buildQuery($request, $tableName);
  }
  
  public function addDateRangeQuery(sfWebRequest $request, Doctrine_Query $q = null)
  {
    if (!$q)
    {
      $q = $this->createQuery('p');
    }
    
    $rootAlias = $q->getRootAlias();

    // if it's an RSS feed, we don't want to be concerned with a time frame, just give us the latest stuff
    if ($request->getParameter('format') != 'rss')
    {
      $q->addWhere($rootAlias.'.published_at > ? and '.$rootAlias.'.published_at < ?', array( 
        $request->getParameter('year', 0).'-'.$request->getParameter('month', 1).'-'.$request->getParameter('day', 1).' 0:00:00',
        $request->getParameter('year', date('Y')).'-'.$request->getParameter('month', 12).'-'.$request->getParameter('day', 31).' 23:59:59'
      ));
    }
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
