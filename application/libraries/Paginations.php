<?php

/*
* Custom Ajax Pagination for codeigniter search
* and other details
* author: Muhammad issa zafari
* Date: 30 july 2013
*/

  class Paginations
  {
    public $total;
    public $anchors;

    function __construct()
    {
      ///constructior
    }
    function __destruct()
    {
      ////destructior
    }

    function make($numrows,$starting,$recpage,$lang,$page_p,$div_p,$str_post)
    {
            $str_post   .='&ajax=1' ;
            $first_lb   = $lang['first'];
            $last_lb    = $lang['last'];
            $previous_lb = $lang['previous'];
            $next_lb    = $lang['next'];
            $page_lb    = $lang['page'];
            $of_lb      = $lang['of'];
            $total_lb   = $lang['total'];

            //ajax pagination preparation
            $next           =    $starting+$recpage;
            $var            =    ((intval($numrows/$recpage))-1)*$recpage;
            $page_showing   =    intval($starting/$recpage)+1;
            $total_page     =    ceil($numrows/$recpage);

            if($numrows % $recpage != 0){
                $last = ((intval($numrows/$recpage)))*$recpage;
            }else{
                $last = ((intval($numrows/$recpage))-1)*$recpage;
            }

            /*ajax funcition js parrams
            * url,divname,starting,string post
            */
            //calculate previous link
            $previous = $starting-$recpage;
            $anc = "<ul id='pagination-flickr'>";
            if($previous < 0){
                $anc .= "<li class='previous-off'>".$first_lb."</li>";
                $anc .= "<li class='previous-off'>".$previous_lb."</li>";
            }else{
                $anc .= "<li class='next'><a href='javascript:void(0)' onclick=\"javascript:paginate('$page_p','$div_p','0','$str_post');\">".$first_lb." </a></li>";
                $anc .= "<li class='next'><a href='javascript:void(0)' onclick=\"javascript:paginate('$page_p','$div_p','$previous','$str_post');\">".$previous_lb." </a></li>";
            }

            ################If you dont want the numbers just comment this block###############
            $norepeat = 4;//no of pages showing in the left and right side of the current page in the anchors
            $j = 1;
            $anch = "";
            for($i=$page_showing; $i>1; $i--){
                $fpreviousPage = $i-1;
                $page = ceil($fpreviousPage*$recpage)-$recpage;
                $anch = "<li><a href='javascript:void(0)' onclick=\"javascript:paginate('$page_p','$div_p','$page','$str_post');\" >$fpreviousPage </a></li>".$anch;
                if($j == $norepeat) break;
                $j++;
            }
            $anc .= $anch;
            $anc .= "<li class='active'>".$page_showing."</li>";
            $j = 1;
            for($i=$page_showing; $i<$total_page; $i++){
                $fnextPage = $i+1;
                $page = ceil($fnextPage*$recpage)-$recpage;
                $anc .= "<li><a href='javascript:void(0)' onclick=\"javascript:paginate('$page_p','$div_p','$page','$str_post');\" >$fnextPage</a></li>";
                if($j==$norepeat) break;
                $j++;
            }
            ############################################################
            if($next >= $numrows){
                $anc .= "<li class='previous-off'>".$next_lb."</li>";
                $anc .= "<li class='previous-off'>".$last_lb."</li>";
            }else{
                $anc .= "<li class='next'><a onclick=\"javascript:paginate('$page_p','$div_p','$next','$str_post');\" href='javascript:void(0)'>".$next_lb." </a></li>";
                $anc .= "<li class='next'><a href='javascript:void(0)' onclick=\"javascript:paginate('$page_p','$div_p','$last','$str_post');\">".$last_lb."</a></li>";
            }
                $anc .= "</ul>";

            //assaign anchors to the public accessable variable
            $this->anchors = $anc;
            //assaign total record details
            $this->total = "".$page_lb." : $page_showing <i> ".$of_lb."  </i> $total_page . ".$total_lb.": $numrows";
            return '<ul class="pagination"><li>'.$this->total.'</li><li style="padding:0"><div>'.$this->anchors.'</div></li></ul>';
      }

    function make_search($numrows,$starting,$recpage,$lang,$page_p,$div_p,$str_post)
    {
            $str_post   .='&ajax=1';
            $first_lb   = $lang['first'];
            $last_lb    = $lang['last'];
            $previous_lb = $lang['previous'];
            $next_lb    = $lang['next'];
            $page_lb    = $lang['page'];
            $of_lb      = $lang['of'];
            $total_lb   = $lang['total'];

            //ajax pagination preparation
            $next           =    $starting+$recpage;
            $var            =    ((intval($numrows/$recpage))-1)*$recpage;
            $page_showing   =    intval($starting/$recpage)+1;
            $total_page     =    ceil($numrows/$recpage);

            if($numrows % $recpage != 0){
                $last = ((intval($numrows/$recpage)))*$recpage;
            }else{
                $last = ((intval($numrows/$recpage))-1)*$recpage;
            }

            /*ajax funcition js parrams
            * url,divname,starting,string post
            */
            //calculate previous link
            $previous = $starting-$recpage;
            $anc = "<ul id='pagination-flickr'>";
            if($previous < 0){
                $anc .= "<li class='previous-off'>".$first_lb."</li>";
                $anc .= "<li class='previous-off'>".$previous_lb."</li>";
            }else{
                $anc .= "<li class='next'><a href='javascript:void(0)' onclick=\"javascript:makeResult('0','$str_post');\">".$first_lb." </a></li>";
                $anc .= "<li class='next'><a href='javascript:void(0)' onclick=\"javascript:makeResult('$previous','$str_post');\">".$previous_lb." </a></li>";
            }

            ################If you dont want the numbers just comment this block###############
            $norepeat = 4;//no of pages showing in the left and right side of the current page in the anchors
            $j = 1;
            $anch = "";
            for($i=$page_showing; $i>1; $i--){
                $fpreviousPage = $i-1;
                $page = ceil($fpreviousPage*$recpage)-$recpage;
                $anch = "<li><a href='javascript:void(0)' onclick=\"javascript:makeResult('$page','$str_post');\" >$fpreviousPage </a></li>".$anch;
                if($j == $norepeat) break;
                $j++;
            }
            $anc .= $anch;
            $anc .= "<li class='active'>".$page_showing."</li>";
            $j = 1;
            for($i=$page_showing; $i<$total_page; $i++){
                $fnextPage = $i+1;
                $page = ceil($fnextPage*$recpage)-$recpage;
                $anc .= "<li><a href='javascript:void(0)' onclick=\"javascript:makeResult('$page','$str_post');\" >$fnextPage</a></li>";
                if($j==$norepeat) break;
                $j++;
            }
            ############################################################
            if($next >= $numrows){
                $anc .= "<li class='previous-off'>".$next_lb."</li>";
                $anc .= "<li class='previous-off'>".$last_lb."</li>";
            }else{
                $anc .= "<li class='next'><a onclick=\"javascript:makeResult('$next','$str_post');\" href='javascript:void(0)'>".$next_lb." </a></li>";
                $anc .= "<li class='next'><a href='javascript:void(0)' onclick=\"javascript:makeResult('$last','$str_post');\">".$last_lb."</a></li>";
            }
                $anc .= "</ul>";

            //assaign anchors to the public accessable variable
            $this->anchors = $anc;
            //assaign total record details
            $this->total = "".$page_lb." : $page_showing <i> ".$of_lb."  </i> $total_page . ".$total_lb.": $numrows";
            return '<ul class="pagination"><li>'.$this->total.'</li><li style="padding:0"><div>'.$this->anchors.'</div></li></ul>';
      }
  
  }
?>