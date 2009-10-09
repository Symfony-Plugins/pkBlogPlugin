<?php // For some reason link_to_if fails here ?>
<?php if ($pk_blog_post->userHasPrivilege('edit')): ?>
  <?php echo link_to($pk_blog_post->getTitle(), 'pk_blog_post_admin_edit', $pk_blog_post) ?> <?php if (!$pk_blog_post->getPublished()): ?> - Draft<?php endif ?>
<?php else: ?>
  <?php echo $pk_blog_post->getTitle() ?> <?php if (!$pk_blog_post->getPublished()): ?> - Draft<?php endif ?>
<?php endif ?>