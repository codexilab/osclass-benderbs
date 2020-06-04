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

function js_contact() {
	CustomContactForm::js_validation();
}
osc_add_hook('footer', 'js_contact');

bender_add_row_class('justify-content-md-center');

osc_current_web_theme_path('header.php'); ?>
	<div class="col-md-10">

		<div class="card border mb-3">
			<div class="card-header"><h1><?php _e('Contact us', osc_current_web_theme()); ?></h1></div>
			<div class="card-body text-secondary">
				<div class="row">
					<div class="col-md-11">
						<form name="contact_form" action="<?php echo osc_base_url(true); ?>" method="post">
							<input type="hidden" name="page" value="contact" />
				            <input type="hidden" name="action" value="contact_post" />

				            <div class="form-group row">
				            	<label for="yourName" class="col-sm-3 col-form-label text-md-right"><?php _e('Your name', osc_current_web_theme()); ?> (<?php _e('optional', osc_current_web_theme()); ?>)</label>
								<div class="col-sm-9">
				            		<?php CustomContactForm::your_name(); ?>
				            	</div>
				            </div>
				            <div class="form-group row">
				            	<label for="yourEmail" class="col-sm-3 col-form-label text-md-right"><?php _e('Your email address', osc_current_web_theme()); ?></label>
								<div class="col-sm-9">
				            		<?php CustomContactForm::your_email(); ?>
				            	</div>
				            </div>
				            <div class="form-group row">
				            	<label for="subject" class="col-sm-3 col-form-label text-md-right"><?php _e('Subject', osc_current_web_theme()); ?> (<?php _e('optional', osc_current_web_theme()); ?>)</label>
								<div class="col-sm-9">
				            		<?php CustomContactForm::the_subject(); ?>
				            	</div>
				            </div>
				            <div class="form-group row">
				            	<label for="message" class="col-sm-3 col-form-label text-md-right"><?php _e('Message', osc_current_web_theme()); ?></label>
								<div class="col-sm-9">
				            		<?php CustomContactForm::your_message(); ?>
				            	</div>
				            </div>
				            <div class="form-group row">
				            	<?php osc_run_hook('contact_form'); ?>
				            	<?php osc_show_recaptcha(); ?>
							    <div class="col-md-9 ml-md-auto">
							    	<button type="submit" class="btn btn-info btn-block-md-down"><?php _e('Send', osc_current_web_theme()); ?></button>
							    </div>
							    <?php osc_run_hook('admin_contact_form'); ?>
							</div>
						</form>
					</div>
				</div>

			</div>
		</div>

	</div>
<?php osc_current_web_theme_path('footer.php'); ?>