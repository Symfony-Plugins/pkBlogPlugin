<?php

/**
 * Base actions for the pkBlogPlugin pkContextCMSCalendar module.
 * 
 * @package     pkBlogPlugin
 * @subpackage  pkContextCMSCalendar
 * @author      Your name here
 * @version     SVN: $Id: BaseComponents.class.php 12628 2008-11-04 14:43:36Z Kris.Wallsmith $
 */
abstract class BasepkContextCMSCalendarComponents extends pkContextCMSBaseComponents
{
  public function executeEditView()
  {
    $this->setup();

		$tags = PluginTagTable::getAllTagNameWithCount(null, array('model' => 'pkBlogEvent'));
			
		$this->tags = array('' => 'Select one or more tags');
		foreach ($tags as $tag => $count)
		{
			$this->tags[$tag] = $tag;
		}
		
		$this->selected_tags = explode(', ', $this->slot->value);
  }

	public function executeNormalView()
	{
    $this->setup();

    $this->date = $this->getRequestParameter('date', time());
    
		$year = date('Y', $this->date);
		$mon = date('m', $this->date);
		$nmon = $mon + 1;
		$nyear = $year;
		if ($nmon === 13) { $nmon = 1; $nyear++; }

    $this->events = array();
    if ($this->value)
    {
      $q = TagTable::getObjectTaggedWithQuery('pkBlogEvent', $this->slot->value, null, array('nb_common_tags' => 1));

  		$q->addwhere($q->getRootAlias().'.start_date >= ?', "$year-$mon-1")
  			->addWhere($q->getRootAlias().'.start_date < ?', "$nyear-$nmon-1")
        ->addWhere($q->getRootAlias().'.published = ?', true)
        ->orderBy($q->getRootAlias().'.published_at ASC');

  		$this->events = $q->execute();
    }
		
		$this->calendar = new sfEventCalendar('month', date('Y-m-d', $this->date));

		foreach ($this->events as $event)
		{
			$this->calendar->addEvent($event->getStartDate(), array(
				'event' => true,
				'title' => $event->getTitle(), 
				'start_date' => $event->getStartDate(), 
			));
		}

		// Need to make this dynamic $this->getRequestParameter('month')
		$this->month = date('F', $this->date);
		$this->today = date('F d Y', $this->date);
	}
}
