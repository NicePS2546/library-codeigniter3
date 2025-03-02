<thead class="table-light">
    <tr>
        <th>No.</th>
        <th>รหัสผู้ใช้</th>
        <th>ชื่อ-นามสกุลผู้ใช้</th>
        <th>หมายเลขห้อง</th>
        <th>จำนวนผู้เข้าใช้งาน</th>
        <th>เวลาเริ่ม</th>
        <th>หมดเวลา</th>
        <th>วันที่จอง</th>
        <th>สถานะ</th>
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
                    <td>" . $row['st_id'] . "</td>
                    <td>" . $row['fullname'] . "</td>
                    <td>" . $row['r_number'] . "</td>
                    <td>" . $row['total_pp'] . " คน</td>
                    <td>" . $row['start_time'] . "</td>
                    <td>" . $row['exp_time'] . "</td>
                    <td>" . $row['r_date'] . "</td>
                    <td class='text-success'>" . ($row['r_verify'] ? "ยืนยันแล้ว" : "ยังไม่ยืนยัน") . "</td>
                ";
    
    ?>
    <td >
        <?= $this->load->view('admin/component/manage_row',['row'=>$row],true )?>

    </td>
    </tr>
    <?php endforeach ?>

</tbody>