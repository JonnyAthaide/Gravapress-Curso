<?php
	echo $before_widget;
	echo $before_title . $title . $after_title;
?>
	
	<div class="about-me">	

		<img src='<?php echo $gravapress_profile->{'entry'}[0]->{'thumbnailUrl'} . '?s=70';?>'/>
	
		<span>
			<h2 id="about-title"><?php echo $gravapress_profile->{'entry'}[0]->{'displayName'};?></h2>
			<p><?php echo $gravapress_profile->{'entry'}[0]->{'currentLocation'};?></p>
		</span>		

	</div>	

	<p><?php echo $gravapress_profile->{'entry'}[0]->{'aboutMe'};?></p>

	<?php if( $display_social ) : ?>

		<h1>
	    <?php 
	        if($gravapress_profile->{'entry'}[0]->{'accounts'}) {            
	            echo 'Social';
	        }
	    ?>                                            
	    </h1>

	    <div>                                               
	        
	        <div>

	            <?php
	                $total_accounts = sizeof( $gravapress_profile->{'entry'}[0]->{'accounts'} );                                                    
	                for( $i = 0; $i < $total_accounts; $i++ ) :
	            ?>		                                                                   
                    <a target="_blank" style="padding: 2px;" href="<?php echo $gravapress_profile->{'entry'}[0]->{'accounts'}[$i]->{'url'} ; ?>">
	                	<img width="30px" src="<?php echo $plugin_url . '/images/social/' . $gravapress_profile->{'entry'}[0]->{'accounts'}[$i]->{'shortname'} . '.png'; ?>">                         
                    </a>	  

	            <?php   
	                                                       
	                endfor; 
	            ?>                                             
	        </div>
	    </div>

	<?php endif;?>

	<p></p>

	<?php if( $display_contact ) : ?>	

		<h1><?php echo 'Contact'; ?></h1>

	    <div>                                               
	        
	        <div>

	            <!-- Email -->

	            <h3>
	                <?php echo 'Email'; ?>
	                <br />
	                <small>
	                    <?php
	                        $total_emails = sizeof($gravapress_profile->{'entry'}[0]->{'emails'});

	                        for( $i = 0; $i <= $total_emails; $i++) {
	                            if( $gravapress_profile->{'entry'}[0]->{'emails'}[$i]->{'primary'} == 'true' ) {
	                                echo $gravapress_profile->{'entry'}[0]->{'emails'}[$i]->{'value'};
	                            }
	                        }
	                    ?>
	                </small>
	            </h3>

	            <hr />

	            <!-- IMS -->

	            <?php if( $gravapress_profile->{'entry'}[0]->{'ims'}) :

	                $total_ims = sizeof($gravapress_profile->{'entry'}[0]->{'ims'});
	                for( $i = 0; $i < $total_ims; $i++ ) :

	            ?>

	            <h3>
	                <?php esc_attr_e( ucfirst($gravapress_profile->{'entry'}[0]->{'ims'}[$i]->{'type'}), 'wp_admin_style' ); ?>
	                <br />
	                <small>
	                    <?php esc_attr_e( $gravapress_profile->{'entry'}[0]->{'ims'}[$i]->{'value'} ); ?>
	                </small>
	            </h3>
	            
	            <hr /> 

	            <?php 
	                endfor;
	                endif; 
	            ?>      

	            <!-- Phones -->                                                                                                                                         

	             <?php if( $gravapress_profile->{'entry'}[0]->{'phoneNumbers'}) :

	                $total_ims = sizeof($gravapress_profile->{'entry'}[0]->{'phoneNumbers'});
	                for( $i = 0; $i < $total_ims; $i++ ) :

	            ?>

	            <h3>
	                <?php esc_attr_e( ucfirst($gravapress_profile->{'entry'}[0]->{'phoneNumbers'}[$i]->{'type'}) . ' Phone', 'wp_admin_style' ); ?>
	                <br />
	                <small>
	                    <?php esc_attr_e( $gravapress_profile->{'entry'}[0]->{'phoneNumbers'}[$i]->{'value'} ); ?>
	                </small>
	            </h3>  

	            <?php 

	                $last_key = end(array_keys($gravapress_profile->{'entry'}[0]->{'phoneNumbers'}));
	                if( $i != $last_key ) :                                                
	            ?>

	            <hr />

	            <?php
	                endif;
	                endfor;
	                endif; 
	            ?>                            

	        </div>
	    </div>
	
	<?php endif;?>

<?php
	echo $after_widget;
?>