<?php
if($record)
{     
    $record=$record[0];
    $title='title_'.shortlang();                                
    $content='content_'.shortlang();
    $image='';        
    $image=base_url('uploads/img/redactornote/'.$record->photo);       
    
?>
    <h3><?=$record->$title?></h3>
    <div class="content-page">
   
       <p><img src="<?=$image?>" alt="About us" class="img-responsive post-box-image candidate-box" onClick="view(this);" onerror='epic(this)'></p> 
      <p>
                                                                      
                   
      <p style="font-size: 18px;">
      <?=$record->$content?>
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