<?php

/*
 Sample view.php file from Intro to developers course
*/ 

require('../../config.php');
require_once('../../lib/moodlelib.php');
 
// Fetch the block id - set the page before require login
$blockid = required_param('blockid', PARAM_INT); 
$size = optional_param('size', 'none', PARAM_TEXT);
$PAGE->set_url('/blocks/cart/view.php', array('blockid'=>$blockid));

require_login();
 
//get our config
$def_config = get_config('block_cart');

// Set user context - ? permissions thing
$usercontext = context_user::instance($USER->id);
$PAGE->set_course($COURSE);

$PAGE->set_heading($SITE->fullname);
$PAGE->set_pagelayout('standard'); 
$PAGE->set_title(get_string('pluginname', 'block_cart'));
$PAGE->navbar->add(get_string('pluginname', 'block_cart'));
 
$renderer = $PAGE->get_renderer('block_cart'); 
$renderer->display_view_page($blockid);
 
return;