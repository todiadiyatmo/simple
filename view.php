<?php

require_once("../../config.php");

$id = optional_param('id',0,PARAM_INT);    // Course Module ID, or
$l = optional_param('l',0,PARAM_INT);     // simple ID

if ($id) {
    $PAGE->set_url('/mod/simple/index.php', array('id'=>$id));
    if (! $cm = get_coursemodule_from_id('simple', $id)) {
        print_error('invalidcoursemodule');
    }

    if (! $course = $DB->get_record("course", array("id"=>$cm->course))) {
        print_error('coursemisconf');
    }

    if (! $simple = $DB->get_record("simple", array("id"=>$cm->instance))) {
        print_error('invalidcoursemodule');
    }

} else {
    $PAGE->set_url('/mod/simple/index.php', array('l'=>$l));
    if (! $simple = $DB->get_record("simple", array("id"=>$l))) {
        print_error('invalidcoursemodule');
    }
    if (! $course = $DB->get_record("course", array("id"=>$simple->course)) ){
        print_error('coursemisconf');
    }
    if (! $cm = get_coursemodule_from_instance("simple", $simple->id, $course->id)) {
        print_error('invalidcoursemodule');
    }
}

require_login($course, true, $cm);

redirect("$CFG->wwwroot/course/view.php?id=$course->id");

