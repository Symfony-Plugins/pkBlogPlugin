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

<?php // Look at $pk_blog_post, not $value; posts can be deleted ?>
<?php if (!$pk_blog_post): ?>
  <?php if ($editable): ?>
    Click edit to select a post. 
  <?php endif ?>
<?php else: ?>
<div class="pk-blog-post <?php echo count($pk_blog_post->getAttachedMedia()) > 0? 'contains-media' : ''?> ">
<h4><?php echo $pk_blog_post->getTitle() ?></h4>
<ul class="pk-blog-post-meta">
	<li class="date"><?php echo date('j F Y', strtotime($pk_blog_post->getPublishedAt())) ?></li>
	<li class="time"><?php echo date('g:iA', strtotime($pk_blog_post->getPublishedAt())) ?></li>		
</ul>

<?php if ($pk_blog_post->getAttachedMedia()): ?>
	<?php if (in_array('pkContextCMSSlideshow', sfConfig::get('sf_enabled_modules'))): ?>
		<div class="pk-blog-post-media">
			<?php include_component('pkContextCMSSlideshow', 'slideshow', array(
				'items' => $pk_blog_post->getAttachedMedia(),
				'id' => $pk_blog_post->getId(),
				'options' => array('width' => 120, 'height' => 90, 'resizeType' => 'c', 'arrows' => false )
			)) ?>
		</div>
	<?php else: ?>
	  <ul class="pk-blog-post-media">
	  <?php foreach ($pk_blog_post->getAttachedMedia() as $media): ?>
	    <li><?php echo image_tag(str_replace(
	      array("_WIDTH_", "_HEIGHT_", "_c-OR-s_", "_FORMAT_"),
	      array('120', '90', 'c', 'jpg',),
	      $media->image
	    )) ?></li>
	  <?php endforeach ?>
	  </ul>
  <?php endif ?>
<?php endif ?>

<div class="pk-blog-post-excerpt-container">
	<?php echo ($pk_blog_post->getExcerpt()) ? $pk_blog_post->getExcerpt() : $pk_blog_post->getPreview(75) ?>
	<span class="pk-blog-read-more"><?php echo link_to('Read More', 'pk_blog_post', $pk_blog_post, array('class' => 'pk-blog-more')) ?></span>
</div>
</div>
<?php endif ?>