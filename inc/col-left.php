<!-- Info -->
<div class="col-wrap">

    <h1><?php esc_attr_e( 'Info', 'wp_admin_style' ); ?></h1>
    
    <div class="inside">

        <!-- Variable Content -->
        <?php 
            $displayName        = $gravapress_profile -> {'entry'}[0] -> {'displayName'};
            $currentLocation    = $gravapress_profile -> {'entry'}[0] -> {'currentLocation'};
            $aboutMe            = $gravapress_profile -> {'entry'}[0] -> {'aboutMe'};
        ?>

        <h1><?php esc_attr_e( $displayName, 'wp_admin_style' ); ?></h1>
        <?php esc_attr_e( $currentLocation, 'wp_admin_style' ); ?>
        <p><?php echo $aboutMe;?></p>
    
    </div>

</div>
<!-- /col-wrap -->



<!-- Social -->
<?php
    $total_accounts = sizeof( $gravapress_profile->{'entry'}[0]->{'accounts'} );
    if($total_accounts):
?>
    <div class="col-wrap">

        <h1><?php esc_attr_e( 'Social', 'wp_admin_style' ); ?></h1>
        
        <div class="inside">

            <?php for ($i=0; $i < $total_accounts ; $i++): ?>

                <h2>
                    <?php esc_attr_e(ucfirst( $gravapress_profile->{'entry'}[0]->{'accounts'}[$i]->{'shortname'} ), 'wp_admin_style'); ?> 
                    <br />
                    <small><a href="<?php $gravapress_profile->{'entry'}[0]->{'accounts'}[$i]->{'url'}; ?>">View Profile</a></small>
                </h2>
                <hr />
            <?php endfor;?>        
        </div>
    </div>
<?php endif;?>
<!-- /Social -->

<!-- Contact -->
<div class="col-wrap">

    <h1><?php esc_attr_e( 'Contact', 'wp_admin_style' ); ?></h1>
    
    <div class="inside">

    <!-- EMAIL -->
        <h2>
            <?php esc_attr_e( 'Email', 'wp_admin_style' ); ?>
        <br />
        <small>
            <?php
                $total_emails = sizeof($gravapress_profile->{'entry'}[0]->{'emails'});

                for( $i = 0; $i < $total_emails; $i++) {                    

                    if( $gravapress_profile->{'entry'}[0]->{'emails'}[$i]->{'primary'} == 'true' ) {
                        $email_primary = $gravapress_profile->{'entry'}[0]->{'emails'}[$i]->{'value'};

                        echo '<a href="mailto:' . $email_primary . '">' . $email_primary . '</a>';
                    }

                }
            ?>
        </small>
        </h2>

        <hr />	

        <!-- IMS -->

        <?php
            if( $gravapress_profile->{'entry'}[0]->{'ims'} ):
                $total_ims = sizeof( $gravapress_profile->{'entry'}[0]->{'ims'} );
                for( $i=0; $i < $total_ims; $i++ ):
        ?>

            <h2>
                    <?php esc_attr_e( ucfirst( $gravapress_profile->{'entry'}[0]->{'ims'}[$i]->{'type'} ), 'wp_admin_style' )?>
                    <br/>
                    <small>
                        <?php esc_attr_e( $gravapress_profile->{'entry'}[0]->{'ims'}[$i]->{'value'} ) ?>
                    </small>
            </h2>
            <hr/>

        <?php
                endfor;
            endif;
        ?>

        <!-- PHONES -->

        <?php
            if( $gravapress_profile->{'entry'}[0]->{'phoneNumbers'} ):
                $total_ims = sizeof( $gravapress_profile->{'entry'}[0]->{'phoneNumbers'} );
                for( $i=0; $i < $total_ims; $i++ ):
        ?>

            <h2>
                    <?php esc_attr_e( ucfirst( $gravapress_profile->{'entry'}[0]->{'phoneNumbersims'}[$i]->{'type'} ) . ' Phone', 'wp_admin_style' )?>
                    <br/>
                    <small>
                        <?php esc_attr_e( $gravapress_profile->{'entry'}[0]->{'phoneNumbers'}[$i]->{'value'} ) ?>
                    </small>
            </h2>
            <hr/>

        <?php
                endfor;
            endif;
        ?>
    
    </div>

</div>
<!-- /col-wrap -->