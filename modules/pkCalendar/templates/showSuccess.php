<?php use_helper('jQuery') ?>

<?php slot('body_class') ?>pk-blog <?php echo $sf_params->get('action') ?><?php end_slot() ?>

<?php include_component('pkTubesEvent', 'tagSidebar', array('tagParams' => array(), 'searchParams' => array())) ?>

<div id="pk-blog-main" class="main">
	<div class="content-container">
		<div class="content">
			
			<h2><?php echo $event->getTitle() ?></h2>
      <p><?php // echo date('d F Y', strtotime($event->getPubDate())) ?></p>

			<?php echo $event->getDescription() ?>

			<ul class="pk-context-cms-event-controls">
				<li class="pk-context-cms-event-tags">
					<span>Tagged: </span>
					<?php $n=1; foreach ($event->getTags() as $tag): ?>
				  	<?php echo link_to($tag, 'pkTubesEvent/index?tags='.$tag) ?><?php if ($n < count($event->getTags())): ?>, <?php endif ?>
					<?php $n++; endforeach ?>
				</li>
			  <?php if ($event->getLink()): ?>
			    <li class="pk-context-cms-event-link"><?php echo link_to('View original event ', $event->getLink(), array('class' => 'pk-link-away', )) ?></li>
			  <?php endif ?>
			</ul>

    </div>
  </div>
</div>

<div id="pk-blog-sidebar" class="pk-blog-media-column sidebar">
	<div class="content-container">
		<div class="content">
			
			<?php if ($event->getAttachedMedia()): ?>

			<?php $options = array('width' => 240, 'height' => 180, 'resizeType' => 's', 'flexHeight' => true,) // pkTubes Media Options ?>

			<?php echo include_component('pkContextCMSSlideshow','slideshow', array(
						'items' => $event->getAttachedImages(),
						'id' => $event->getId(), 
						'options' => array('width' => $options['width'], 'height' => $options['height'], 'resizeType' => $options['resizeType'], 'flexHeight' => $options['flexHeight']),
			)); ?>

			<?php $videos = $event->getAttachedVideos() ?>
			<?php foreach ($videos as $video): ?>
			  <div class="pk-blog-video pk-context-media-video" style="margin-top: 20px;">
			  <?php $embed = str_replace(
			    array("_WIDTH_", "_HEIGHT_", "_c-OR-s_", "_FORMAT_"),
			    array($options['width'], 
			      $options['flexHeight'] ? floor(($options['width'] / $video->width) * $video->height) : $options['height'], 
			      $options['resizeType'],
			      $video->format),
			    $video->embed) ?>
			  <?php echo $embed ?>
			  </div>
			<?php endforeach ?>	

			<?php endif ?>
		</div>
	</div>
</div>