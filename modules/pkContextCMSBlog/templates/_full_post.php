<?php use_helper('jQuery') ?>

<div class="pk-blog-post">
  <h3><?php echo link_to($pk_blog_post->getTitle(), pkContextCMSTools::getCurrentPage()->getUrl().'?p='.$pk_blog_post->getSlug()) ?></h3>
  <p><?php echo $pk_blog_post->getBody() ?></p>
	<br class="c clear"/>	
  <?php if ($pk_blog_post->getAttachedMedia()): ?>
  <ul class="pk-tubes-plugin-attached-media">
  <?php foreach ($pk_blog_post->getAttachedMedia() as $media): ?>
    <li><?php echo image_tag(str_replace(
      array("_WIDTH_", "_HEIGHT_", "_c-OR-s_", "_FORMAT_"),
      array('100', '75', 'c', 'jpg'),
      $media->image
    )) ?></li>
  <?php endforeach ?>
  </ul>
	<br class="c clear"/>	
  <?php endif ?>

  <p><span>Tagged: </span><?php $n=1; foreach ($pk_blog_post->getTags() as $tag): ?>
    <?php echo link_to($tag, pkContextCMSTools::getCurrentPage()->getUrl().'?tag='.$tag) ?><?php if ($n < count($pk_blog_post->getTags())): ?>, <?php endif ?>
  <?php $n++; endforeach ?></p>

</div>
<br class="c clear"/>
