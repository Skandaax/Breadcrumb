<?php

/*
Plugin Name: My Breadcrumb !
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

/***************************************************²*************/
/***Création d'une fonction simple du fil d'ariane****************/
function fil_ariane() {
    global $post;

    if (!is_front_page()) {
        $fil = '<div id="fil">vous êtes ici : ';
        $fil.= '<a href="'.get_bloginfo('wpurl').'"';
        $fil.= get_bloginfo('name');
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

/***************************************************²***************
****Fonction qui est appelé dans un modèle de page servant**********
****à l'affichage du thème*****************************************/
?>
<div class="site-content-contain">

<?php

if (function_exists('fil_ariane')) {
    echo fil_ariane();
}
?>

<div id="content" class="site-content">

<?php

/***************************************************²****************
****Ajout d'un fichier style.CSS pour l'apparence du fil d'ariane***/
function add_css() {
    wp_register_style('my_breadcrumb', 
    plugins_url('style.css', __FILE__));
    wp_enqueue_style('my_breadcrumb');  

}

/***************************************************²****************
****Appeler la function do_shortcode********************************/
if (shortcode_exists('mybreadcrumb')) {
    echo do_shorcode('[mybreadcrumb]');
}

/***************************************************²***************/
/***On appele les hooks pour greffer********************************/
/***l'objet au core de WordPress************************************/
/***Relie le css au fil d'ariane************************************/
    add_action('wp_enqueue_scripts', 'add_css');

/***************************************************²***************/
/***Shortcode a mettre sur les pages de votre site******************/
    add_shortcode('mybreadcrumb', 'fil_ariane');

/***************************************************²***************/
/***afficher l'onglet et la page dans l'administration de WordPress*/
    add_action('admin_menu', 'breadcrumb_menu');

/***************************************************²***************/
/***Onglet pour le menu de l'administration*************************/
function add_link_menu() {
    add_menu_page($page_title, $menu_title, $capability, $menu_slug, 
                    $function, $icon_url, $position, 15);
}

/***************************************************²***************/
/***Créer un onglet dans le sous menu réglage***********************/
function breadcrumb_menu() {
    if (function_exists('add_options_page')) {
        add_options_page('breadcrumb', 'my breadcrumb', 'administrator', 
                            'breadcrumb', 'breadcrumb_page_content');
    }
}

/***************************************************²***************/
/***Fonction permettant d'afficher le contenu de la page************/
function breadcrumb_page_content() {
    ?>
    <div class="wrap">
        <h2>My breadcrumb (fil d'Ariane)</h2>
    <div>

    Pour utiliser l'extension : 
        <ul>
            <li>
                1/ Télécharger le dossier de l'extention dans le répertoire wp-content/plugins
            </li>
            <li>
                2/ Activez l'extension.
            </li>
            <li>
                3/ Inserez la function PHP : <input type="text"
                    value="if(function_exists('fil_ariane')) {echo fil_ariane(); }"
                    size="40" readonly="readonly" />
                    dans les fichiers PHP de votre thème,
                    <br/>
                    ou utilisez le shortcode : 
                    <input type="text" value="[mybreadcrumb]" readonly="readonly" />
            </li>
        </ul>
    </div>

    <?php
}
