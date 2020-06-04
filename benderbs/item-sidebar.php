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
<div id="sidebar" class="col-md-4 order-2">
	<div class="bg-gray-bender rounded p-3">
		<h2><?php _e("Contact publisher", osc_current_web_theme()); ?></h2>

	<?php if (osc_item_is_expired()) : ?>
		
		<?php _e("The listing is expired. You can't contact the publisher.", osc_current_web_theme()); ?>
		
	<?php elseif ((osc_logged_user_id() == osc_item_user_id()) && osc_logged_user_id() != 0) : ?>
		
		<?php _e("It's your own listing, you can't contact the publisher.", osc_current_web_theme()); ?>
		
	<?php elseif (osc_reg_user_can_contact() && !osc_is_web_user_logged_in()) : ?>
		
		<?php _e("You must log in or register a new account in order to contact the advertiser", osc_current_web_theme()); ?>
		<a class="btn btn-info btn-block small" href="<?php echo osc_user_login_url(); ?>"><?php _e('Login', osc_current_web_theme()) ; ?></a>
		<div class="m-2"></div>
		<a class="btn btn-info btn-block small" href="<?php echo osc_register_account_url(); ?>"><?php _e('Register for a free account', osc_current_web_theme()); ?></a>
		
	<?php else : ?>

		<?php if (osc_item_user_id() != null) : ?>
			<p><?php _e('Name', osc_current_web_theme()) ?>: <a href="<?php echo osc_user_public_profile_url( osc_item_user_id() ); ?>" ><?php echo osc_item_contact_name(); ?></a></p>
		<?php else : ?>
			<p><?php printf(__('Name: %s', osc_current_web_theme()), osc_item_contact_name()); ?></p>
		<?php endif; ?>

		<?php if (osc_item_show_email()) : ?>
			<p><?php printf(__('E-mail: %s', osc_current_web_theme()), osc_item_contact_email()); ?></p>
		<?php endif; ?>

		<?php if (osc_user_phone() != '') : ?>
			<p><?php printf(__("Phone: %s", osc_current_web_theme()), osc_user_phone()); ?></p>
		<?php endif; ?>

		<form action="<?php echo osc_base_url(true); ?>" method="post" name="contact_form" id="contact_form" <?php if (osc_item_attachment()) echo 'enctype="multipart/form-data"';?> >
			<?php osc_prepare_user_info(); ?>
			<input type="hidden" name="action" value="contact_post" />
	        <input type="hidden" name="page" value="item" />
	        <input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />

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

			<?php if (osc_item_attachment()) : ?>
			<div class="form-group">
				<label><?php _e('Attachment', osc_current_web_theme()); ?>:</label>
				<?php CustomContactForm::your_attachment(); ?>
			</div>
			<?php endif; ?>

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
		osc_add_hook('footer', function() {
			CustomContactForm::js_validation();
		});
		?>
		
	<?php endif; ?>
	</div>

	<?php if (osc_get_preference('sidebar-300x250', 'bender') != '') : ?>
	<!-- sidebar ad 300x250 -->
	<div class="ads_300 mt-2">
	    <?php echo osc_get_preference('sidebar-300x250', 'bender'); ?>
	</div>
	<!-- /sidebar ad 300x250 -->
	<?php endif; ?>

	<?php if (!osc_is_web_user_logged_in() || osc_logged_user_id() != osc_item_user_id()) : ?>
	    <form action="<?php echo osc_base_url(true); ?>" method="post" name="mask_as_form" id="mask_as_form" class="mt-2">
	        <input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />
	        <input type="hidden" name="as" value="spam" />
	        <input type="hidden" name="action" value="mark" />
	        <input type="hidden" name="page" value="item" />
	        <div class="form-group">
		        <select name="as" id="as" class="form-control form-control-light">
		            <option><?php _e("Mark as...", osc_current_web_theme()); ?></option>
		            <option value="spam"><?php _e("Mark as spam", osc_current_web_theme()); ?></option>
		            <option value="badcat"><?php _e("Mark as misclassified", osc_current_web_theme()); ?></option>
		            <option value="repeated"><?php _e("Mark as duplicated", osc_current_web_theme()); ?></option>
		            <option value="expired"><?php _e("Mark as expired", osc_current_web_theme()); ?></option>
		            <option value="offensive"><?php _e("Mark as offensive", osc_current_web_theme()); ?></option>
		        </select>
	    	</div>
	    </form>

		<?php osc_add_hook('footer', function() { ?>
		<script>
		$('#mask_as_form select').on('change',function() {
			$('#mask_as_form').submit();
		});
		</script>
		<?php }); ?>
	<?php endif; ?>
</div>