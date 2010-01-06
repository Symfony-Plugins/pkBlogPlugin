<?php if(count($pk_blog_events)):?>
<select name="pk_blog_event_id-<?php echo $id ?>" id="pk_blog_event_id-<?php echo $id ?>">
  <?php foreach ($pk_blog_events as $id => $pk_blog_event):?>
    <option value="<?php echo $id ?>"><?php echo $pk_blog_event ?></option>
  <?php endforeach?>
</select>

<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
    $('#pk_blog_event_id-<?php echo $id ?>').addClass('pkContextCMSBlogeventSelect');
  });
</script>
<?php else:?>
You have no blog events.
<?php endif?>