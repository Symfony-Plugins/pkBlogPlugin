<?php echo link_to('Edit Events', '@pk_blog_event_admin', array('class' => 'pk-btn icon pk-blog-btn', )) ?>

<script src='/sfDoctrineActAsTaggablePlugin/js/pkTagahead.js'></script>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
    pkTagahead(<?php echo json_encode(url_for("taggableComplete/complete")) ?>);
	});
</script>