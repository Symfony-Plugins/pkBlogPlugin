<div class="pk-blog-categories">
  <h4>Categories</h4>
  <ul class="pk-blog-filter-options">
  <?php foreach ($categories as $category): ?>
    <li><?php echo link_to($category, pkUrl::addParams(($sf_params->get('cat') == $category->getSlug()) ? 'pkBlog/index' : 'pkBlog/index?cat='.$category->getSlug(), $params['cat']), array(
      'class' => ($category->getSlug() == $sf_params->get('cat')) ? 'selected' : '', 
    )) ?></li>
  <?php endforeach ?>
  </ul>	
</div>

<hr />

<div class="pk-blog-filter">
  <h4>Browse by</h4>
  <ul class="pk-blog-filter-options">
    <li><?php echo link_to('Day', 'pkBlog/index?'.http_build_query(($dateRange == 'day') ? $params['nodate'] : $params['day']), array('class' => ($dateRange == 'day') ? 'selected' : '')) ?></li>
    <li><?php echo link_to('Month', 'pkBlog/index?'.http_build_query(($dateRange == 'month') ? $params['nodate'] : $params['month']), array('class' => ($dateRange == 'month') ? 'selected' : '')) ?></li>
    <li><?php echo link_to('Year', 'pkBlog/index?'.http_build_query(($dateRange == 'year') ? $params['nodate'] : $params['year']), array('class' => ($dateRange == 'year') ? 'selected' : '')) ?></li>
  </ul>
</div>

<hr />

<div class="pk-blog-tags">  

	<?php if (isset($tag)): ?>
	<h4 class="pk-tag-sidebar-title selected-tag">Selected Tag</h4>  
	<ul class="pk-blog-selected-tag">
		<li><?php #echo $tag ?><?php echo link_to($tag, pkUrl::addParams('pkBlog/index', $params['tag']), array('class' => 'selected', )) ?></li>
	</ul>
	<?php endif ?>


	<h4 class="pk-tag-sidebar-title popular">Popular Tags</h4>  			
	<ul class="pk-tag-sidebar-list popular">
		<?php $n=1; foreach ($popular as $tag => $count): ?>
	  <li <?php echo ($n == count($popular) ? 'class="last"':'') ?>>
			<span class="pk-tag-sidebar-tag"><?php echo link_to($tag, pkUrl::addParams('pkBlog/index?tag='.$tag, $params['tag'])) ?></span>
			<span class="pk-tag-sidebar-tag-count"><?php echo $count ?></span>
		</li>
		<?php $n++; endforeach ?>
	</ul>

	<br class="c"/>
	<h4 class="pk-tag-sidebar-title all-tags">All Tags <span class="pk-tag-sidebar-tag-count"><?php echo count($tags) ?></span></h4>
	<ul class="pk-tag-sidebar-list all-tags">
		<?php $n=1; foreach ($tags as $tag => $count): ?>
	  <li <?php echo ($n == count($tag) ? 'class="last"':'') ?>>
			<span class="pk-tag-sidebar-tag"><?php echo link_to($tag, pkUrl::addParams('pkBlog/index?tag='.$tag, $params['tag'])) ?></span>
			<span class="pk-tag-sidebar-tag-count"><?php echo $count ?></span>
		</li>
		<?php $n++; endforeach ?>
	</ul>
	
</div>

<hr />

<h5><?php echo link_to('RSS Feed','@pk_blog_feed', array('class' => 'pk-rss-feed', )) ?></h5>


<script type="text/javascript">
$(document).ready(function() {
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
	
	$('a.selected').prepend('<span class="close"></span>')
});	
</script>