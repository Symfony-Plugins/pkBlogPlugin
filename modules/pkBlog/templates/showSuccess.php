<?php slot('body_class') ?>pk-blog <?php echo $sf_params->get('action') ?><?php end_slot() ?>

<div id="pk-subnav" class="blog">
	<div id="pk-subnav-top" class="pk-subnav-top"></div>
	<div class="pk-subnav-wrapper">
    <?php include_component('pkBlog', 'tagSidebar', array('params' => $params, 'dateRange' => '')) ?>
	</div>		
	<div id="pk-subnav-bottom" class="pk-subnav-bottom"></div>
</div>

<div id="pk-blog-main" class="pk-blog-main">
  <?php echo include_partial('pkBlog/post', array('pk_blog_post' => $pk_blog_post)); ?>
</div>