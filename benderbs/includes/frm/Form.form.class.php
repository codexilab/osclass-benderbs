<?php if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');

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

/**
 * class Form
 */
class CustomForm {
    
    public static $class = 'form-control form-control-light';

    /**
     * @param array $attr 
     * @param array $options 
     */
    protected static function select($attr = array(), $options = array()) 
    {

        $attr['name']   = osc_esc_html($attr['name']);
        $attr['id']     = preg_replace('|([^_a-zA-Z0-9-]+)|', '', $attr['name']);

        $option = '';
        if ($options) {
            foreach ($options as $i) {
                if (isset($i['value']) && isset($i['option'])) {
                    $i['value'] = osc_esc_html($i['value']);
                    $text = osc_esc_html($i['option']); unset($i['option']);

                    $option .= '<option '. implode(' ', array_map(
                        function ($k, $v) { return $k .'="'. $v .'"'; },
                        array_keys($i), $i
                    )) .'>'.$text.'</option>'.PHP_EOL;
                }
            }
        }

        if ($attr) {
            $html = '<select '. implode(' ', array_map(
                function ($k, $v) { return $k .'="'. $v .'"'; },
                array_keys($attr), $attr
            )) .'>'.$option.'</select>';

            echo $html;
        } else {
            echo '';
        }

    }

    /**
     * @param $name
     * @param $items
     * @param $fld_key
     * @param $fld_name
     * @param $default_item
     * @param $id
     */
    protected static function generic_select($name, $items, $fld_key, $fld_name, $default_item, $id)
    {
        $attr = array(
            'name'  => $name,
            'class' => self::$class
        );

        $options = array();

        if ($default_item) {
            // Keep first position this default value
            array_unshift($options, array('value' => '', 'option' => $default_item));
        }
        
        // Setting values
        $j = 0;
        foreach ($items as $i) {
            $j++;
            $options[$j]['value']   = $i[$fld_key];
            $options[$j]['option']  = $i[$fld_name];
        }

        // Searching selected item
        if ($id) {
            $num = count($options);
            for ($i=0; $i < $num; $i++) {
                if (isset($options[$i]['value']) && $options[$i]['value'] == $id) {
                    $options[$i]['selected'] = 'selected';
                }
            }
        }

        self::select($attr, $options);
    }

    /**
     * @param array $attr 
     */
    protected static function input($attr = array()) 
    {

        $attr['name']   = osc_esc_html($attr['name']);
        $attr['id']     = preg_replace('|([^_a-zA-Z0-9-]+)|', '', $attr['name']);

        if (isset($attr['value'])) $attr['value'] = osc_esc_html(htmlentities( $attr['value'], ENT_COMPAT, 'UTF-8' ));
        if (isset($attr['placeholder'])) $attr['placeholder'] = osc_esc_html(htmlentities( $attr['placeholder'], ENT_COMPAT, 'UTF-8' ));
        if (isset($attr['maxlength'])) $attr['maxlength'] = osc_esc_html( $attr['maxlength'] );
        if (isset($attr['minlength'])) $attr['minlength'] = osc_esc_html( $attr['minlength'] );

        if ($attr) {
            $html = '<input '. implode(' ', array_map(
                function ($k, $v) { return $k .'="'. $v .'"'; },
                array_keys($attr), $attr
            )) .' />';

            echo $html;
        } else {
            echo '';
        }

    }

    /**
     * @param $name
     * @param $value
     */
    protected static function generic_input_hidden($name, $value)
    {
        self::input(array('type' => 'hidden', 'name' => $name, 'value' => $value));
    }

    /**
     * @param      $name
     * @param      $value
     * @param null $maxLength
     * @param bool $readOnly
     * @param bool $autocomplete
     */
    protected static function generic_input_text($name, $value, $maxLength = null, $readOnly = false, $autocomplete = true)
    {
        $attr = array('type' => 'text', 'name' => $name, 'value' => $value, 'class' => self::$class);
        
        if (isset($maxLength)) $attr['maxlength'] = $maxLength;
        
        if (!$autocomplete) $attr['autocomplete'] = 'off';
        
        if ($readOnly) {
            $attr['disabled'] = 'disabled';
            $attr['readonly'] = 'readonly';
        }

        self::input($attr);
    }

    /**
     * @param      $name
     * @param      $value
     * @param null $maxLength
     * @param bool $readOnly
     */
    protected static function generic_password($name, $value, $maxLength = null, $readOnly = false)
    {
        $attr = array('type' => 'password', 'name' => $name, 'value' => $value, 'class' => self::$class, 'autocomplete' => 'off');
        
        if ($readOnly) {
            $attr['disabled'] = 'disabled';
            $attr['readonly'] = 'readonly';
        }

        self::input($attr);
    }

    /**
     * @param      $name
     * @param      $value
     * @param bool $checked
     */
    protected static function generic_input_checkbox( $name , $value , $checked = false )
    {
        $attr = array('type' => 'checkbox', 'name' => $name, 'value' => $value);
        
        if ($checked) {
            $attr['checked'] = 'checked';
        }

        self::input($attr);
    }

    

    /**
     * @param array $attr 
     */
    protected static function textarea($attr = array()) 
    {

        $attr['name']   = osc_esc_html($attr['name']);
        $attr['id']     = preg_replace('|([^_a-zA-Z0-9-]+)|', '', $attr['name']);

        if (isset($attr['placeholder'])) $attr['placeholder'] = osc_esc_html(htmlentities( $attr['placeholder'], ENT_COMPAT, 'UTF-8' ));
        if (!isset($attr['rows']) || !is_integer($attr['rows'])) $attr['rows'] = 10;

        $value = $attr['value']; unset($attr['value']);

        if ($attr) {
            $html = '<textarea '. implode(' ', array_map(
                function ($k, $v) { return $k .'="'. $v .'"'; },
                array_keys($attr), $attr
            )) .'>'.$value.'</textarea>';

            echo $html;
        } else {
            echo '';
        }

    }

    /**
     * @param $name
     * @param $value
     */
    protected static function generic_textarea($name, $value)
    {
        self::textarea(array('name' => $name, 'value' => $value, 'class' => self::$class));
    }

}