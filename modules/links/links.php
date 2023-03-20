<?php
$template['layout'] =  $theme->base()."/layout.blank.php";
error_reporting(0);
?>
<title>Get Content Blogger</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/irpian/css@master/4.0.0/4.0.0.css" type="text/css" media="all" />

<body class="font-arial">
    <?php
    if($_POST['url']!="" || $_GET['url']!=""){

        if($_POST['url']!=""){
            $_GET['url'] = $_POST['url'];
            $set_url =$_POST['url'];
        }

        if($_GET['url']!=""){
            $_POST['url'] = $_GET['url'];
            $set_url = $_GET['url'];
        }

        require_once base_root."/modules/links/controller/domhtml.php";
        $find_title = ".entry-title";
        $find_description = ".post-body";
        $find_tag = "#tag";
        $find_image = "";

        $html = file_get_html($set_url);
     ?>
    <?php } ?>

        <div class="wrapper wrapper-xs round-xl mg-t-xxl shadow-m content-xl res3-c">
            <form name="form1" method="post" action="">
                <table align="center" class="table table-clear full">
                    <tr>
                        <td height="30" class="text-center"><h1 class="title-xl">Get Content Blogger</h1></td>
                    </tr>
                    <tr>
                        <td class="content-m">
                            <input name="url" type="text" class="input-text input-m full" value="<?php echo $_POST['url']; ?>" placeholder="Url Blogger" />
                        </td>
                    </tr>
                     <tr>
                        <td  class="content-m pd-lr-xl">
<?php if($set_url!=""){ ?><textarea class="input-textarea textarea-m "  id="copy" rows="7"><?php } ?>
<?php
if($set_url!=""){
    foreach($html->find($find_title) as $element){
        echo ltrim($element->plaintext);
    }
    echo "&#10;";
    echo $_POST['url'];
    echo "&#10;";
    $cek_tag = 1;
    foreach($html->find($find_tag) as $element){
        echo link_tag($element->plaintext);
        if(!empty($element->plaintext)){
            $cek_tag = 0;
        }
    }

    if($cek_tag==1){
        foreach($html->find($find_description) as $element){
            //echo $element->plaintext;
            $text = $element->plaintext;
            $check_hash = preg_match_all("/([#][a-zA-Z-0-9]+)/", $text, $hashtweet);
            foreach ($hashtweet[1] as $tags){
              echo $tags." ";
            }
        }
    }
}
?>
<?php if($set_url!=""){ ?></textarea><?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="content-m pd-lr-xl">
                            <input type="submit" value="Find" class="btn btn-m btn-orange mouse-pointer" />
                            <input type="button" onclick="setCopy()" value="Copy" class="btn btn-m btn-green mouse-pointer right" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>

</body>

<script type="text/javascript">
function setCopy(){
    var target_copy = document.getElementById("copy");
    target_copy.select(); //select the text area
    document.execCommand("copy"); //copy to clipboard
    alert("Content has been copied !");
}
</script>
