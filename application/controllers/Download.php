<?php
class Download extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->lang->load('global',shortlang());
    }
    function index($path='') {
        if($path != '')
        {
            if($path == NULL)  
                return null;
            $file = "./uploads/book/".$path;
            //ex(file_exists($file));
            if(!file_exists($file)){ die("I'm sorry,It seem that file does not exist.");}

            $type = filetype($file);
            header("Content-type: $type");
            header("Content-Disposition: attachment;filename=".$file);
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: ".filesize($file));
            header('Pragma: no-cache');
            header('Expires: 0');
            // Send the file contents.
            //set_time_limit(0);
            readfile($file);
        }
        else
        {
             echo '<div class="alert alert-danger fade in">'.lang("no_record_found_msg").'</div><a href="javascript: void(0)" onclick="window.history.back()">'.lang('back').'</a>';
        }
    }
    function news($path='') {
        if($path != '')
        {
            if($path == NULL)  
                return null;
            $file = "./uploads/download/".$path;
            //ex(file_exists($file));
            if(!file_exists($file)){ die("I'm sorry,It seem that file does not exist.");}

            $type = filetype($file);
            header("Content-type: $type");
            header("Content-Disposition: attachment;filename=".$file);
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: ".filesize($file));
            header('Pragma: no-cache');
            header('Expires: 0');
            // Send the file contents.
            //set_time_limit(0);
            readfile($file);
        }
        else
        {
             echo '<div class="alert alert-danger fade in">'.lang("no_record_found_msg").'</div><a href="javascript: void(0)" onclick="window.history.back()">'.lang('back').'</a>';
        }
    }
}
