<p>
  <label>Title</label> 
  <input class="widefat" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
  <label>Display Social?</label> 
  <input type="checkbox" name="<?php echo $this->get_field_name('display_social'); ?>" value="1" <?php checked( $display_social, 1 ); ?> />
</p>

<p>
  <label>Display Contacts?</label> 
  <input type="checkbox" name="<?php echo $this->get_field_name('display_contact'); ?>" value="1" <?php checked( $display_contact, 1 ); ?> />
</p>