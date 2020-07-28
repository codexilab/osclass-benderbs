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
?>
<div class="mb-3 <?php echo $class; ?> premium">
	<div class="col-item">
		
		<?php if (osc_images_enabled_at_items()) : ?>
		<div class="photo">
			
			<?php if (osc_count_premium_resources()) : ?>
			<a href="<?php echo osc_premium_url() ; ?>" title="<?php echo osc_esc_html(osc_premium_title()) ; ?>"><img src="<?php echo osc_resource_thumbnail_url(); ?>" class="img-responsive" alt="<?php echo osc_esc_html(osc_premium_title()); ?>" /></a>
			<?php else: ?>
			<a href="<?php echo osc_premium_url() ; ?>" title="<?php echo osc_esc_html(osc_premium_title()) ; ?>"><img src="<?php echo osc_current_web_theme_url('img/no_photo.gif'); ?>" class="img-responsive" alt="<?php echo osc_esc_html(osc_premium_title()) ; ?>" /></a>
			<?php endif; ?>

		</div>
		<?php endif; ?>
		
		<div class="info text-wrap">

			<div class="content-item">
				<a class="u" href="<?php echo osc_premium_url() ; ?>" title="<?php echo osc_esc_html(osc_premium_title()) ; ?>"><?php echo osc_premium_title(); ?></a>
				<div class="small">
					<span><?php echo osc_premium_category(); ?></span> 
					<span><?php echo osc_premium_city(); ?> <?php if (osc_premium_region()!='') echo '('.osc_premium_region().')'; ?></span> 
					<span>-</span> <span class="text-nowrap"><?php echo osc_format_date(osc_premium_pub_date()); ?></span>
					<?php if (osc_price_enabled_at_items()) : ?><span class="text-bender-price font-weight-bold text-nowrap"><?php echo osc_format_price(osc_premium_price(),osc_premium_currency_symbol()); ?></span><?php endif; ?>
				</div>
				<?php if (!bender_show_as() || bender_show_as() == 'list') : ?>
				<div class="mt-2"><?php echo osc_highlight( osc_premium_description(), 250 ); ?></div>
				<?php endif; ?>

				<?php if ($admin) : ?>
				<div class="text-right text-sm">
					<a href="<?php echo osc_premium_edit_url(); ?>" class="text-gray-600 ml-2" rel="nofollow" data-toggle="tooltip" data-placement="top" title="<?php _e('Edit item', osc_current_web_theme()); ?>"><i class="fas fa-pencil-alt"></i></a>
					
					<a href="#" onclick="modalDeleteItem('<?php echo osc_premium_delete_url();?>');return false;" class="text-gray-600 ml-2 delete-item" data-toggle="tooltip" data-placement="top" title="<?php _e('Delete', osc_current_web_theme()); ?>"><i class="fas fa-trash"></i></a>

					<?php if (osc_premium_is_inactive()) : ?>
					<a href="<?php echo osc_premium_activate_url();?>" class="text-gray-600 ml-2" data-toggle="tooltip" data-placement="top" title="<?php _e('Activate', osc_current_web_theme()); ?>"><i class="fas fa-check"></i></a>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>

			<div class="clearfix"></div>
		</div>

	</div>
</div>