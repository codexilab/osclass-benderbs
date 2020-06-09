<?php if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');

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
 * Custom buttoms style for Pagination Class
 */
class CustomPagination extends Pagination
{
    
    /**
     * @return string
     */
    public function doPagination()
    {
        if ($this->total > 1) {
            $links = $this->get_links();
            if($this->listClass !== false) {
                return '<ul class="pagination pagination-sm justify-content-center ' . $this->listClass . '">' . implode($this->delimiter, $links) . '</ul>';
            } else {
                return '<ul class="pagination pagination-sm justify-content-center">' . implode($this->delimiter, $links) . '</ul>';
            }
        } else {
            return '';
        }
    }

    /**
     * @param $text
     * @param $attrs
     *
     * @return string
     */
    protected function createATag( $text , $attrs )
    {
        $attrs['class'] = 'page-link ' . $attrs['class'];
        $att = array();
        foreach($attrs as $k => $v) {
            $att[] = $k . '="' . osc_esc_html($v) . '"';
        }
        return '<li class="page-item"><a ' . implode(' ', $att) . '>' . $text . '</a></li>';
    }

    /**
     * @param $text
     * @param $attrs
     *
     * @return string
     */
    protected function createSpanTag( $text , $attrs )
    {
        $attrs['class'] = 'page-link ' . $attrs['class'];
        $att = array();
        foreach($attrs as $k => $v) {
            $att[] = $k . '="' . osc_esc_html($v) . '"';
        }
        return '<li class="page-item active"><span ' . implode(' ', $att) . '>' . $text . '</span></li>';
    }
}