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

function custom_meta_title($data){
    return __('Alerts');;
}
osc_add_filter('meta_title_filter','custom_meta_title');

$list 		= 'active';
$gallery 	= '';
$listClass 	= 'col-sm-12 list-item';
if (benderbs_show_as() == 'gallery') {
	$list 		= '';
	$gallery 	= 'active';
	$listClass 	= 'col-sm-4';
}

osc_current_web_theme_path('header.php');
$osc_user = osc_user(); ?>

	<?php osc_current_web_theme_path('user-sidebar.php'); ?>
	
	<div class="col-md-9">
		<h1><?php _e('Alerts'); ?></h1>

		<?php if (osc_count_alerts() == 0) : ?>
		<div class="row mb-3">
			<div class="container-fluid">
			    <p class="text-center"><?php _e('You do not have any alerts yet', BENDERBS_THEME_FOLDER); ?>.</p>
			</div>
		</div>
		<?php else : ?>
		<div class="row">
			<?php $i = 1; ?>
			<?php while (osc_has_alerts()) : ?>

			<div class="col-md-12">
				<h3><?php _e('Alert'); ?> <?php echo $i; ?> <small><a href="#" onclick="modalDeleteItem('<?php echo osc_user_unsubscribe_alert_url();?>');return false;" class="text-gray-600 ml-2 delete-item" data-toggle="tooltip" data-placement="top" title="<?php _e('Delete this alert', BENDERBS_THEME_FOLDER); ?>"><i class="fas fa-trash"></i></a></small></h3>
			</div>

			<?php
			View::newInstance()->_exportVariableToView("listClass", $listClass);
			osc_current_web_theme_path('loop.php');
			?>

			<?php if (osc_count_items() == 0) : ?>
			<div class="col-md-12 mb-3">0 <?php _e('Listings'); ?></div>
			<?php endif; ?>

			<?php $i++; ?>
			<?php endwhile; ?>
		</div>
		<?php endif; ?>
	</div>
<?php osc_current_web_theme_path('footer.php'); ?>