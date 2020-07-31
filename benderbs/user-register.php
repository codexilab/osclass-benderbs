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
benderbs_add_row_class('justify-content-md-center');
osc_current_web_theme_path('header.php'); ?>
	<div class="col-md-10">

		<div class="card border mb-3">
			<div class="card-header"><h1><?php _e('Register an account for free', BENDERBS_THEME_FOLDER); ?></h1></div>
			<div class="card-body text-secondary">
				<div class="row">
					<div class="col-md-11">
						<form name="register" action="<?php echo osc_base_url(true); ?>" method="post">
							<input type="hidden" name="page" value="register" />
            				<input type="hidden" name="action" value="register_post" />

				            <div class="form-group row">
				            	<label for="name" class="col-sm-3 col-form-label text-md-right"><?php _e('Name', BENDERBS_THEME_FOLDER); ?></label>
								<div class="col-sm-9">
				            		<?php CustomUserForm::name_text(); ?>
				            	</div>
				            </div>

				            <div class="form-group row">
				            	<label for="email" class="col-sm-3 col-form-label text-md-right"><?php _e('E-mail', BENDERBS_THEME_FOLDER); ?></label>
								<div class="col-sm-9">
				            		<?php CustomUserForm::email_text(); ?>
				            	</div>
				            </div>

				            <div class="form-group row">
				            	<label for="password" class="col-sm-3 col-form-label text-md-right"><?php _e('Password', BENDERBS_THEME_FOLDER); ?></label>
								<div class="col-sm-9">
				            		<?php CustomUserForm::password_text(); ?>
				            	</div>
				            </div>

				            <div class="form-group row">
				            	<label for="password-2" class="col-sm-3 col-form-label text-md-right"><?php _e('Repeat password', BENDERBS_THEME_FOLDER); ?></label>
								<div class="col-sm-9">
				            		<?php CustomUserForm::check_password_text(); ?>
				            	</div>
				            </div>
				            
				            <?php osc_run_hook('user_register_form'); ?>

				            <div class="form-group row">
								<div class="col-sm-9">
				            		<?php osc_show_recaptcha('register'); ?>
				            	</div>
				            </div>

				            <div class="form-group row">
							    <div class="col-md-9 ml-md-auto">
							    	<button type="submit" class="btn btn-info btn-block-md-down"><?php _e("Create", BENDERBS_THEME_FOLDER); ?></button>
							    </div>
							</div>

							<div class="form-group row">
		                   		<div class="col-md-6 offset-md-3">
		                   			<a href="<?php echo osc_user_login_url(); ?>"><?php _e('Login', BENDERBS_THEME_FOLDER); ?></a><br /><a href="<?php echo osc_recover_user_password_url(); ?>"><?php _e("Forgot password?", BENDERBS_THEME_FOLDER); ?></a>
		                   		</div>
		                   	</div>
						</form>
					</div>
				</div>
			</div>
		</div>

	</div>
<?php
function js_user_register() {
	CustomUserForm::js_validation();
}
osc_add_hook('footer', 'js_user_register');
osc_current_web_theme_path('footer.php'); ?>