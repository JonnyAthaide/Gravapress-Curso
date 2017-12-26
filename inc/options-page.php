<h2><?php esc_attr_e( 'Gravapress - Gravatar Wordpress Profile Integration', 'WpAdminStyle' ); ?></h2>

<div class="wrap">

	<div id="icon-options-general" class="icon32"></div>
	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables ui-sortable">

					<?php if( !isset($gravapress_email) || $gravapress_email == '') : ?>
					<!-- postbox LOGIN -->
					<div class="postbox">

						<div class="handlediv" title="Click to toggle"><br></div>
						<!-- Toggle -->

						<h2 class="hndle"><span><?php esc_attr_e( 'Insert your Gravatar e-mail', 'WpAdminStyle' ); ?></span>
						</h2>

						<div class="inside">
                            <form name="email_form" method="post" action="">
								<input type="hidden" name="email_submitted" value="Y">
                                <table class="form-table">                                
                                    <tr>
                                        <td><input type="text" name="gravatar_email" id="gravatar_email" class="regular-text" placeholder="Gravatar e-mail" /></td>
                                        <td><input class="button-primary" type="submit" id="gravatar_email_submit" name="gravatar_submit" value="<?php esc_attr_e( 'Login' ); ?>" /></td>
                                </table>
                            </form>
						</div>
						<!-- .inside -->

					</div>
					<!-- postbox LOGIN -->

					<?php else : ?>
                    <!-- .postbox PROFILE -->
                    <div class="postbox">

						<div class="handlediv" title="Click to toggle"><br></div>
						<!-- Toggle -->

						<h2 class="hndle">
						<span><?php esc_attr_e( 'Gravatar Profile Preview', 'WpAdminStyle' ); ?></span>
						</h2>

						<div class="inside">
							<p>Bellow is a complete preview of your Gravatar Profile</p>

							<div class="wrap">
								<h1><?php esc_attr_e( 'Heading', 'WpAdminStyle' ); ?></h1>
								<div id="col-container">

									<div id="col-right">

										<div class="col-wrap">
											<?php require('col-right.php'); ?>
										</div>
										<!-- /col-wrap -->

									</div>
									<!-- /col-right -->

									<!-- Left Col -->
									<div id="col-left">

										<div class="col-wrap">
											<?php require('col-left.php'); ?>
										</div>
										<!-- /col-wrap -->

									</div>
									<!-- /col-left -->

									<p style="clear:both;"></p>

								</div>
								<!-- /col-container -->

							</div> <!-- .wrap -->
                            
						</div>
						<!-- .inside -->

					</div>
					<!-- .postbox -->


					<!-- postbox JSON -->

					<?php if ($display_json == true): ?>

					<div class="postbox">

						<h2 class="hndle">
							<span><?php esc_attr_e( 'JSON Gravatar Profile', 'WpAdminStyle' ); ?></span>
						</h2>						

						<div class="inside">
                            <pre>
								<code>
									<?php var_dump($gravapress_profile);?>
								</code>
							</pre>
						</div>
						<?php endif; ?>
						<!-- .inside -->

					</div>
					<!-- postbox JSON -->

					<?php endif;?>

				</div>
				<!-- .meta-box-sortables .ui-sortable -->

			</div>
			<!-- post-body-content -->

			<!-- SIDEBAR -->
			<div id="postbox-container-1" class="postbox-container">

				<div class="meta-box-sortables">

				<?php if( isset($gravapress_email) && $gravapress_email != '') : ?>
					<div class="postbox">

						<div class="handlediv" title="Click to toggle"><br></div>
						<!-- Toggle -->

						<h2 class="hndle"><span><?php esc_attr_e(
									'Gravatar Account', 'WpAdminStyle'
								); ?></span></h2>

						<div class="inside">
							<form name="email_form" method="post" action="">
								<table class="form-table">
								<input type="hidden" name="email_submitted" value="Y">                         
									<tr>
										<td>
											<label for="gravatar_email"> E-mail
												<input type="text" name="gravatar_email" id="gravatar_email" value="<?php echo $gravapress_email;?>" placeholder="Gravatar e-mail" />
											</label>
										</td>
									</tr>
									<tr>
										<td><input class="button-primary" type="submit" id="gravatar_submit" name="gravatar_submit" value="<?php esc_attr_e( 'Update' ); ?>" /></td>
									</tr>
								</table>
							</form>
						</div>
						<!-- .inside -->

					</div>
					<!-- .postbox -->

							<?php endif;?>

				</div>
				<!-- .meta-box-sortables -->

			</div>
			<!-- #postbox-container-1 .postbox-container -->

		</div>
		<!-- #post-body .metabox-holder .columns-2 -->

		<br class="clear">
	</div>
	<!-- #poststuff -->

</div> <!-- .wrap -->