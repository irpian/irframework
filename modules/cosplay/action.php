<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Authorization");
header("Access-Control-Allow-Methods: PUT,GET,POST,DELETE");

if(isset($_POST['next'])!=""){
    $query_update = $db->update("config", 'value=value+1', "WHERE inisial='coscounter'");
    $db->execute($query_update);
}

if(isset($_POST['prev'])!=""){
    $query_update = $db->update("config", 'value=value-1', "WHERE inisial='coscounter'");
    $db->execute($query_update);
}

if(isset($_GET['list'])==1){
    if(empty($_GET['page'])){
        $_GET['page'] = 1;
    }
    $limit = 10 ;
    $member = config("coscounter");
    $page = $_GET['page'];

    //----------------------------------------------------------------------------
    if($member > 0){
        $id_member = $member;

        require 'controller/domhtml.php';
        $url_address = "https://worldcosplay.net/member/".$id_member;
        $html = file_get_html($url_address);

        foreach($html->find("script") as $element){
            //echo $element;
            preg_match('/const owner = (.*?);/', $element, $m);
              foreach ($m as $key => $value) {
                $setInfo[] = $value;
              }
        }
        //die("xxx");

        $getInfo = json_decode($setInfo[1], true);

        $nameCosplayer =  $getInfo['global_name'];
        if($nameCosplayer==""){
            $nameCosplayer = $getInfo['nickname'];
        }

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
     }

    $info['name'] = $nameCosplayer;
    $info['description'] = $detailCosplayer;
    $info = json_encode($info);
    //-------------------------------------------------------------------------------

    $url = "https://worldcosplay.net/api/member/role_photos.json?limit=".$limit."&member_id=".$member."&p3_photo_list=true&page=".$page."&photo_context=member_role:".$member.":1&role_id=1&upload_type=all_ages";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);
    curl_close($ch);

    $obj = json_decode($result,true);

    // Allowing access from cross origin
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Authorization");
    header("Access-Control-Allow-Methods: PUT,GET,POST,DELETE");
    header('Content-Type: application/json');

    $result2 = json_encode('<div id="adv"></div>');
    if(!empty($info)){
        echo "[$result,$result2,$info]";
    } else {
        echo "[$result,$result2]";
    }

    $_SESSION['description'] = $detailCosplayer;
    die();
}

if(isset($_GET['save']) == 1){
    $cek_url = $db->row("url", "cosplay", "WHERE url='".$_GET['url']."' AND account='".$_GET['account']."' ");
    if ($cek_url>=1){
        echo 0;
    } else {
        if($_GET['url']!="" && $_GET['name']!="" && $_GET['member']!="" && $_GET['cosplayer']!="" && $_GET['account']!=""){
            $set_description = $_GET['name']."<br>";
            $set_description .= "Cosplayer : ".$_GET['cosplayer']."<br>";
            $set_description .= $_SESSION['description']."<br>";
            $set_description .= "#ircosplay #cospian #excrozer #excrozercosplay #excrozerdesign #cosplay #cosplayer #hot #hotcosplay #sexy #sexycosplay #anime #cosplayanime #kawaii #viral #costume ";
            $set_description .= "#".$_GET['cosplayer']." #".$_GET['name'];
            $query_set = "url='".$_GET['url']."', ";
            $query_set .= "name='".$_GET['name']."', ";
            $query_set .= "cosplayer='".$_GET['cosplayer']."', ";
            $query_set .= "member='".$_GET['member']."', ";
            $query_set .= "account='".$_GET['account']."', ";
            $query_set .= "description='".$set_description."', ";
            $query_set .= "number='".$_GET['number']."', ";
            $query_set .= "status='0' ";
            $query_add = "INSERT INTO cosplay SET
            ".$query_set.",
            date_create = '".date("Y-m-d H:i:s")."' ";
            $db->execute($query_add);
            echo 1;
        } else {
            echo 0;
        }
    }
    die();
}

if(isset($_GET['update']) == 1){
    if($_GET['id'] > 0){
        $db->execute($db->update("cosplay", "status='1'", "WHERE id='".$_GET['id']."' "));
        echo 1;
    } else {
        echo 0;
    }
    die();
}

if(isset($_GET['delete']) == 1){
    if($_GET['id'] > 0){
        $db->execute("DELETE FROM cosplay WHERE id='".$_GET['id']."' ");
        echo 1;
    } else {
        echo 0;
    }
    die();
}


if(isset($_GET['grouping'])==1){
    if(empty($_GET['page'])){
        $_GET['page'] = 1;
    }
    $list = getList("cosplay", "cosplay", "id", "*", "WHERE member='".$_GET['member']."' AND account='".$_GET['filter']."' ", "ORDER BY status,name ASC", 10, $_GET['page']);
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Authorization");
    header("Access-Control-Allow-Methods: PUT,GET,POST,DELETE");
    header('Content-Type: application/json');

    echo json_encode($list['data']);
    die();
}
?>
