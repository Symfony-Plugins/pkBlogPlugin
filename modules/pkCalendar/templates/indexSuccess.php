<?php slot('body_class') ?>pk-blog <?php echo $sf_params->get('action') ?><?php end_slot() ?>

<div id="pk-subnav" class="blog">
	<div id="pk-subnav-top" class="pk-subnav-top"></div>
	<div class="pk-subnav-wrapper">
		<?php include_component('pkCalendar', 'tagSidebar', array('params' => $params, 'dateRange' => $dateRange)) ?>
	</div>		
	<div id="pk-subnav-bottom" class="pk-subnav-bottom"></div>
</div>

<div class="pk-blog-main">
  <?php if ($sf_params->get('year')): ?>
  <h2><?php echo $sf_params->get('day') ?> <?php echo ($sf_params->get('month')) ? date('F', strtotime(date('Y').'-'.$sf_params->get('month').'-01')) : '' ?> <?php echo $sf_params->get('year') ?></h2>
  <ul class="pk-controls pk-blog-browser-controls">
    <li><?php echo link_to('Previous', 'pkCalendar/index?'.http_build_query($params['prev']), array('class' => 'pk-btn icon pk-arrow-left nobg', )) ?></li>
    <li><?php echo link_to('Next', 'pkCalendar/index?'.http_build_query($params['next']), array('class' => 'pk-btn icon pk-arrow-right nobg', )) ?></li>
  </ul>
  <?php endif ?>

  <?php if ($pk_blog_events->haveToPaginate()): ?>
  <?php echo include_partial('pkCalendar/pagination', array('pager' => $pk_blog_events, 'params' => $params['pagination'])); ?>
  <?php endif ?>

  <div style="clear:both;">
  <?php foreach ($pk_blog_events->getResults() as $pk_blog_event): ?>
  <?php echo include_partial('pkCalendar/event', array('pk_blog_event' => $pk_blog_event, 'excerpt' => 'true')); ?>
  <?php endforeach ?>
  
  <?php if (!count($pk_blog_events->getResults())): ?>
  <?php include_partial('pkCalendar/noresults') ?>
  <?php endif ?>
  </div>

  <?php if ($pk_blog_events->haveToPaginate()): ?>
  <?php echo include_partial('pkCalendar/pagination', array('pager' => $pk_blog_events, 'params' => $params['pagination'])); ?>
  <?php endif ?>
</div>