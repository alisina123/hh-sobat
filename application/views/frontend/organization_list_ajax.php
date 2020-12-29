<?php
  if($record)
  {
      $name='name_'.shortlang();
      $address='address_'.shortlang();
      //$description='description_'.shortlang();
    
?>
<div class="row">
    <div class="col-sm-12">
        <div class="company-item table-responsive table-full-width ulist">
           
                    <?php
                    $counter = $start;
                    foreach($record AS $rec)
                    {
                          $image='';    
                          $image=base_url('uploads/img/organization/'.$rec->photo); 
                          
                    ?>
                        <div class="positions-list-item">
                         <h2>
                           <b> <?=++$counter.': '?></b><a href="<?=site_url('main/getOrganizationById/'.$rec->id)?>"><?=substr($rec->$name,0,60)?></a>
                        </h2>
                        <img src="<?=$image?>" alt="" width="15%" onClick="view(this);" onerror='epic(this)'><?=' '.lang('address').': '.$rec->$address?>
                        <br>
                        <?=lang('facebook_link').': '?><a href="https://www.facebook.com/<?=$rec->facebook_link?>" target="_blank"><?=$rec->facebook_link?></a>


                        </div>
                    <?php
                    }
                    ?>
            
            <div  class="col-md-12 col-sm-12 col-xs-12 pgn"><?=@$pagination?></div>
        </div>
    </div>
</div>
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