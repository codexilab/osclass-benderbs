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
     
$loopClass = '';
$type = 'items';
if(View::newInstance()->_exists('listType')){
    $type = View::newInstance()->_get('listType');
}
if(View::newInstance()->_exists('listClass')){
    $loopClass = View::newInstance()->_get('listClass');
}
?>
<?php
    $i = 0;

    if ($type == 'latestItems') {
        while (osc_has_latest_items()) {
            benderbs_draw_item($loopClass);
        }
    } elseif ($type == 'premiums') {
        while (osc_has_premiums()) {
            benderbs_draw_item($loopClass, false, true);
        }
    } else {
        search_ads_listing_top_fn();
        while (osc_has_items()) {
            $i++;
            $admin = false;
            if (View::newInstance()->_exists("listAdmin")) {
                $admin = true;
            }

            benderbs_draw_item($loopClass, $admin);

            if(benderbs_show_as()=='gallery') {
                if($i%8 == 0){
                    osc_run_hook('search_ads_listing_medium');
                }
            } else if(benderbs_show_as()=='list') {
                if($i%6 == 0){
                    osc_run_hook('search_ads_listing_medium');
                }
            }
      	}
    }
?>