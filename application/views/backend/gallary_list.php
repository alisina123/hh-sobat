 <?=$this->session->flashdata('msg');?>                                     
<div class="row">
  <a href="#" style="float: right;"  class="btn btn-fill btn-info" onclick="location.href='<?=site_url('backend/addToGallary')?>'"><?=lang('add_to_gallary')?></a>                            
</div>
<hr/>
<div class="nlist" id="searchResult">
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

