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
	 * Class CommentForm
	 */
	class CustomCommentForm extends BenderForm
    {

		/**
         * @param null $comment
         */
        public static function primary_input_hidden( $comment = null )
        {
            $commentId = null;
            if( isset($comment['pk_i_id']) ) {
                $commentId = $comment['pk_i_id'];
            }
            if(Session::newInstance()->_getForm('commentId') != '') {
                $commentId = Session::newInstance()->_getForm('commentId');
            }
            if ( null !== $commentId ) {
                parent::generic_input_hidden( 'id' , $commentId);
            }
        }

		/**
         * @param null $comment
         */
        public static function title_input_text( $comment = null )
        {
            $commentTitle = '';
            if( isset($comment['s_title']) ) {
                $commentTitle = $comment['s_title'];
            }
            if(Session::newInstance()->_getForm('commentTitle') != '') {
                $commentTitle = Session::newInstance()->_getForm('commentTitle');
            }
            parent::generic_input_text( 'title' , $commentTitle);
        }

		/**
         * @param null $comment
         */
        public static function author_input_text( $comment = null )
        {
            $commentAuthorName = '';
            if( isset($comment['s_author_name']) ) {
                $commentAuthorName = $comment['s_author_name'];
            }
            if(Session::newInstance()->_getForm('commentAuthorName') != '') {
                $commentAuthorName = Session::newInstance()->_getForm('commentAuthorName');
            }
            parent::generic_input_text( 'authorName' , $commentAuthorName);
        }

		/**
         * @param null $comment
         */
        public static function email_input_text( $comment = null )
        {
            $commentAuthorEmail = '';
            if( isset($comment['s_author_email']) ) {
                $commentAuthorEmail = $comment['s_author_email'];
            }
            if(Session::newInstance()->_getForm('commentAuthorEmail') != '') {
                $commentAuthorEmail = Session::newInstance()->_getForm('commentAuthorEmail');
            }
            parent::generic_input_text( 'authorEmail' , $commentAuthorEmail);
        }

		/**
         * @param null $comment
         */
        public static function body_input_textarea( $comment = null )
        {
            $commentBody = '';
            if( isset($comment['s_body']) ) {
                $commentBody = $comment['s_body'];
            }
            if(Session::newInstance()->_getForm('commentBody') != '') {
                $commentBody = Session::newInstance()->_getForm('commentBody');
            }
            parent::generic_textarea( 'body' , $commentBody);
        }

		/**
		 * @param bool $admin
		 */
		public static function js_validation( $admin = false ) {
?>
<script>
$(document).ready(function() {
    $('form[name=comment_form]').formValidation({
        framework: 'bootstrap4',
        icon: {
            valid: 'fa fa-check',
            invalid: 'fa fa-times',
            validating: 'fa fa-refresh'
        },
        fields: {
            body: {
                row: '.col-sm-10',
                validators: {
                    notEmpty: {
                        message: '<?php _e('Comment: this field is required'); ?>.'
                    }
                }
            },
            authorEmail: {
                row: '.col-sm-10',
                validators: {
                    notEmpty: {
                        message: '<?php _e('Email: this field is required'); ?>.'
                    },
                    emailAddress: {
                        message: '<?php _e('Invalid email address'); ?>.'
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