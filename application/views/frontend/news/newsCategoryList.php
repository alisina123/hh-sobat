<?=$this->session->flashdata('msg');?>
<form action="#" id="SearchForm" method="post">
<div class="row">
    <?php
     if($record)
     {
         $record=$record[0];

    ?>
    <!-- Search -->
    <div class="col-sm-6">                  
        <div class="form-group input-group">
            <input type="text" name="search" style="width:100%" id="search" class="form-control" value="<?=$keyword?>" placeholder="<?=lang('search')?>..">
            <div class="input-group-btn">
                <button class="btn btn-fill btn-info" onclick="makeSearch('<?=site_url("main/weeknewsList")?>','SearchForm','searchResult');" type="button"><i class="fa fa-search"></i><?=lang('search')?></button>
            </div> 
        </div> 
    </div>
     <?php
     }
     ?>                                       
            
                      
</div> 
</form>                               



<hr/>
<div class="ulist" id="searchResult">
<?=$list?>
</div>
<script>
    function makeSearch(url,formID,targetDiv)
    {   
        openModal();
        $.ajax({
            url     : url,
            type    : 'POST',
            dataType:'json',
            data    : $("#"+formID).serialize()+"&ajax=search",
            success : function(r){ 
                closeModal();
                $("#"+targetDiv).html(r.result);
            }
        });
    }
</script> 

