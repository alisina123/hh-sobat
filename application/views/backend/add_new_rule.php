 <?=$this->session->flashdata('msg');?>
<center><h3><?=lang('add_new_rule')?></h3></center>
     <!-- BEGIN FORM-->
     <form method="POST" action="<?=site_url('backend/addNewRule')?>" enctype="multipart/form-data" onsubmit="javascript: void(0);loadAjax();">
        <div id="rule">
             <div class="form-group">
                  <label for="title"><?=lang('title')?></label>
                  <input type="text" class="form-control"  name="title[]" id="title" required placeholder="<?=lang('title')?>">
                  <?=form_error('title');?>
            </div>   
             <div class="form-group">
              <label for="content"><?=lang('content')?></label>
              <textarea class="ckeditor form-control" rows="8" name="content[]" id="editor1" required style="max-width: 100%;"></textarea>
              <?=form_error('content');?>
            </div>
             
            <div style="margin-top: 3px;"><input type="button" class="btn btn-success" onclick="addMore(this)" value="<?=lang('add_more')?>+"/></div> 
        </div>
        <br>
        
        <div class="padding-top-20">                  
          <button type="submit" class="btn btn-fill btn-info"><?=lang('save')?></button>
        </div>
        
      </form>
      <!-- END FORM--> 
<script type="text/javascript">

  function addMore(el){

    temp = $(el).parent().parent().html();
    //console.log(temp)
    $('#rule').append('<br><div>'+temp+'</div>'); 
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