<?php

/*
Plugin Name: My breadcrumb !
Plugin URI: https://www.inforaz.com/developpement-web-web-mobile/
Description: Fil d'ariane pour les articles et les pages.
Author: Couillin Yannick
Version 1.0
Author URI: http:/www.inforaz.com/
Licence: GPLv2

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2020 Inforaz
*/

/***************************************************²*/
/***Création d'une fonction simple du fil d'ariane***/
function fil_ariane() {
    global $post;

    if (!is-front_page()) {
        $fil = '<div id="fil">vous êtes ici : ';
        $fil.= '<a href="'.get_bloginfo('wpurl').'"';
        $fil.= get_bloinfo('name');
        $fil.= '</a> > ';

        $parents = array_reverse(get_ancestors($_POST->ID,'page'));
        foreach($parents as $parent) {
            $fil.='<a href="' .get_permalink($parent) .'">';
            $fil.= get_the_title($parent);
            $fil.= '</a> > ';
        }
            $fil.= $post->post_title;

            $fil.='</div>';
    }
    return $fil;
}
