<?php if ($sf_params->get('year')): ?>
<h2><?php echo $sf_params->get('day') ?> <?php echo ($sf_params->get('month')) ? date('F', strtotime(date('Y').'-'.$sf_params->get('month').'-01')) : '' ?> <?php echo $sf_params->get('year') ?></h2>
<ul class="pk-controls pk-blog-browser-controls">
  <li><?php echo link_to('Previous', pkContextCMSTools::getCurrentPage()->getUrl().'?'.http_build_query($params['prev']), array('class' => 'pk-btn icon pk-arrow-left nobg', )) ?></li>
  <li><?php echo link_to('Next', pkContextCMSTools::getCurrentPage()->getUrl().'?'.http_build_query($params['next']), array('class' => 'pk-btn icon pk-arrow-right nobg', )) ?></li>
</ul>
<?php endif ?>

<?php if ($pk_blog_posts->haveToPaginate()): ?>
<?php echo include_partial('pkContextCMSBlog/pagination', array('pager' => $pk_blog_posts, 'params' => $params['pagination'])); ?>
<?php endif ?>

<div style="clear:both;">
<?php foreach ($pk_blog_posts->getResults() as $pk_blog_post): ?>
<?php echo include_partial('pkContextCMSBlog/post', array('pk_blog_post' => $pk_blog_post, 'excerpt' => 'true')); ?>
<?php endforeach ?>
</div>

<?php if ($pk_blog_posts->haveToPaginate()): ?>
<?php echo include_partial('pkContextCMSBlog/pagination', array('pager' => $pk_blog_posts, 'params' => $params['pagination'])); ?>
<?php endif ?>
