<!doctype html >
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <meta charset="<?php bloginfo( 'charset' );?>" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php td_util::author_meta(); ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <?php

    //facebook sharing fix for videos, we add the custom meta data
    if (is_single()) {
        global $post;
        if (has_post_thumbnail($post->ID)) {
            $td_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
            if (!empty($td_image[0])) {
                echo '<meta property="og:image" content="' .  $td_image[0] . '" />';
            }
        }
    }


    $tds_favicon_upload = td_util::get_option('tds_favicon_upload');
    if (!empty($tds_favicon_upload)) {
        echo '<link rel="icon" type="image/png" href="' . $tds_favicon_upload . '">';
    }

    $tds_ios_76 = td_util::get_option('tds_ios_icon_76');
    $tds_ios_120 = td_util::get_option('tds_ios_icon_120');
    $tds_ios_152 = td_util::get_option('tds_ios_icon_152');
    $tds_ios_114 = td_util::get_option('tds_ios_icon_114');
    $tds_ios_144 = td_util::get_option('tds_ios_icon_144');

    if(!empty($tds_ios_76)) {
        echo '<link rel="apple-touch-icon-precomposed" sizes="76x76" href="' . $tds_ios_76 . '"/>';
    }

    if(!empty($tds_ios_120)) {
        echo '<link rel="apple-touch-icon-precomposed" sizes="120x120" href="' . $tds_ios_120 . '"/>';
    }

    if(!empty($tds_ios_152)) {
        echo '<link rel="apple-touch-icon-precomposed" sizes="152x152" href="' . $tds_ios_152 . '"/>';
    }


    if(!empty($tds_ios_114)) {
        echo '<link rel="apple-touch-icon-precomposed" sizes="114x114" href="' . $tds_ios_114 . '"/>';
    }


    if(!empty($tds_ios_144)) {
        echo '<link rel="apple-touch-icon-precomposed" sizes="144x144" href="' . $tds_ios_144 . '"/>';
    }


    wp_head();
    ?>
</head>

<body <?php body_class() ?>>



<div id="outer-wrap">
    <div id="inner-wrap">
<?php

// load the mobile menu
locate_template('parts/menu-mobile.php', true);


// show the black top menu if it's enabled
if (td_util::get_option('tds_' . 'top_menu') != 'hide') {
    locate_template('parts/menu-top.php', true);
}




$tds_header_style = td_util::get_option('tds_header_style');
switch ($tds_header_style) {

    default:
        // this is the default header configuration
        // (logo + ad) + menu
        locate_template('parts/header-style-1.php', true);
        locate_template('parts/menu-header.php', true);
        break;

    case '2':
        // (text logo + ad) + menu
        locate_template('parts/header-style-2.php', true);
        locate_template('parts/menu-header.php', true);
        break;

    case '3':
        // full width logo + menu
        locate_template('parts/header-style-3-logo.php', true);
        locate_template('parts/menu-header.php', true);
        locate_template('parts/header-style-3-ad.php', true);
        break;

    case '4':
        // menu + (logo + ad)
        locate_template('parts/menu-header.php', true);
        locate_template('parts/header-style-1.php', true);
        break;

    case '5':
        // menu + (text logo + ad)
        locate_template('parts/menu-header.php', true);
        locate_template('parts/header-style-2.php', true);
        break;

    case '6':
        // menu + full width logo
        locate_template('parts/menu-header.php', true);
        locate_template('parts/header-style-3-logo.php', true);
        locate_template('parts/header-style-3-ad.php', true);
        break;

    case '7':
        // full text logo + menu - used BLOG style
        locate_template('parts/header-full-text-logo.php', true);
        locate_template('parts/menu-header-center.php', true);
        break;

    case '8':
        // logo + menu - on one line
        locate_template('parts/header-style-8-one-line.php', true);
        break;
}
