<!-- Right Col -->
<div id="col-right">

    <div class="col-wrap">
        
        <div class="inside">

        <?php 
            $thumbnailUrl = $gravapress_profile->{'entry'}[0]->{'thumbnailUrl'};
            $gallery_photos = $gravapress_profile->{'entry'}[0]->{'photos'};
            $urls_sites = $gravapress_profile->{'entry'}[0]->{'urls'};
        ?>

        

            <!-- PROFILE IMAGE -->

            <a href="<?php echo ($thumbnailUrl ? $thumbnailUrl : $plugin_url . '/images/no-image.png' ) . '?s=300'; ?>" target="_blank">
                <img class="main-image" src="<?php echo ($thumbnailUrl ? $thumbnailUrl : $plugin_url . '/images/no-image.png' ) . '?s=300'; ?>" 
                alt="Gravatar User image Profile">
            </a>

            <!-- GALLERY -->
            <h1><?php esc_attr_e( 'Photo Gallery', 'wp_admin_style' ); ?></h1>
            <div class="gallery-image">            

                <?php
                    $total_photos = sizeof( $gallery_photos );
                    for ($i=0; $i < $total_photos ; $i++) : 
                ?>                
                    <a href="<?php echo $gallery_photos[$i]->{'value'}; ?>" target="_blank">
                        <img class="gallery_gravatar_image" src="<?php echo $gallery_photos[$i]->{'value'}; ?>" 
                        alt="Gravatar User image Profile">
                    </a>
                <?php endfor; ?>

            </div>            

            <!-- SITES -->
            <h1><?php esc_attr_e( 'Websites', 'wp_admin_style' ); ?></h1>
            <div class="sites-image">

                <?php
                    $total_url = sizeof( $urls_sites );
                    for ($i=0; $i < $total_url ; $i++) : 
                ?>                
                    <a href="<?php echo $urls_sites[$i]->{'urls'}; ?>" target="_blank">
                        <img src="<?php echo ( $urls_sites[$i]->{'urls'} ? $urls_sites[$i]->{'urls'} : $plugin_url . '/images/link.png') ; ?>" 
                        width="100" height="100">
                        <div class="caption"><?php echo $urls_sites[$i]->{'title'}; ?></div>
                    </a>
                <?php endfor; ?>

            </div>           
            
        </div>

    </div>
    <!-- /col-wrap -->

</div>
<!-- /col-right -->