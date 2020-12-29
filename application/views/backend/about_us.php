<?=$this->session->flashdata('msg')?>
<div class="header">
    <center><h4 class="title"><?=lang('about_us')?></h4></center>
</div>                                                                    
  <div class="row">
        <div class="col-sm-6" style="float: <?=shortlang()=='en'?'left':'right'?>;">  
                <div class="form-group">
                    <button  class="btn  btn-block btn-fill btn-info" onclick="location.href='<?=site_url('backend/aboutLeaders')?>'"><?=lang('about_leaders')?></button>
                </div><!-- /.form-group -->
                <div class="form-group">
                    <button  class="btn  btn-block btn-fill btn-info" onclick="location.href='<?=site_url('backend/RulesList')?>'"><?=lang('rules')?></button>
                </div><!-- /.form-group -->
                <div class="form-group">
                    <button  class="btn  btn-block btn-fill btn-info" onclick="location.href='<?=site_url('backend/presidenciesList')?>'"><?=lang('presidencies')?></button>
                </div><!-- /.form-group -->
                <div class="form-group">
                    <button  class="btn  btn-block btn-fill btn-info" onclick="location.href='<?=site_url('backend/presidenciesProList')?>'"><?=lang('presidencies_province')?></button>
                </div><!-- /.form-group -->
                <hr>
                     
        </div><!-- /.col-sm-4 -->
    </div><!-- /.row --> 
<script type="text/javascript">  
function loadAjax() {
    //document.getElementById('result').innerHTML = '';
    openModal();       
    var xhr = false;
    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    }
    else {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    if (xhr) {
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                closeModal();
                document.getElementById("result").innerHTML = xhr.responseText;
            }
        }
        //xhr.open("POST", "<?=base_url()?>", true); 
        xhr.send(null);
    }
}
</script>