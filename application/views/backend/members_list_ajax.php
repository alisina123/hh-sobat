<?php
  if($record)
  {
?>
<div class="row">
    <div class="col-sm-12">
        <div class="company-item table-responsive table-full-width ulist">
            <table class="table table-hover table-striped">
                <thead>       
                    <th>#</th> 
                    <th><?=lang('name')?></th> 
                    <th><?=lang('fname')?></th> 
                    <th><?=lang('gender')?></th> 
                    <th><?=lang('tazkira_number')?></th> 
                    <th><?=lang('introduced_by')?></th> 
                    <th><?=lang('reg_date')?></th> 
                    <th><?=lang('edit')?></th> 
                    <th><?=lang('print')?></th> 
                </thead>
                <tbody>
                    <?php
                    $counter = $start;
                    foreach($record AS $rec)
                    {
                    ?>
                    <tr>
                        <td><?=++$counter?></td>
                        <td><?=$rec->name?></td> 
                        <td><?=$rec->fname?></td> 
                        <td><?=lang($rec->gender)?></td>
                        <td><?=$rec->tazkira_number?></td> 
                        <td><?=$rec->r_name?></td> 
                        </td>     
                        <td>
                         <?php
                             $post_date='';
                             $date='';
                             if(shortlang()!='en')
                             {
                                $post_date = explode('-', date('Y-m-d',$rec->regDate));
                                $date_conv = $this->dateconverter->GregorianToJalali($post_date[0], $post_date[1], $post_date[2]);
                                $date= $date_conv[0] . '-' . $date_conv[1] . '-' . $date_conv[2];
                             }
                             else{
                                 $date = date('Y-m-d',$rec->regDate);
                             }
                        echo $date;
                        ?>
                        </td>
                        <td><a href="<?=site_url('backend/updateMember/'.$rec->m_id.'/'.$rec->id)?>"><?=lang('edit')?></a></td> 
                        <td><a href="<?=site_url('backend/printMember/'.$rec->m_id.'/'.$rec->id)?>"><?=lang('print')?></a></td> 
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
