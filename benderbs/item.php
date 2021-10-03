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
if( osc_item_is_spam() || osc_premium_is_spam() ) {
    osc_add_hook('header','benderbs_nofollow_construct');
} else {
    osc_add_hook('header','benderbs_follow_construct');
}

// For related items loop
$list 		= 'active';
$gallery 	= '';
$listClass 	= 'col-sm-12 list-item';
if (benderbs_show_as() == 'gallery') {
	$list 		= '';
	$gallery 	= 'active';
	$listClass 	= 'col-sm-4';
}

$location = array();
if( osc_item_city_area() !== '' ) {
    $location[] = osc_item_city_area();
}
if( osc_item_city() !== '' ) {
    $location[] = osc_item_city();
}
if( osc_item_region() !== '' ) {
    $location[] = osc_item_region();
}
if( osc_item_country() !== '' ) {
    $location[] = osc_item_country();
}

function js_item() {
	CustomCommentForm::js_validation();
}
osc_add_hook('footer', 'js_item');

osc_current_web_theme_path('header.php'); ?>

	<?php osc_current_web_theme_path('item-sidebar.php'); ?>

	<article id="item-content" class="col-md-8 order-1 pb-3 item">
		<h1>
			<?php if (osc_price_enabled_at_items()) : ?>
			<span id="price-item-<?php echo osc_item_id(); ?>" class="price<?php if (osc_item_price() !== null) echo ' cursor-pointer'; ?>" 
				<?php if (osc_item_price() !== null) : ?>
				data-toggle="tooltip" data-placement="top" title="<?php _e('Copy to Clipboard', BENDERBS_THEME_FOLDER); ?>" onclick="copyPriceToClipboard(<?php echo osc_item_id(); ?>, 'item');return false;"
				<?php endif; ?>
			>
				<?php echo osc_item_formatted_price(); ?>
			</span> 
			<?php endif; ?>
			<strong><?php echo osc_item_title() . ', ' . osc_item_city(); ?></strong>
		</h1>

		<section class="bg-gray-bender small mt-3 p-1 rounded">

			<?php if (osc_item_pub_date() !== '') : ?>
				<div><?php printf(__('<strong class="publish">Published date</strong>: %1$s', BENDERBS_THEME_FOLDER), osc_format_date( osc_item_pub_date())); ?></div>
			<?php endif; ?>
			
			<?php if (osc_item_mod_date() !== '') : ?>
				<div><?php printf(__('<strong class="update">Modified date:</strong> %1$s', BENDERBS_THEME_FOLDER), osc_format_date( osc_item_mod_date())); ?></div>
			<?php endif; ?>
			
			<?php if (count($location)>0) : ?>
			<div id="item_location"><strong><?php _e('Location', BENDERBS_THEME_FOLDER); ?></strong>: <?php echo implode(', ', $location); ?></div>
			<?php endif; ?>

		</section>

		<?php if (osc_is_web_user_logged_in() && osc_logged_user_id()==osc_item_user_id()) : ?>
		<div id="edit_item_view" class="mt-1 text-right"><a href="<?php echo osc_item_edit_url(); ?>" rel="nofollow"><?php _e('Edit item', BENDERBS_THEME_FOLDER); ?></a></div>
		<?php endif; ?>

		<?php if (osc_images_enabled_at_items()) : ?>
			
			<?php if (osc_count_item_resources() > 0) : ?>
			<div id="itemCarousel" class="carousel slide mt-3" data-ride="carousel">

				<div class="carousel-inner">
					<?php $num = 0; while (osc_has_item_resources()) : $num++; ?>
                    <div class="carousel-item<?php if ($num == 1) echo ' active'; ?>">
                        <a href="<?php echo (file_exists(osc_resource_path())) ? osc_resource_original_url() : osc_resource_url(); ?>" target="_blank">
							<img src="<?php echo osc_resource_url(); ?>" class="img-fluid" alt="<?php echo osc_resource_name(); ?>">
						</a>
					</div>
					<?php endwhile; ?>
				</div>

				<?php if (osc_count_item_resources() > 1) : ?>
				<a class="carousel-control-prev" href="#itemCarousel" data-slide="prev">
					<span class="carousel-control-prev-icon"></span>
				</a>

				<a class="carousel-control-next" href="#itemCarousel" data-slide="next">
					<span class="carousel-control-next-icon"></span>
				</a>
				<?php endif; ?>
				
			</div>
			<?php endif; // if (osc_count_item_resources() > 0) ?>

			<?php View::newInstance()->_erase('resources'); ?>
			<?php if (osc_count_item_resources() > 1) : ?>
			<div class="scroll-h-auto mt-2">
				<div class="center">
					<div style="width: max-content">
						<ul class="list-inline">
							<?php $num = 0; while (osc_has_item_resources()) : ?>
							<li class="list-inline-item m-1">
								<a href="" data-target="#itemCarousel" data-slide-to="<?php echo $num++; ?>">
									<img width="75" src="<?php echo osc_resource_thumbnail_url(); ?>" alt="<?php echo osc_item_title(); ?>" class="img-fluid img-thumbnail" title="<?php echo osc_item_title(); ?>" />
								</a>
							</li>
							<?php endwhile; ?>
						</ul>
					</div>
				</div>
			</div>
			<?php endif; // if (osc_count_item_resources() > 1) ?>

		<?php endif; // if (osc_images_enabled_at_items()) ?>

		<section id="description" class="mt-1">
			<p><?php echo osc_item_description(); ?></p>
			
			<?php if (osc_count_item_meta() >= 1) : ?>
			<div id="custom_fields" class="clearfix">
                <ul class="list-unstyled meta_list">
                    <?php while (osc_has_item_meta()) : ?>
                        <?php if (osc_item_meta_value()!='') : ?>
                            <li class="w-50 float-left meta meta">
                                <b><?php echo osc_item_meta_name(); ?>:</b> <span class="float-right mr-1"><?php echo osc_item_meta_value(); ?></span>
                            </li>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </ul>
	        </div>
	        <?php endif; ?>

	        <?php osc_run_hook('item_detail', osc_item()); ?>

			<?php if (!osc_item_is_expired()) : ?>
			<?php if (!( ( osc_logged_user_id() == osc_item_user_id()) && osc_logged_user_id() != 0)) : ?>
				<?php if (osc_reg_user_can_contact() && osc_is_web_user_logged_in() || !osc_reg_user_can_contact()) : ?>
				<a href="#contact" class="btn btn-info btn-block d-md-none mb-2"><?php _e('Contact seller', BENDERBS_THEME_FOLDER); ?>r</a>
				<?php endif; ?>
			<?php endif; ?>
			<?php endif; ?>

			<a href="<?php echo osc_item_send_friend_url(); ?>" rel="nofollow" class="btn btn-light btn-block-md-down mb-1"><?php _e('Share', BENDERBS_THEME_FOLDER); ?></a>

			<?php osc_run_hook('location'); ?>
		</section>

		<!-- plugins -->

		<section id="useful_info" class="mt-2 small p-3 border border-bender rounded">
	        <h5><?php _e('Useful information', BENDERBS_THEME_FOLDER); ?></h5>
	        <ul>
	            <li><?php _e('Avoid scams by acting locally or paying with PayPal', BENDERBS_THEME_FOLDER); ?></li>
	            <li><?php _e('Never pay with Western Union, Moneygram or other anonymous payment services', BENDERBS_THEME_FOLDER); ?></li>
	            <li><?php _e('Don\'t buy or sell outside of your country. Don\'t accept cashier cheques from outside your country', BENDERBS_THEME_FOLDER); ?></li>
	            <li><?php _e('This site is never involved in any transaction, and does not handle payments, shipping, guarantee transactions, provide escrow services, or offer "buyer protection" or "seller certification"', BENDERBS_THEME_FOLDER); ?></li>
	        </ul>
	    </section>

	    <?php related_listings(); ?>
        <?php if (osc_count_items() > 0) : ?>
        <section class="similar_ads mt-3">
            <h2><?php _e('Related listings', BENDERBS_THEME_FOLDER); ?></h2>
            <div class="row">
        	<?php
            View::newInstance()->_exportVariableToView("listType", 'items');
            View::newInstance()->_exportVariableToView("listClass", $listClass);
            osc_current_web_theme_path('loop.php');
            ?>
            </div>
            <div class="clear"></div>
        </section>
    	<?php endif; ?>

    	<?php if (osc_comments_enabled()) : ?>
    	<?php if (osc_reg_user_post_comments () && osc_is_web_user_logged_in() || !osc_reg_user_post_comments()) : ?>
		<section id="comments" class="mt-3">
			
			<h2><?php _e('Comments', BENDERBS_THEME_FOLDER); ?></h2>

			<?php if (osc_count_item_comments() >= 1) : ?>
				<?php while (osc_has_item_comments()) : ?>
					<article class="media mt-3 mb-2">
						<div class="w-min-content">
							<img width="64" src="<?php echo user_thumb_url(); ?>" class="rounded-circle mr-3" alt="...">
							<br>
							<div class="text-wrap text-center mr-3"><h5><small><?php echo osc_format_date(osc_comment_pub_date(), 'M j, Y g:i a'); ?></small></h5></div>
						</div>

						<div class="media-body mw-100 scroll-h-auto">
							<h5 class="mt-0"><?php echo osc_comment_title(); ?> <small><?php _e('by', BENDERBS_THEME_FOLDER); ?> <?php echo benderbs_comment_author(); ?></small></h5>
							<?php echo nl2br(osc_comment_body()); ?>
						</div>

						<?php if (osc_comment_user_id() && (osc_comment_user_id() == osc_logged_user_id())) : ?>
						<div>
							<a href="#" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-caret-down"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<a rel="nofollow" class="dropdown-item" href="<?php echo osc_delete_comment_url(); ?>" title="<?php _e('Delete your comment', BENDERBS_THEME_FOLDER); ?>"><?php _e('Delete', BENDERBS_THEME_FOLDER); ?></a>
							</div>
						</div>
						<?php endif; ?>
					</article>
				<?php endwhile; ?>
			<?php endif; ?>

			<p class="font-osclass text-dark"><strong><?php _e('Leave your comment (spam and offensive messages will be removed)', BENDERBS_THEME_FOLDER); ?></strong></p>

			<form action="<?php echo osc_base_url(true); ?>" method="post" name="comment_form" id="comment_form">
				<input type="hidden" name="action" value="add_comment" />
                <input type="hidden" name="page" value="item" />
                <input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />
            	
            	<?php if (osc_is_web_user_logged_in()) : ?>
            	<input type="hidden" name="authorName" value="<?php echo osc_esc_html( osc_logged_user_name()); ?>" />
                <input type="hidden" name="authorEmail" value="<?php echo osc_logged_user_email(); ?>" />
            	
            	<?php else : ?>
				
				<div class="form-group row text-md-right">
					<label for="authorName" class="col-sm-2 col-form-label"><?php _e('Your name', BENDERBS_THEME_FOLDER); ?></label>
					<div class="col-sm-10">
						<?php CustomCommentForm::author_input_text(); ?>
					</div>
				</div>
				<div class="form-group row text-md-right">
					<label for="authorEmail" class="col-sm-2 col-form-label"><?php _e('Your e-mail', BENDERBS_THEME_FOLDER); ?></label>
					<div class="col-sm-10">
						<?php CustomCommentForm::email_input_text(); ?>
					</div>
				</div>
            	<?php endif; ?>

            	<div class="form-group row text-md-right">
					<label for="title" class="col-sm-2 col-form-label"><?php _e('Title', BENDERBS_THEME_FOLDER); ?></label>
					<div class="col-sm-10">
						<?php CustomCommentForm::title_input_text(); ?>
					</div>
				</div>
				<div class="form-group row text-md-right">
					<label for="body" class="col-sm-2 col-form-label"><?php _e('Comment', BENDERBS_THEME_FOLDER); ?></label>
					<div class="col-sm-10">
						<?php CustomCommentForm::body_input_textarea(); ?>
					</div>
				</div>
            	<div class="form-group row">
				    <div class="col-sm-12 col-md-10 ml-md-auto">
				    	<button type="submit" class="btn btn-light btn-block-md-down"><?php _e('Send', BENDERBS_THEME_FOLDER); ?></button>
				    </div>
				</div>
			</form>
		</section>
		<?php endif; ?>
		<?php endif; // if (osc_comments_enabled()) ?>
	</article>
<?php osc_current_web_theme_path('footer.php') ; ?>
