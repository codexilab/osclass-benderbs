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
 * Custom render for Breadcrumb Class
 */
class CustomBreadcrumb extends Breadcrumb
{
    
    /**
     * @param string $separator
     *
     * @return string
     */
    public function render($separator = '&raquo;')
    {
        if( count($this->aLevel) == 0 ) {
            return '';
        }

        $node = array();
        for ($i = 0 , $iMax = count( $this->aLevel ); $i < $iMax; $i ++) {
            $text = '<li class="breadcrumb-item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
            // set separator
            if( $i > 0 ) {
                $text .= '' . $separator . '';
            }
            // create span tag
            $title = $this->aLevel[$i]['title'];
            if( array_key_exists('url', $this->aLevel[$i]) ) {
                $title = '<a href="' . osc_esc_html($this->aLevel[$i]['url']) . '" itemprop="url">' . $title . '</a>';
            }
            $node[] = $text . $title . '</li>' . PHP_EOL;
        }

        $result  = '<ul class="breadcrumb bg-gray-bender small">' . PHP_EOL;
        $result .= implode(PHP_EOL, $node);
        $result .= '</ul>' . PHP_EOL;

        return $result;
    }
}