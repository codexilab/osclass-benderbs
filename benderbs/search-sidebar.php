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
	 
$category = __get("category");
if (!isset($category['pk_i_id'])) {
	$category = array('pk_i_id' => null);
}
?>
<aside id="sidebar" class="col">
	<?php osc_alert_form(); ?>

	<form action="<?php echo osc_base_url(true); ?>" method="get" class="pt-3">
		<input type="hidden" name="page" value="search"/>
	    <input type="hidden" name="sOrder" value="<?php echo osc_search_order(); ?>" />
	    <input type="hidden" name="iOrderType" value="<?php $allowedTypesForSorting = Search::getAllowedTypesForSorting() ; echo $allowedTypesForSorting[osc_search_order_type()]; ?>" />
		<?php foreach (osc_search_user() as $userId) : ?>
	    <input type="hidden" name="sUser[]" value="<?php echo $userId; ?>"/>
	    <?php endforeach; ?>

		<div class="form-group">
			<h3><label for="query"><?php _e('Your search', BENDERBS_THEME_FOLDER); ?></label></h3>
			<input type="text" class="form-control form-control-light" name="sPattern" id="query" value="<?php echo osc_esc_html(osc_search_pattern()); ?>">
		</div>

		<div class="form-group">
			<h3><label for="sCity"><?php _e('City', BENDERBS_THEME_FOLDER); ?></label></h3>
			<input class="input-text" type="hidden" id="sRegion" name="sRegion" value="<?php echo osc_esc_html(Params::getParam('sRegion')); ?>" />
			<input type="text" class="form-control form-control-light" autocomplete="off" id="sCity" name="sCity" value="<?php echo osc_esc_html(osc_search_city()); ?>">
		</div>

		<div id="output"></div>

		<?php if (osc_images_enabled_at_items()) : ?>
		<div class="form-group">
			<h3><?php _e('Show only', BENDERBS_THEME_FOLDER); ?></h3>
			<div class="form-check">
				<input type="checkbox" class="form-check-input" name="bPic" id="withPicture" value="1" <?php echo (osc_search_has_pic() ? 'checked' : ''); ?>>
				<label class="form-check-label" for="withPicture"><?php _e('listings with pictures', BENDERBS_THEME_FOLDER) ; ?></label>
			</div>
		</div>
		<?php endif; ?>

		<?php if (osc_price_enabled_at_items()) : ?>
		<div class="form-group">
			<h3><label><?php _e('Price', BENDERBS_THEME_FOLDER) ; ?></label></h3>
			<div class="row">
				<div class="col-6"><input type="text" class="form-control form-control-light" id="priceMin" name="sPriceMin" value="<?php echo osc_esc_html(osc_search_price_min()); ?>" placeholder="<?php _e('Min', BENDERBS_THEME_FOLDER) ; ?>." maxlength="10"></div>
				<div class="col-6"><input type="text" class="form-control form-control-light" id="priceMax" name="sPriceMax" value="<?php echo osc_esc_html(osc_search_price_max()); ?>" placeholder="<?php _e('Max', BENDERBS_THEME_FOLDER) ; ?>." maxlength="10"></div>  
			</div>
		</div>
		<?php endif; ?>

		<?php
	    if(osc_search_category_id()) {
	        osc_run_hook('search_form', osc_search_category_id()) ;
	    } else {
	        osc_run_hook('search_form') ;
	    }
	    ?>

		<?php $aCategories = osc_search_category();
	    foreach ($aCategories as $cat_id) : ?>
	    <input type="hidden" name="sCategory[]" value="<?php echo osc_esc_html($cat_id); ?>"/>
	    <?php endforeach; ?>
	    
		<button type="submit" class="btn btn-info btn-block-md-down"><?php _e('Apply', BENDERBS_THEME_FOLDER) ; ?></button>
	</form>
	<h3 class="pt-3"><?php _e('Refine category', BENDERBS_THEME_FOLDER) ; ?></h3>
	<?php benderbs_sidebar_category_search($category['pk_i_id']); ?>
</aside>