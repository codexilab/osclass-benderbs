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
bender_add_row_class('justify-content-md-center');
osc_current_web_theme_path('header.php'); ?>
    <div class="col-md-8">
        <div class="card border mb-3">
            <div class="card-header"><h1><?php _e('Recover your password', osc_current_web_theme()); ?></h1></div>
            <div class="card-body text-secondary">
                <form action="<?php echo osc_base_url(true); ?>" method="post" >
                	<input type="hidden" name="page" value="login" />
                    <input type="hidden" name="action" value="recover_post" />

                    <div class="form-group row">
                        <label for="new_password" class="col-md-4 col-form-label text-md-right"><?php _e('E-mail', osc_current_web_theme()); ?></label>
                        <div class="col-md-6">
                            <?php CustomUserForm::email_text(); ?>
                            <?php osc_show_recaptcha('recover_password'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
	                    <div class="col-md-6 offset-md-4">
	                        <button type="submit" class="btn btn-info btn-block-md-down">
	                            <?php _e("Send me a new password", osc_current_web_theme());?>
	                        </button>
	                    </div>
                   	</div>

                   	<div class="form-group row">
                   		<div class="col-md-6 offset-md-4">
                   			<a href="<?php echo osc_user_login_url(); ?>"><?php _e('Login', osc_current_web_theme()); ?></a><br />
                            <a href="<?php echo osc_register_account_url(); ?>"><?php _e('Register for a free account', osc_current_web_theme()); ?></a>
                   		</div>
                   	</div>
            	</form>
            </div>
        </div>
    </div>
<?php osc_current_web_theme_path('footer.php'); ?>