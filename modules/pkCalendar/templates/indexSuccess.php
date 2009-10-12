<?php use_helper('jQuery') ?>
	
<?php slot('body_class') ?>pk-blog <?php echo $sf_params->get('action') ?><?php end_slot() ?>

<?php include_component('pkCalendar', 'tagSidebar', array('tagParams' => $params['tags'], 'searchParams' => $params['search'])) ?>

<div id="pk-blog-main" class="main">
	<div class="content-container">
		<div class="content">		  

			<div class="pk-context-archive-filter">
		  <h4>Browse by:</h4>
      <ul class="pk-multi-button">
        <li class="pk-multi-button-option first option-1"><?php echo link_to('Day', 'pkCalendar/index?'.http_build_query($params['day']), array('class' => ($dateRange == 'day') ? 'selected' : '')) ?></li>
        <li class="pk-multi-button-option middle option-2"><?php echo link_to('Month', 'pkCalendar/index?'.http_build_query($params['month']), array('class' => ($dateRange == 'month') ? 'selected' : '')) ?></li>
        <li class="pk-multi-button-option last option-4"><?php echo link_to('Year', 'pkCalendar/index?'.http_build_query($params['year']), array('class' => ($dateRange == 'year') ? 'selected' : '')) ?></li>
      </ul>
			</div>
			<br class="c"/>
			
			<?php if ($sf_params->get('year')): ?>
		  <h2 class="pk-context-archive-title">
				<span>
	        <?php echo $sf_params->get('day') ?>
			    <?php echo ($sf_params->get('month')) ? date('F', strtotime(date('Y').'-'.$sf_params->get('month').'-01')) : '' ?>
	        <?php echo ucfirst($sf_params->get('semester')) ?>
	        <?php echo $sf_params->get('year') ?>
				</span>
				<div class="pk-context-archive-controls">
				  <?php if (isset($params['prev'])): ?>
		        <?php echo link_to('&larr;', 'pkCalendar/index?'.http_build_query($params['prev']), array('class' => 'pk-btn icon arrow-left', )) ?>
		      <?php endif ?>
				  <?php if (isset($params['next'])): ?>
		        <?php echo link_to('&rarr;', 'pkCalendar/index?'.http_build_query($params['next']), array('class' => 'pk-btn icon arrow-right', )) ?>
		      <?php endif ?>
				</div>
      </h2>
			<?php endif ?>
		  
      <?php if ($events->haveToPaginate()): ?>
      <?php echo include_partial('pkCalendar/pagination', array('pager' => $events, 'params' => $params['pagination'])); ?>
      <?php endif ?>

      <div class="pk-blog-events">
      <?php foreach ($events->getResults() as $event): ?>
      <?php echo include_partial('pkCalendar/event', array('event' => $event)); ?>
      <?php endforeach ?>
      </div>
    
      <?php if ($events->haveToPaginate()): ?>
      <?php echo include_partial('pkCalendar/pagination', array('pager' => $events, 'params' => $params['pagination'])); ?>
      <?php endif ?>

    </div>
  </div>
</div>

