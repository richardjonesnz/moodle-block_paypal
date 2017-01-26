<?php

class block_cart_renderer extends plugin_renderer_base {
	
  //Here we return all the content that the goes in the block
  function fetch_block_content($blockid){
    global $CFG, $USER;
    
    $content = '';  // local variable to build return value
    $content .= '<br />' . get_string('welcome_user', 'block_cart', $USER) . '<br />';
    
    // Link to the iFrame - add block id as a parameter
    $link = new moodle_url('/blocks/cart/view.php',array('blockid'=>$blockid));
    // $content .= html_writer::link($link, get_string('gotocart', 'block_cart'));
    $content .=  $this->output->action_link($link, 
			        get_string('gotocart','block_cart'), 
			        new popup_action('click', $link)); 
    $content .= '<br />';
    $link = new moodle_url('/blocks/cart/item_manager.php',array('blockid'=>$blockid));
    $content .=  $this->output->action_link($link, 
			        get_string('gotoitem_manager','block_cart'), 
			        new popup_action('click', $link)); 
    return $content;
  }

  // Here we aggregate all the pieces of content of the view page and displays them
  // The passed in parameters originate in the admin config settings for the block  
    function display_view_page($blockid){
    global $USER, $DB;
    
    // start output to browser
    echo $this->output->header();
    $configdata = $DB->get_field('block_instances', 'configdata', array('id'=>$blockid));

    if($configdata) {
      $config = unserialize(base64_decode($configdata));
      $email = $config->email;
    }
    else {
      $email = get_string('noemail', 'block_cart');
    } 
        
    // Placeholder for items editor
    echo html_writer::start_div('block_cart_heading');
    echo $this->output->heading(get_string('cart_name', 'block_cart'),5);
    echo html_writer::nonempty_tag('p', get_string('cart_description', 'block_cart'));    
    echo html_writer::end_div();
        
    // read records from file
    $tablename = "block_cart_items";
    $data = $DB->get_records($tablename, array(), null, 'id, code, title, image, description, price'); 
   
    //if we do not have any data, lets just return a string to that effect
    if(!$data || empty($data)){
        echo 'No records found';
    } 

    // make sure that we are an array
    if(!is_array($data)){
        $data = array($data);
    }

    // Place all items inside a Bootstrap grid
    echo html_writer::start_div('container');        
    echo html_writer::start_div('row');
    echo html_writer::start_div('col-md-4');   

    // Get the items available and display them
    foreach($data as $item) {
        // Build an html item block div
        echo html_writer::start_div('block_cart_item'); 
        $oneitem = '<ul>';
        $oneitem .= '<li>' . $item->title . '</li>';
        $oneitem .= '<li>' . $item->description . '</li>';
        $oneitem .= '<li>NZD ' . $item->price . '</li>';
        $oneitem .= '</ul>';
        echo $oneitem;
        echo html_writer::end_div();
        // an add button for each item
        // $mform = new \block_cart\forms\item_list_form_button();
          // add the item to the current cart table
          // if ($mform->get_data()) {
            // Add this item to the current cart
		    // $DB->update_record($block_cart_current,$item->id, $USER->id);		    
         // }
            $button_form = new \block_cart\forms\item_list_form_button();
            $button_form->display();
    }
    echo html_writer::end_div(); 
    echo html_writer::end_div(); 
    echo html_writer::end_div(); 
    //send footer to browser
    echo $this->output->footer();
  }

    // This function display data from the table for editing
    function display_items_table($blockid) {
    
    global $DB;

    // start output to browser
    echo $this->output->header();
    echo 'here';
    
    echo html_writer::start_div('block_cart_sizes');
    echo $this->output->heading(get_string('pluginname', 'block_cart'),5);
    echo html_writer::nonempty_tag('p', get_string('sale_items', 'block_cart'));    
    echo html_writer::end_div();
    
   
    // read records from file
    $tablename = "block_cart_items";
        $data = $DB->get_records($tablename, array(), null, 'id, code, title, image, description, price'); 

        //if we do not have any data, lets just return a string to that effect
        if(!$data || empty($data)){
        echo 'No records found';
    } 

    // make sure that we are an array
    if(!is_array($data)){
        $data = array($data);
    }
    $head=false;
    $table = new html_table();
    foreach($data as $onedata){
        $onearray = get_object_vars($onedata);
        //build the head row
        if(!$head){
        $head=true;
        $table->head= array_keys($onearray);
        $table->head[] = get_string('edit');
        $table->head[] = get_string('delete');
    }
    //build all the other rows
    $rowdata=array_values($onearray);

    $editlink = html_writer::link(
    new moodle_url('/blocks/cart/view.php', 
    array('id'=>$onearray['id'],'action' => 'edit')),get_string('edit'));
    $rowdata[] = $editlink; 

    $deletelink = html_writer::link(
        new moodle_url('/blocks/cart/view.php', 
        array('id'=>$onearray['id'],'action' => 'delete')),get_string('delete'));
        $rowdata[] = $deletelink;
        $table->data[]=$rowdata; 
    }
    echo html_writer::table($table);

    //send footer to browser
    echo $this->output->footer();
    }
}