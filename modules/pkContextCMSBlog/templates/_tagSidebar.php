<div class="pk-blog-categories">
  <h4>Categories</h4>
  <ul class="pk-blog-filter-options">
  <?php foreach ($categories as $category): ?>
    <li><?php echo link_to($category, pkUrl::addParams(pkContextCMSTools::getCurrentPage()->getUrl().'?cat='.$category->getSlug(), $params['cat']), array(
      'class' => ($category->getSlug() == $sf_params->get('cat')) ? 'selected' : '', 
    )) ?></li>
  <?php endforeach ?>
  </ul>	
</div>

<hr />

<div class="pk-blog-filter">
  <h4>Browse by</h4>
  <ul class="pk-blog-filter-options">
    <li><?php echo link_to('Day', pkContextCMSTools::getCurrentPage()->getUrl().'?'.http_build_query(($dateRange == 'day') ? $params['nodate'] : $params['day']), array('class' => ($dateRange == 'day') ? 'selected' : '')) ?></li>
    <li><?php echo link_to('Month', pkContextCMSTools::getCurrentPage()->getUrl().'?'.http_build_query(($dateRange == 'month') ? $params['nodate'] : $params['month']), array('class' => ($dateRange == 'month') ? 'selected' : '')) ?></li>
    <li><?php echo link_to('Year', pkContextCMSTools::getCurrentPage()->getUrl().'?'.http_build_query(($dateRange == 'year') ? $params['nodate'] : $params['year']), array('class' => ($dateRange == 'year') ? 'selected' : '')) ?></li>
  </ul>
</div>

<hr />

<div class="pk-blog-tags">  
	<ul class="pk-blog-selected-tag">
	<?php if (isset($tag)): ?>
		<li><?php echo $tag ?><?php echo link_to('remove', pkUrl::addParams(pkContextCMSTools::getCurrentPage()->getUrl(), $params['tag']), array('class' => 'pk-btn icon close', )) ?></li>
	<?php endif ?>
	</ul>

	<h4 class="pk-tag-sidebar-title popular">Popular Tags</h4>  			
	<ul class="pk-tag-sidebar-list popular">
		<?php $n=1; foreach ($popular as $tag => $count): ?>
	  <li <?php echo ($n == count($popular) ? 'class="last"':'') ?>>
			<span class="pk-tag-sidebar-tag"><?php echo link_to($tag, pkUrl::addParams(pkContextCMSTools::getCurrentPage()->getUrl().'?tag='.$tag, $params['tag'])) ?></span>
			<span class="pk-tag-sidebar-tag-count"><?php echo $count ?></span>
		</li>
		<?php $n++; endforeach ?>
	</ul>

	<br class="c"/>
	<h4 class="pk-tag-sidebar-title all-tags">All Tags <span class="pk-tag-sidebar-tag-count"><?php echo count($tags) ?></span></h4>
	<ul class="pk-tag-sidebar-list all-tags">
		<?php $n=1; foreach ($tags as $tag => $count): ?>
	  <li <?php echo ($n == count($tag) ? 'class="last"':'') ?>>
			<span class="pk-tag-sidebar-tag"><?php echo link_to($tag, pkUrl::addParams(pkContextCMSTools::getCurrentPage()->getUrl().'?tag='.$tag, $params['tag'])) ?></span>
			<span class="pk-tag-sidebar-tag-count"><?php echo $count ?></span>
		</li>
		<?php $n++; endforeach ?>
	</ul>
	
</div>

<script type="text/javascript">
	$('.pk-tag-sidebar-title.all-tags').click(function(){
		$('.pk-tag-sidebar-list.all-tags').slideToggle();
		$(this).toggleClass('open');
	});
	
	$('.pk-tag-sidebar-title.all-tags').hover(function(){
		$(this).toggleClass('over');
	},
	function(){
		$(this).toggleClass('over');		
	});
</script>