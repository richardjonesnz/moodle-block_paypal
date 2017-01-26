<?php
namespace block_cart\forms;
defined('MOODLE_INTERNAL') || die();
require_once($CFG->libdir . '/formslib.php');  

class item_list_form_button extends moodleform {
    /**
     * Defines a form with just a button
     */
    public function definition() {
        global $CFG;
        $mform = $this->_form;
        $mform->addElement('button', 'addtocart', get_string("addtocart", "block_cart"));
    }    
}