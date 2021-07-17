
<!DOCTYPE html>
<html>


<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<meta name="harakat" content="harakat,harakat party,harakat political party,">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="<?=base_url()?>assets/fonts/profession/style.css" rel="stylesheet" type="text/css">
<link href="<?=base_url()?>assets/libraries/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?=base_url()?>assets/libraries/bootstrap-fileinput/css/fileinput.min.css" rel="stylesheet" type="text/css">
<link href="<?=base_url()?>assets/libraries/bootstrap-wysiwyg/bootstrap-wysiwyg.min.css" rel="stylesheet" type="text/css">
<link href="<?=base_url()?>assets/css/style.css" rel="stylesheet" type="text/css">
<?php
if(shortlang()=='en')
{
?>
    <link href="<?=base_url()?>assets/css/profession-blue-cyan-en.css" rel="stylesheet" type="text/css" id="style-primary">
    <link href="<?=base_url()?>assets/libraries/bootstrap-select/css/bootstrap-select-en.min.css" rel="stylesheet" type="text/css">
<?php
}
else
{    
?>
    <link href="<?=base_url()?>assets/css/profession-blue-cyan-dr.css" rel="stylesheet" type="text/css" id="style-primary"> 
    <link href="<?=base_url()?>assets/libraries/bootstrap-select/css/bootstrap-select-dr.min.css" rel="stylesheet" type="text/css">
<?php
}
?>

<!-- <link href="<?=base_url()?>assets/image-crop/jcrop/css/jquery.Jcrop.min.css" rel="stylesheet"/>
<link href="<?=base_url()?>assets/image-crop/image-crop.css" rel="stylesheet"/>
--> 
<link href="<?=base_url()?>assets/css/components.css" rel="stylesheet" type="text/css"/>  
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/bootstrap-toastr/toastr.min.css"/>
<script src="<?=base_url()?>assets/js/new/jquery.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/js/new/jquery-migrate.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/js/new/toastr.min.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script src="<?=base_url()?>assets/js/new/ui-toastr.js"></script>                                                   
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/date/css/bootstrap-datepicker.min.css">  
<!--  <link href="<?=base_url()?>assets/date/js/jquery.timepicker.css" rel="stylesheet" type="text/css"/>
-->  
<!--persian-datepicker Begannig-->                                                    
<link rel="stylesheet" href="<?=base_url()?>assets/date/css/persian-datepicker-0.4.5.min.css"/>
<!--  <link rel="stylesheet" href="<?=base_url()?>assets/date/css/persian-datepicker-0.4.5.css"/>
--><!--  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/date/css/persianDatepicker-default.css">
-->  <!--persian-datepicker End-->
<style>
.right {
float: right;
width: 300px;
border: 3px solid #73AD21;
padding: 10px;
@media screen and (max-width: 420px) {
    header-nav nav nav-pills collapse{
        
    }
            
         
}

</style>                                                                                                  

<title><?=lang('system_title')?></title>
<script type="text/javascript">
var xmlhttp_sp = false;
var is_csrf = true;

try {
    //If the Javascript version is greater than 5.
    xmlhttp_sp = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
    //If not, then use the older active x object.
    try {
        xmlhttp_sp = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (E) {
        //Else we must be using a non-IE browser.
        xmlhttp_sp = false;
    }
}

if (!xmlhttp_sp && typeof XMLHttpRequest != 'undefined') {
    xmlhttp_sp = new XMLHttpRequest();
}

// AJAX CALL 
// params: 
// ur: url of the ajax call
// dt: data
// sc: callback function
// type: true for posting file data  false for normal data
function jscon(ur,dt,sc,type){
        //loading(1);
        if(type==true){
            $.ajax({
                    url: ur,
                    type: 'POST',
                    dataType: 'json',
                    data: dt,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(r){sc(r);}
            });
        }else{
            $.ajax({
                    url: ur,
                    type: 'POST',
                    dataType: 'json',
                    data: dt,
                    success: function(r){sc(r);}
            });
        }
}


// PAGINATION FUNCTION FOR AJAX PANIGATION IN LISTS
function paginate(url,divname,starting,str){
    openModal();
    dt = '&start='+starting+str;
    jscon(url,dt,function(r){
        closeModal();
        $(divname).html(r.result);
    },false);
}

//paginaton with getting the data
function makepage(url,divname,starting,str){
    var match = str.split("&");

    var q_ids = match[1].substring(2);
    var result = q_ids.split(",");

    var ans = '';
    for(a=0; a<result.length; a++)
    {
        if ($("input[name='q_"+result[a]+"']:checked").val())
        {
            ans += '&ans_'+result[a]+'='+$("input[name='q_"+result[a]+"']:checked").val();

        }
        //alert(result[a]);
    }

    $.ajax({
        url: url,
        type: 'POST',
        data:'&start='+starting+str+ans,
        success: function(r)
        {
            $(divname).html(r);
        }
    });
}


// REDIRECT TO SPCIFIC URL
function go(url){
    document.location.href = url;
}
    

</script>

<script type="text/javascript">
    
function initAll(){     
    <?php if(shortlang()=='en'){?>
        $('.dates').datepicker({format: 'yyyy/m/d',autoclose: true}).on('changeDate',function(e){
            tt = parseInt((e.date.getTime()) / 1000);
            dd = $('input[name="'+($(this).attr('name'))+'_v"]');
            if(!dd.length>0){
                dd = dd = $('input[name="v_'+($(this).attr('name'))+'"]');   
            }
            dd.attr('value',tt);
        }); 


        $('.time').timepicker({
            'showDuration': true,
            'timeFormat': 'H:i',
            'step': 15,
            'minTime': '5:00am',
            'maxTime': '9:00pm',
            'disableTimeRanges': [
                ['12:01pm', '1pm'],
            ]
        })
        $('.times').datepair();

        <?php } else {?>
        $(".dates").pDatepicker({
            format:'YYYY-MM-DD',
            autoClose:true,
            persianDigit: true,
            
            //justSelectOnDate:true,
            observer: true,
            
            onSelect:function(e){
                el = this.$container.context.activeElement;
                pd = (persianDate(e)).gDate;
        
                $('#'+$(el).attr('name')+'_v').val(pd.getTime());
                
            }
        });

        <?php }?>
        
}

$(function(){
    initAll();
});


</script>
</head>


<body class="hero-content-dark footer-dark" dir="<?=shortlang()=='en'?'ltr':'rtl'?>">

<div class="page-wrapper">
<div class="header-wrapper hidden-print">
<div class="header"> 

<div class="header-bottom container" style="  border-width: 5px; border: 5px solid red; border-radius: 1px;border: 0px  #fff; border-color: red;border-style: solid; background-color: #fff;">


    <a href="<?=site_url('main/changeLang/'."en")?>">English</a> &nbsp;&nbsp;
    
        <a font-family: Bahij_Bold; href="<?=site_url('main/changeLang/'."dr")?>">دری</a>
        
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a class="social"  href="www.facebook.com"><i aria-hidden="true" class="fa fa-facebook" data-toggle="tooltip" title="Facebook"></i></a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a class="social" href="www.facebook.com"><i aria-hidden="true" class="fa fa-twitter" data-toggle="tooltip" title="twitter"></i></a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a class="social" style="color:#c8102e" href="www.facebook.com"><i aria-hidden="true" class="fa fa-youtube-play" data-toggle="tooltip" title="youtube"></i></a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a class="social" style="color:#c8102e" href="www.facebook.com"><i aria-hidden="true" class="fa fa-instagram" data-toggle="tooltip" title="instagram"></i></a>
         <?php 
         echo "Today is " . date("Y/m/d") . "<br>";
         
         ?>
         
</div><!-- /.header-top -->

    <span><?php  ?>
</span>    
<div class="header-bottom container">   
    <div class="container"> 
        <ul class="header-nav nav nav-pills collapse" style="float: <?=shortlang()=='en'?'left':'right'?>;">
                <?php
                    if(shortlang()!='en')
                    { 
                ?>
        
                
                    <li class="">
                <a href="#"><?=lang('setting')?> <i class="fa fa-chevron-down"></i></a>
                <ul class="sub-menu">
                    
                        
                    <li><a href="<?=site_url('backend')?>"><?=lang('dashboard')?></a></li>
                    <?php
                        if(isLogin())
                        {
                    ?>             
                        <li><a href="<?=site_url('users/changePassword/'.getUserId())?>"><?=lang('change_password')?></a></li>
                        <li><a href="<?=site_url('main/logout')?>"><?=lang('logout')?></a></li> 
                
                    <?php
                        }
                        ?>
                </ul>
                </li>
        
                <?php
                    } 
                ?>


            <?php
                $menu =getMenus();
                if($menu)
                {   
                    foreach($menu AS $menu)
                    {
                            if($menu->link =='#')
                            {
                            ?>
                        <li class="">
                            <a href="<?=site_url($menu->link)?>"><?=$menu->title?> <i class="fa fa-chevron-down"></i></a>
                            <ul class="sub-menu"> 
                                <li><a href="<?=site_url('main/getLeaderByType/5')?>"><?=lang('about_current_leader')?></a></li> 
                                <li><a href="<?=site_url('main/presidenciesList')?>"><?=lang('presidencies')?></a></li> 
                                <li><a href="<?=site_url('main/presidencies_provinceList')?>"><?=lang('presidencies_province')?></a></li> 
                                <li><a href="<?=site_url('main/rulesList')?>"><?=lang('rules')?></a></li> 
                                <li><a href="<?=site_url('main/organizationList')?>"><?=lang('joined_organization')?></a></li> 
                            </ul>
                        </li> 
                            <?php
                            continue;    
                            
                        }

                  
                        
                        if($menu->link =='##')
                        {
                        ?>
                       <li class="">
                        <a href="<?=site_url($menu->link)?>"><?=$menu->title?> <i class="fa fa-chevron-down"></i></a>
                        <?php
                        //name_'.shortlang().' AS name
                        $news_name='name_'.shortlang();                                

                        $services_category=getAllFirstLevelMenu1('news_category');
                        if($services_category)
                        {
                        ?>
                        <ul class="sub-menu">

                        <?php    
                        foreach($services_category AS $whcat)

                        {    
                        ?>
                        
                        <li><a href="<?=site_url('main/newslist/'.$whcat->id)?>"><?=$whcat->$news_name?></a></li>     
                        
                        <?php
                        }
                        ?>
                                
                        </ul>
                        <?php
                        }
                    ?>
                        </li> 
                        <?php
                        continue;    
                        
                    }
                        

                        
                      ?>   

                
                 
                        <li>
                        <a href="<?=site_url($menu->link)?>"><?=$menu->title?></a>
                        </li> 
                        
                <?php
                            
                        
                    }
                }
            ?>  
            <?php
            if(shortlang()=='en')
            {
                ?>
                <li class="">
                <a href="#"><?=lang('setting')?> <i class="fa fa-chevron-down"></i></a>
                <ul class="sub-menu">
                    
                   
                
                    <li><a href="<?=site_url('backend')?>"><?=lang('dashboard')?></a></li>
                    <?php
                        if(isLogin())
                        {
                    ?>             
                        <li><a href="<?=site_url('users/changePassword/'.getUserId())?>"><?=lang('change_password')?></a></li>
                        <li><a href="<?=site_url('main/logout')?>"><?=lang('logout')?></a></li> 
                
                    <?php
                        }
                        ?>
                </ul>
            </li> 
            
                <?php
            }
                ?> 
            


            

        
        </ul>   
            
    </div><!-- /.container -->
    
</div><!-- /.header-bottom -->

</div><!-- /.header -->

</div><!-- /.header-wrapper-->

<script>
$(function(){
$('.selectpicker').selectpicker();
});
</script>
