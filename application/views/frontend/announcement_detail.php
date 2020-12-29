<?php
if($record)
{
    $record=$record[0];
    $news_title='title_'.shortlang();                                
    $news_content='description_'.shortlang();
    $image='';        
    $image=base_url('uploads/img/announcement/'.$record->photo);        
    
?>
    <h3><?=$record->$news_title?></h3>
    <div class="content-page">
  
       <p><img src="<?=$image?>" alt="About us" class="img-responsive post-box-image candidate-box" onClick="view(this);" onerror='epic(this)'></p> 
      <p>
     
      <p style="font-size: 18px;">
      <?=lang('date').':  '.datecheck($record->date,false)?>
      <br>
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