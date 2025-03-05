
<thead class="table-light">
    <tr>
        <th>No.</th>
        <th>รหัสผู้ใช้</th>
        <th>ชื่อ-นามสกุลผู้ใช้</th>
        <th>บริการ</th>
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
     $u_data = $find_sso_data(array_column($rows, 'st_id'));
     
     foreach ($rows as $row) :
        $data = $typeModel->get_by_id($row['r_s_id']);
        $service_name = $data['type'];
        $fullname = isset($u_data[$row['st_id']]) ? $u_data[$row['st_id']] : 'Unknown'; // Fetch the full name from the result
         
         // Store fullname in the correct entry inside the array
         $row['fullname'] = $fullname;
 
         $no++;
        echo "<tr>
                    <td>$no</td>
                    <td>" . $row['st_id'] . "</td>
                    <td>" . $row['fullname'] . "</td>
                    <td>$service_name</td>
                    <td>" . $row['r_number'] . "</td>
                    <td>" . $row['total_pp'] . " คน</td>
                    <td>" . $row['start_time'] . "</td>
                    <td>" . $row['exp_time'] . "</td>
                    <td>" . $row['r_date'] . "</td>
                    
                ";
    
    ?>
    <td class="<?= $row['r_verify'] == 1 ? 'text-success' : 'text-danger'?>"><?= ($row['r_verify'] == 1 ? '<i class="bi bi-check-lg"></i>' : '<i class="bi bi-x-lg"></i>') ?></td>
    <td>
        <?= $this->load->view('history/manage_row',['row'=>$row],true )?>

    </td>
    </tr>
    <?php endforeach ?>

</tbody>