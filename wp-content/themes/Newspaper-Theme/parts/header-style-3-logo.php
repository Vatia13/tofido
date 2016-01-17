<?php

/*  ----------------------------------------------------------------------------
    Full width logo - the ad is separate
 */

?>

<!-- full width logo -->
<div class="td-header-bg">
    <div class="container header-style-3">
        <div class="row">
            <div class="span12 td-full-logo" role="banner" itemscope="itemscope" itemtype="<?php echo td_global::$http_or_https?>://schema.org/Organization">
                <div class="td-grid-wrap">
                    <div class="container-fluid">
                        <?php
                        //read the logo + retina logo
                        $td_customLogo = td_util::get_option('tds_logo_upload');
                        $td_customLogoR = td_util::get_option('tds_logo_upload_r');

                        $td_logo_alt = td_util::get_option('tds_logo_alt');
                        $td_logo_title = td_util::get_option('tds_logo_title');

                        if (!empty($td_logo_title)) {
                            $td_logo_title = ' title="' . $td_logo_title . '"';
                        }

                        if (!empty($td_customLogoR)) {
                            //if retina
                            ?>
                            <a itemprop="url" href="<?php echo home_url(); ?>">
                                <img class="td-retina-data td-logo"  data-retina="<?php echo htmlentities($td_customLogoR) ?>" src="<?php echo $td_customLogo?>" alt="<?php echo $td_logo_alt ?>"<?php echo $td_logo_title ?>/>
                            </a>
                            <meta itemprop="name" content="<?php bloginfo('name')?>">
                        <?php
                        } else {
                            //not retina
                            if (!empty($td_customLogo)) {
                                ?>
                                <a class="td-logo" itemprop="url" href="<?php echo home_url(); ?>"><img src="<?php echo $td_customLogo?>" alt="<?php echo $td_logo_alt ?>"<?php echo $td_logo_title ?>/></a>
                                <meta itemprop="name" content="<?php bloginfo('name')?>">
                            <?php
                            }
                        }




                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
