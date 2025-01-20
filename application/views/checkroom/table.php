<style>
    table#Table {
        border-collapse: separate; /* Separate borders for proper rounding */
        border-spacing: 0; /* Ensures no gaps between cells */
        border-radius: 6px !important; /* Apply overall rounded corners */
        overflow: hidden; /* Ensures content respects the border-radius */
    }

    table#Table thead th {
        text-align: center;
    }

    table#Table tbody td {
        border: 1px solid #ddd;
        text-align: center;
    }

    /* Top-left corner */
    table#Table thead tr:first-child th:first-child {
        border-top-left-radius: 6px !important;
    }

    /* Top-right corner */
    table#Table thead tr:first-child th:last-child {
        border-top-right-radius: 6px !important;
    }

    /* Bottom-left corner */
    table#Table tbody tr:last-child td:first-child {
        border-bottom-left-radius: 6px !important;
    }

    /* Bottom-right corner */
    table#Table tbody tr:last-child td:last-child {
        border-bottom-right-radius: 6px !important;
    }
</style>

<div class="container">
    <?php  if(!empty($rows)){
?>
   
<div class="table-responsive">
    <table class="table table-bordered" id="Table">
    
    <?php  
    if($table === "music"){
        echo $this->load->view('component/table/music',['rows'=>$rows],true);
    }?>
    </table>
    </div>

</div>
<?php
}else{ 
    echo $this->load->view('component/table/no_data',['page'=>'music'],true);
} ?>
<script src="<?= base_url('public/cdn/jQuery/jquery-3.6.0.min.js') ?>"></script>
<!-- DataTable CSS -->
<link rel="stylesheet" href="<?= base_url('public/cdn/dataTable/css/dataTables.dataTables.min.css') ?>">
<script src="<?= base_url('public/cdn/dataTable/js/dataTables.min.js') ?>"></script>
<script>
        // let table = new DataTable('#productTable');
        function intializingDataTable(table) {
            $(table).DataTable();
        };

        intializingDataTable('#Table');


    </script>
    <script>
    // Reload the page every 60,000 milliseconds (1 minute)
    setInterval(() => {
        location.reload();
    }, 60000);
</script>