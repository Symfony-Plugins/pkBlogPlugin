<?php if ($pk_blog_post->getAttachedMedia()): ?>
	<?php if (in_array('pkContextCMSSlideshow', sfConfig::get('sf_enabled_modules'))): ?>
		<?php include_component('pkContextCMSSlideshow', 'slideshow', array(
			'items' => $pk_blog_post->getAttachedMedia(),
			'id' => $pk_blog_post->getId(),
			'options' => array('width' => 80, 'height' => 60, 'resizeType' => 'c', 'arrows' => false )
		)) ?>
	<?php else: ?>
	  <ul>
	  <?php foreach ($pk_blog_post->getAttachedMedia() as $media): ?>
	    <li><?php echo image_tag(str_replace(
	      array("_WIDTH_", "_HEIGHT_", "_c-OR-s_", "_FORMAT_"),
	      array('120', '90', 'c', 'jpg',),
	      $media->image
	    )) ?></li>
	  <?php endforeach ?>
	  </ul>
  <?php endif ?>
<?php endif ?>
