<thead class="table-light">
    <tr>
        <th>No.</th>
        <th>ชื่อวันหยุด</th>
        <th>วันที่</th>
        <th>สี</th>
        <th>จัดการ</th>
    </tr>
</thead>
<tbody>
    <?php
    
    $no = 0;

    foreach ($rows as $row) :
        $no++; 
        echo "<tr>
                    <td>$no</td>
                    <td>" . $row['title'] . "</td>
                    <td>" . $row['date'] . "</td>
                    <td ><div class='d-flex' style='width:30px; border-radius:5px; justify-content:center; height:30px; background-color:".$row['color'].";'></div></td>

                ";
    
    ?>
    <td >
        <?= $this->load->view('admin/no_service_date/table/manage_row',['row'=>$row],true )?>

    </td>
    </tr>
    <?php endforeach ?>

</tbody>
