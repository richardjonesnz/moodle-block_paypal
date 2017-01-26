<?php

class block_cart_edit_form extends block_edit_form {

    protected function specific_definition($mform) {
    
      // Section header title according to language file.
      $mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));
  
      // A Paypal business email will be needed, could be already in enrolment plugin
        
      $default_email = 'attempt to get from plugin';  
      $mform->addElement('text', 'config_email', get_string('email', 'block_cart'));
      $mform->setDefault('config_email', $default_email);
      $mform->setType('config_email', PARAM_MULTILANG); 
   }
}
