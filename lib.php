<?php
//to override in the lib.php
defined('MOODLE_INTERNAL') || die;

/** simple_MAX_NAME_LENGTH = 50 */
define("SIMPLE_MAX_NAME_LENGTH", 50);

function get_simple_name($simple) {
    $name = strip_tags(format_string($simple->intro,true));
    if (core_text::strlen($name) > SIMPLE_MAX_NAME_LENGTH) {
        $name = core_text::substr($name, 0, SIMPLE_MAX_NAME_LENGTH)."...";
    }

    if (empty($name)) {
        // arbitrary name
        $name = get_string('modulename','simple');
    }

    return $name;
}

function simple_add_instance($simple) {
    global $DB;

    $simple->name = get_simple_name($simple);
    $simple->timemodified = time();

    return $DB->insert_record("simple", $simple);
}

function simple_update_instance($simple) {
    global $DB;

    $simple->name = get_simple_name($simple);
    $simple->timemodified = time();
    $simple->id = $simple->instance;

    return $DB->update_record("simple", $simple);
}

function simple_delete_instance($id) {
    global $DB;

    if (! $simple = $DB->get_record("simple", array("id"=>$id))) {
        return false;
    }

    $result = true;

    if (! $DB->delete_records("simple", array("id"=>$simple->id))) {
        $result = false;
    }

    return $result;
}