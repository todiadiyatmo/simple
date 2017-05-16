<?php
if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    
    ///  It must be included from a Moodle page
}
require_once($CFG->dirroot.'/course/moodleform_mod.php');
 
class mod_simple_mod_form extends moodleform_mod {

    function definition() {

        $mform = $this->_form;

        $mform->addElement('header', 'heading', get_string('userpreferences','simple'));
        $mform->addElement('text', 'text', get_string('content','simple'));
        $mform->setType('text', PARAM_TEXT);
        $this->standard_coursemodule_elements();
        $this->add_action_buttons(true, false, null);

    }

}

?>