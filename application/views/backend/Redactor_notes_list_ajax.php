<?php
  if($record)
  {
      $name='name_'.shortlang();
    
?>
<div class="row">
    <div class="col-sm-12">
        <div class="company-item table-responsive table-full-width ulist">
            <table class="table table-hover table-striped">
                <thead>       
                    <th>#</th>                  
                    <th><?=lang('title')?></th>     
                    <th><?=lang('edit')?></th> 
                </thead>
                <tbody>
                    <?php
                    $counter = $start;
                    foreach($record AS $rec)
                    {               
                          $title='title_'.shortlang();   
                    ?>
                    <tr>
                        <td><?=++$counter?></td>
                        <td><?=$rec->$title?></td>  
                        <td><a href="<?=site_url('backend/updateRedactorNote/'.$rec->id)?>"><?=lang('edit')?></a></td> 
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
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