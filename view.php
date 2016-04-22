<?php

/*
 Sample view.php file from Intro to developers course
 
*/ 

require('../../config.php');
require_once('../../lib/moodlelib.php');
 
require_login();
 
//get our config
$def_config = get_config('block_superiframe');
$url = $def_config->url;
$width = $def_config->width;
$height = $def_config->height;
$layout = $def_config->pagelayout;
 
$usercontext = context_user::instance($USER->id);
$PAGE->set_course($COURSE);
$PAGE->set_url('/blocks/superiframe/view.php');
$PAGE->set_heading($SITE->fullname);
$PAGE->set_pagelayout($layout);
$PAGE->set_title(get_string('pluginname', 'block_superiframe'));
$PAGE->navbar->add(get_string('pluginname', 'block_superiframe'));
 
 
// start output to browser
echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('pluginname', 'block_superiframe'),5);
 
// Our iFrame content
echo '<br />' . fullname($USER);
echo '<br />' . $OUTPUT->user_picture($USER);
echo "<iframe src='$url' height='$height' width='width' style='border:0'></iframe>";    
 
//send footer out to browser
echo $OUTPUT->footer();
return;