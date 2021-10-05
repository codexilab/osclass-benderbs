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
osc_add_hook('header','benderbs_nofollow_construct');

$list 		= 'active';
$gallery 	= '';
$listClass 	= 'col-sm-12 list-item';
if (benderbs_show_as() == 'gallery') {
	$list 		= '';
	$gallery 	= 'active';
	$listClass 	= 'col-sm-4';
}

$rw = (osc_rewrite_enabled()) ? '?' : '&';

osc_current_web_theme_path('header.php'); ?>

	<?php osc_current_web_theme_path('user-sidebar.php'); ?>

	<div class="col-md-9">
		<?php osc_run_hook('search_ads_listing_top'); ?>
		<h1><?php _e('My listings'); ?></h1>

	<?php if (osc_count_items() == 0) : ?>
		
		<div class="row mb-3">
			<div class="container-fluid">
			    <p class="text-center"><?php _e('No listings have been added yet', BENDERBS_THEME_FOLDER); ?></p>
			</div>
		</div>

	<?php else : ?>

		<div class="row mb-3">
			<div class="col-md-12 text-right">
				<div class="btn-group btn-group-toggle">
					<a href="<?php echo osc_user_list_items_url() . $rw; ?>sShowAs=list" class="btn btn-info btn-sm <?php echo $list; ?>">
						<i class="fas fa-list-ul"></i>
					</a>
					<a href="<?php echo osc_user_list_items_url() . $rw; ?>sShowAs=gallery" class="btn btn-info btn-sm <?php echo $gallery; ?>">
						<i class="fas fa-th"></i>
					</a>
				</div>
			</div>
		</div><!-- /.row -->

		<div class="row">
			<?php
			View::newInstance()->_exportVariableToView("listClass", $listClass);
			View::newInstance()->_exportVariableToView("listAdmin", true);
			osc_current_web_theme_path('loop.php');
			?>

			<div class="col-md-12">
			<?php if (osc_rewrite_enabled()) : ?>
				<?php $footerLinks = osc_search_footer_links(); ?>

				<ul class="list-inline">
					<?php foreach ($footerLinks as $f) : View::newInstance()->_exportVariableToView('footer_link', $f); ?>
					<?php if ($f['total'] < 3) continue; ?>
					<li class="list-inline-item"><a href="<?php echo osc_footer_link_url(); ?>"><?php echo osc_footer_link_title(); ?></a></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

				<nav aria-label="Pagination">
					<?php echo benderbs_pagination_items(); ?>
				</nav>
			</div>
		</div>

	<?php endif; ?>

	</div><!-- /.col-md-9 -->
<?php osc_current_web_theme_path('footer.php'); ?>