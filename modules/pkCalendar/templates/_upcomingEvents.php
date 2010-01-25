<div class="pk-calendar-upcomingevents">
  <?php foreach ($pk_blog_events as $pk_blog_event): ?>
    
    <div class="pk-calendar-event">
      <div class="pk-calendar-meta">
        <ul>
	        <li class="pk-calendar-date"><?php echo date('l, F jS Y', strtotime($pk_blog_event->getStartDate())) ?></li>
          <?php if($pk_blog_event->getStartTime()): ?>
          <li><?php echo date('g:iA', strtotime($pk_blog_event->getStartTime())) ?> 
          <?php if($pk_blog_event->getEndTime()): ?>- <?php echo date('g:iA', strtotime($pk_blog_event->getEndTime())) ?></li>
          <?php endif ?>
          <?php endif ?>
        </ul>
      </div>
    
      <div class="pk-calendar-event-body">
        <h3 class="pk-blog-post-title"><?php echo link_to($pk_blog_event->getTitle(), 'pk_calendar_post', $pk_blog_event) ?></h3>
        <?php if (str_word_count(strip_tags($pk_blog_event->getBody())) > 30): ?>
          <?php echo ($pk_blog_event->getExcerpt()) ? $pk_blog_event->getExcerpt() : $pk_blog_event->getPreview(30) ?>
          <span class='pk-blog-read-more'><?php echo link_to('Read More', 'pk_calendar_post', $pk_blog_event, array('class' => 'pk-blog-more')) ?></span>
        <?php else: ?>
          <?php echo ($pk_blog_event->getBody()) ?>
        <?php endif ?>
      </div>
    </div>
    
  <?php endforeach ?>
</div>

