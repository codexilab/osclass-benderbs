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
osc_add_hook('header', 'benderbs_nofollow_construct');
benderbs_add_wrapper_class('border border-warning rounded alert alert-warning mt-4');
osc_current_web_theme_path('header.php'); ?>
	<div class="col mt-3">
		<h1><?php _e("Sorry but I can't find the page you're looking for", BENDERBS_THEME_FOLDER) ; ?></h1>

		<p><?php _e("Let us help you, we have got a few tips for you to find it.", BENDERBS_THEME_FOLDER) ; ?></p>
		<ul class="list-unstyled">
			<li>
				<?php _e("<strong>Search</strong> for it:", 'bender') ; ?>
				<form action="<?php echo osc_base_url(true); ?>" method="get">
					<input type="hidden" name="page" value="search" />
					<div class="form-row mr-1">
						<div class="col-sm-10 col-md-6 col-lg-4">
							<input type="text" name="sPattern" class="form-control form-control-light" id="query" value="">
						</div>
						<div class="col-sm-10 mt-max-sm-2 col-md-2">
							<button type="submit" class="btn btn-light btn-block-md-down"><?php _e('Search', BENDERBS_THEME_FOLDER) ; ?></button>
						</div>
					</div>
				</form>
			</li>
			<li class="mt-3">
				<?php _e("<strong>Look</strong> for it in the most popular categories.", BENDERBS_THEME_FOLDER) ; ?>
				<?php osc_goto_first_category(); ?>
				<ul class="list-inline">
				<?php while (osc_has_categories()) : ?>
					<li class="list-inline-item">
						<h6><a class="<?php echo osc_category_slug(); ?>" href="<?php echo osc_search_category_url(); ?>"><?php echo osc_category_name(); ?></a> <span>(<?php echo osc_category_total_items(); ?>)</h6>
					</li>
					<?php if (osc_count_subcategories() > 0) : ?>
						<?php while (osc_has_subcategories()) : ?>
							<?php if (osc_category_total_items() > 0) : ?>
								<li class="list-inline-item">
									<h6><a class="<?php echo osc_category_slug(); ?>" href="<?php echo osc_search_category_url(); ?>"><?php echo osc_category_name(); ?></a> <span>(<?php echo osc_category_total_items(); ?>)</h6>
								</li>
							<?php endif; ?>
						<?php endwhile; ?>
					<?php endif; ?>
				<?php endwhile; ?>
				</ul>
			</li>
		</ul>
	</div>
<?php osc_current_web_theme_path('footer.php'); ?>