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
if (osc_count_items() == 0 || stripos($_SERVER['REQUEST_URI'], 'search')) {
    osc_add_hook('header','bender_nofollow_construct');
} else {
    osc_add_hook('header','bender_follow_construct');
}

$list 		= 'active';
$gallery 	= '';
$listClass 	= 'col-sm-12 list-item';
if (osc_search_show_as() == 'gallery') {
	$list 		= '';
	$gallery 	= 'active';
	$listClass 	= 'col-sm-4';
}

function autocompleteCity() { ?>
<script>
$(function() {
    function log(message) {
        $("<div/>").text(message).prependTo("#log");
        $("#log").attr("scrollTop", 0);
    }

    $("#sCity").autocomplete({
        source: "<?php echo osc_base_url(true); ?>?page=ajax&action=location",
        minLength: 2,
        select: function( event, ui ) {
            $("#sRegion").attr("value", ui.item.region);
            log(ui.item ?
                "<?php echo osc_esc_html( __('Selected', osc_current_web_theme()) ); ?>: " + ui.item.value + " aka " + ui.item.id :
                "<?php echo osc_esc_html( __('Nothing selected, input was', osc_current_web_theme()) ); ?> " + this.value );
        }
    });
});
</script>
<?php
}
osc_add_hook('footer','autocompleteCity');

osc_current_web_theme_path('header.php'); ?>

	<?php osc_current_web_theme_path('search-sidebar.php'); ?>

	<div class="col-md-9 pb-3">
		<?php osc_run_hook('search_ads_listing_top'); ?>
		
		<h1><?php echo search_title(); ?></h1>

		<div class="row mb-3">
			<div class="col-md-6 order-md-2 text-md-right">
				<?php _e('Sort by', osc_current_web_theme()); ?>: 

				<?php
				$orders = osc_list_orders();
				$current = '';
				foreach ($orders as $label => $params) {
					$orderType = ($params['iOrderType'] == 'asc') ? '0' : '1';
					if(osc_search_order() == $params['sOrder'] && osc_search_order_type() == $orderType) {
						$current = $label;
					}
				}
				?>

				<div class="btn-group">
					<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
					<?php echo $current; ?>
					</button>
					<div class="dropdown-menu dropdown-menu-lg-right text-right">
						<?php 
						$i = 0;
						foreach ($orders as $label => $params) {
							$orderType = ($params['iOrderType'] == 'asc') ? '0' : '1';
							if (osc_search_order() == $params['sOrder'] && osc_search_order_type() == $orderType) {
								echo '<a class="dropdown-item active" href="'.osc_esc_html(osc_update_search_url($params)).'" class="dropdown-item">'.$label.'</a>' . PHP_EOL;
							} else {
								echo '<a class="dropdown-item" href="'.osc_esc_html(osc_update_search_url($params)).'" class="dropdown-item">'.$label.'</a>' . PHP_EOL;
							}
							$i++;
						}
						?>
					</div>
				</div>

				<div class="btn-group btn-group-toggle">
					<a href="<?php echo osc_esc_html(osc_update_search_url(array('sShowAs'=> 'list'))); ?>" class="btn btn-info btn-sm <?php echo $list; ?>">
						<i class="fas fa-list-ul"></i>
					</a>
					<a href="<?php echo osc_esc_html(osc_update_search_url(array('sShowAs'=> 'gallery'))); ?>" class="btn btn-info btn-sm <?php echo $gallery; ?>">
						<i class="fas fa-th"></i>
					</a>
				</div>
			</div>

			<div class="col-md-6 order-md-1"><?php
                $search_number = bender_search_number();
                printf(__('%1$d - %2$d of %3$d listings', osc_current_web_theme()), $search_number['from'], $search_number['to'], $search_number['of']);
            ?></div>
		</div><!-- /.row -->

		<div class="row">

		<?php osc_get_premiums();
        if (osc_count_premiums() > 0) {
        	echo '<div class="col-12"><h5>'.__('Premium listings', osc_current_web_theme()).'</h5></div>';
            View::newInstance()->_exportVariableToView("listType", 'premiums');
            View::newInstance()->_exportVariableToView("listClass", $listClass);
            osc_current_web_theme_path('loop.php');
            echo '<div class="col-12"></div>';
        } ?>
			
		<?php if (osc_count_items() > 0) : ?>

			<?php
			echo '<div class="col-12"><h5>'.__('Listings', osc_current_web_theme()).'</h5></div>';
		    View::newInstance()->_exportVariableToView("listType", 'items');
		    View::newInstance()->_exportVariableToView("listClass", $listClass);
		    osc_current_web_theme_path('loop.php');
		    ?>

			<div class="col-md-12">
			
			<?php if (osc_rewrite_enabled()) : ?>
				<?php $footerLinks = osc_search_footer_links(); ?>
				<?php if (count($footerLinks) > 0) : ?>
				<h5><?php _e('Other searches that may interest you',osc_current_web_theme()); ?></h5>
				<ul class="list-inline">
					<?php foreach ($footerLinks as $f) : View::newInstance()->_exportVariableToView('footer_link', $f); ?>
					<?php if ($f['total'] < 3) continue; ?>
					<li class="list-inline-item"><a href="<?php echo osc_footer_link_url(); ?>"><?php echo osc_footer_link_title(); ?></a></li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>
			<?php endif; ?>

				<nav aria-label="Pagination">
				<?php echo bender_search_pagination(); ?>
				</nav>

			</div>

		<?php else : ?>

			<div class="col-sm-12">
				<p><?php printf(__('There are no results matching "%s"', osc_current_web_theme()), osc_search_pattern()) ; ?></p>
			</div>

		<?php endif; ?>

		</div><!-- /.row -->

	</div><!-- /.col-md-9 -->

<?php osc_current_web_theme_path('footer.php') ; ?>