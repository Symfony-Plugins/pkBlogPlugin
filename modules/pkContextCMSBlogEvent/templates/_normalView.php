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

<?php // Look at $pk_blog_event, not $value; events can be deleted ?>
<?php if (!$pk_blog_event): ?>
  <?php if ($editable): ?>
    Click edit to select a event. 
  <?php endif ?>
<?php else: ?>
<h3 class="pk-blog-post-title"><?php echo link_to($pk_blog_event->getTitle(), 'pk_calendar_post', $pk_blog_event) ?></h3>
<?php if ($pk_blog_event->getAttachedMedia()): ?>
	<?php if (in_array('pkContextCMSSlideshow', sfConfig::get('sf_enabled_modules'))): ?>
		<div class="pk-blog-event-media">
			<?php include_component('pkContextCMSSlideshow', 'slideshow', array(
				'items' => $pk_blog_event->getAttachedMedia(),
				'id' => $pk_blog_event->getId(),
				'options' => array('width' => 150, 'height' => 110, 'resizeType' => 'c', 'arrows' => false )
			)) ?>
		</div>
	<?php else: ?>
	  <ul class="pk-blog-event-media">
	  <?php foreach ($pk_blog_event->getAttachedMedia() as $media): ?>
	    <li><?php echo image_tag(str_replace(
	      array("_WIDTH_", "_HEIGHT_", "_c-OR-s_", "_FORMAT_"),
	      array('120', '90', 'c', 'jpg',),
	      $media->image
	    )) ?></li>
	  <?php endforeach ?>
	  </ul>
  <?php endif ?>
<?php endif ?>

<div class="pk-blog-event-excerpt-container">
	<?php 
	if (str_word_count($pk_blog_event->getBody())>30) 
		{
			echo ($pk_blog_event->getExcerpt()) ? $pk_blog_post->getExcerpt() : $pk_blog_post->getPreview(30);
			echo ("<span class='pk-blog-read-more'>");
			echo link_to('Read More', 'pk_celendar_post', $pk_blog_event, array('class' => 'pk-blog-more'));
			echo ("</span>");
		}
	else 	echo ($pk_blog_event->getBody());
		?>
</div>

<?php endif ?>