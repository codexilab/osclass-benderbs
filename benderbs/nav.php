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
<nav class="navbar navbar-expand navbar-dark bg-info topbar fixed-top">
	
	<?php echo logo_nav(); ?>

	<?php if (osc_is_home_page() || osc_is_static_page() || osc_is_contact_page()) : ?>
	<form class="d-none d-xsm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="<?php echo osc_base_url(true); ?>" method="get">
		<input type="hidden" name="page" value="search"/>
		<div class="input-group">
			<input type="text" name="sPattern" value="" class="form-control form-control-info bg-light border-1 small" placeholder="<?php echo osc_esc_html(__(osc_get_preference('keyword_placeholder', 'bender'), 'bender')); ?>" aria-label="Search" aria-describedby="basic-addon2">
			<div class="input-group-append">
				<button class="btn btn-info" type="submit">
					<i class="fas fa-search fa-sm"></i>
				</button>
			</div>
		</div>
	</form>
	<?php else: ?>
	<div class="d-none d-xsm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"></div>
	<?php endif; ?>

	<?php if (osc_users_enabled() || (!osc_users_enabled() && !osc_reg_user_post())) : ?>
	<a class="btn btn-danger d-none d-lg-block" href="<?php echo osc_item_post_url_in_category() ; ?>"><?php _e('Publish your ad for free', osc_current_web_theme());?></a>
	<?php endif; ?>

	<ul class="navbar-nav ml-max-sm-auto">
		
		<?php if (osc_is_home_page() || osc_is_static_page() || osc_is_contact_page()) : ?>
		<!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-xsm-none">
        	<a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            	<i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown search -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
				<form class="form-inline mr-auto w-100 navbar-search" action="<?php echo osc_base_url(true); ?>" method="get">
					<input type="hidden" name="page" value="search"/>
					<div class="input-group">
						<input type="text" name="sPattern" value="" class="form-control form-control-info bg-light border-1 small" placeholder="<?php echo osc_esc_html(__(osc_get_preference('keyword_placeholder', 'bender'), 'bender')); ?>" aria-label="Search" aria-describedby="basic-addon2">
						<div class="input-group-append">
							<button class="btn btn-info" type="submit">
								<i class="fas fa-search fa-sm"></i>
							</button>
						</div>
					</div>
				</form>
				<div class="mt-2 text-right"><a href="<?php echo osc_search_category_url(); ?>"><?php _e('Go to advanced search page', osc_current_web_theme()); ?> &raquo;</a></div>
            </div>
        </li>
        <?php endif; ?>

        <li class="nav-item dropdown no-arrow mx-1">
			<a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<span class="mr-2 d-lg-inline text-white small u"><?php echo __('Menu', osc_current_web_theme()); ?></span><?php echo (osc_users_enabled() && osc_is_web_user_logged_in()) ? '<i class="fas fa-user-circle fa-lg"></i>' : '<i class="fas fa-bars"></i>'; ?>
			</a>

			<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
			<?php if (osc_users_enabled()) : ?>
				<?php if (osc_is_web_user_logged_in()) : ?>
				<a class="dropdown-item d-flex align-items-center" href="<?php echo osc_user_public_profile_url(osc_logged_user_id()); ?>">
					<div class="dropdown-list-image mr-3">
						<img class="rounded-circle" src="<?php echo user_thumb_url(); ?>" alt="">
					</div>
					<div>
						<div class="font-weight-bold"><?php echo sprintf(__('Hi %s', osc_current_web_theme()), osc_logged_user_name() . '!'); ?></div>
						<span class="text-gray-500"><?php echo osc_logged_user_email(); ?></span>
					</div>
				</a>

				<?php else : /* else osc_is_web_user_logged_in() */ ?>

				<?php if (osc_user_registration_enabled()) : ?>
				<div class="dropdown-row d-flex align-items-center">
					<div class="dropdown-list-image mr-3">
						<img class="rounded-circle" src="<?php echo user_thumb_url(); ?>" alt="">
					</div>
					<div>
						<div class="font-weight-bold"><?php _e('Welcome!', osc_current_web_theme()); ?></div>
						<span class="text-gray-500"><?php _e('Register for a free account', osc_current_web_theme()); ?></span>
					</div>
				</div>
				<?php endif; /* endif osc_user_registration_enabled() */ ?>

				<div class="dropdown-divider"></div>

				<div class="dropdown-row d-flex align-items-center ml-auto">
					<div class="col">
						<a class="btn btn-info btn-block small" href="<?php echo osc_user_login_url(); ?>"><?php _e('Login', osc_current_web_theme()) ; ?></a>
					</div>
					<?php if(osc_user_registration_enabled()) : ?>
					<div class="col">
						<a class="btn btn-info btn-block small" href="<?php echo osc_register_account_url() ; ?>"><?php _e('Register', osc_current_web_theme()); ?></a>
					</div>
					<?php endif; ?>
				</div>

				<?php endif; /* endif osc_is_web_user_logged_in() */ ?>
			<?php endif; /* endif osc_users_enabled() */ ?>

				<div class="dropdown-divider"></div>

				<div class="dropdown-scroll">
					<?php echo bender_user_nav_menu(get_user_nav_menu()); ?>
				</div><!-- /.dropdown-scroll -->

			</div><!-- /.dropdown-menu -->
        </li><!-- /.nav-item -->

	</ul><!-- /.navbar-nav -->

</nav>