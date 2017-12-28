<?php
	echo $before_widget;
	echo $before_title . $title . $after_title;
?>

<div class="about-st">

	<!-- About -->

	<div class="about-me-st">

		<h3><?php echo $gravapress_profile->{'entry'}[0]->{'displayName'};?> <br />
			<small><?php echo $gravapress_profile->{'entry'}[0]->{'currentLocation'};?></small>
		</h3>
		
		<p><?php echo $gravapress_profile->{'entry'}[0]->{'aboutMe'}; ?></p>

	</div> 

	<!-- Gallery -->

	<?php if( $display_gallery == 1 ) : ?>

	<div class="gallery-st">

		<h3>Galeria</h3>

		<table>		

			<tr>	

		    <?php
		        $total_photos = sizeof( $gravapress_profile->{'entry'}[0]->{'photos'} );
		        for( $i = 0; $i < $total_photos; $i++ ) : 
		    ?> 	 

				<td> 
				    <a href="<?php echo $gravapress_profile->{'entry'}[0]->{'photos'}[$i]->{'value'}; ?>" target="_blank">
				        <img class="gallery-st-img" src="<?php echo $gravapress_profile->{'entry'}[0]->{'photos'}[$i]->{'value'}; ?>" alt="Gravatar User Image Profile">
				    </a>        
	        	</td>

	   		<?php endfor; ?>

	        </tr>

	    </table>

	</div>

	<?php endif; ?>

	<!-- Sites -->

	<?php if( $display_sites == 1 ) : ?>

	<div class="sites-st">

		<h3>Sites</h3>

		<table>

			<tr>

				<?php
				    $total_urls = sizeof( $gravapress_profile->{'entry'}[0]->{'urls'} );                                                            
				    for( $i = 0; $i < $total_urls; $i++ ) : 
				?>

					<td>
						<a href="<?php echo $gravapress_profile->{'entry'}[0]->{'urls'}[$i]->{'value'}; ?>" target="_blank">
						    <img src="<?php echo $plugin_url . '/images/link.png'; ?>" width="100px" height="100px" >                                                                                                                
						    <div class="caption"><?php echo $gravapress_profile->{'entry'}[0]->{'urls'}[$i]->{'title'}; ?></div>
						</a>
					</td> 

			    <?php endfor; ?>

		    </tr>

	    </table>

	</div>

	<?php endif; ?>

	<!-- Social -->

	<?php if( $display_social == 1 ) : ?>

	<div class="social-st">

		<h3>Social</h3>

		<table>

			<tr>

	            <?php
	                $total_accounts = sizeof( $gravapress_profile->{'entry'}[0]->{'accounts'} );                                                    
	                for( $i = 0; $i < $total_accounts; $i++ ) :
	            ?>	
	            	<td>	                                                                   
	                    <a target="_blank" href="<?php echo $gravapress_profile->{'entry'}[0]->{'accounts'}[$i]->{'url'} ; ?>">
		                	<img width="30px" src="<?php echo $plugin_url . '/images/social/' . $gravapress_profile->{'entry'}[0]->{'accounts'}[$i]->{'shortname'} . '.png'; ?>">                         
	                    </a>
                    </td>	  

	            <?php   
	                                                       
	                endfor; 
	            ?> 

		    </tr>

	    </table>

	</div>

	<?php endif; ?>

	<!-- Contact -->

	<?php if( $display_contact == 1 ) : ?>

	<div class="contact-st">

		<h3>Contato</h3>

		<table>

			<tr>

				<!-- Email -->
	            
	            <p>Email : <?php echo $gravapress_profile->{'entry'}[0]->{'emails'}[0]->{'value'}; ?></p>

	            <!-- IMS -->

	            <?php if( $gravapress_profile->{'entry'}[0]->{'ims'}) :

	                $total_ims = sizeof($gravapress_profile->{'entry'}[0]->{'ims'});
	                for( $i = 0; $i < $total_ims; $i++ ) :

	            ?>

	            <p>
	                <?php echo ucfirst($gravapress_profile->{'entry'}[0]->{'ims'}[$i]->{'type'}) . ': '; ?>	             
	                <?php echo $gravapress_profile->{'entry'}[0]->{'ims'}[$i]->{'value'} ; ?>
	        
	            </p>	           

	            <?php 
	                endfor;
	                endif; 
	            ?>      

	            <!-- Phones -->                                                                                                                                         

	             <?php if( $gravapress_profile->{'entry'}[0]->{'phoneNumbers'}) :

	                $total_ims = sizeof($gravapress_profile->{'entry'}[0]->{'phoneNumbers'});
	                for( $i = 0; $i < $total_ims; $i++ ) :

	            ?>

	            <p>
	                <?php echo ucfirst($gravapress_profile->{'entry'}[0]->{'phoneNumbers'}[$i]->{'type'}) . ' Phone: '; ?>
	        		<?php echo $gravapress_profile->{'entry'}[0]->{'phoneNumbers'}[$i]->{'value'}; ?>	    
	            </p>  	    

	            <?php	                
	                endfor;
	                endif; 
	            ?>

		    </tr>

	    </table>

	</div>

	<?php endif; ?>		

</div>
                                                                                                    
<?php
	echo $after_widget;
?>