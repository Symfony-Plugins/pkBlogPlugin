<?php use_helper('Form') ?>
<?php echo select_tag("pk_blog_event_id-$id", options_for_select($pk_blog_events, $value), $options) ?>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#pk_blog_event_id-<?php echo $id ?>').addClass('pkContextCMSBlogEventSelect');
	});
</script>