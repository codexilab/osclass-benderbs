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
osc_add_hook('header','benderbs_follow_construct');

osc_remove_hook('before-content', 'benderbs_header');

function benderbs_public_profile_header() {
    echo '<div id="user-cover" class="jumbotron bg-gray"></div>';
}
osc_add_hook('before-content', 'benderbs_public_profile_header');

osc_remove_hook('before-main', 'breadcrumb');

$address = '';
if(osc_user_address()!='') {
    if(osc_user_city_area()!='') {
        $address = osc_user_address().", ".osc_user_city_area();
    } else {
        $address = osc_user_address();
    }
} else {
    $address = osc_user_city_area();
}
$location_array = array();
if(trim(osc_user_city()." ".osc_user_zip())!='') {
    $location_array[] = trim(osc_user_city()." ".osc_user_zip());
}
if(osc_user_region()!='') {
    $location_array[] = osc_user_region();
}
if(osc_user_country()!='') {
    $location_array[] = osc_user_country();
}
$location = implode(", ", $location_array);
unset($location_array);

$list 		= 'active';
$gallery 	= '';
$listClass 	= 'col-sm-12 list-item';
if (benderbs_show_as() == 'gallery') {
	$list 		= '';
	$gallery 	= 'active';
	$listClass 	= 'col-sm-4';
}

osc_current_web_theme_path('header.php'); ?>

	<?php osc_current_web_theme_path('user-public-sidebar.php'); ?>

	<div class="col-md-8 order-1">
		<div class="fb-profile clearfix">
			<!-- <img align="left" class="fb-image-lg" src="http://lorempixel.com/850/280/nightlife/5/" alt="Profile image example"/> -->
	        <img align="left" class="fb-image-profile img-fluid img-thumbnail" src="<?php echo osc_current_web_theme_url('images/user_default.gif'); ?>" alt="Profile image example"/>
	        <div class="fb-profile-text">
	            <h1><?php echo osc_user_name(); ?></h1>
	        </div>
	    </div>

	    <div class="center mt-3">
	    	<ul class="list-unstyled">
	    		<?php if (osc_user_website() !== '') : ?>
	    		<li><a href="<?php echo osc_user_website(); ?>"><?php echo osc_user_website(); ?></a></li>
	    		<?php endif; ?>

	    		<?php if ($location !== '') : ?>
	    		<li><?php echo $location; ?></li>
	    		<?php endif; ?>
	    		
	    		<?php if ($address !== '') : ?>
	    		<li><?php echo $address; ?></li>
	    		<?php endif; ?>
	    	</ul>
	    </div>

	    <?php if (osc_count_items() > 0) : ?>
	    <h2><?php _e('Latest listings', BENDERBS_THEME_FOLDER); ?></h2>
	    <div class="row">
	    	<?php
			View::newInstance()->_exportVariableToView("listClass", $listClass);
			osc_current_web_theme_path('loop.php');
			?>

	    	<div class="col-md-12">
	    		<nav aria-label="Pagination">
	    			<?php echo benderbs_pagination_items(); ?>
	    		</nav>
	    	</div>
	    </div>
		<?php endif; ?>
	</div>
<?php osc_current_web_theme_path('footer.php'); ?>