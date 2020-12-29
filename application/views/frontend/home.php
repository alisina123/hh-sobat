<?php
if($record)
{           
?>

      
<div class="nlist" style="border-radius: 100px;margin-top:20px">
   <?php
        $counter =0;
        $news_title='title_'.shortlang();                                
        $news_content='content_'.shortlang();  
        foreach($record AS $rec)
        {
            $counter++;
            $image='';        
            $video='';        
            $image=base_url('uploads/img/news/'.$rec->photo);           
            $video=base_url('uploads/img/news/video/'.$rec->video); 
    ?>         
                
                <hr >  
               <?php
                    if($rec->video && $rec->video !='' && $rec->video!=null)
                   {  
               ?> 
               <div class="post-box-small post-box">
                   <div class="post-box-image col-sm-12" style="float: <?=shortlang()=='en'?'':'right'?>;">
                         <video controls style="width: 100%"><source src="<?=$video?>" "type=\'video/wave; codecs="avc1.42E01E, mp4a.40.2"\'" /></video>
                      
                </div><!-- /.post-box-image --> 
                <div class="post-box-content">
                    <h5><a href="<?=base_url('main/getNewsById/'.$rec->id)?>"><?=word_limiter($rec->$news_title,30)?></a></h5>

                    <p>
                        <?=word_limiter($rec->$news_content,100)?> <a href="<?=base_url('main/getNewsById/'.$rec->id)?>"><?=lang('read_more')?></a></p>
                </div><!-- /.post-box-content -->
                
            </div><!-- /.post-box -->      
               <?php
                    }
                    else
                    {
                ?>
                <div class="row" > 
                  <div class="post-box-image col-lg-3" style="float: <?=shortlang()=='en'?'':'right'?>;">
                    <a href="#">
                        <img src="<?=$image?>" style="height:100px;margin-top:20px" alt="" onClick="view(this);" onerror='epic(this)'>
                    </a>
                </div><!-- /.post-box-image --> 
                <div class="post-box-content col-lg-9">
                    <h5><a href="<?=base_url('main/getNewsById/'.$rec->id)?>"><?=substr($rec->$news_title,0,120)?></a></h5>

                    <p>
                        <?=substr($rec->$news_content,0,450)?> <a href="<?=base_url('main/getNewsById/'.$rec->id)?>"><?=lang('read_more')?></a></p>
                </div><!-- /.post-box-content --> 
                
            </div><!-- /.post-box -->      
                <?php
                    }
                 ?>
                                       
               
      <?php     
        }
      ?> 
</div>   
<hr>              
    <?php 
  }
  else
  {
      echo '<div  class="alert alert-danger fade in">'.lang('no_record_found').'</div>';
  }
 ?>
 <script>
//for not available image
   function epic(c) {
    c.onerror='';
    c.src='<?php echo base_url().'assets/img/not_available.jpg'?>';
};

   function view(img) {
      imgsrc = img.src.split("_")[0];
      viewwin = window.open(imgsrc,'#modal_image');    
   }
</script>