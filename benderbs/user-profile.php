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
osc_add_hook('header','bender_nofollow_construct');

function custom_meta_title($data){
    return __('Update account', osc_current_web_theme());
}
osc_add_filter('meta_title_filter','custom_meta_title');

function js_user_profile() {
	CustomUserForm::location_javascript();
}
osc_add_hook('footer', 'js_user_profile');

osc_current_web_theme_path('header.php');
$osc_user = osc_user(); ?>

	<?php osc_current_web_theme_path('user-sidebar.php'); ?>

	<div class="col-md-9">
		<h1><?php _e('Update account', osc_current_web_theme()); ?></h1>

		<form action="<?php echo osc_base_url(true); ?>" method="post" class="mt-3">
			<input type="hidden" name="page" value="user" />
            <input type="hidden" name="action" value="profile_post" />
			<div class="form-group row">
				<label for="name" class="col-sm-2 col-form-label text-md-right"><?php _e('Name', osc_current_web_theme()); ?></label>
				<div class="col-sm-9">
					<?php CustomUserForm::name_text(osc_user()); ?>
				</div>
			</div>

			<div class="form-group row">
				<label for="user_type" class="col-sm-2 col-form-label text-md-right"><?php _e('User type', osc_current_web_theme()); ?></label>
				<div class="col-sm-9">
					<?php CustomUserForm::is_company_select(osc_user()); ?>
				</div>
			</div>

			<div class="form-group row">
				<label for="phoneMobile" class="col-sm-2 col-form-label text-md-right"><?php _e('Cell phone', osc_current_web_theme()); ?></label>
				<div class="col-sm-9">
					<?php CustomUserForm::mobile_text(osc_user()); ?>
				</div>
			</div>

			<div class="form-group row">
				<label for="phoneLand" class="col-sm-2 col-form-label text-md-right"><?php _e('Phone', osc_current_web_theme()); ?></label>
				<div class="col-sm-9">
					<?php CustomUserForm::phone_land_text(osc_user()); ?>
				</div>
			</div>

			<div class="form-group row">
				<label for="country" class="col-sm-2 col-form-label text-md-right"><?php _e('Country', osc_current_web_theme()); ?></label>
				<div class="col-sm-9">
					<?php CustomUserForm::country_select(osc_get_countries(), osc_user()); ?>
				</div>
			</div>

			<div class="form-group row">
				<label for="region" class="col-sm-2 col-form-label text-md-right"><?php _e('Region', osc_current_web_theme()); ?></label>
				<div class="col-sm-9">
					<?php CustomUserForm::region_select(osc_get_regions(), osc_user()); ?>
				</div>
			</div>

			<div class="form-group row">
				<label for="city" class="col-sm-2 col-form-label text-md-right"><?php _e('City', osc_current_web_theme()); ?></label>
				<div class="col-sm-9">
					<?php CustomUserForm::city_select(osc_get_cities(), osc_user()); ?>
				</div>
			</div>

			<div class="form-group row">
				<label for="city_area" class="col-sm-2 col-form-label text-md-right"><?php _e('City area', osc_current_web_theme()); ?></label>
				<div class="col-sm-9">
					<?php CustomUserForm::city_area_text(osc_user()); ?>
				</div>
			</div>

			<div class="form-group row">
				<label for="address" class="col-sm-2 col-form-label text-md-right"><?php _e('Address', osc_current_web_theme()); ?></label>
				<div class="col-sm-9">
					<?php CustomUserForm::address_text(osc_user()); ?>
				</div>
			</div>

			<div class="form-group row">
				<label for="webSite" class="col-sm-2 col-form-label text-md-right"><?php _e('Website', osc_current_web_theme()); ?></label>
				<div class="col-sm-9">
					<?php CustomUserForm::website_text(osc_user()); ?>
				</div>
			</div>

			<div class="form-group row">
				<label for="s_info" class="col-sm-2 col-form-label text-md-right"><?php _e('Description', osc_current_web_theme()); ?></label>
				<div class="col-sm-9">
					<?php CustomUserForm::info_textarea('s_info', osc_locale_code(), @$osc_user['locale'][osc_locale_code()]['s_info']); ?>
				</div>
			</div>

			<?php osc_run_hook('user_profile_form', osc_user()); ?>

			<div class="form-group row">
			    <div class="col-sm-12 col-md-10 ml-md-auto">
			    	<button type="submit" class="btn btn-info btn-block-md-down"><?php _e("Update", osc_current_web_theme());?></button>
			    </div>
			</div>

			<div class="form-group row">
				<?php osc_run_hook('user_form', osc_user()); ?>
			</div>
		</form>
	</div>
<?php osc_current_web_theme_path('footer.php') ; ?>