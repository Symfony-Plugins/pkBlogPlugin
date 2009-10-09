<?php if ($pk_blog_event->userHasPrivilege('edit')): ?>
  <?php echo link_to($pk_blog_event->getTitle(), 'pk_blog_event_admin_edit', $pk_blog_event) ?> <?php if (!$pk_blog_event->getPublished()): ?> - Draft<?php endif ?>
<?php else: ?>
  <?php echo $pk_blog_event->getTitle() ?> <?php if (!$pk_blog_event->getPublished()): ?> - Draft<?php endif ?>
<?php endif ?>