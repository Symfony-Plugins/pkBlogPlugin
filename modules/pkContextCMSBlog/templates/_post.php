<?php use_helper('jQuery') ?>

<div class="pk-blog-post">
  <?php if ($pk_blog_post->userHasPrivilege('edit')): ?>
    <?php echo link_to('Edit This Post', 'pk_blog_post_admin_edit', $pk_blog_post, array('class' => 'pk-btn icon pk-blog-btn')) ?>
  <?php endif ?>
  <h3 class="pk-blog-post-title"><?php echo link_to($pk_blog_post->getTitle(), 'pk_blog_post', $pk_blog_post) ?></h3>
	<ul class="pk-blog-post-meta">
		<li class="date"><?php echo date('j F Y', strtotime($pk_blog_post->getPublishedAt())) ?></li>
		<li class="time"><?php echo date('g:iA', strtotime($pk_blog_post->getPublishedAt())) ?></li>		
	</ul>
  <div class="pk-blog-post-body">
		<div class="pk-blog-post-excerpt">
			<?php echo (isset($excerpt)) ? $pk_blog_post->getExcerpt() : $pk_blog_post->getBody() ?>
			<ul class="pk-blog-post-tags">
				<li class="title">Tagged: </li>
				<li class="tag"><?php $n=1; foreach ($pk_blog_post->getTags() as $tag): ?>
					<?php echo link_to($tag, pkContextCMSTools::getCurrentPage()->getUrl().'?tag='.$tag) ?><?php if ($n < count($pk_blog_post->getTags())): ?>, <?php endif ?>
			  <?php $n++; endforeach ?></li>
			</ul>			
		</div>
		
  	<?php if ($pk_blog_post->getAttachedMedia()): ?>
			<?php if (in_array('pkContextCMSSlideshow', sfConfig::get('sf_enabled_modules'))): ?>
				<div class="pk-blog-post-media">
					<?php include_component('pkContextCMSSlideshow', 'slideshow', array(
						'items' => $pk_blog_post->getAttachedMedia(),
						'id' => $pk_blog_post->getId(),
						'options' => array('width' => 240, 'height' => 180, 'resizeType' => 'c')
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

	</div>
</div>
