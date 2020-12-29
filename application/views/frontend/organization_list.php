 <?=$this->session->flashdata('msg');?>
<form action="#" id="SearchForm" method="post">
<div class="row">
    <?php
     if($record)
     {
    ?>
    <!-- Search -->
    <div class="col-sm-12">                  
        <div class="form-group input-group">
            <input type="text" name="search" id="search" class="form-control" value="<?=$keyword?>" placeholder="<?=lang('search')?>..">
            <div class="input-group-btn">
                <button class="btn btn-fill btn-info" onclick="makeSearch('<?=site_url("main/organizationList")?>','SearchForm','searchResult');" type="button"><i class="fa fa-search"></i><?=lang('search')?></button>
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

