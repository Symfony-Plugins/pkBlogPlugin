<?php if(count($pk_blog_posts)):?>
<select name="pk_blog_post_id-<?php echo $id ?>" id="pk_blog_post_id-<?php echo $id ?>">
  <?php foreach ($pk_blog_posts as $id => $pk_blog_post):?>
    <option value="<?php echo $id ?>"><?php echo $pk_blog_post ?></option>
  <?php endforeach?>
</select>

<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
    $('#pk_blog_post_id-<?php echo $id ?>').addClass('pkContextCMSBlogPostSelect');
  });
</script>
<?php else:?>
You have no blog posts.
<?php endif?>