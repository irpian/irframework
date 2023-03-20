<?php
$template['layout'] =  $theme->base()."/layout.blank.php";
error_reporting(0);
$now_member = $db->value("member, cosplayer, description", "cosplay", "WHERE status=0 GROUP BY member ORDER BY RAND() DESC LIMIT 1");
?>
<title>Sorting</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/irpian/css@master/4.0.0/4.0.0.css" type="text/css" media="all" />

<div class="wrapper wrapper-xs round-l mg-t-xl mg-b-xl shadow-s content-xl res3-c font-arial">

    <?php
        $list_account = $db->all("*", "cosplay_account", "WHERE status=1 ORDER BY name DESC");
        foreach($list_account as $data) {
            if(preg_match('/Blog/', $data['name'])){
                $btn_collor = "btn-orange";
            } elseif(preg_match('/Facebook/', $data['name'])){
                $btn_collor = "btn-blue";
            } elseif(preg_match('/Twitter/', $data['name'])){
                $btn_collor = "btn-skyblue";
            } elseif(preg_match('/Instagram/', $data['name'])){
                $btn_collor = "btn-purple";
            } elseif(preg_match('/Pinterest/', $data['name'])){
                $btn_collor = "btn-red";
            } else {
                $btn_collor = "btn-green";
            }
    ?>
            <div class="btn-m <?php echo $btn_collor; ?>  mg-m cursor-pointer account" value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></div>
    <?php
        }
    ?>
    <table align="center" class="table table-clear full mg-t-l">
        <tr>
            <td class="text-center"><h1 class="title-xl">Cosplay</h1></td>
        </tr>
        <tr>
            <td class="text-center">Member : <?php echo $now_member['member']; ?></td>
        </tr>
        <tr>
            <td class="text-center">Cosplayer : <?php echo $now_member['cosplayer']; ?></td>
        </tr>
        <tr>
            <td class="text-left"><?php echo $now_member['description']; ?></td>
        </tr>
        <tr>
            <td class="text-center">
                <div id="cosplayer-name" class="content-m bold"></div>
                <div id="cosplayer-description" class="content-m text-left"></div>
            </td>
        </tr>
        <tr>
            <td class="content-m pd-lr-xl text-center">
                <a href="<?php echo base_url."/cosplay"; ?>" class="link"><input type="button" name="back" value="Back" class="btn btn-m btn-blue mouse-pointer" /></a>
                <input type="hidden" name="filter" id="filter" value="" />
            </td>
        </tr>
         <tr>
            <td class="content-m pd-lr-xl">
                <div id="area"></div>
                <div class="area-x"></div>
                <div class="navigation content-m cursor-pointer center"><input type="button" value="Show" id="next" class="btn-m btn-blue next" onClick="more(1)"></div>
                <div class="loading content-m center hide">Loading...</div>
                <div class="end content-m center"></div>
            </td>
        </tr>
    </table>
</div>

<script type="text/javascript">

function more(page) {
    var filter = parseInt($("#filter").val());

    var member = '<?php echo $now_member['member']; ?>';
    $(".end").hide();

    $(".next").remove();
    $(".loading").show();

    if (page > 0) {
        var page = page;
    } else {
        var page = 1;
    }

    var flickerAPI = "<?php echo base_url.'/cosplay/grouping'; ?>?grouping=1&member="+member+"&filter="+filter+"&page=" + page;

    $.getJSON(flickerAPI, {

    }).done(function(data) {

        if(data==null){
            $(".end").show();
            $(".end").html('Data Not Found');
        } else {
            $('<div class="area center" id="area' + page + '"></div>').appendTo(".area-x");

            $.each(data, function(i, item) {
                if(item.status==1){
                    var opacity = "opacity3";
                } else {
                    var opacity = "";
                }
                var name_target = 'copy-'+item.number;
                var btn_copy = '<div class="btn btn-m btn-purple mg-m left copy" onClick="setCopy(this, \''+name_target+'\')">Copy</div>';
                var btn_update = '<div class="btn btn-m btn-green mg-m right '+ opacity +'" onClick="update(this, \''+item.id+'\')">Update</div>';
                var btn_delete = '<div class="btn btn-m btn-red mg-m right '+ opacity +'" onClick="deletes(this, \''+item.id+'\')">Delete</div>';
                var description = '<textarea class="hide" id="copy-'+item.number+'">'+item.description+'</textarea>';
                var image = '<div id="'+item.number+'" class="image brick list-line-xl"><img class="img-cosplay img-res '+ opacity +'" src="' + item.url + '" id="image-' + item.id + '" alt="' + item.name + '"><p class="content-m pd-tb-m character-name nowrap-ellipsis">' + item.name + '</p>'+ btn_copy + btn_update + btn_delete + description +'<div class="clear"></div></div>';
                $(image).appendTo("#area" + page);
            });
        }

        var next = page + 1;
        var prev = page - 1;

        if (data.length === 0) {
            $(".loading").hide();
            $(".end").html('Search Complete');
        } else {
            $('<div class="clear"></div>').appendTo("#area" + page);
            $('<input type="button" value="View More" id="next" class="btn-m btn-blue mg-m next cursor-pointer" onClick="more(' + next + ')">').appendTo(".navigation");
            $(".loading").hide();
        }

    });

}

$(".account").on("click", function(){
    $(".account").removeClass("opacity5");
    $(this).addClass("opacity5");
    $(".area-x").html("");
    $("#filter").val($(this).attr('value'));
    more(1);
});

function setCopy(that, target) {
    $(that).addClass("opacity3");
    setTimeout(function() {
        $(that).removeClass("opacity3");
    }, 5000);
    $("#"+target).show();

    var default_tag = $('#'+target).val();
    var default_tag = default_tag.replace('</a>', '</a>-----').replace('<br>', '\n').replace('-----', '\n');
    var default_tag = default_tag.replace(/<[^>]*>?/gm, '');
    var default_tag = $('#'+target).val(default_tag);

    var target_copy = document.getElementById(target);
    target_copy.select(); //select the text area
    document.execCommand("copy"); //copy to clipboard
    //alert("Content has been copied !");
    console.log("Content has been copied !");
    $("#"+target).hide();
    return false;
}

function update(that, id){
    var parent = $(that).parents('div:first').attr('id');
    var update = "<?php echo base_url.'/cosplay/update'; ?>?update=1&id=" + id;
    $.getJSON(update,{ }).done(function(data) {
        if(data==0){
            $(that).addClass("btn-grey").html("Posted");
            $("#"+parent).addClass("opacity3");
        } else {
            $(that).addClass("opacity3");
            $("#"+parent).addClass("opacity3");
        }
    });
}

function deletes(that, id){
    var parent = $(that).parents('div:first').attr('id');
    $("#"+parent).addClass("bg-red");
    if (confirm("Delete This ?") == true) {

    } else {
        $("#"+parent).removeClass("bg-red");
        return false;
    }
    var update = "<?php echo base_url.'/cosplay/delete'; ?>?delete=1&id=" + id;
    $.getJSON(update,{ }).done(function(data) {
        if(data==0){
            $("#"+parent).remove();
        } else {
            $("#"+parent).remove();
        }
    });
}

$('.area-x').on('click', '.copy', function() {
    var parent = $(this).parents('div:first').attr('id');
    var src = $("#"+parent+" img").attr('src');
    var hd = hd_image(src);
    $("#"+parent+" img").fadeOut("slow");
    $("#"+parent+" img").attr('src', hd);
    $("#"+parent+" img").fadeIn("slow");
})

function hd_image(url) {

    var match_350 = /350x600/;
    var match_700 = /-700/;
    var match_1200 = /-1200/;

    var match_350 = match_350.exec(url);
    if (match_350 != null) {
        var url = url.replace("-350x600", "-740");
    }

    var src = url.replace("-740", "-3000");

    var match700 = match_700.exec(url);
    if (match700 != null) {
        var src = url;
    }

    var match1200 = match_1200.exec(url);
    if (match1200 != null) {
        var src = url.replace("-740", "-1200");
    }

    return src;
}
</script>
