<thead class="table-light">
    <tr>
        <th>บริการ</th>
        <th>รหัสผู้ใช้</th>
        <th>จำนวนผู้เข้าใช้งาน</th>
        <th>จัดการ</th>
    </tr>
</thead>
<tbody>
    <?php
    $no = 0;
    foreach ($rows as $row) :
        $type = $get_type($row['r_s_id']);
        $no++;
        echo "<tr>
                    <td>$type</td>
                    <td>" . $row['st_id'] . "</td>
                    <td>" . $row['total_pp'] . " คน</td>
                ";
    
    ?>
    <td >
        <?= $this->load->view('admin/component/outdate/manage_room',['row'=>$row],true )?>

    </td>
    </tr>
    <?php endforeach ?>

</tbody>