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
     * Class SendFriendForm
     */
    class CustomSendFriendForm extends BenderForm {

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
    $('form[name=sendfriend]').formValidation({
        framework: 'bootstrap4',
        icon: {
            valid: 'fa fa-check',
            invalid: 'fa fa-times',
            validating: 'fa fa-refresh'
        },
        fields: {
            yourName: {
                validators: {
                    notEmpty: {
                        message: '<?php _e('Your name: this field is required'); ?>.'
                    }
                }
            },
            yourEmail: {
                validators: {
                    notEmpty: {
                        message: '<?php _e('Email: this field is required'); ?>.'
                    },
                    emailAddress: {
                        message: '<?php _e('Invalid email address'); ?>.'
                    }
                }
            },
            friendName: {
                validators: {
                    notEmpty: {
                        message: "<?php _e("Friend's name: this field is required"); ?>."
                    }
                }
            },
            friendEmail: {
                validators: {
                    notEmpty: {
                        message: "<?php _e("Friend's email: this field is required"); ?>."
                    },
                    emailAddress: {
                        message: "<?php _e("Invalid friend's email address"); ?>."
                    }
                }
            },
            message: {
                validators: {
                    notEmpty: {
                        message: '<?php _e('Message: this field is required'); ?>.'
                    }
                }
            }
        }
    });
});
</script>
<?php
        }

    }

?>