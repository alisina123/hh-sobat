<?php
  if($record)
  {
?>

    <div class="col-sm-12 ulist">
     
                    <?php
                    $counter = $start;
                    $title='title_'.shortlang();             
                    $content='content_'.shortlang();             
                    foreach($record AS $rec)
                    {    
                    ?>
                  
                         <div class="positions-list-item">
                            
                            <?=$rec->$content?>
                            </h2>
                          
                       </div><!-- /.position-list-item --> 
                   
                    <?php
                    }
                    ?>
            
            <div  class="col-md-12 col-sm-12 col-xs-12 pgn"><?=@$pagination?></div>
      
    </div>   
<?php
  }
  else
  {
      echo '<div  class="alert alert-danger fade in">'.lang('no_record_found').'</div>';
  }
 ?>
