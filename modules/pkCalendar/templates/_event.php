<?php use_helper('jQuery') ?>

<div class="pk-blog-post">
  <?php if ($pk_blog_event->userHasPrivilege('edit')): ?>
    <?php echo link_to('Edit This Post', 'pk_blog_event_admin_edit', $pk_blog_event, array('class' => 'pk-btn icon pk-blog')) ?>
  <?php endif ?>
  <h3 class="pk-blog-post-title"><?php echo link_to($pk_blog_event->getTitle(), 'pk_calendar_post', $pk_blog_event) ?></h3>
	<ul class="pk-blog-post-meta">
		<li class="pk-calendar-date"><?php echo date('l', strtotime($pk_blog_event->getStartDate())) ?></li>
		<li><?php echo date('F jS Y', strtotime($pk_blog_event->getStartDate())) ?></li>
		<li><?php echo date('g:iA', strtotime($pk_blog_event->getStartTime())) ?> - <?php echo date('g:iA', strtotime($pk_blog_event->getEndTime())) ?></li>
	</ul>
  <div class="pk-blog-post-body">
		<div class="pk-blog-post-excerpt">
			<?php echo (isset($excerpt) && $pk_blog_event->getExcerpt()) ? $pk_blog_event->getExcerpt() : $pk_blog_event->getBody() ?>			
			<?php if ((isset($excerpt) && $pk_blog_event->getExcerpt())): ?>
				<span class="pk-blog-read-more"><?php echo link_to('Read More', 'pk_calendar_post', $pk_blog_event, array('class' => 'pk-blog-more')) ?></span>
			<?php endif ?>
		</div>
		
  	<?php if ($pk_blog_event->getAttachedMedia()): ?>
			<?php if (in_array('pkContextCMSSlideshow', sfConfig::get('sf_enabled_modules'))): ?>
				<div class="pk-blog-post-media">
				  <?php include_component('pkContextCMSSlideshow', 'slideshow', array(
						'items' => $pk_blog_event->getAttachedMedia(),
						'id' => $pk_blog_event->getId(),
						'options' => array('width' => 420, 'height' => 300, 'resizeType' => 'c'),
						'constraints' => array('minimum-width' => 420,'minimum-height' => 300 )
					)) ?>
				</div>
			<?php else: ?>
			  <ul class="pk-blog-post-media pk-tubes-attached-media">
			  <?php foreach ($pk_blog_event->getAttachedMedia() as $media): ?>
			    <li><?php echo image_tag(str_replace(
			      array("_WIDTH_", "_HEIGHT_", "_c-OR-s_", "_FORMAT_"),
			      array('240', '180', 'c', 'jpg',),
			      $media->image
			    )) ?></li>
			  <?php endforeach ?>
			  </ul>
		  <?php endif ?>
		<?php endif ?>

	</div>
	<?php if ($pk_blog_event->getTags()): ?>
	<ul class="pk-blog-post-tags">
		<li class="title">Tagged: </li>
		<li class="tag"><?php $n=1; foreach ($pk_blog_event->getTags() as $tag): ?>
			<?php echo link_to($tag, 'pkCalendar/index?tag='.$tag) ?><?php if ($n < count($pk_blog_event->getTags())): ?>, <?php endif ?>
	  <?php $n++; endforeach ?></li>
	</ul>
	<?php endif ?>
</div>
