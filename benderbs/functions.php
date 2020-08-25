<?php
    /*
     *      Osclass – software for creating and publishing online classified
     *                           advertising platforms
     *
     *                        Copyright (C) 2014 OSCLASS
     *
     *       This program is free software: you can redistribute it and/or
     *     modify it under the terms of the GNU Affero General Public License
     *     as published by the Free Software Foundation, either version 3 of
     *            the License, or (at your option) any later version.
     *
     *     This program is distributed in the hope that it will be useful, but
     *         WITHOUT ANY WARRANTY; without even the implied warranty of
     *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *             GNU Affero General Public License for more details.
     *
     *      You should have received a copy of the GNU Affero General Public
     * License along with this program.  If not, see <http://www.gnu.org/licenses/>.
     */

define('BENDERBS_THEME_VERSION', '1.1.5');
define('BENDERBS_THEME_FOLDER', osc_current_web_theme());
define('BENDERBS_THEME_PATH', osc_themes_path() . BENDERBS_THEME_FOLDER . '/');

// CUSTOM CLASSES
require BENDERBS_THEME_PATH . 'includes/classes/BenderBSAutoLoader.php';
BenderBSAutoLoader::addFolder(BENDERBS_THEME_PATH . 'includes/classes');
BenderBSAutoLoader::addFolder(BENDERBS_THEME_PATH . 'includes/frm');
BenderBSAutoLoader::register();

if (!OC_ADMIN) {
    // Custom fonts for this template
    osc_enqueue_style('fontawesome', 'https://cdn.jsdelivr.net/gh/FortAwesome/Font-Awesome@5.12.0/css/all.min.css');
    osc_enqueue_style('fonts-googleapis', 'https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i');

    // Custom styles for this template
    osc_enqueue_style('sb-admin-2', osc_current_web_theme_url('css/sb-admin-2.min.css'));
    osc_enqueue_style('datepicker', osc_current_web_theme_url('vendor/datepicker/css/bootstrap-datepicker3.min.css'));
    osc_enqueue_style('jquery-ui', osc_current_web_theme_url('css/jquery-ui.custom.css'));
    osc_enqueue_style('css-style', osc_current_web_theme_url('css/style.css'));

    // Bootstrap core JavaScript
    osc_register_script('jquery', osc_current_web_theme_url('vendor/jquery/jquery.min.js'));
    osc_enqueue_script('jquery');
    osc_register_script('jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js');
    osc_enqueue_script('jquery-ui');
    osc_register_script('jquery-validate', 'https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js');
    osc_enqueue_script('jquery-validate');
    osc_register_script('bootstrap-bundle', osc_current_web_theme_url('vendor/bootstrap/js/bootstrap.bundle.min.js'));
    osc_enqueue_script('bootstrap-bundle');
    osc_register_script('jquery-easing', osc_current_web_theme_url('vendor/jquery-easing/jquery.easing.min.js'));
    osc_enqueue_script('jquery-easing');

    // Custom scripts for all pages
    osc_register_script('sb-admin-2', osc_current_web_theme_url('js/sb-admin-2.js'));
    osc_enqueue_script('sb-admin-2');
    osc_register_script('global', osc_current_web_theme_url('js/global.js'));
    osc_enqueue_script('global');
    osc_register_script('datepicker', osc_current_web_theme_url('vendor/datepicker/js/bootstrap-datepicker.min.js'));
    osc_enqueue_script('datepicker');
    osc_enqueue_script('php-date');

    if (osc_is_publish_page() || osc_is_edit_page()) {
        osc_enqueue_style('fine-uploader-css', osc_assets_url('js/fineuploader/fineuploader.css'));
        osc_enqueue_style('bender-fine-uploader-css', osc_current_web_theme_url('css/ajax-uploader.css'));
        osc_enqueue_script('jquery-fineuploader');
    }
}

if ((string) osc_get_preference('keyword_placeholder', 'bender') == "") {
    Params::setParam('keyword_placeholder', __('ie. PHP Programmer', BENDERBS_THEME_FOLDER));
}

// install options
if (!function_exists('benderbs_theme_install')) {
    function benderbs_theme_install() {
        osc_set_preference('keyword_placeholder', Params::getParam('keyword_placeholder'), 'bender');
        osc_set_preference('version', BENDERBS_THEME_VERSION, 'bender');
        osc_set_preference('defaultShowAs@all', 'list', 'bender');
        osc_set_preference('defaultShowAs@search', 'list');
        osc_set_preference('defaultLocationShowAs', 'dropdown', 'bender'); // dropdown / autocomplete
        osc_reset_preferences();
    }
}

if (!function_exists('benderbs_nofollow_construct')) {
    /**
    * Hook for header, meta tags robots nofollos
    */
    function benderbs_nofollow_construct() {
        echo '<meta name="robots" content="noindex, nofollow, noarchive" />' . PHP_EOL;
        echo '<meta name="googlebot" content="noindex, nofollow, noarchive" />' . PHP_EOL;

    }
}

if (!function_exists('benderbs_follow_construct')) {
    /**
    * Hook for header, meta tags robots follow
    */
    function benderbs_follow_construct() {
        echo '<meta name="robots" content="index, follow" />' . PHP_EOL;
        echo '<meta name="googlebot" content="index, follow" />' . PHP_EOL;
    }
}

function benderbs_add_row_class_construct($classes) {
    $CustomRowClass = CustomRowClass::newInstance();
    $classes = array_merge($classes, $CustomRowClass->get());
    return $classes;
}

/**
 * Print body classes.
 *
 * @param string $echo Optional parameter.
 * @return print string with all body classes concatenated
 */
function benderbs_row_class($echo = true) {
    osc_add_filter('benderbs_rowClass', 'benderbs_add_row_class_construct');
    $classes = osc_apply_filter('benderbs_rowClass', array());
    if($echo && count($classes)){
        echo 'class="'.implode(' ', $classes).'"';
    } else {
        return $classes;
    }
}

/**
 * Add new body class to body class array.
 *
 * @param string $class required parameter.
 */
function benderbs_add_row_class($class) {
    $CustomRowClass = CustomRowClass::newInstance();
    $CustomRowClass->add($class);
}
benderbs_add_row_class('row');

/**
 * Detect if a string is PHP script
 * with only the PHP tags is opened and closed
 * and without white spaces blank before or after of string
 *
 * @param $str
 * @return bool
 */
if (!function_exists('check_php_tags')) {
    function check_php_tags($str) {
        $str = str_replace("\r", "", $str); // Minify

        $opened_php_tag = preg_match('/^<\?php/i', $str);
        $closed_php_Tag = preg_match('/\?>$/i', $str);

        return (bool) $opened_php_tag && (bool) $closed_php_Tag;
    }
}

/**
 * Remove PHP tags for eval,
 * prevent it print errors/warnings
 *
 * @param $php
 */
if (!function_exists('eval_nice')) {
    function eval_nice($php) {
        $code_str = preg_replace('/<\?php(.+?)\?>/is', '$1', $php);

        try {
            $result = @eval($code_str);
            return eval($result);
        } catch (ParseError $e) {
            return '<!-- PHP Error -->';
        }

    }
}

if (!function_exists('apply_eval_nice')) {
    function apply_eval_nice($preference) {
        return check_php_tags($preference) ? eval_nice($preference) : $preference;
    }
}

// ads  SEARCH
if (!function_exists('search_ads_listing_top_fn')) {
    function search_ads_listing_top_fn() {
        if(osc_get_preference('search-results-top-728x90', 'bender')!='') {
            echo '<div class="col-md-12 text-center mb-2"><div class="ads_728">' . PHP_EOL;
            echo apply_eval_nice(osc_get_preference('search-results-top-728x90', 'bender'));
            echo '</div></div>' . PHP_EOL;
        }
    }
    //osc_add_hook('search_ads_listing_top', 'search_ads_listing_top_fn');
}

if (!function_exists('search_ads_listing_medium_fn')) {
    function search_ads_listing_medium_fn() {
        if(osc_get_preference('search-results-middle-728x90', 'bender')!='') {
            echo '<div class="col-md-12 text-center mt-2 mb-2"><div class="ads_728">' . PHP_EOL;
            echo apply_eval_nice(osc_get_preference('search-results-middle-728x90', 'bender'));
            echo '</div></div>' . PHP_EOL;
        }
    }
    osc_add_hook('search_ads_listing_medium', 'search_ads_listing_medium_fn');
}

if (!function_exists('benderbs_logged_username')) {
    function benderbs_logged_username() {
        $user = User::newInstance()->findByPrimaryKey(osc_logged_user_id());
        return (string) (isset($user['s_username']) && $user['s_username']) ? $user['s_username'] : '';
    }
}

if( !function_exists('osc_uploads_url')) {
    function osc_uploads_url($item = '') {
        $logo = osc_get_preference('logo', 'bender');
        if ($logo != '' && file_exists(osc_uploads_path() . $logo)) {
            $path = str_replace(ABS_PATH, '', osc_uploads_path() . '/');
            return osc_base_url() . $path . $item;
        }
    }
}

if (!function_exists('benderbs_logo_url')) {
    function benderbs_logo_url() {
        $logo = osc_get_preference('logo','bender');
        if($logo) {
            return osc_uploads_url($logo);
        }
        return false;
    }
}
function benderbs_logo_nav() {
     $logo = osc_get_preference('logo', 'bender');
     $html = '<a class="navbar-brand font-weight-bold" href="'.osc_base_url().'">';
     $html .= '<img style="max-width: 150px; max-height: 40px;" src="'.benderbs_logo_url().'" class="d-inline-block align-top img-fluid" alt="'.osc_page_title().'">';
     $html .= '</a>';
     if($logo!='' && file_exists(osc_uploads_path() . $logo )) {
        return $html;
     } else {
        return '<a class="navbar-brand font-weight-bold" href="'.osc_base_url().'">'.osc_page_title().'</a>';
    }
}
if (!function_exists('benderbs_logo_header')) {
    function benderbs_logo_header() {
         $logo = osc_get_preference('logo', 'bender');
         $html = '<a href="'.osc_base_url().'"><img class="img-fluid" border="0" alt="' . osc_page_title() . '" src="' . benderbs_logo_url() . '"></a>';
         if($logo!='' && file_exists(osc_uploads_path() . $logo )) {
            return $html;
         } else {
            return '<a href="'.osc_base_url().'">'.osc_page_title().'</a>';
        }
    }
}

function benderbs_header() {
    $logo = benderbs_logo_header();
    $description = osc_page_description();
echo <<<FB
            <header id="header" class="jumbotron bg-info">
                <div class="container">
                    <div id="logo">
                        $logo <span id="description">$description</span>
                    </div>
                </div>
            </header>
FB;
}
osc_add_hook('before-content', 'benderbs_header');

if(!function_exists('get_breadcrumb_lang')) {
    function get_breadcrumb_lang() {
        $lang = array();
        $lang['item_add']               = __('Publish a listing', BENDERBS_THEME_FOLDER);
        $lang['item_edit']              = __('Edit your listing', BENDERBS_THEME_FOLDER);
        $lang['item_send_friend']       = __('Send to a friend', BENDERBS_THEME_FOLDER);
        $lang['item_contact']           = __('Contact publisher', BENDERBS_THEME_FOLDER);
        $lang['search']                 = __('Search results', BENDERBS_THEME_FOLDER);
        $lang['search_pattern']         = __('Search results: %s', BENDERBS_THEME_FOLDER);
        $lang['user_dashboard']         = __('Dashboard', BENDERBS_THEME_FOLDER);
        $lang['user_dashboard_profile'] = __("%s's profile", BENDERBS_THEME_FOLDER);
        $lang['user_account']           = __('Account', BENDERBS_THEME_FOLDER);
        $lang['user_items']             = __('Listings', BENDERBS_THEME_FOLDER);
        $lang['user_alerts']            = __('Alerts', BENDERBS_THEME_FOLDER);
        $lang['user_profile']           = __('Update account', BENDERBS_THEME_FOLDER);
        $lang['user_change_email']      = __('Change email', BENDERBS_THEME_FOLDER);
        $lang['user_change_username']   = __('Change username', BENDERBS_THEME_FOLDER);
        $lang['user_change_password']   = __('Change password', BENDERBS_THEME_FOLDER);
        $lang['login']                  = __('Login', BENDERBS_THEME_FOLDER);
        $lang['login_recover']          = __('Recover password', BENDERBS_THEME_FOLDER);
        $lang['login_forgot']           = __('Change password', BENDERBS_THEME_FOLDER);
        $lang['register']               = __('Create a new account', BENDERBS_THEME_FOLDER);
        $lang['contact']                = __('Contact', BENDERBS_THEME_FOLDER);
        return $lang;
    }
}

/**
 * @param string $separator
 * @param bool   $echo
 * @param array  $lang
 *
 * @return string|void
 */
function benderbs_breadcrumb($separator = '&raquo;' , $echo = true , $lang = array ()) {
    $br = new CustomBreadcrumb($lang);
    $br->init();
    if( $echo ) {
        echo $br->render($separator);
        return;
    }
    return $br->render($separator);
}

// Add breadcrumb to all pages
if (!function_exists('breadcrumb')) {
    function breadcrumb() {
        $breadcrumb = benderbs_breadcrumb('', false, get_breadcrumb_lang());
        if ($breadcrumb !== '') {
echo <<<FB
        <div class="row">
            <div class="col-md-12">
            $breadcrumb
            </div>
        </div>
FB;
        }
    }
    osc_add_hook('before-main', 'breadcrumb');
}

if (!function_exists('user_thumb_url')) {
    function user_thumb_url() {
        return osc_current_web_theme_url('images/user-icon.png');
    }
}

if (!function_exists('benderbs_default_location_show_as')) {
    function benderbs_default_location_show_as() {
        return osc_get_preference('defaultLocationShowAs', 'bender');
    }
}

if (!function_exists('benderbs_draw_categories_list')) {
    function benderbs_draw_categories_list() { ?>
    <?php if (!osc_is_home_page()) echo '<div class="resp-wrapper">'; ?>
    <?php
    //cell_3
    $total_categories   = osc_count_categories();
    $col1_max_cat       = ceil($total_categories/3);

    osc_goto_first_category();
    $i      = 0;

    while (osc_has_categories()) { ?>
    <?php
        if($i%$col1_max_cat == 0){
            if ($i > 0) echo '</div>';
            if($i == 0) {
               echo '<div class="col-md-3 first_cel">';
            } else {
                echo '<div class="col-md-3">';
            }
        }
    ?>
    <ul class="list-unstyled mb-0 r-list">
         <li>
             <h1>
                <?php
                $_slug      = osc_category_slug();
                $_url       = osc_search_category_url();
                $_name      = osc_category_name();
                $_total_items = osc_category_total_items();
                if (osc_count_subcategories() > 0) { ?>
                <span class="collapse resp-toogle"><i class="fa fa-caret-right fa-lg"></i></span>
                <?php } ?>
                <?php if ($_total_items > 0) { ?>
                <a class="category <?php echo $_slug; ?>" href="<?php echo $_url; ?>"><?php echo $_name ; ?></a> <span>(<?php echo $_total_items ; ?>)</span>
                <?php } else { ?>
                <a class="category <?php echo $_slug; ?>" href="#"><?php echo $_name ; ?></a> <span>(<?php echo $_total_items ; ?>)</span>
                <?php } ?>
             </h1>
             <?php if (osc_count_subcategories() > 0) { ?>
               <ul class="list-unstyled mb-0">
                     <?php while (osc_has_subcategories()) { ?>
                         <li>
                         <?php if (osc_category_total_items() > 0) { ?>
                             <a class="category sub-category <?php echo osc_category_slug() ; ?>" href="<?php echo osc_search_category_url() ; ?>"><?php echo osc_category_name() ; ?></a> <span>(<?php echo osc_category_total_items() ; ?>)</span>
                         <?php } else { ?>
                             <a class="category sub-category <?php echo osc_category_slug() ; ?>" href="#"><?php echo osc_category_name() ; ?></a> <span>(<?php echo osc_category_total_items() ; ?>)</span>
                         <?php } ?>
                         </li>
                     <?php } ?>
               </ul>
             <?php } ?>
         </li>
    </ul>
    <?php
            $i++;
        }
        echo '</div>';
        if (!osc_is_home_page()) echo '</div>';
    }

    if (osc_is_home_page()) {
        osc_add_hook('inside-main', 'benderbs_draw_categories_list');
    }
}

if (!function_exists('benderbs_search_number')) {
    /**
    *
    * @return array
    */
    function benderbs_search_number() {
        $search_from = ((osc_search_page() * osc_default_results_per_page_at_search()) + 1);
        $search_to   = ((osc_search_page() + 1) * osc_default_results_per_page_at_search());
        if( $search_to > osc_search_total_items() ) {
            $search_to = osc_search_total_items();
        }

        return array(
            'from' => $search_from,
            'to'   => $search_to,
            'of'   => osc_search_total_items()
        );
    }
}

/*
 * Helpers used at view
 */
if (!function_exists('benderbs_item_title')) {
    function benderbs_item_title() {
        $title = osc_item_title();
        foreach( osc_get_locales() as $locale ) {
            if( Session::newInstance()->_getForm('title') != "" ) {
                $title_ = Session::newInstance()->_getForm('title');
                if( @$title_[$locale['pk_c_code']] != "" ){
                    $title = $title_[$locale['pk_c_code']];
                }
            }
        }
        return $title;
    }
}

if (!function_exists('benderbs_item_description')) {
    function benderbs_item_description() {
        $description = osc_item_description();
        foreach( osc_get_locales() as $locale ) {
            if( Session::newInstance()->_getForm('description') != "" ) {
                $description_ = Session::newInstance()->_getForm('description');
                if( @$description_[$locale['pk_c_code']] != "" ){
                    $description = $description_[$locale['pk_c_code']];
                }
            }
        }
        return $description;
    }
}

if (!function_exists('related_listings')) {
    function related_listings() {
        View::newInstance()->_exportVariableToView('items', array());

        $mSearch = new Search();
        $mSearch->addCategory(osc_item_category_id());
        $mSearch->addRegion(osc_item_region());
        $mSearch->addItemConditions(sprintf("%st_item.pk_i_id < %s ", DB_TABLE_PREFIX, osc_item_id()));
        $mSearch->limit('0', '3');

        $aItems      = $mSearch->doSearch();
        $iTotalItems = count($aItems);
        if( $iTotalItems == 3 ) {
            View::newInstance()->_exportVariableToView('items', $aItems);
            return $iTotalItems;
        }
        unset($mSearch);

        $mSearch = new Search();
        $mSearch->addCategory(osc_item_category_id());
        $mSearch->addItemConditions(sprintf("%st_item.pk_i_id != %s ", DB_TABLE_PREFIX, osc_item_id()));
        $mSearch->limit('0', '3');

        $aItems = $mSearch->doSearch();
        $iTotalItems = count($aItems);
        if( $iTotalItems > 0 ) {
            View::newInstance()->_exportVariableToView('items', $aItems);
            return $iTotalItems;
        }
        unset($mSearch);

        return 0;
    }
}

if (!function_exists('delete_user_js')) {
    function delete_user_js() {
        $location = Rewrite::newInstance()->get_location();
        $section  = Rewrite::newInstance()->get_section();
        if (($location === 'user' && in_array($section, array('dashboard', 'profile', 'alerts', 'change_email', 'change_username',  'change_password', 'items'))) || (Params::getParam('page') ==='custom' && Params::getParam('in_user_menu')==true )) { 
            // user_info_js()
            $user = User::newInstance()->findByPrimaryKey(Session::newInstance()->_get('userId'));
            View::newInstance()->_exportVariableToView('user', $user); ?> 
            <script>
            user = {};
            user.id = '<?php echo osc_user_id(); ?>';
            user.secret = '<?php echo osc_user_field("s_secret"); ?>';

            // delete_user.js
            $(document).ready(function() {
                function delete_user() {
                    window.location = '<?php echo osc_base_url(true); ?>' + '?page=user&action=delete&id=' + user.id  + '&secret=' + user.secret;
                }

                $('a[href="#delete_account"]').click(function() {
                    $('#genModal').modal('show');
                    $('#genModal').on('shown.bs.modal', function(e) {
                        $("#genModal .modal-header").html('<h5 class="modal-title"><?php echo osc_esc_js(__('Delete account', BENDERBS_THEME_FOLDER)); ?></h5>');
                        $("#genModal .modal-body").html('<?php echo osc_esc_js(__('Are you sure you want to delete your account?', BENDERBS_THEME_FOLDER)); ?>');
                        $("#genModal .modal-footer").html('<button class="btn btn-secondary" type="button" onClick="genModalHide();return false;"><?php echo osc_esc_js(__('Cancel', BENDERBS_THEME_FOLDER)); ?></button> <button class="btn btn-primary" type="button" onClick="delete_user();return false;"><?php echo osc_esc_js(__('Delete', BENDERBS_THEME_FOLDER)); ?></button>');
                    });
                });
            });
            </script>
<?php
        }
    }
    osc_add_hook('footer', 'delete_user_js', 1);
}

if (!function_exists('benderbs_default_show_as')) {
    function benderbs_default_show_as() {
        return getPreference('defaultShowAs@all','bender');
    }
}

if (!function_exists('benderbs_show_as')) {
    function benderbs_show_as() {
        $p_sShowAs    = Params::getParam('sShowAs');
        $aValidShowAsValues = array('list', 'gallery');
        if (!in_array($p_sShowAs, $aValidShowAsValues)) {
            $p_sShowAs = benderbs_default_show_as();
        }
        return $p_sShowAs;
    }
}

if (!function_exists('benderbs_draw_item')) {
    function benderbs_draw_item($class = false,$admin = false, $premium = false) {
        $filename = 'loop-single';
        if ($premium) {
            $filename .='-premium';
        }
        require WebThemes::newInstance()->getCurrentThemePath().$filename.'.php';
    }
}

/**
 * Get html option to nav menu
 *
 * @param $n to use in switch structure
 * @return $html
 */
function html_option_nav_menu($n) {
    switch ($n) {
        case 'publish_btn':
            return  '<div class="dropdown-row d-flex align-items-center ml-auto d-lg-none">
                        <a class="btn btn-danger btn-lg btn-block" href="' . osc_item_post_url_in_category() . '">' . __('Publish your ad for free', BENDERBS_THEME_FOLDER) . '</a>
                    </div>';
            break;

        case 'logout_link':
            return  '<a class="dropdown-item logout" href="javascript:void(0);">
                        <i class="fas fa-sign-out-alt fa-dm fa-fw mr-2 text-gray-900"></i>
                        ' . __('Logout') . '
                    </a>';
            break;
    }
}

function get_user_nav_menu() {
    $options   = array();
    if (osc_users_enabled()) {
        if (osc_is_web_user_logged_in()) {
            $options[] = array(
                'name'  => __('My listings'),
                'url'   => osc_user_dashboard_url(),
                'class' => 'fas fa-th-list fa-dm fa-fw mr-2 text-gray-900'
            );

            $options[] = array(
                'name'  => __('Alerts'),
                'url'   => osc_user_alerts_url(),
                'class' => 'fas fa-bell fa-dm fa-fw mr-2 text-gray-900'
            );

            $options[] = array(
                'name'  => __('My account', BENDERBS_THEME_FOLDER),
                'url'   => osc_user_profile_url(),
                'class' => 'fas fa-user-circle fa-dm fa-fw mr-2 text-gray-900'
            );

            $options[] = array('custom' => '<div class="dropdown-divider"></div>');
        }
    }

    $options[] = array(
        'name'  => __('Home', BENDERBS_THEME_FOLDER),
        'url'   => osc_base_url(),
        'class' => 'fas fa-home fa-dm fa-fw mr-2 text-gray-900'
    );

    $options[] = array(
        'name'  => __('Contact'),
        'url'   => osc_contact_url(),
        'class' => 'far fa-address-book fa-dm fa-fw mr-2 text-gray-900'
    );

    $options[] = array('custom' => '<div class="dropdown-divider d-lg-none"></div>');

    if (osc_users_enabled() || (!osc_users_enabled() && !osc_reg_user_post())) {
        $options[] = array('custom' => html_option_nav_menu('publish_btn'));
    }
    
    if (osc_users_enabled()) {
        if (osc_is_web_user_logged_in()) {
            $options[] = array('custom' => '<div class="dropdown-divider"></div>');
            $options[] = array('custom' => html_option_nav_menu('logout_link'));
        }
    }

    return $options;
}

/**
 * Prints the user's account nav menu
 *
 * @param array $options array with options of the form 
 *  array(
 *   'name'             => 'display name',
 *   'url'              => 'url of link',
 *   'class'            => 'css class of item',
 *   'custom'           => 'custom html'
 * @return void
 */
function benderbs_user_nav_menu($options = null) {
    if($options == null) {
        $options = array();
        if (osc_users_enabled()) {
            if (osc_is_web_user_logged_in()) {
                $options[] = array('name' => __('My listings'), 'url' => osc_user_dashboard_url(), 'class' => 'fas fa-th-list fa-dm fa-fw mr-2 text-gray-900');
                $options[] = array('custom' => '<div class="dropdown-divider"></div>');
            }
        }
        $options[] = array('name' => __('Home', BENDERBS_THEME_FOLDER), 'url' => osc_base_url(), 'class' => 'fas fa-home fa-dm fa-fw mr-2 text-gray-900');
        $options[] = array('name' => __('Contact'), 'url' => osc_contact_url(), 'class' => 'far fa-address-book fa-dm fa-fw mr-2 text-gray-900');
        
        $options[] = array('custom' => '<div class="dropdown-divider d-lg-none"></div>');

        if (osc_users_enabled() || (!osc_users_enabled() && !osc_reg_user_post())) {
            $options[] = array('custom' => html_option_nav_menu('publish_btn'));
        }
        
        if (osc_users_enabled()) {
            if (osc_is_web_user_logged_in()) {
                $options[] = array('custom' => '<div class="dropdown-divider"></div>');
                $options[] = array('custom' => html_option_nav_menu('logout_link'));
            }
        }
    }

    $options = osc_apply_filter('user_nav_menu_filter', $options);

    $var_l = count($options);
    for($var_o = 0; $var_o < ($var_l); $var_o++) {

        if (isset($options[$var_o]['custom']) && $options[$var_o]['custom']) {
            echo $options[$var_o]['custom'];
        } else {
            echo '<a class="dropdown-item" href="' . $options[$var_o]['url'] . '"><i class="' . $options[$var_o]['class'] . '"></i> ' . $options[$var_o]['name'] . '</a>';
        }

    }

    osc_run_hook('user_nav_menu');
}

if (!function_exists('get_user_menu')) {
    function get_user_menu() {
        $options   = array();
        $options[] = array(
            'name'  => __('Public Profile'),
             'url'  => osc_user_public_profile_url(osc_logged_user_id()),
           'class'  => 'far fa-user-circle fa-lg fa-fw text-gray-600'
        );
        $options[] = array(
            'name'  => __('Listings'),
            'url'   => osc_user_list_items_url(),
            'class' => 'fas fa-th-list fa-lg fa-fw text-gray-600'
        );
        $options[] = array(
            'name'  => __('Alerts'),
            'url'   => osc_user_alerts_url(),
            'class' => 'far fa-bell fa-lg fa-fw text-gray-600'
        );
        $options[] = array(
            'name'  => __('Account'),
            'url'   => osc_user_profile_url(),
            'class' => 'fas fa-cogs fa-lg fa-fw text-gray-600'
        );
        $options[] = array(
            'name'  => __('Change email', BENDERBS_THEME_FOLDER),
            'url'   => osc_change_user_email_url(),
            'class' => 'far fa-envelope fa-lg fa-fw text-gray-600'
        );
        $options[] = array(
            'name'  => __('Change username', BENDERBS_THEME_FOLDER),
            'url'   => osc_change_user_username_url(),
            'class' => 'fas fa-user-tag fa-lg fa-fw text-gray-600'
        );
        $options[] = array(
            'name'  => __('Change password'),
            'url'   => osc_change_user_password_url(),
            'class' => 'fas fa-key fa-lg fa-fw text-gray-600'
        );
        $options[] = array(
            'name'  => ' ' . __('Delete account', BENDERBS_THEME_FOLDER),
            'url'   => '#delete_account',
            'class' => 'fas fa-user-times fa-lg fa-fw text-gray-600'
        );

        return $options;
    }
}

/**
 * Prints the user's account menu
 *
 * @param array $options array with options of the form array('name' => 'display name', 'url' => 'url of link')
 * @return void
 */
function benderbs_private_user_menu($options = null) {
    if($options == null) {
        $options = array();
        $options[] = array('name' => __('Public Profile'), 'url' => osc_user_public_profile_url(osc_logged_user_id()), 'class' => 'opt_publicprofile');
        $options[] = array('name' => __('Dashboard'), 'url' => osc_user_dashboard_url(), 'class' => 'opt_dashboard');
        $options[] = array('name' => __('Manage your listings'), 'url' => osc_user_list_items_url(), 'class' => 'opt_items');
        $options[] = array('name' => __('Manage your alerts'), 'url' => osc_user_alerts_url(), 'class' => 'opt_alerts');
        $options[] = array('name' => __('My profile'), 'url' => osc_user_profile_url(), 'class' => 'opt_account');
        $options[] = array('name' => __('Logout'), 'url' => osc_user_logout_url(), 'class' => 'opt_logout');
    }

    $options = osc_apply_filter('user_menu_filter', $options);


    echo '<div class="scroll-h-auto"><div style="width: max-content"><ul class="user_menu nav nav-pills flex-md-column">';

    $var_l = count($options);
    for($var_o = 0; $var_o < ($var_l-1); $var_o++) {
        echo '<li class="nav-item"><a class="nav-link" href="' . $options[$var_o]['url'] . '"><i class="' . $options[$var_o]['class'] . '"></i> ' . $options[$var_o]['name'] . '</a></li>';
    }

    osc_run_hook('user_menu');

    echo '<li class="nav-item"><a class="nav-link" href="' . $options[$var_l-1]['url'] . '"><i class="' . $options[$var_l-1]['class'] . '"></i>' . $options[$var_l-1]['name'] . '</a></li>';

    echo '</ul></div></div>';
}

if(!function_exists('user_dashboard_redirect')) {
    function user_dashboard_redirect() {
        if(osc_is_user_dashboard()) {
            header('Location: ' .osc_user_list_items_url());
            exit;
        }
    }
    osc_add_hook('init', 'user_dashboard_redirect');
}

if (!function_exists('benderbs_print_sidebar_category_search')) {
    function benderbs_print_sidebar_category_search($aCategories, $current_category = null, $i = 0) {
        $class = 'list-unstyled';
        if(!isset($aCategories[$i])) {
            return null;
        }

        if($i!=0) {
            $class = $class . ' ml-3';
        }

        $c   = $aCategories[$i];
        $i++;
        if(!isset($c['pk_i_id'])) {
            echo '<ul class="'.$class.'">';
            if($i==1) {
                echo '<li><a href="'.osc_esc_html(osc_update_search_url(array('sCategory'=>null, 'iPage'=>null))).'">'.__('All categories', BENDERBS_THEME_FOLDER)."</a></li>";
            }
            foreach($c as $key => $value) {
        ?>
                <li>
                    <a id="cat_<?php echo osc_esc_html($value['pk_i_id']);?>" href="<?php echo osc_esc_html(osc_update_search_url(array('sCategory'=> $value['pk_i_id'], 'iPage'=>null))); ?>">
                    <?php if(isset($current_category) && $current_category == $value['pk_i_id']){ echo '<strong>'.$value['s_name'].'</strong>'; }
                    else{ echo $value['s_name']; } ?>
                    </a>

                </li>
        <?php
            }
            if($i==1) {
            echo "</ul>";
            } else {
            echo "</ul>";
            }
        } else {
        ?>
        <ul class="<?php echo $class;?>">
            <?php if($i==1) { ?>
            <li><a href="<?php echo osc_esc_html(osc_update_search_url(array('sCategory'=>null, 'iPage'=>null))); ?>"><?php _e('All categories', BENDERBS_THEME_FOLDER); ?></a></li>
            <?php } ?>
                <li>
                    <a id="cat_<?php echo osc_esc_html($c['pk_i_id']);?>" href="<?php echo osc_esc_html(osc_update_search_url(array('sCategory'=> $c['pk_i_id'], 'iPage'=>null))); ?>">
                    <?php if(isset($current_category) && $current_category == $c['pk_i_id']){ echo '<strong>'.$c['s_name'].'</strong>'; }
                          else{ echo $c['s_name']; } ?>
                    </a>
                    <?php benderbs_print_sidebar_category_search($aCategories, $current_category, $i); ?>
                </li>
            <?php if($i==1) { ?>
            <?php } ?>
        </ul>
    <?php
        }
    }
}

if (!function_exists('benderbs_sidebar_category_search')) {
    function benderbs_sidebar_category_search($catId = null) {
        $aCategories = array();
        if($catId==null) {
            $aCategories[] = Category::newInstance()->findRootCategoriesEnabled();
        } else {
            // if parent category, only show parent categories
            $aCategories = Category::newInstance()->toRootTree($catId);
            end($aCategories);
            $cat = current($aCategories);
            // if is parent of some category
            $childCategories = Category::newInstance()->findSubcategoriesEnabled($cat['pk_i_id']);
            if(count($childCategories) > 0) {
                $aCategories[] = $childCategories;
            }
        }

        if(count($aCategories) == 0) {
            return "";
        }

        benderbs_print_sidebar_category_search($aCategories, $catId);
    }
}

/**
 * Gets the pagination links of search pagination
 *
 * @return string pagination links
 * @throws \Exception
 */
function benderbs_search_pagination() {
    $params = array();
    if( View::newInstance()->_exists('search_uri') ) { // CANONICAL URL
        $params['url'] = osc_base_url().View::newInstance()->_get('search_uri') . '/{PAGE}';
        $params['first_url'] = osc_base_url().View::newInstance()->_get('search_uri');
    } else {
        $params['first_url'] = osc_update_search_url(array('iPage' => null));
    }
    $pagination = new CustomPagination($params);
    return $pagination->doPagination();
}

/**
 * @param array $extraParams
 * @param bool  $field
 *
 * @return string
 */
function benderbs_pagination_items($extraParams = array (), $field = false) {
    if(osc_is_public_profile()) {
        $url = osc_user_list_items_pub_profile_url('{PAGE}', $field);
        $first_url = osc_user_public_profile_url();
    } elseif(osc_is_list_items()) {
        $url = osc_user_list_items_url('{PAGE}', $field);
        $first_url = osc_user_list_items_url();
    }

    $params = array('total'    => osc_search_total_pages(),
                    'selected' => osc_search_page(),
                    'url'      => $url,
                    'first_url' => $first_url
              );

    if(is_array($extraParams) && !empty($extraParams)) {
        foreach($extraParams as $key => $value) {
            $params[$key] = $value;
        }
    }
    $pagination = new CustomPagination($params);
    return $pagination->doPagination();
}

function benderbs_meta_description() {
    if (osc_is_public_profile()) {
        return osc_highlight( osc_user_info() , 120 );
    }
}
osc_add_filter('meta_description_filter', 'benderbs_meta_description');

/**
 *
 * All CF will be searchable
 *
 * @param null $catId
 */
osc_remove_hook('search_form', 'osc_meta_search');

function benderbs_meta_search($catId = null) {
    CustomFieldForm::meta_fields_search($catId);
}
osc_add_hook('search_form', 'benderbs_meta_search');

/**
 * @param null $catId
 */
function benderbs_meta_publish($catId = null) {
    //osc_enqueue_script( 'php-date' );
    CustomFieldForm::meta_fields_input( $catId );
}

/**
 * @param null $catId
 * @param null $item_id
 */
function benderbs_meta_edit($catId = null, $item_id = null) {
    //osc_enqueue_script( 'php-date' );
    CustomFieldForm::meta_fields_input( $catId , $item_id );
}

osc_remove_hook('item_form', 'osc_meta_publish');
osc_remove_hook('item_edit', 'osc_meta_edit');

osc_add_hook('item_form', 'benderbs_meta_publish');
osc_add_hook('item_edit', 'benderbs_meta_edit');

/**
 * Shows all the pending flash messages in session and cleans up the array.
 *
 * @param $section
 * @param $class
 * @param $id
 * @return void
 */
function benderbs_show_flash_message($section = 'pubMessages', $class = 'fade show alert-dismissible alert' , $id = 'flashmessage' ) {
    $messages = Session::newInstance()->_getMessage($section);
    if (is_array($messages)) {

        foreach ($messages as $message) {
            if (isset($message['msg']) && $message['msg'] != '') {

                if ($message['type'] == 'ok') $message['type'] = 'success';
                if ($message['type'] == 'error') $message['type'] = 'danger';

                echo '<div id="' . $id . '" class="' . strtolower($class) . ' alert-' . $message['type'] . '" role="alert">';
                echo osc_apply_filter('flash_message_text', $message['msg']);
                echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
            } else if($message!='') {
                echo '<div id="' . $id . '" class="' . $class . ' alert-secondary" role="alert">';
                echo osc_apply_filter('flash_message_text', $message);
                echo '</div>';
            } else {
                echo '<div id="' . $id . '" class="' . $class . ' alert-secondary" style="display:none;" role="alert">';
                echo osc_apply_filter('flash_message_text', '');
                echo '</div>';
            }
        }
    }
    Session::newInstance()->_dropMessage($section);
}

function benderbs_comment_author() {
    if (osc_comment_user_id() > 0) {
       return '<a href="'.osc_user_public_profile_url(osc_comment_user_id()).'">'.osc_comment_author_name().'</a>';
    }
    return osc_comment_author_name();
}

if (!function_exists('benderbs_delete')) {
    function benderbs_delete() {
        Preference::newInstance()->delete(array('s_section' => 'benderbs'));
    }
    osc_add_hook('theme_delete_bender', 'benderbs_delete');
}

if (!function_exists('theme_benderbs_actions_admin')) {
    function theme_benderbs_actions_admin() {
        //if(OC_ADMIN)
        switch (Params::getParam('action_specific')) {
            case 'settings':
                osc_set_preference('keyword_placeholder', Params::getParam('keyword_placeholder'), 'bender');
                osc_set_preference('defaultShowAs@all', Params::getParam('defaultShowAs@all'), 'bender');
                osc_set_preference('defaultShowAs@search', Params::getParam('defaultShowAs@all'));

                osc_set_preference('defaultLocationShowAs', Params::getParam('defaultLocationShowAs'), 'bender');

                osc_set_preference('header-728x90',         trim(Params::getParam('header-728x90', false, false, false)), 'bender');
                osc_set_preference('homepage-728x90',       trim(Params::getParam('homepage-728x90', false, false, false)), 'bender');
                osc_set_preference('sidebar-300x250',       trim(Params::getParam('sidebar-300x250', false, false, false)), 'bender');
                osc_set_preference('search-results-top-728x90',     trim(Params::getParam('search-results-top-728x90', false, false, false)), 'bender');
                osc_set_preference('search-results-middle-728x90',  trim(Params::getParam('search-results-middle-728x90', false, false, false)), 'bender');

                //osc_set_preference('rtl', (Params::getParam('rtl') ? '1' : '0'), 'bender');

                ob_get_clean();
                osc_add_flash_ok_message(__('Theme settings updated correctly', BENDERBS_THEME_FOLDER), 'admin');
                osc_redirect_to(osc_admin_render_theme_url('oc-content/themes/'.BENDERBS_THEME_FOLDER.'/admin/settings.php'));
            break;
            case 'upload_logo':
                $package = Params::getFiles('logo');
                if ($package['error'] == UPLOAD_ERR_OK) {
                    $img = ImageResizer::fromFile($package['tmp_name']);
                    $ext = $img->getExt();
                    $logo_name     = 'bender_logo';
                    $logo_name    .= '.'.$ext;
                    $path = osc_uploads_path() . $logo_name;
                    //$img->saveToFile($path);
                    if (move_uploaded_file($package['tmp_name'], $path)) {
                        osc_set_preference('logo', $logo_name, 'bender');
                        osc_add_flash_ok_message(_m('The logo image has been uploaded correctly'), 'admin');
                    } else {
                        osc_add_flash_error_message(_m("An error has occurred, please try again"), 'admin');
                    }
                } else {
                    osc_add_flash_error_message(_m("An error has occurred, please try again"), 'admin');
                }
                ob_get_clean();
                osc_redirect_to(osc_admin_render_theme_url('oc-content/themes/'.BENDERBS_THEME_FOLDER.'/admin/header.php'));
            break;
            case 'remove':
                $logo = osc_get_preference('logo', 'bender');
                $path = osc_uploads_path() . $logo ;
                if(file_exists( $path ) ) {
                    @unlink( $path );
                    osc_delete_preference('logo', 'bender');
                    osc_reset_preferences();
                    osc_add_flash_ok_message(__('The logo image has been removed', BENDERBS_THEME_FOLDER), 'admin');
                } else {
                    osc_add_flash_error_message(__("Image not found", BENDERBS_THEME_FOLDER), 'admin');
                }
                ob_get_clean();
                osc_redirect_to(osc_admin_render_theme_url('oc-content/themes/'.BENDERBS_THEME_FOLDER.'/admin/header.php'));
            break;
        }
    }
    osc_add_hook('init_admin', 'theme_benderbs_actions_admin');
}

osc_admin_menu_appearance(__('Header logo', BENDERBS_THEME_FOLDER), osc_admin_render_theme_url('oc-content/themes/'.BENDERBS_THEME_FOLDER.'/admin/header.php'), 'header_bender');
osc_admin_menu_appearance(__('Theme settings', BENDERBS_THEME_FOLDER), osc_admin_render_theme_url('oc-content/themes/'.BENDERBS_THEME_FOLDER.'/admin/settings.php'), 'settings_bender');
