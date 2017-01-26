<?php
class block_class_item_list_form_button extends moodleform {
    /**
     * Defines a form with just a button
     */
    public function definition() {
        $mform = $this->_form;
        $mform->addElement('button', 'addtocart', get_string("addtocart", "block_cart"));
    }
}