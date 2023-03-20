<?php
$template['layout'] =  $theme->base()."/layout.blank.php";
error_reporting(0);

//----------------------------------------------------------------------------
$member = config("coscounter");
if($member > 0){
    $_SESSION['description'] = "";
    $id_member = $member;

    require 'controller/domhtml.php';
    $url_address = "https://worldcosplay.net/member/".$id_member;
    $html = file_get_html($url_address);

    foreach($html->find("script") as $element){
        preg_match('/const owner = (.*?);/', $element, $m);
          foreach ($m as $key => $value) {
            $setInfo[] = $value;
          }
    }

    $getInfo = json_decode($setInfo[1], true);

    $detailCosplayer = "Social Media : <br>";
    $setSosmed = explode(" ", str_replace("\r\n"," ",strip_tags($getInfo['introduction'])));
    foreach ($setSosmed as $key => $values) {
        if (filter_var($values, FILTER_VALIDATE_URL) == TRUE) {
            $detailCosplayer .= '<a class="jump-url" href="'.$values.'" target="_blank">'.str_replace(array("http://", "https://", "www."), "", $values).'</a><br>';
        }
    }

    if(count($setSosmed) == 0) {
        $detailCosplayer = nl2br($getInfo['introduction']);
    }
$detailCosplayer .= "
cospian.blogspot.com/member/".$member."
";
    $_SESSION['description'] .= $detailCosplayer;
 }
//----------------------------------------------------------------------------

?>
<title>Get Cosplayer</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/irpian/css@master/4.0.0/4.0.0.css" type="text/css" media="all" />

<body class="font-arial">

        <div class="wrapper wrapper-xs round-l mg-t-xl mg-b-xl shadow-s content-xl res3-c">
            <form name="form1" method="post" action="">
                <table align="center" class="table table-clear full">
                    <tr>
                        <td class="text-center"><h1 class="title-xl">Cosplay</h1></td>
                    </tr>
                    <tr>
                        <td class="text-center">Member : <?php echo config("coscounter"); ?></td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <div id="cosplayer-name" class="content-m bold"></div>
                            <div id="cosplayer-description" class="content-m text-left"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="content-m pd-lr-xl text-center">
                            <input type="submit" name="prev" value="Prev" class="btn btn-m btn-green mouse-pointer left" />
                            <a href="<?php echo base_url."/cosplay/sorting"; ?>" class="link"><input type="button" name="sorting" value="Sorting" class="btn btn-m btn-blue mouse-pointer" /></a>
                            <input type="submit" name="next" value="Next" class="btn btn-m btn-green mouse-pointer right" />
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
            </form>
        </div>

</body>

<script type="text/javascript">

function more(page) {

    var member = '<?php echo config("coscounter"); ?>';
    var limit = 10;

    $(".next").remove();
    $(".loading").slideDown();

    if (page > 0) {
        var page = page;
    } else {
        var page = 1;
    }

    //var flickerAPI = "<?php echo base_url.'/cosplay/list'; ?>?list=1&page=" + page; //local
    var flickerAPI = "https://ircosplay.000webhostapp.com/cosplay.php?limit=" + limit + "&member=" + member + "&page=" + page; //numpang

    var action = "";

    $.getJSON(flickerAPI, {

    }).done(function(data) {
        $('<div class="area center" id="area' + page + '"></div>').appendTo(".area-x");

        if(data[0].list==undefined){
            $(".loading").hide();
            $(".end").html('Cosplay Not Found');
        }

        $.each(data[0].list, function(i, item) {
            if (item.photo !== undefined) {
                var image_id = item.photo.id;
                var image_name = item.photo.subject;
                var image_url = item.photo.sq300_url;
                var image = '<div id="'+image_id+'" class="image brick list-line-xl"><img class="img-cosplay img-res" src="' + item.photo.sq300_url + '" id="image-' + item.photo.id + '" alt="' + item.photo.subject + '"><p class="content-m pd-tb-m character-name nowrap-ellipsis">' + item.photo.subject + '</p></div>';
            } else {
                var image_id = item.id;
                var image_name = item.subject;
                var image_url = item.sq300_url;
                var image = '<div id="'+image_id+'" class="image brick list-line-xl"><img class="img-cosplay img-res" src="' + item.sq300_url + '" id="image-' + item.id + '" alt="' + item.subject + '"><p class="content-m pd-tb-m character-name nowrap-ellipsis">' + item.subject + '</p></div>';
            }

            var myregexp = /shocked/;
            var match = myregexp.exec(image);
            if (match != null) {

            } else {
                $(image).appendTo("#area" + page);
                buttonSave(image_id, image_url, image_name);
            }

        });
        var next = page + 1;
        var prev = page - 1;

        if (data[0].list.length === 0) {
            $(".loading").hide();
            $(".end").html('Search Complete');
        } else {
            $('<div class="clear"></div>').appendTo("#area" + page);
            $('<input type="button" value="View More" id="next" class="btn-m btn-blue mg-m next cursor-pointer" onClick="more(' + next + ')">').appendTo(".navigation");
            $(".loading").slideUp();
        }

        if (data[1] != "") {

        }

        if (data[2] != undefined) {

            if (data[2].name != "") {
                $("#cosplayer-name").html(data[2].name);
            }
            if (data[2].description != "Social Media : <br>") {
                var self_url = window.location.host + "/member/" + member + "\n<br>";
                var content_description = data[2].description + self_url;
                $("#cosplayer-description").html(content_description);
            } else {
                var self_url = window.location.host + "/member/" + member + "\n<br>";
                var content_description = self_url;
                $("#cosplayer-description").html(content_description);
            }

        } else {
            $("#cosplayer-name").html("");
            $("#cosplayer-description").html("");
        }

        dataReady();
    });

}

more(1);

function buttonSave(image_id, image_url, image_name){
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
            $( '<div class="btn-m <?php echo $btn_collor; ?>  mg-m cursor-pointer account-<?php echo $data['id']; ?>" onClick="save(this, <?php echo $data['id']; ?>);"><?php echo $data['name']; ?></div>').insertAfter("#image-"+image_id);
    <?php
        }
    ?>

}

function save(that, account){
    var parent = $(that).parents('div:first').attr('id');
    var image_url = $("#"+parent+" img").attr("src");
    var image_name = $("#"+parent+" p").html();
    var cosplayer = $("#cosplayer-name").html();
    var description = ""; //$("#cosplayer-description").html();
    var member = <?php echo config("coscounter"); ?>;
    var save = "<?php echo base_url.'/cosplay/saved'; ?>?save=1&url=" + image_url + "&name=" + image_name + "&cosplayer=" + cosplayer + "&member=" + member + "&description=" + description + "&account=" + account+ "&number=" + parent;
    $.getJSON(save,{ }).done(function(data) {
        if(data==0){
            $(that).addClass("btn-grey").html("Ready");
        } else {
            $(that).addClass("opacity3");
        }

    });
}

function dataReady(){
    <?php
        $list_account = $db->all("*", "cosplay", "WHERE member='".config("coscounter")."' ORDER BY id ASC");
        foreach($list_account as $data) {
            if($data['number'] > 0){ ?>
                $("#<?php echo $data['number']; ?> .account-<?php echo $data['account']; ?>").addClass("opacity3");;
    <?php
            }
        }
    ?>
}
</script>
