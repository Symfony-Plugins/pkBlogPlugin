<?php slot('body_class') ?>pk-blog <?php echo $sf_params->get('action') ?><?php end_slot() ?>

<div id="pk-subnav" class="blog">
	<div id="pk-subnav-top" class="pk-subnav-top"></div>
	<div class="pk-subnav-wrapper">
		<?php include_component('pkBlog', 'tagSidebar', array('params' => $params, 'dateRange' => $dateRange)) ?>
	</div>		
	<div id="pk-subnav-bottom" class="pk-subnav-bottom"></div>
</div>

<div id="pk-blog-main" class="pk-blog-main">
  <?php if ($sf_params->get('year')): ?>
  <h2><?php echo $sf_params->get('day') ?> <?php echo ($sf_params->get('month')) ? date('F', strtotime(date('Y').'-'.$sf_params->get('month').'-01')) : '' ?> <?php echo $sf_params->get('year') ?></h2>
  <ul class="pk-controls pk-blog-browser-controls">
    <li><?php echo link_to('Previous', 'pkBlog/index?'.http_build_query($params['prev']), array('class' => 'pk-btn icon pk-arrow-left nobg', )) ?></li>
    <li><?php echo link_to('Next', 'pkBlog/index?'.http_build_query($params['next']), array('class' => 'pk-btn icon pk-arrow-right nobg', )) ?></li>
  </ul>
  <?php endif ?>

  <?php if ($pk_blog_posts->haveToPaginate()): ?>
  <?php echo include_partial('pkBlog/pagination', array('pager' => $pk_blog_posts, 'params' => $params['pagination'])); ?>
  <?php endif ?>

  <div style="clear:both;">
  <?php foreach ($pk_blog_posts->getResults() as $pk_blog_post): ?>
  <?php echo include_partial('pkBlog/post', array('pk_blog_post' => $pk_blog_post, 'excerpt' => 'true')); ?>
  <?php endforeach ?>
  </div>

  <?php if ($pk_blog_posts->haveToPaginate()): ?>
  <?php echo include_partial('pkBlog/pagination', array('pager' => $pk_blog_posts, 'params' => $params['pagination'])); ?>
  <?php endif ?>
</div>