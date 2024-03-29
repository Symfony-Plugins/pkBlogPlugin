<?php use_helper('jQuery') ?>

<div class="pk-blog-post <?php echo $pk_blog_post->getAttachedMedia()? 'contains-media': '';?>">
	<h3 class="pk-blog-post-title">
		<?php echo link_to($pk_blog_post->getTitle(), 'pk_blog_post', $pk_blog_post) ?>
	</h3>
	<ul class="pk-blog-post-meta">
		<li class="date"><?php echo date('l F jS Y', strtotime($pk_blog_post->getPublishedAt())) ?></li>
		<li class="author">Posted By: <?php echo $pk_blog_post->getAuthor() ?></li>
		<?php if ($pk_blog_post->userHasPrivilege('edit')): ?>
		<li class="edit">
	    <?php echo link_to('Edit Post', 'pk_blog_post_admin_edit', $pk_blog_post, array('class' => 'pk-btn icon pk-blog-btn pk-edit-post')) ?>
	  </li>
	  <?php endif ?>		
	</ul>
  <div class="pk-blog-post-body">
			<?php if ($pk_blog_post->getAttachedMedia()): ?>
				<?php if (in_array('pkContextCMSSlideshow', sfConfig::get('sf_enabled_modules'))): ?>
					<div class="pk-blog-post-media">
					  <?php include_component('pkContextCMSSlideshow', 'slideshow', array(
							'items' => $pk_blog_post->getAttachedMedia(),
							'id' => $pk_blog_post->getId(),
							'options' => array('width' => 420, 'height' => 300, 'resizeType' => 'c'),
							'constraints' => array('minimum-width' => 420,'minimum-height' => 300 )
						)) ?>
					</div>
				<?php else: ?>
				  <ul class="pk-blog-post-media pk-tubes-attached-media">
				  <?php foreach ($pk_blog_post->getAttachedMedia() as $media): ?>
				    <li><?php echo image_tag(str_replace(
				      array("_WIDTH_", "_HEIGHT_", "_c-OR-s_", "_FORMAT_"),
				      array('240', '180', 'c', 'jpg',),
				      $media->image
				    )) ?></li>
				  <?php endforeach ?>
				  </ul>
			  <?php endif ?>
			<?php endif ?>
		<div class="pk-blog-post-excerpt">
			<?php echo (isset($excerpt) && $pk_blog_post->getExcerpt()) ? $pk_blog_post->getExcerpt() : $pk_blog_post->getBody() ?>			
			<?php if ((isset($excerpt) && $pk_blog_post->getExcerpt())): ?>
				<span class="pk-blog-read-more"><?php echo link_to('Read More', 'pk_blog_post', $pk_blog_post, array('class' => 'pk-blog-more')) ?></span>
			<?php endif ?>		
		</div>
	</div>
	
	<?php if ($pk_blog_post->getTags()): ?>
	<ul class="pk-blog-post-tags">
		<li class="title">Tagged: </li>
		<li class="tag"><?php $n=1; foreach ($pk_blog_post->getTags() as $tag): ?>
			<?php echo link_to($tag, 'pkBlog/index?tag='.$tag) ?><?php if ($n < count($pk_blog_post->getTags())): ?>, <?php endif ?>
	  <?php $n++; endforeach ?></li>
	</ul>
	<?php endif ?>
</div>
