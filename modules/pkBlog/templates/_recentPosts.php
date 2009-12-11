<ul class="pk-blog-recentposts">
	<?php foreach ($pk_blog_posts as $pk_blog_post): ?>
		<li>
			<h3 class="pk-blog-post-title"><?php echo link_to($pk_blog_post->getTitle(), 'pk_blog_post', $pk_blog_post) ?></h3>
			<p><?php echo ($pk_blog_post->getExcerpt()) ? $pk_blog_post->getExcerpt() : $pk_blog_post->getPreview() ?></p>
			<p><?php echo link_to('Read More', 'pk_blog_post_show', $pk_blog_post, array('class' => 'pk-blog-more')) ?></p>
		</li>
	<?php endforeach ?>
</ul>