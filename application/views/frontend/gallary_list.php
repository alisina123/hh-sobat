 <?=$this->session->flashdata('msg');?>                              

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

