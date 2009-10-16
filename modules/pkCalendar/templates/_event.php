<div class="pk-blog-pk_blog_event">
  <h3><?php echo link_to($pk_blog_event->getTitle(), 'pk_calendar_post', $pk_blog_event) ?></h3>
	<br class="c clear"/>	
  <?php if ($pk_blog_event->getAttachedMedia()): ?>
  <ul class="pk-blog-plugin-attached-media">
  <?php foreach ($pk_blog_event->getAttachedMedia() as $media): ?>
    <li><?php echo image_tag(str_replace(
      array("_WIDTH_", "_HEIGHT_", "_c-OR-s_", "_FORMAT_"),
      array('100', '75', 'c', 'jpg'),
      $media->image
    )) ?></li>
  <?php endforeach ?>
  </ul>
	<br class="c clear"/>	
  <?php endif ?>

  <p><span>Tagged: </span><?php $n=1; foreach ($pk_blog_event->getTags() as $tag): ?>
    <?php echo link_to($tag, 'pkCalendar/index?tags='.$tag) ?><?php if ($n < count($pk_blog_event->getTags())): ?>, <?php endif ?>
  <?php $n++; endforeach ?></p>
</div>