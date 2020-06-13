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
<div id="sidebar" class="col-md-4 order-2 mb-3 pl-sm-0">
	<?php if (osc_user_info() !== '') : ?>
	<h2><?php _e('User description', osc_current_web_theme()); ?></h2>
	<?php endif; ?>
	<?php echo nl2br(osc_user_info()); ?>

	<?php if (osc_logged_user_id() !=  osc_user_id()) : ?>
		<?php if(osc_reg_user_can_contact() && osc_is_web_user_logged_in() || !osc_reg_user_can_contact()) : ?>
		<div class="bg-gray-bender rounded p-3 mt-3">
			<h2><?php _e("Contact", osc_current_web_theme()); ?></h2>

			<form action="<?php echo osc_base_url(true); ?>" method="post" name="contact_form" id="contact_form">
				<input type="hidden" name="action" value="contact_post" />
				<input type="hidden" name="page" value="user" />
				<input type="hidden" name="id" value="<?php echo osc_user_id();?>" />

				<div class="form-group">
					<label for="yourName"><?php _e('Your name', osc_current_web_theme()); ?>:</label>
					<?php CustomContactForm::your_name(); ?>
				</div>

				<div class="form-group">
					<label for="yourEmail"><?php _e('Your e-mail address', osc_current_web_theme()); ?>:</label>
					<?php CustomContactForm::your_email(); ?>
				</div>

				<div class="form-group">
					<label for="phoneNumber"><?php _e('Phone number', osc_current_web_theme()); ?> (<?php _e('optional', osc_current_web_theme()); ?>):</label>
					<?php CustomContactForm::your_phone_number(); ?>
				</div>

				<div class="form-group">
					<label for="message"><?php _e('Message', osc_current_web_theme()); ?>:</label>
					<?php CustomContactForm::your_message(); ?>
				</div>

				<div class="form-group">
					<?php osc_run_hook('item_contact_form', osc_item_id()); ?>
					<?php if (osc_recaptcha_public_key()) : ?>
					<script>
		                var RecaptchaOptions = {
		                    theme : 'custom',
		                    custom_theme_widget: 'recaptcha_widget'
		                };
		            </script>
		            <style type="text/css">
		            	div#recaptcha_widget, div#recaptcha_image > img { width:240px; margin-top: 5px; }
		            	div#recaptcha_image { margin-bottom: 15px; }
		            </style>
		            <div id="recaptcha_widget">
		                <div id="recaptcha_image"><img /></div>
		                <span class="recaptcha_only_if_image"><?php _e('Enter the words above',osc_current_web_theme()); ?>:</span>
		                <input type="text" id="recaptcha_response_field" name="recaptcha_response_field" />
		                <div><a href="javascript:Recaptcha.showhelp()"><?php _e('Help', osc_current_web_theme()); ?></a></div>
		            </div>
					<?php osc_show_recaptcha(); ?>
					<?php endif; ?>
				</div>

				<button type="submit" class="btn btn-info btn-block-md-down"><?php _e("Send", osc_current_web_theme());?></button>
			</form>
			<?php
			function js_user_public_sidebar() {
				CustomContactForm::js_validation();
			}
			osc_add_hook('footer', 'js_user_public_sidebar');
			?>
		</div>
		<?php endif; ?>
	<?php endif; ?>
</div><!-- /#sidebar -->