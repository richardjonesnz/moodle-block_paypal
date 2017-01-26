<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will   be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * This is a one page wonder table manager
 *
 * @package    block_cart
 * @copyright  2015 Flash Gordon http://www.flashgordon.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// defined('MOODLE_INTERNAL') || die();

require('../../config.php');
require_once('../../lib/moodlelib.php');

// Fetch the block id - set the page before require login
$blockid = required_param('blockid', PARAM_INT); 
$size = optional_param('size', 'none', PARAM_TEXT);
$PAGE->set_url('/blocks/cart/item_manager.php', array('blockid'=>$blockid));

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
$renderer->display_items_table($blockid);
 
return;