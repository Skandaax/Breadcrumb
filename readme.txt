=== MY beadcrumb ===

License GPLv2

=== Description ===

1/ Télécharger le dossier de l'extension dans le repertoire 
wp-content/plugins.
2/ Activez l'extension.
3/ Insérez la fonction <?php if (function_exists''fil_ariane'))
{echo fil_ariane(); } ?> dans le fichier header.php de votre thème.
4/ Pour insérer un shortcode directement dans les pages de votre thème
il faut utiliser la fonction <?php if(shortcode_exists(mybreadcrumb))
{echo do_shortcode('[mybreadcrumb]');} ?>