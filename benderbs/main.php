<?php
	/*
	 * MIT License
	 * 
	 * Copyright (c) 2020 CodexiLab
	 * 
	 * Permission is hereby granted, free of charge, to any person obtaining a copy
	 * of this software and associated documentation files (the "Software"), to deal
	 * in the Software without restriction, including without limitation the rights
	 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	 * copies of the Software, and to permit persons to whom the Software is
	 * furnished to do so, subject to the following conditions:
	 * 
	 * The above copyright notice and this permission notice shall be included in all
	 * copies or substantial portions of the Software.
	 * 
	 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
	 * SOFTWARE.
	 */
	 
// meta tag robots
osc_add_hook('header','benderbs_follow_construct');

$list 		= 'active';
$gallery 	= '';
$listClass 	= 'col-sm-12 list-item';
if (benderbs_show_as() == 'gallery') {
	$list 		= '';
	$gallery 	= 'active';
	$listClass 	= 'col-sm-4';
}

osc_current_web_theme_path('header.php'); ?>
	<aside id="sidebar" class="col-md-3 mt-3">
		<?php if (osc_get_preference('sidebar-300x250', 'bender') != '') : ?>
		<!-- sidebar ad 300x250 -->
		<div class="ads_300 mb-2">
		<?php echo osc_get_preference('sidebar-300x250', 'bender'); ?>
		</div>
		<!-- /sidebar ad 300x250 -->
		<?php endif; ?>
		
		<div class="p-2 mb-3 widget-box">
			<?php if (osc_count_list_regions() > 0) : ?>
			<h3><strong><?php _e("Location", BENDERBS_THEME_FOLDER) ; ?></strong></h3>
			<ul class="mt-3">
				<?php while (osc_has_list_regions()) : ?>
				 <li><a href="<?php echo osc_list_region_url(); ?>"><?php echo osc_list_region_name() ; ?> <em>(<?php echo osc_list_region_items() ; ?>)</em></a></li>
				<?php endwhile; ?>
			</ul>
			<?php endif; ?>
		</div><!-- /.widget-box -->
	</aside>

	<section class="col-md-9 mt-max-sm-2 mt-3">

		<div class="row mb-3">

			<div class="col-md-6">
			<h1><strong><?php _e('Latest Listings', BENDERBS_THEME_FOLDER) ; ?></strong></h1>
			</div>

			<?php if (osc_count_latest_items() > 0) : ?>
			<div class="col-md-6 text-right">
				<div class="btn-group btn-group-toggle">
					<a href="<?php echo osc_base_url(true); ?>?sShowAs=list" class="btn btn-info btn-sm <?php echo $list; ?>">
						<i class="fas fa-list-ul"></i>
					</a>
					<a href="<?php echo osc_base_url(true); ?>?sShowAs=gallery" class="btn btn-info btn-sm <?php echo $gallery; ?>">
						<i class="fas fa-th"></i>
					</a>
				</div>
			</div>
			<?php endif; ?>
		
		</div><!-- /.row -->

	<?php if (osc_count_latest_items() > 0) : ?>

		<section class="row">
		<?php
		View::newInstance()->_exportVariableToView("listType", 'latestItems');
	    View::newInstance()->_exportVariableToView("listClass", $listClass);
	    osc_current_web_theme_path('loop.php');
		?>
		</section>

		<?php if (osc_count_latest_items() == osc_max_latest_items()) : ?>
		<div class="text-md-left text-right">
			<p><a href="<?php echo osc_search_show_all_url(); ?>"><strong><?php _e('See all listings', BENDERBS_THEME_FOLDER) ; ?> &raquo;</strong></a></p>	
		</div>
		<?php endif; ?>
		
	<?php else: ?>

		<div class="center"><?php _e("There aren't listings available at this moment", BENDERBS_THEME_FOLDER); ?></div>
		
	<?php endif; ?>

	</section><!-- /.col-md-9 -->

	<?php if (osc_get_preference('homepage-728x90', 'bender') != '') : ?>
	<div class="col-sm-12 text-center">
		<!-- homepage ad 728x60-->
		<div class="ads_728">
			<?php echo osc_get_preference('homepage-728x90', 'bender'); ?>
		</div>
	</div>
	<?php endif; ?>
<?php osc_current_web_theme_path('footer.php'); ?>