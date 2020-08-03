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

$action = 'item_add_post';
$edit = false;
if(Params::getParam('action') == 'item_edit') {
    $action = 'item_edit_post';
    $edit = true;
}

function js_item_post() {
	if (benderbs_default_location_show_as() == 'dropdown') {
	    CustomItemForm::location_javascript();
	} else {
	    CustomItemForm::location_javascript_new();
	}
}
osc_add_hook('footer', 'js_item_post');

osc_current_web_theme_path('header.php'); ?>
	<div class="col-md-12">
		<h1><?php _e('Publish a listing', BENDERBS_THEME_FOLDER); ?></h1>

		<form name="item" action="<?php echo osc_base_url(true);?>" method="post" enctype="multipart/form-data" id="item-post">
			<input type="hidden" name="action" value="<?php echo $action; ?>" />
			<input type="hidden" name="page" value="item" />
		<?php if ($edit) : ?>
			<input type="hidden" name="id" value="<?php echo osc_item_id();?>" />
            <input type="hidden" name="secret" value="<?php echo osc_item_secret();?>" />
		<?php endif; ?>

			<h2><?php _e('General Information', BENDERBS_THEME_FOLDER); ?></h2>
			
			<div class="form-group row">
			    <label for="email" class="col-md-4 col-form-label text-md-right"><?php _e('Category', BENDERBS_THEME_FOLDER); ?></label>
			    <div class="col-md-5">
			        <?php CustomItemForm::category_select(null, null, __('Select a category', BENDERBS_THEME_FOLDER)); ?>
			    </div>
			</div>

			<div class="form-group row">
			    <label for="title[<?php echo osc_current_user_locale(); ?>]" class="col-md-4 col-form-label text-md-right"><?php _e('Title', BENDERBS_THEME_FOLDER); ?></label>
			    <div class="col-md-5">
			        <?php CustomItemForm::title_input('title',osc_current_user_locale(), osc_esc_html( benderbs_item_title() )); ?>
			    </div>
			</div>

			<div class="form-group row">
			    <label for="description[<?php echo osc_current_user_locale(); ?>]" class="col-md-4 col-form-label text-md-right"><?php _e('Description', BENDERBS_THEME_FOLDER); ?></label>
			    <div class="col-md-5">
			        <?php CustomItemForm::description_textarea('description',osc_current_user_locale(), osc_esc_html( benderbs_item_description() )); ?>
			    </div>
			</div>

		<?php if (osc_price_enabled_at_items()) : ?>
			<div class="form-group form-group-price row">
			    <label for="price" class="col-md-4 col-form-label text-md-right"><?php _e('Price', BENDERBS_THEME_FOLDER); ?></label>
			    <div class="col col-md-3">
			        <?php CustomItemForm::price_input_text(); ?>
			    </div>
			    <div class="col col-md-2">
			    	<?php CustomItemForm::currency_select(); ?>
			    </div>
			</div>
		<?php endif; ?>

		<?php if (osc_images_enabled_at_items()) CustomItemForm::ajax_photos(); ?>

			<div class="location">
				<h2><?php _e('Listing Location', BENDERBS_THEME_FOLDER); ?></h2>

		<?php if (count(osc_get_countries()) > 1) : ?>

				<div class="form-group row">
				    <label for="country" class="col-md-4 col-form-label text-md-right"><?php _e('Country', BENDERBS_THEME_FOLDER); ?></label>
				    <div class="col-md-5">
				        <?php CustomItemForm::country_select(osc_get_countries(), osc_user()); ?>
				    </div>
				</div>

				<div class="form-group row">
				    <label for="regionId" class="col-md-4 col-form-label text-md-right"><?php _e('Region', BENDERBS_THEME_FOLDER); ?></label>
				    <div class="col-md-5">
			        <?php
	                if (benderbs_default_location_show_as() == 'dropdown') {
	                    if($edit) {
	                        CustomItemForm::region_select(osc_get_regions(osc_item_country_code()), osc_item());
	                    } else {
	                        CustomItemForm::region_select(osc_get_regions(osc_user_field('fk_c_country_code')), osc_user());
	                    }
	                } else {
	                    if($edit) {
	                        CustomItemForm::region_text(osc_item());
	                    } else {
	                        CustomItemForm::region_text(osc_user());
	                    }
	                }
	                ?>
				    </div>
				</div>

		<?php else : ?>

			<?php
			$aCountries = osc_get_countries();
			$aCountries[0]['pk_c_code'] = isset($aCountries[0]['pk_c_code']) && $aCountries[0]['pk_c_code'] ? $aCountries[0]['pk_c_code'] : '';
            $aRegions = osc_get_regions($aCountries[0]['pk_c_code']);
            ?>

            	<input type="hidden" id="countryId" name="countryId" value="<?php echo osc_esc_html($aCountries[0]['pk_c_code']); ?>"/>
	            <div class="form-group row">
				    <label for="country" class="col-md-4 col-form-label text-md-right"><?php _e('Region', BENDERBS_THEME_FOLDER); ?></label>
				    <div class="col-md-5">
					<?php
					if (benderbs_default_location_show_as() == 'dropdown') {
						if($edit) {
							CustomItemForm::region_select($aRegions, osc_item());
						} else {
							CustomItemForm::region_select($aRegions, osc_user());
						}
					} else {
						if($edit) {
							CustomItemForm::region_text(osc_item());
						} else {
							CustomItemForm::region_text(osc_user());
						}
					}
					?>
				    </div>
				</div>
		
		<?php endif; ?>

				<div class="form-group row">
				    <label for="city" class="col-md-4 col-form-label text-md-right"><?php _e('City', BENDERBS_THEME_FOLDER); ?></label>
				    <div class="col-md-5">
					<?php
	                if (benderbs_default_location_show_as() == 'dropdown') {
	                    if($edit) {
	                        CustomItemForm::city_select(null, osc_item());
	                    } else { // add new item
	                        CustomItemForm::city_select(osc_get_cities(osc_user_region_id()), osc_user());
	                    }
	                } else {
	                    CustomItemForm::city_text(osc_user());
	                }
	                ?>
				    </div>
				</div>

				<div class="form-group row">
				    <label for="cityArea" class="col-md-4 col-form-label text-md-right"><?php _e('City Area', BENDERBS_THEME_FOLDER); ?></label>
				    <div class="col-md-5">
					<?php CustomItemForm::city_area_text(osc_user()); ?>
				    </div>
				</div>

				<div class="form-group row">
				    <label for="address" class="col-md-4 col-form-label text-md-right"><?php _e('Address', BENDERBS_THEME_FOLDER); ?></label>
				    <div class="col-md-5">
					<?php CustomItemForm::address_text(osc_user()); ?>
				    </div>
				</div>
			</div><!-- ./location -->

			<!-- seller info -->
		<?php if (!osc_is_web_user_logged_in()) : ?>
			<div class="seller_info">
				<h2><?php _e("Seller's information", BENDERBS_THEME_FOLDER); ?></h2>

				<div class="form-group row">
				    <label for="contactName" class="col-md-4 col-form-label text-md-right"><?php _e('Name', BENDERBS_THEME_FOLDER); ?></label>
				    <div class="col-md-5">
					<?php CustomItemForm::contact_name_text(); ?>
				    </div>
				</div>

				<div class="form-group row">
				    <label for="contactEmail" class="col-md-4 col-form-label text-md-right"><?php _e('E-mail', BENDERBS_THEME_FOLDER); ?></label>
				    <div class="col-md-5">
					<?php CustomItemForm::contact_email_text(); ?>
				    </div>
				</div>

				<div class="form-group row">
                    <div class="col-md-5 offset-md-4">
                        <div class="checkbox" for="showEmail">
                            <label>
                                <?php CustomItemForm::show_email_checkbox(); ?> <?php _e('Show e-mail on the listing page', BENDERBS_THEME_FOLDER); ?>
                            </label>
                        </div>
                    </div>
                </div>
			</div><!-- ./seller_info -->
		<?php endif; ?>

		<?php
		if ($edit) {
            CustomItemForm::plugin_edit_item();
        } else {
            CustomItemForm::plugin_post_item();
        }
        ?>

        <?php if (osc_recaptcha_items_enabled()) : ?>
	        <div class="form-group row">
	            <div class="col-md-5 offset-md-4">
	                <?php osc_show_recaptcha(); ?>
	            </div>
	       	</div>
       	<?php endif; ?>

	        <div class="form-group row">
	            <div class="col-md-5 offset-md-4">
	                <button type="submit" class="btn btn-info btn-block-md-down">
	                    <?php if ($edit) { _e("Update", BENDERBS_THEME_FOLDER); } else { _e("Publish", BENDERBS_THEME_FOLDER); } ?>
	                </button>
	            </div>
	       	</div>
		</form>
	</div>
<?php osc_add_hook('footer', function() { ?>
	<script>
	$('#price').bind('hide-price', function(){
	    $('.form-group-price').hide();
	});

	$('#price').bind('show-price', function(){
	    $('.form-group-price').show();
	});

	<?php if (osc_locale_thousands_sep()!='' || osc_locale_dec_point() != '') : ?>
	$().ready(function(){
	    $("#price").blur(function(event) {
	        var price = $("#price").prop("value");
	        <?php if(osc_locale_thousands_sep()!='') { ?>
	        while(price.indexOf('<?php echo osc_esc_js(osc_locale_thousands_sep());  ?>')!=-1) {
	            price = price.replace('<?php echo osc_esc_js(osc_locale_thousands_sep());  ?>', '');
	        }
	        <?php }; ?>
	        <?php if(osc_locale_dec_point()!='') { ?>
	        var tmp = price.split('<?php echo osc_esc_js(osc_locale_dec_point())?>');
	        if(tmp.length>2) {
	            price = tmp[0]+'<?php echo osc_esc_js(osc_locale_dec_point())?>'+tmp[1];
	        }
	        <?php }; ?>
	        $("#price").prop("value", price);
	    });
	});
	<?php endif; ?>
	</script>
<?php }); ?>
<?php osc_current_web_theme_path('footer.php'); ?>