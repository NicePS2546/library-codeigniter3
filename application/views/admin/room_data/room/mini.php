<thead class="table-light">
    <tr>
        <th>No.</th>
        <th>หมายเลขห้อง</th>
        <th>รูปห้อง</th>
        <th>คำอธิบาย</th>
        <!-- <th>คำอธิบายปิดห้อง</th> -->
        <th>สถานะ</th>
        <th>จัดการ</th>
    </tr>
</thead>
<tbody>
    <?php
    $no = 0;

    foreach ($rows as $row) :
        $status = $row['r_status'] == 1 ? 'เปิดใช้งาน': 'ปิดใช้งาน';
        $status_color = $row['r_status'] == 1 ? 'text-success': 'text-danger';
        $close_desc = $row['r_close_desc'] ? $row['r_close_desc'] : "ยังไม่ได้ตั้ง";
        $no++;
        echo "<tr>
                    <td>$no</td>
                    <td>" . $row['r_number'] . "</td>
                    <td><img heigh='50px' width='50px' class='img-fluid rounded' src='".base_url('public/assets/img/room_img/').$row['r_img']."'></td>
                    <td>" . $row['r_desc']. "</td>
                   
                    <td class = '$status_color' >" . $status  . "</td>
                  
                ";
    
    ?>
    <td >
        <?= $this->load->view('admin/room_data/manage_row',['row'=>$row],true )?>

    </td>
    </tr>
    <?php endforeach ?>

</tbody>
