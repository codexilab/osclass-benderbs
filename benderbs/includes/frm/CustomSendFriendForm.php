<?php if ( ! defined( 'ABS_PATH' ) ) {
    exit( 'ABS_PATH is not loaded. Direct access is not allowed.' );
}

/*
 * Copyright 2014 Osclass
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

    /**
     * SendFriend.form.class.php
     */
    class CustomSendFriendForm extends CustomForm {

        /*static public function primary_input_hidden($page) {
            parent::generic_input_hidden("id", $page["pk_i_id"]);
        }*/

        /**
         * @return bool
         */
        public static function your_name() {

            if( Session::newInstance()->_getForm( 'yourName' ) != '' ){
                $yourName = Session::newInstance()->_getForm( 'yourName' );
                parent::generic_input_text( 'yourName' , $yourName);
            } else {
                parent::generic_input_text( 'yourName' , '');
            }
            return true;
        }

        /**
         * @return bool
         */
        public static function your_email() {

            if( Session::newInstance()->_getForm( 'yourEmail' ) != '' ){
                $yourEmail = Session::newInstance()->_getForm( 'yourEmail' );
                parent::generic_input_text( 'yourEmail' , $yourEmail);
            } else {
                parent::generic_input_text( 'yourEmail' , '');
            }
            return true;
        }

        /**
         * @return bool
         */
        public static function friend_name() {
            if( Session::newInstance()->_getForm( 'friendName' ) != '' ){
                $friendName = Session::newInstance()->_getForm( 'friendName' );
                parent::generic_input_text( 'friendName' , $friendName);
            } else {
                parent::generic_input_text( 'friendName' , '');
            }
            return true;
        }

        /**
         * @return bool
         */
        public static function friend_email() {
            if( Session::newInstance()->_getForm( 'friendEmail' ) != '' ){
                $friendEmail = Session::newInstance()->_getForm( 'friendEmail' );
                parent::generic_input_text( 'friendEmail' , $friendEmail);
            } else {
                parent::generic_input_text( 'friendEmail' , '');
            }
            return true;
        }

        /**
         * @return bool
         */
        public static function your_message() {
            if( Session::newInstance()->_getForm( 'message_body' ) != '' ){
                $message_body = Session::newInstance()->_getForm( 'message_body' );
                parent::generic_textarea( 'message' , $message_body );
            } else {
                parent::generic_textarea( 'message' , '' );
            }
            return true;
        }

        public static function js_validation() {
?>
<script>
$(document).ready(function() {
    $('form[name=sendfriend]').validate({
        rules: {
            yourName: {
                required: true
            },
            yourEmail: {
                required: true,
                email: true
            },
            friendName: {
                required: true
            },
            friendEmail: {
                required: true,
                email: true
            },
            message:  {
                required: true
            }
        },
        messages: {
            yourName: {
                required: "<?php _e("Your name: this field is required"); ?>."
            },
            yourEmail: {
                email: "<?php _e("Invalid email address"); ?>.",
                required: "<?php _e("Email: this field is required"); ?>."
            },
            friendName: {
                required: "<?php _e("Friend's name: this field is required"); ?>."
            },
            friendEmail: {
                required: "<?php _e("Friend's email: this field is required"); ?>.",
                email: "<?php _e("Invalid friend's email address"); ?>."
            },
            message: "<?php _e("Message: this field is required"); ?>."

        },
        highlight: function(element) {
            $(element).closest('.form-control').addClass('is-invalid');
            $(element).closest(".form-group").children(".col-form-label").addClass('text-danger');
        },
        unhighlight: function(element) {
            $(element).closest('.form-control').removeClass('is-invalid');
            $(element).closest(".form-group").children(".col-form-label").removeClass('text-danger');
        },
        errorElement: 'div',
        errorClass: 'invalid-feedback'
    });
});
</script>
<?php
        }

    }

?>