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
     
if ((!defined('ABS_PATH'))) exit('ABS_PATH is not loaded. Direct access is not allowed.');
if (!OC_ADMIN) exit('User access is not allowed.');
$logo_prefence = osc_get_preference('logo', 'bender'); ?>

<style type="text/css" media="screen">
    .command { background-color: white; color: #2E2E2E; border: 1px solid black; padding: 8px; }
    .theme-files { min-width: 500px; }
</style>

<?php if (is_writable(osc_uploads_path())) : ?>
    
    <?php if ($logo_prefence) : ?>
        
        <?php if (file_exists(osc_uploads_path() . osc_get_preference('logo','bender'))) : ?>
        <h2 class="render-title"><?php _e('Header logo', osc_current_web_theme()); ?></h2>
        <h3 class="render-title"><?php _e('Preview', osc_current_web_theme()) ?></h3>
        <img border="0" alt="<?php echo osc_esc_html(osc_page_title()); ?>" src="<?php echo bender_logo_url().'?'.filemtime(osc_uploads_path() . osc_get_preference('logo','bender'));?>" />
        <br /><?php echo $logo_prefence; ?><br /><br />
        <form action="<?php echo osc_admin_render_theme_url('oc-content/themes/'.osc_current_web_theme().'/admin/header.php');?>" method="post" enctype="multipart/form-data" class="nocsrf">
            <input type="hidden" name="action_specific" value="remove" />
            <fieldset>
            	<input id="button_remove" type="submit" value="<?php echo osc_esc_html(__('Remove logo',osc_current_web_theme())); ?>" class="btn btn-red btn-mini">
            </fieldset>
        </form>
        <?php endif; ?>

    <?php else : ?>

        <div class="flashmessage flashmessage-warning flashmessage-inline" style="display: block;">
            <p><?php _e('No logo has been uploaded yet', osc_current_web_theme()); ?></p>
        </div>
        
    <?php endif; ?>

    <h2 class="render-title separate-top"><?php _e('Upload logo', osc_current_web_theme()) ?></h2>
    <p><?php _e('The preferred size of the logo is 600x100.', osc_current_web_theme()); ?></p>
    
    <?php if ($logo_prefence) : ?>
    <div class="flashmessage flashmessage-inline flashmessage-warning"><p><?php _e('<strong>Note:</strong> Uploading another logo will overwrite the current logo.', osc_current_web_theme()); ?></p></div>
    <?php endif; ?>

    <br/><br/>

    <form action="<?php echo osc_admin_render_theme_url('oc-content/themes/'.osc_current_web_theme().'/admin/header.php'); ?>" method="post" enctype="multipart/form-data" class="nocsrf">
        <input type="hidden" name="action_specific" value="upload_logo" />
        <fieldset>
            <div class="form-horizontal">
                <div class="form-row">
                    <div class="form-label"><?php _e('Logo image (png,gif,jpg)',osc_current_web_theme()); ?></div>
                    <div class="form-controls">
                        <input type="file" name="logo" id="package" />
                    </div>
                </div>
                <div class="form-actions">
                    <input id="button_save" type="submit" value="<?php echo osc_esc_html(__('Upload',osc_current_web_theme())); ?>" class="btn btn-submit">
                </div>
            </div>
        </fieldset>
    </form>

<?php else : ?>

    <div class="flashmessage flashmessage-error" style="display: block;">
        <p>
    	<?php
        $msg  = sprintf(__('The images folder <strong>%s</strong> is not writable on your server', osc_current_web_theme()), osc_uploads_path() ) .", ";
        $msg .= __("Osclass can't upload the logo image from the administration panel.", osc_current_web_theme()) . ' ';
        $msg .= __('Please make the aforementioned image folder writable.', osc_current_web_theme()) . ' ';
        echo $msg;
        ?>
        </p>
        <p><?php _e('To make a directory writable under UNIX execute this command from the shell:', osc_current_web_theme()); ?></p>
        <p class="command">chmod a+w <?php echo osc_uploads_path(); ?></p>
    </div>

<?php endif; ?>