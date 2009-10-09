<?php echo select_tag("pk_blog_post_id-$id", options_for_select($pk_blog_posts, $value), $options) ?>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#pk_blog_post_id-<?php echo $id ?>').addClass('pkContextCMSBlogPostSelect');
	});
</script>