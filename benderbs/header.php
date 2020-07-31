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
<!DOCTYPE html>
<html lang="en">
<head>
    <?php osc_current_web_theme_path('common/head.php'); ?>
</head>

<body id="page-top">
		
	<!-- nav -->
	<?php osc_current_web_theme_path('nav.php'); ?>

    <?php osc_run_hook('before-content'); ?>

    <?php if (osc_get_preference('header-728x90', 'bender') != '' && !osc_is_public_profile()) : ?>
	<!-- header ad 728x60-->
	<div class="container">
		<div class="row mb-2">
			<div class="col-sm-12 text-center">
				<div class="ads_header">
			    <?php echo osc_get_preference('header-728x90', 'bender'); ?> 
			    </div>
			</div>
		</div>
	</div>
	<!-- /header ad 728x60-->
	<?php endif; ?>

    <?php osc_show_widgets('header'); ?>

	<main class="container">

		<?php osc_run_hook('before-main'); ?>

		<?php benderbs_show_flash_message(); ?>

		<div <?php benderbs_row_class(); ?>>

			<?php osc_run_hook('inside-main'); ?>