<div class="pk-calendar-upcomingevents">
	<?php foreach ($pk_blog_events as $pk_blog_event): ?>
		
		<div class="pk-calendar-event">
			<div class="pk-calendar-meta">
				<ul>
					<li class="pk-calendar-date"><?php echo date('l', strtotime($pk_blog_event->getStartDate())) ?></li>
					<li><?php echo date('F jS Y', strtotime($pk_blog_event->getStartDate())) ?></li>
					<li><?php echo date('gA', strtotime($pk_blog_event->getStartDate())) ?></li>
				</ul>
			</div>
		
			<div class="pk-calendar-event-body">
				<h4><?php echo $pk_blog_event->getTitle() ?></h4>
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
		</div>
		
	<?php endforeach ?>
</div>