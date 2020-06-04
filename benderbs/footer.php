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
		</div><!-- /.row -->
	</div><!-- /.container -->

	<?php osc_run_hook('after-main'); ?>

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

	<!-- General Modal -->
	<div class="modal fade" id="genModal" tabindex="-1" role="dialog">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header"></div>
	            <div class="modal-body text-center">
	            	<div class="d-flex justify-content-center">
						<div class="spinner-border" role="status">
							<span class="sr-only">Loading...</span>
						</div>
					</div>
	            </div>
	            <div class="modal-footer"></div>
	        </div>
	    </div>
	</div>

	<?php osc_show_widgets('footer');?>

	<footer class="small mt-3">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-12 text-center text-md-left">
					<ul class="list-inline">
					<?php if (osc_users_enabled()) : ?>
        				<?php if (osc_is_web_user_logged_in()) : ?>
						
						<li class="list-inline-item"><?php echo sprintf(__('Hi %s', osc_current_web_theme()), osc_logged_user_name() . '!'); ?></li>
						<li class="list-inline-item"><strong><a href="<?php echo osc_user_dashboard_url(); ?>"><?php _e('My account', osc_current_web_theme()); ?></a></strong></li>
						<li class="list-inline-item"><a href="<?php echo osc_user_logout_url(); ?>"><?php _e('Logout', osc_current_web_theme()); ?></a></li>
					
						<?php else: ?>
					
						<li class="list-inline-item"><a href="<?php echo osc_user_login_url(); ?>"><?php _e('Login', osc_current_web_theme()); ?></a></li>
						<?php if (osc_user_registration_enabled()) : ?>
						<li class="list-inline-item"><a href="<?php echo osc_register_account_url(); ?>"><?php _e('Register for a free account', osc_current_web_theme()); ?></a></li>
						<?php endif; ?>

						<?php endif; ?>
					<?php endif; ?>

					</ul>
				</div>
				<div class="col-md-6 col-sm-12 text-center text-md-right">
					<?php if (osc_users_enabled() || (!osc_users_enabled() && !osc_reg_user_post())) : ?>
					<a href="<?php echo osc_item_post_url_in_category(); ?>" class="btn btn-danger btn-lg btn-block d-md-none"><?php _e("Publish your ad for free", osc_current_web_theme());?></a>
					<?php endif; ?>

					<a href="<?php echo osc_contact_url(); ?>"><?php _e('Contact', osc_current_web_theme()); ?></a>

					<?php osc_reset_static_pages(); while( osc_has_static_pages()) : ?>
					<a href="<?php echo osc_static_page_url(); ?>"><?php echo osc_static_page_title(); ?></a>
					<?php endwhile; ?>

					<?php if (osc_count_web_enabled_locales() > 1) { ?>
			            <?php osc_goto_first_locale(); ?>
			            <strong><?php _e('Language:', osc_current_web_theme()); ?></strong>
			            <?php $i = 0;  ?>
			            <?php while ( osc_has_web_enabled_locales() ) { ?>
			            <span><a id="<?php echo osc_locale_code(); ?>" href="<?php echo osc_change_language_url (osc_locale_code()); ?>"><?php echo osc_locale_name(); ?></a></span><?php if( $i == 0 ) { echo " &middot; "; } ?>
			                <?php $i++; ?>
			            <?php } ?>
			        <?php } ?>
				</div>
			</div>
		</div>
	</footer>

<?php if (osc_users_enabled()) : ?>
	<?php if (osc_is_web_user_logged_in()) : ?>
	<script>
	$(document).ready(function() {
		$(".logout").click(function() {
		    $('#genModal').modal('show');
		    $('#genModal').on('shown.bs.modal', function(e) {
	            $("#genModal .modal-header").html('<h5 class="modal-title"><?php _e('Ready to Leave?', osc_current_web_theme()); ?></h5>');
	            $("#genModal .modal-body").html('<?php _e('Select "Logout" below if you are ready to end your current session.', osc_current_web_theme()); ?>');
	            $("#genModal .modal-footer").html('<button class="btn btn-secondary" type="button" onClick="genModalHide();return false;"><?php _e('Cancel'); ?></button> <a class="btn btn-primary" href="<?php echo osc_user_logout_url(); ?>"><?php _e('Logout', osc_current_web_theme()); ?></a>');
		    });
		});
	});

	function modalDeleteItem(url) {
		$('#genModal').modal('show');
		$('#genModal').on('shown.bs.modal', function(e) {
			$("#genModal .modal-header").html('<h5 class="modal-title"><?php echo osc_esc_js(__('Message', osc_current_web_theme())); ?></h5>');
			$("#genModal .modal-body").html('<?php echo osc_esc_js(__('This action can not be undone. Are you sure you want to continue?', osc_current_web_theme())) ?>');
			$("#genModal .modal-footer").html('<button class="btn btn-secondary" type="button" onClick="genModalHide();return false;"><?php echo osc_esc_js(__('Cancel')); ?></button> <a class="btn btn-primary" href="'+url+'"><?php echo osc_esc_js(__('Delete', osc_current_web_theme())); ?></a>');
		});
	}
	</script>
	<?php endif; ?>
<?php endif; ?>

	<?php osc_run_hook('footer'); ?>

</body>
</html>