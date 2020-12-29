<?php
if($record)
{
    $record=$record[0];
    $news_title='title_'.shortlang();                                
    $news_content='content_'.shortlang();
    $image='';        
    $video='';        
    $image=base_url('uploads/img/news/'.$record->photo);
    $video=base_url('uploads/img/news/video/'.$record->video);
    
?>
    <h3><a href="#"><?=$record->$news_title?></a></h3>
    <div class="content-page">
     <?php
         if($record->video  && $record->video !='' && $record->video !=0)
         {
     ?>
       <p>
      <video controls style="width: 100%"><source src="<?=$video?>" "type=\'video/wave; codecs="avc1.42E01E, mp4a.40.2"\'" /></video>
      </p> 
     <?php
        }
        else
        {
      ?>
       <p><img src="<?=$image?>" alt="About us" class="img-responsive post-box-image candidate-box" onClick="view(this);" onerror='epic(this)'></p> 
      <p>
      <?php
        }
       ?>                                              
      <h4><a href="#"><?=lang('views').': '.$record->views?></a></h4>
                   
      <p style="font-size: 18px;">
      <?=$record->$news_content?>
      </p>
    </div>            
<?php
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