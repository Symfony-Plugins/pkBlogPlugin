<ul class="pk-blog-recentposts">
	<?php foreach ($pk_blog_events as $pk_blog_event): ?>
		<li>
			<h4><?php echo $pk_blog_event->getTitle() ?></h4>
			<p><?php echo $pk_blog_event->getExcerpt() ?></p>
			<p><?php echo link_to('Read More', 'pk_blog_calendar_post', $pk_blog_event, array('class' => 'pk-blog-more')) ?></p>
		</li>
	<?php endforeach ?>
</ul>