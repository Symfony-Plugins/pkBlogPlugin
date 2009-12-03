<ul class="pk-blog-recentposts">
	<?php foreach ($pk_blog_posts as $pk_blog_post): ?>
		<li>
			<h4><?php echo $pk_blog_post->getTitle() ?></h4>
			<p><?php echo ($pk_blog_post->getExcerpt()) ? $pk_blog_post->getExcerpt() : $pk_blog_post->getPreview() ?></p>
			<p><?php echo link_to('Read More', 'pk_blog_post_show', $pk_blog_post, array('class' => 'pk-blog-more')) ?></p>
		</li>
	<?php endforeach ?>
</ul>