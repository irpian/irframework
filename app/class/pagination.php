<?php
class pagination{
    var $open_pagging = '<ul class="pagination pull-right">';
    var $close_pagging = '</ul>';
    var $open_list_pagging 	= '<li>';
    var $close_list_pagging 	= '</li>';
    var $open_active_pagging 	= '<li class="active">';
    var $open_disable_pagging 	= '<li class="disable">';
    var $spare = '3';

    function open(){
        echo $this->open_pagging;
    }

    function close(){
        echo $this->close_pagging;
    }

    function open_list(){
        echo $this->open_list_pagging;
    }

    function close_list(){
        echo $this->close_list_pagging;
    }

    function open_list_active(){
        echo $this->open_active_pagging;
    }

    function close_list_active(){
        echo $this->close_active_pagging;
    }

    //----------------

    function list($url, $page, $label){
        echo $this->open_list_pagging;
        echo '<a href="'.$url.$page.'">'.$label.'</a>';
        echo $this->close_list_pagging;
    }

    function active($url, $page, $label){
        echo $this->open_active_pagging;
        echo '<a href="#">'.$label.'</a>';
        echo $this->close_list_pagging;
    }

    function disable($label){
        echo $this->open_disable_pagging;
        echo '<a>'.$label.'</a>';
        echo $this->close_list_pagging;
    }

    function next($url, $page, $total, $label){
        if($page < $total){

            echo $this->open_list_pagging;
            echo '<a href="'.$url.$page + 1.'">'.$label.'</a>';
            echo $this->close_list_pagging;
        } else {
            echo $this->open_disable_pagging;
            echo '<a>'.$label.'</a>';
            echo $this->close_list_pagging;
        }
    }

    function prev($url, $page, $label){
        if($page > 1){
            echo $this->open_list_pagging;
            echo '<a href="'.$url.$page - 1.'">'.$label.'</a>';
            echo $this->close_list_pagging;
        } else {
            echo $this->open_disable_pagging;
            echo '<a>'.$label.'</a>';
            echo $this->close_list_pagging;
        }
    }

    function set($action, $page, $total){
        $paging = "";
        if($page < 1){
            $page = 1;
        }

        /* prev */
        if($page<=1){
            $paging .= $this->open_list().$this->disable('Prev').$this->close_list();
        } else {
            $prev = $page-1;
            $paging .= $this->open_list().$this->list($url, $prev, 'Prev').$this->close_list();
        }

        /* first */
        if($page > 3){
            $first = $this->open_list().$this->list($url, 1, '1').$this->close_list();
        } else {
            $first = "";
        }

        /* dots */
        $number = ( $page > 3 ? $this->open_list().$this->disable('...').$this->close_list() : "" );

        /* before now */
        $paging .= "$first";
        for($i = $page - 2;$i < $page; $i++) {
            if($i < 1){
                continue;
            }
            $number .= $this->open_list().$this->list($url, $i, $i).$this->close_list();
        }

        /* now */
        $number .= $this->open_list_active().$this->active($url, $page, $page).$this->close_list_active();

        /* before after */
        for($i=$page+1;$i<($page+3);$i++) {
            if($i > $total ){
                break;
            }
            $number .= $this->open_list().$this->list($url, $i, $i).$this->close_list();
        }

        /* dots */
        $number .= ( $page+2 < $total ? $this->open_list().$this->disable('...').$this->close_list() : "" ) . $this->list($url, $total, $total) : "" );
        $paging .= $number;

        /* next */
        if($page>=$total){
            $paging .= $this->open_list().$this->disable('Next').$this->close_list();
        }else{
            $next = $page+1;
            $paging .= $this->open_list().$this->list($url, $next, 'Next').$this->close_list();

        }
        return $paging;
    }

    function show($action, $page, $total){
        if($total > 1){
            $this->open();
            $this->pagging();
            $this->close();
        }
    }

}

$pagination = new pagination();
?>


<?php
	//if($total > 1){
	?>
	<!-- <div class="row content-row-pagination">
		<div class="col-md-4">
			<div class="pagination">
				<?php //echo("Page {$page} From {$total}  "); ?>
			</div>
		</div>
		<div class="col-md-8">
			<?php
                //$pagination->show($page_url, $page, $total);
            ?>
		</div>
	</div> -->
<?php //} ?>
