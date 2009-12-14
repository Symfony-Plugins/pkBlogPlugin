<?php use_helper('Form') ?>

<?php echo select_tag("tags-$id", options_for_select($tags, $selected_tags), array_merge($options, array('multiple' => true))) ?>

<script type="text/javascript" charset="utf-8">
	pkMultipleSelect('#pk-slot-form-<?php echo $id ?>', { });
</script>