<?php
include_once base_root."/modules/".$value."/controller/config.php";
$list_account = $db->all("*", $table2, "WHERE status=1 ORDER BY name ASC");
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $title_page; ?></h3>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                      <tr>
                        <th width="40%">Account</th>
                        <th width="10%">Share </th>
                        <th width="20%">Pending</th>
                        <th width="20%">Progress</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list_account as $data) { 
                        $share = $db->row("id", $table, "WHERE account='".$data['id']."' AND status=1");
                        $pending = $db->row("id", $table, "WHERE account='".$data['id']."' AND status=0");
                        $total = $db->row("id", $table, "WHERE account='".$data['id']."' ");
                    ?>
                    <tr>
                        <td><?php echo $data['name']; ?></td>
                        <td><?php echo ribuan($share); ?></td>
                        <td><?php echo ribuan($pending); ?></td>
                        <td>
                            <?php
                                $count_width = ($share / 100) * $total;
                            ?>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $count_width; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $count_width; ?>%;"><?php echo $count_width; ?>%</div>
                          </div>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<?php
//unset
include_once "include/actionUnset.php";
?>
