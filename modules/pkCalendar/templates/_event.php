<div class="pk-blog-event">
  <h3><?php echo link_to($event->getTitle(), 'pk_blog_event_show', $event) ?></h3>
  <p><?php echo $event->getPreview() ?></p>
	<br class="c clear"/>	
  <?php if ($event->getAttachedMedia()): ?>
  <ul class="pk-blog-plugin-attached-media">
  <?php foreach ($event->getAttachedMedia() as $media): ?>
    <li><?php echo image_tag(str_replace(
      array("_WIDTH_", "_HEIGHT_", "_c-OR-s_", "_FORMAT_"),
      array('100', '75', 'c', 'jpg'),
      $media->image
    )) ?></li>
  <?php endforeach ?>
  </ul>
	<br class="c clear"/>	
  <?php endif ?>

  <p><span>Tagged: </span><?php $n=1; foreach ($event->getTags() as $tag): ?>
    <?php echo link_to($tag, 'pkCalendar/index?tags='.$tag) ?><?php if ($n < count($event->getTags())): ?>, <?php endif ?>
  <?php $n++; endforeach ?></p>
</div>