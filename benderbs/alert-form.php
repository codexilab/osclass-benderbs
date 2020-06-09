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
    
osc_add_hook('footer', 'js_alert_form'); ?>
<?php function js_alert_form() { ?>
<script>
$(document).ready(function() {
    /* Show modal process */
    $(".sub_button").click(function() {
        var modalHeader, modalBody, modalFooter = '';

        $('#genModal').modal('show');
    
        $('#genModal').on('shown.bs.modal', function(e) {
            $.post('<?php echo osc_base_url(true); ?>', {email:$("#alert_email").val(), userid:$("#alert_userId").val(), alert:$("#alert").val(), page:"ajax", action:"alerts"},
            function(data) {
                modalHeader = '<h5 class="modal-title"><?php echo osc_esc_js(__('Message', osc_current_web_theme())); ?></h5>';

                if (data == 1) {
                    modalBody = '<?php echo osc_esc_js(__('You have sucessfully subscribed to the alert', osc_current_web_theme())); ?> <div class="bg-gradient-success btn-circle text-gray-100 btn-sm"><i class="fas fa-check"></i></div>';
                    $('.alert-form').html('<h3><strong><?php echo osc_esc_js(__('Already subscribed to this search', osc_current_web_theme())); ?></strong></h3>');
                } else if(data == -1) {
                    modalBody = '<?php echo osc_esc_js(__('Invalid email address', osc_current_web_theme())); ?> <div class="bg-gradient-danger btn-circle text-gray-100 btn-sm"><i class="fas fa-exclamation-triangle"></i></div>';
                } else { 
                    modalBody = '<?php echo osc_esc_js(__('There was a problem with the alert', osc_current_web_theme())); ?> <div class="bg-gradient-danger btn-circle text-gray-100 btn-sm"><i class="fas fa-exclamation-triangle"></i></div>';
                }

                modalFooter = '<button type="button" class="btn btn-secondary" onClick="genModalHide();return false;"><?php echo osc_esc_js(__('Close')); ?></button>';
                
                $("#genModal .modal-header").prepend().html(modalHeader);
                $("#genModal .modal-body").html(modalBody);
                $("#genModal .modal-footer").html(modalFooter);
            });
        });
    });
    /* End modal process */

    var sQuery = '<?php echo osc_esc_js(CustomAlertForm::default_email_text()); ?>';

    if($('input[name=alert_email]').val() == sQuery) {
        $('input[name=alert_email]').css('color', 'gray');
    }
    $('input[name=alert_email]').click(function(){
        if($('input[name=alert_email]').val() == sQuery) {
            $('input[name=alert_email]').val('');
            $('input[name=alert_email]').css('color', '');
        }
    });
    $('input[name=alert_email]').blur(function(){
        if($('input[name=alert_email]').val() == '') {
            $('input[name=alert_email]').val(sQuery);
            $('input[name=alert_email]').css('color', 'gray');
        }
    });
    $('input[name=alert_email]').keypress(function(){
        $('input[name=alert_email]').css('background','');
    })
});
</script>
<?php } ?>
<div class="alert-form bg-gray-bender">
    <?php if (function_exists('osc_search_alert_subscribed') && osc_search_alert_subscribed()) : ?>
    <h3><strong><?php _e('Already subscribed to this search', osc_current_web_theme()); ?></strong></h3>
    <?php else: ?>
    <h3><strong><?php _e('Subscribe to this search', osc_current_web_theme()); ?></strong></h3>
    <form action="<?php echo osc_base_url(true); ?>" method="post" name="sub_alert" id="sub_alert">
        <?php CustomAlertForm::page_hidden(); ?>
        <?php CustomAlertForm::alert_hidden(); ?>

        <?php if(osc_is_web_user_logged_in()) { ?>
            <?php CustomAlertForm::user_id_hidden(); ?>
            <?php CustomAlertForm::email_hidden(); ?>

        <?php } else { ?>
            <?php CustomAlertForm::user_id_hidden(); ?>
            <?php CustomAlertForm::email_text(); ?>
        <?php }; ?>
        <button type="button" class="btn btn-info btn-block sub_button"><?php _e('Subscribe now', osc_current_web_theme()); ?>!</button>
    </form>
    <?php endif; ?>
</div>