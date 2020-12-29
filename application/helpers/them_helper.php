<?php
    /**
    * to put content in a frame
    * 
    * @param mixed $content
    */
    function frame($content = '',$backend=false)
    {
        $ci = & get_instance();
        $data['content'] = $content;
        if($backend)
        {
            $data['sidebar'] =  $ci->load->view('lib/sidebar_backend',true,true);
            $ci->load->view('lib/content_backend',$data);  
        }
        else
        {
          
            $data['left'] =  $ci->load->view('lib/left',true,true);
            $data['right'] =  $ci->load->view('lib/right',true,true);
            $ci->load->view('lib/content',$data);
        }
        
    }
    /**
    * to make a dropdown by query
    * 
    * @param mixed $query
    * @param mixed $id
    * @param mixed $value
    * @param mixed $onchange
    * @param mixed $is_langfile
    */
    function dropdown($query=null,$id=null,$value=null,$onchange=null,$is_langfile=false){
        if($query==null && $id==null)
        {
            return null;
        }else
        {
            $ci = & get_instance();
            $ci->load->library('util');
            $temp = '<select name="'.$id.'" id="'.$id.'" '.$onchange.'>';
            $temp .='<option value="">'.lang('all_'.$id).'</option>';
            if(!$is_langfile){
            
                $result = $ci->util->getRecordByQuery($query);
                if($result){
                    foreach($result AS $r){
                        if($value==$r->value){
                            $temp .= '<option value="'.$r->value.'" selected="selected">'.$r->name.'</option>';
                        }else{
                            $temp .= '<option value="'.$r->value.'">'.$r->name.'</option>';
                        }
                    }

                }
            }else{
                foreach($query AS $k=>$r){
                    if($value==$k){
                        $temp .= '<option value="'.$k.'" selected="selected">'.$r.'</option>';
                    }else{
                        $temp .= '<option value="'.$k.'">'.$r.'</option>';
                    }
                }
            }
            $temp .='</select>';
            return $temp;
        }
    }

?>
