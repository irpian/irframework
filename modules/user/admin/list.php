<?php
include "include/action.php";

$list = getList($module, $table, $primary, $select, $where, $orderby, $limit, $page);
$paging = $list['paging'];
?>

<h2 class="content-row-title">
  <?php echo $title_list; ?>
</h2>

<?php 
if(isUserRoot($_SESSION["admin_id"])){
  addDataButton($module, "add", $title_add);
}
?>

<div class="row">
  <div class="col-md-12">
  <table class="table">
    <thead>
    <tr>
      <th>Admin</th>
      <th>Email</th>
      <th>Last Login</th>
      <th>Status</th>
      <th><span class="action">Action</span></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($list['data'] as $key=>$data){ ?>
    <tr>
      <td><?php echo $data['name']; ?></td>
      <td><?php echo $data['email']; ?></td>
      <td><?php echo $data['login']; ?></td>
      <td><?php echo status("Aktif", "Non Aktif", $data['status']); ?></td>
      <td>
        <span class="group-action btn-group pull-right">
        <?php if(isUserRoot($_SESSION["admin_id"])){ 
          action("edit", $module, $data['id'], $page, ""); 
        } ?>
        </span>
      </td>
    </tr>
    <?php } ?>
    </tbody>
  </table>
  </div>
</div>

<?php pagination(urlPagingAdmin($module), $paging['page'], $paging['totalpage']); ?>
