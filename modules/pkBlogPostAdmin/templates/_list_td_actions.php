<td>
  <ul class="pk-admin-td-actions">
    <?php if ($pk_blog_post->userHasPrivilege('edit')): ?>
      <?php echo $helper->linkToEdit($pk_blog_post, array(  'params' =>   array(),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
      <li class="pk-admin-action-media">
        <?php echo link_to(__('Manage media', array(), 'messages'), 'pkBlogPostAdmin/media?id='.$pk_blog_post->getId(), 'class=pk-btn icon icon-only pk-media') ?>
      </li>
      <?php echo $helper->linkToDelete($pk_blog_post, array(  'params' =>   array(),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
    <?php endif ?>
  </ul>
</td>
