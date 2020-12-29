 <?=$this->session->flashdata('msg');?>
<?php
    if($record)
    {
          $record=$record[0]; 
          $image='';    
          $image=base_url('uploads/img/user/'.$record->photo);

?>

<div class="header">
    <center><h4 class="title"><?=lang('update_user')?></h4></center>
</div> 
<div class="row">
      <div class="col-sm-3 text-center"  style="float:<?=shortlang()=='en'?'left':'right'?>;">
            <div class="relative" id="photo">
                  <img src="<?=$image?>" onClick="view(this);" onerror='epic(this)'  class="img-responsive img-profile user-img">
                <div class="change-photo" style="border: 1px solid #ffddee; background-color:#0A81F7;" id="changee"><a href="javascript:void(0)" class="btn btn-custom btn-xs btn-photo" id="user_image_display" style="color: white; padding: 4px;"><?=lang('change')?></a></div>
            </div>
            <form method="post"  action="<?=site_url('users/changeImage/'.$record->pid.'/'.$record->photo)?>" class="user_image_form" id="user_image_form" enctype="multipart/form-data">
                <input type="file" id="user_image" name="image" style="display: none;"/>
                <button type="submit" id="upload" class="btn btn-secondary" style="margin-top: 5px; "><i class="fa fa-upload"></i><?=lang('upload')?></button>
            </form>
        </div> 
</div>                                                                    
<div class="row">
     <form method="POST" action="<?=site_url('users/updateUser/'.$record->id.'/'.$record->pid)?>" enctype="multipart/form-data" onsubmit="javascript: void(0);loadAjax();">
        <div class="col-sm-12">
            <div class="col-sm-6">
               <div class="form-group">
                    <label for="name"><?=lang('name')?></label>
                    <input type="text" class="form-control rq"  name="name" id="name" value="<?=$record->name?>" placeholder="<?=lang('name')?>">
                    <?=form_error('name');?>
               </div><!-- /.form-group -->  
            </div>
             <div class="col-sm-6">
               <div class="form-group">
                    <label for="lastname"><?=lang('lastname')?></label>
                    <input type="text" class="form-control rq"  name="lastname" id="lastname" value="<?=$record->lastname?>" placeholder="<?=lang('lastname')?>">
                    <?=form_error('lastname');?>
               </div><!-- /.form-group -->  
            </div>
         </div>
         
          <div class="col-sm-12">
             <div class="col-sm-6">
                <div class="form-group">
                    <label for="fname"><?=lang('fname')?></label> 
                    <input type="text" class="form-control rq"   name="fname" id="fname" value="<?=$record->fname?>" placeholder="<?=lang('fname')?>">
                      <?=form_error('fname');?>
                </div><!-- /.form-group -->
             </div>
               <div class="col-sm-6">
                     <div class="form-group">
                        <label for="type"><?=lang('type')?></label> 
                         <select name="type" id="type" class="form-control">
                                <option value=""><?=lang('select')?></option> 
                                <option value="1" <?php if($record->role ==1){echo 'selected="selected"';} ?>><?=lang('admin')?></option>
                                <option value="2" <?php if($record->role ==2){echo 'selected="selected"';} ?>><?=lang('staff')?></option> 
                               
                         </select>
                        <?=form_error('type');?>
                    </div><!-- /.form-group -->
             </div>
         </div>
            <div class="col-sm-12">
              <div class="col-sm-6">
                 <div class="form-group">
                    <label for="username"><?=lang('username')?></label> 
                    <input type="text" class="form-control rq" maxlength="15"  name="username" id="username" value="<?=$record->username?>"  placeholder="<?=lang('username')?>">
                     <div id="r_div"></div>  
                    <?=form_error('username');?>
                </div><!-- /.form-group -->
             </div>
               <div class="col-sm-6">
                     <div class="form-group">
                        <label for="status"><?=lang('status')?></label> 
                         <select name="status" id="status" class="form-control">
                                <option value=""><?=lang('select')?></option> 
                                <option value="1" <?php if($record->active ==1){echo 'selected="selected"';} ?>><?=lang('active')?></option>
                                <option value="0" <?php if($record->active ==0){echo 'selected="selected"';} ?>><?=lang('inactive')?></option>
                              
                         </select>
                        <?=form_error('type');?>
                    </div><!-- /.form-group -->
             </div>
         </div>
         <div class="col-sm-12">     
            <div class="form-group"> 
                 <br>
                 <button type="submit" id="save" class="btn btn-fill btn-info"><?=lang('save')?></button>
                 <button type="Button" class="btn btn-fill btn-info" onclick="location.href='<?=site_url('users')?>'"><?=lang('back')?></button>
            </div><!-- /.form-group --> 
         </div>
         

            </form>
    </div><!-- /.row --> 
<?php
    }
    else
    {
        echo '<div class="alert alert-danger fade in">'.lang('no_record_found').'</div>';
    }
?>
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

    $('#username').on('blur change',function(e){
        val = $('#username').val();
        user_id ='<?=$record->id?>';  
        if(val != '') {
         $.ajax({
                url: '<?=site_url('users/checkUsername')?>',
                type: 'POST',
                data:'&username='+val+'&user_id='+user_id,
                success: function(r)
                {
                    //console.log(r);
                    $('#r_div').html(r);
                    
                }
            });
        }
    });
    

 $("#user_image_display").click(function() {
        $("input[id='user_image']").click();
    });

    $('#user_image_form').on('submit',(function(e) {  
        e.preventDefault();  
        if($('#user_image').val() != '') {
               
            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                 $("#photo").load(location.href + " #photo"); 
                                                     
                }
            });
        }
        else {
            var msg='<?=lang('select').' '.lang('file')?>';
            alert(msg);
            return 0;                          
        }
    }));


//for not available image
   function epic(c) {
    c.onerror='';
    c.src='<?php echo base_url().'assets/img/not_available.jpg'?>';
};

   function view(img) {
      imgsrc = img.src.split("_")[0];
      viewwin = window.open(imgsrc,'#modal_image');    
   }

///this function is used to 
//dispaly image larger in 
//another window
   function view(img) {
      imgsrc = img.src.split("_")[0];
      viewwin = window.open(imgsrc,'viewwin');    
   }
     var UIToastr = function () {
    return {
        //main function to initiate the module
        init: function () {

            var i = -1,
                toastCount = 0,
                $toastlast   
            $('#upload').click(function () {
                   toastr.options = {
                          "closeButton": true,
                          "debug": false,   
                          "positionClass": "<?=shortlang()=='en'?"toast-top-right":"toast-top-left"?>", // toast-top-right,toast-top-left ,toast-top-center,toast-top-full-width
                          "onclick": null,
                          "showDuration": "1000",
                          "hideDuration": "1000",
                          "timeOut": "5000",
                          "extendedTimeOut": "1000",
                          "showEasing": "swing",
                          "hideEasing": "linear",
                          "showMethod": "fadeIn",
                          "hideMethod": "fadeOut"
                    };
                                               
                 if($('#user_image').val() == '') 
                 {    
                    var shortCutFunction = 'info'; //info/warning/error,success
                    var msg = '<?=lang('select').' '.lang('file')?>';
                    var title = '';  
                    var toastIndex = toastCount++;   
                                    
                }
                else
                {
                    return true;
                }  
                $("#toastrOptions").text("Command: toastr[" + shortCutFunction + "](\"" + msg + (title ? "\", \"" + title : '') + "\")\n\ntoastr.options = " + JSON.stringify(toastr.options, null, 2));
                var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
                $toastlast = $toast;  
                return false;    
            });    
        }   
    };

}();
   
</script>