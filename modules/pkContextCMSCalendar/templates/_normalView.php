<?php use_helper('jQuery') ?>

<?php slot("pk-slot-controls-$name-$permid") ?>
	<li class="pk-controls-item edit">
    <?php echo jq_link_to_function('edit', '', array(
  		'id' => 'pk-slot-edit-'.$name.'-'.$permid, 
  		'class' => 'pk-btn icon pk-edit', 
  		'title' => 'Edit', 
  	)) ?>

  	<script type="text/javascript">
  	$(document).ready(function(){
  		var editBtn = $('#pk-slot-edit-<?php echo $name ?>-<?php echo $permid ?>');
  		var editSlot = $('#pk-slot-<?php echo $name ?>-<?php echo $permid ?>');
		
  		editBtn.click(function(event){
  			$(this).parent().addClass('editing-now');
  			$(editSlot).children('.pk-slot-content').children('.pk-slot-content-container').hide(); // Hide content
  			$(editSlot).children('.pk-slot-content').children('.pk-slot-form').fadeIn();	// I changed this to fadeIn from show() -- this seemed to help with the stroke re-draw bug we were experiencing.
  			pkUI($(this).parents('.pk-slot').attr('id'));
  			// $(editSlot).children('.pk-messages').css('visibility','hidden'); // Hide the messages
  			return false;
  		});
  	})
  	</script>
	</li>
<?php end_slot() ?>

<?php if ($sf_params->get('action') != 'day'): ?>
<div class="pk-blog-calendar" id="pk-blog-calendar">
<?php endif ?>
	<ul class="month">
		<li class="title">
			<h3 style="clear:both;width: 100%">Events</h3>
			<h4><?php echo date('F y', $date) ?></h4>
			<div class="pk-blog-calendar-controls">
				<?php echo jq_link_to_remote('Previous Month', 
				  array(
				    'url' => 'pkContextCMSCalendar/day?date='.strtotime('-1 month', $date).'&slug='.$page->getSlug().'&slot='.$name.'&value='.$value.'&permid='.$permid,
    				'update' => 'pk-blog-calendar', 
    				'script' => 'true', 
						'loading'	=> '$(".pk-context-cms-loading-ani.calendar").show();',
						'complete' => '$(".pk-context-cms-loading-ani.calendar").hide(); pkUI("#pk-blog-calendar");', 
				    ),
				  array('class' => 'pk-btn icon pk-arrow-left nobg')
				) ?>
				<?php echo jq_link_to_remote('Next Month', 
				  array(
				    'url' => 'pkContextCMSCalendar/day?date='.strtotime('+1 month', $date).'&slug='.$page->getSlug().'&slot='.$name.'&value='.$value.'&permid='.$permid,
    				'update' => 'pk-blog-calendar', 
    				'script' => 'true',
						'loading'	=> '$(".pk-context-cms-loading-ani.calendar").show();',
						'complete' => '$(".pk-context-cms-loading-ani.calendar").hide(); pkUI("#pk-blog-calendar");', 
				    ),
				  array('class' => 'pk-btn icon pk-arrow-right nobg')
				) ?>
			</div>
		</li>
	</ul>

	<?php if (!strlen($value)): ?>
	  <?php if ($editable): ?>
	    <p class="instructions">Click edit to choose event tags.</p>
	  <?php endif ?>
	<?php else: ?>

		<ul class="pk-blog-calendar-days">
		<?php foreach ($calendar->getEventCalendar() as $week): ?>
			<?php foreach ($week as $date => $events): ?>
				<?php if (!empty($events)): ?>
				<li class="pk-blog-calendar-day-events" id="day-events-<?php echo date('j', strtotime($date)) ?>">
					<ul>
						<li class="day-event-date"><h5><?php echo date('l m/j/Y', strtotime($date)) ?></h5></li>
					<?php foreach ($events as $event): ?>
						<li class="day-event-details">
							<ul>
								<li class="day-event-details-date"><?php echo date('g:ia' , strtotime($event['start_date'])) ?></li>
								<li class="day-event-details-title"><?php echo link_to($event['title'], $event['permalink']) ?></li>
							</ul>
						</li>
					<?php endforeach ?>
					</ul>
				</li>
				<?php endif ?>
			<?php endforeach ?>
		<?php endforeach ?>
		</ul>
		
	<?php endif ?>
<script type="text/javascript">
	$('#day-events-<?php echo date('j', strtotime($today)) ?>').show();
	$("#pk-blog-calendar .title h3").append(' <img src="/pkContextCMSPlugin/images/pk-icon-loader-ani.gif" title="loading..." alt="loading..." class="pk-context-cms-loading-ani calendar" style="display:none;"/>');
</script>
<?php if ($sf_params->get('action') != 'day'): ?>
</div>
<?php endif ?>