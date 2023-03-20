<?php 
//$form_search = array('search', 'status', 'sort', 'category');
//jika tidak ada array in maka tombol add saja
?>
    <div class="row">
        <?php if(!empty($form_search)){ ?>
            <?php 
                $form->formOpen("", "filter", "post", 'class="form-filter"');
            ?>

            <?php if(in_array('search', $form_search)){ ?>
                <div class="col-md-2 col-xs-6">
                    <?php $form->formText("search", $search, 'placeholder="Search" class="form-control filter" '); ?>
                </div>
            <?php } ?>
            
            <?php if(in_array('status', $form_search)){ ?>
                <div class="col-md-2 col-xs-6">
                    <?php           
                        $array_status = array("99"=>"All Status", "1"=>"Active", "0"=>"Non Active");
                        $form->formOption("publish", $publish, $array_status, 'class="form-control filter" ');
                    ?>
                </div>
            <?php } ?>

            <?php if(in_array('sort', $form_search)){ ?>
                <div class="col-md-2 col-xs-6">
                    <?php 
                        $array_sort = array("asc"=>"New", "desc"=>"Old", "az"=>"Name A-Z", "za"=>"Name Z-A");
                        $form->formOption("sort", $sort, $array_sort, 'class="form-control filter" ');
                    ?>
                </div>
            <?php } ?>

            <?php if(in_array('category', $form_search)){ ?>
                <div class="col-md-2 col-xs-6">
                    <?php
                        //note bagian name
                        $where_category = "WHERE 1 ORDER BY name ASC";
                        $form->formOptionTable("category", $category_filter, "*", $table2, $where_category, "id", "name", "Select FIlter", 'class="form-control filter" ');
                    ?>
                </div>
            <?php } ?>

            <?php $form->formClose(); ?>

            <div class="col-md-2 col-xs-6">
                <?php 
                $form->formOpen("", "");
                    if(!empty($_SESSION['filter'][$module])){
                        $form->formSubmit("reset_filter", "reset", ' class="btn btn-info pull-left" ');
                    }
                $form->formClose();
                ?>
            </div>
        <?php } ?>

        <div class="col-md-2 col-xs-6 pull-right">
            <?php addDataButton($module, "add", $title_add); ?>
        </div>
    </div>