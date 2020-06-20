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
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Cache-Control" content="no-cache" />
	<meta http-equiv="Expires" content="Fri, Jan 01 1970 00:00:00 GMT" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<meta name="title" content="<?php echo osc_esc_html(meta_title()); ?>" />

	<?php
	if (meta_description() != '') {
		echo '<meta name="description" content="'.osc_esc_html(meta_description()).'" />' . PHP_EOL;
	}

	if (meta_keywords() != '') {
		echo '<meta name="keywords" content="'.osc_esc_html(meta_keywords()).'" />'	. PHP_EOL;
	}

	if (osc_get_canonical() != '') {
		echo '<link rel="canonical" href="'.osc_get_canonical().'" />' . PHP_EOL;
	}
	?>

	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">

	<!-- favicon -->
	<link rel="shortcut icon" href="<?php echo osc_current_web_theme_url('favicon/favicon-48.png'); ?>">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo osc_current_web_theme_url('favicon/favicon-144.png'); ?>">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo osc_current_web_theme_url('favicon/favicon-114.png'); ?>">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo osc_current_web_theme_url('favicon/favicon-72.png'); ?>">
	<link rel="apple-touch-icon-precomposed" href="<?php echo osc_current_web_theme_url('favicon/favicon-57.png'); ?>">
	<!-- /favicon -->
	
	<title><?php echo meta_title(); ?></title>

	<?php osc_run_hook('header'); ?>