<div id="pk-subnav" class="blog">
	<div id="pk-subnav-top" class="pk-subnav-top"></div>
	<div class="pk-subnav-wrapper">
		<?php include_component('pkContextCMSBlog', 'tagSidebar', array('params' => $params, 'dateRange' => $dateRange)) ?>
	</div>		
	<div id="pk-subnav-bottom" class="pk-subnav-bottom"></div>
</div>

<div class="pk-blog-main">
  <?php if ($pk_blog_post): ?>
    <?php echo include_partial('pkContextCMSBlog/post', array('pk_blog_post' => $pk_blog_post)); ?>
  <?php else: ?>
    <?php echo include_partial('pkContextCMSBlog/list', array('pk_blog_posts' => $pk_blog_posts, 'params' => $params)); ?>
  <?php endif ?>
</div>