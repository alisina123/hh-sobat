 <?=$this->session->flashdata('msg');?>
<center><h3><?=lang('gallary')?></h3></center>
<h5><?=lang('multiple_upload')?></h5>
 <!-- BEGIN FORM-->
 <form method="POST" action="<?=site_url('backend/insertToGallary')?>" enctype="multipart/form-data" onsubmit="javascript: void(0);loadAjax();">
    <div id="more_photo">
        <div class="form-group">
          <label for="photo"><?=lang('photo')?></label>
          <br>
          <span style="color: red"><?=lang('gallary_note')?></span>
          <input type="file" class="form-control"  name="photo[]" id="photo" required placeholder="<?=lang('photo')?>">
          <?=form_error('photo');?>
        </div>

       
        <div style="margin-top: 3px;"><input type="button" class="btn btn-success" onclick="addMore(this)" value="<?=lang('add_more')?>+"/></div> 
    </div>  
  
    <div class="padding-top-20">                  
      <button type="submit" class="btn btn-fill btn-info"><?=lang('save')?></button>
    </div>
  </form>
  <!-- END FORM--> 
 <script type="text/javascript">

  function addMore(el){

    temp = $(el).parent().parent().html();
    //console.log(temp)
    $('#more_photo').append('<div>'+temp+'</div>'); 
    $(el).parent().remove();   
 }
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