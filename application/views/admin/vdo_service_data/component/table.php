<thead class="table-light">
    <tr>
        <th>No.</th>
        <th>รหัสผู้ใช้</th>
        <th>ชื่อ-นามสกุลผู้ใช้</th>
        <th>บทบาท</th>
        <th>สถานะ</th>
        <th>จัดการ</th>
    </tr>
</thead>
<tbody>
    <?php
    $no = 0;

    foreach ($rows as $row) :
        $status = $row['admin_status'] == 1 ? 'เปิดใช้งาน': 'ปิดใช้งาน';
        $status_color = $row['admin_status'] == 1 ? 'text-success': 'text-danger';
        $no++;
        echo "<tr>
                    <td>$no</td>
                    <td>" . $row['user_id'] . "</td>
                    <td>" . $row['fullname'] . "</td>
                    <td>" . $row['role']. "</td>
                    <td class = '$status_color' >" . $status  . "</td>
                  
                ";
    
    ?>
    <td >
        <?= $this->load->view('admin/admin_data/manage_row',['row'=>$row],true )?>

    </td>
    </tr>
    <?php endforeach ?>

</tbody>
