<?php
//read the logo + retina logo
$td_mobile_customLogo = td_util::get_option('tds_logo_menu_upload');
$td_mobile_customLogoR = td_util::get_option('tds_logo_menu_upload_r');

$td_logo_alt = td_util::get_option('tds_logo_alt');
$td_logo_title = td_util::get_option('tds_logo_title');

if (!empty($td_logo_title)) {
    $td_logo_title = ' title="' . $td_logo_title . '"';
}

if (!empty($td_mobile_customLogoR)) {
    //if retina
    ?>
    <a itemprop="url" href="<?php echo home_url(); ?>">
        <img class="td-retina-data" data-retina="<?php echo htmlentities($td_mobile_customLogoR) ?>" src="<?php echo $td_mobile_customLogo?>" alt="<?php echo $td_logo_alt ?>"<?php echo $td_logo_title ?>/>
    </a>
    <meta itemprop="name" content="<?php bloginfo('name')?>">
<?php
} else {
    //not retina
    if (!empty($td_mobile_customLogo)) {
        ?>
        <a itemprop="url" href="<?php echo home_url(); ?>"><img src="<?php echo $td_mobile_customLogo?>" alt="<?php echo $td_logo_alt ?>"<?php echo $td_logo_title ?>/></a>
        <meta itemprop="name" content="<?php bloginfo('name')?>">
    <?php
    }
}