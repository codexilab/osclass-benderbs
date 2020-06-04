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
    return __('Change username', osc_current_web_theme());;
}
osc_add_filter('meta_title_filter','custom_meta_title');

osc_current_web_theme_path('header.php') ;
$osc_user = osc_user(); ?>
    <?php osc_current_web_theme_path('user-sidebar.php'); ?>
    
	<div class="col-md-9">
		<h1><?php _e('Change username', osc_current_web_theme()); ?></h1>

		<form action="<?php echo osc_base_url(true); ?>" method="post" id="change-username" class="mt-3">
			<input type="hidden" name="page" value="user" />
            <input type="hidden" name="action" value="change_username_post" />
            <div class="form-group row">
				<label for="s_username" class="col-sm-3 col-form-label text-md-right"><?php _e('Username', osc_current_web_theme()); ?></label>
				<div class="col-sm-8">
					<input type="text" name="s_username" id="s_username" value="" class="form-control form-control-light" />
                    <div id="available"></div>
				</div>
			</div>

			<div class="form-group row">
			    <div class="col-sm-12 col-md-9 ml-md-auto">
			    	<button type="submit" class="btn btn-info btn-block-md-down"><?php _e("Update", osc_current_web_theme());?></button>
			    </div>
			</div>
		</form>
	</div>
<?php function js_user_change_username() { ?>
<script>
$(document).ready(function() {
    $('form#change-username').formValidation({
        framework: 'bootstrap4',
        icon: {
            valid: 'fa fa-check',
            invalid: 'fa fa-times',
            validating: 'fa fa-refresh'
        },
        fields: {
            s_username: {
                validators: {
                    notEmpty: {
                        message: '<?php echo osc_esc_js(__('Username: this field is required', osc_current_web_theme())); ?>.'
                    }
                }
            }
        }
    });

    var cInterval;
    $("#s_username").keydown(function(event) {
        if($("#s_username").attr("value")!='') {
            clearInterval(cInterval);
            cInterval = setInterval(function(){
                $.getJSON(
                    "<?php echo osc_base_url(true); ?>?page=ajax&action=check_username_availability",
                    {"s_username": $("#s_username").attr("value")},
                    function(data){
                        clearInterval(cInterval);
                        if(data.exists==0) {
                            $("#available").text('<?php echo osc_esc_js(__("The username is available", "bender")); ?>');
                        } else {
                            $("#available").text('<?php echo osc_esc_js(__("The username is NOT available", "bender")); ?>');
                        }
                    }
                );
            }, 1000);
        }
    });

});
</script>    
<?php } ?>
<?php osc_add_hook('footer', 'js_user_change_username'); ?>
<?php osc_current_web_theme_path('footer.php'); ?>