<link rel="stylesheet" href="<?= base_url() ?>public/cdn/bootstrap-icons.min.css"/>
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
        <th>หมายเหตุ</th>
    </tr>
</thead>
<tbody>
    <?php
    $deleted_by_admin ="<span class='info-box-icon text-bg-warning shadow-sm' data-label='ผู้ดูแลได้ทำการปิดห้องเนื่องจากออกก่อนเวลา'>
      ออกก่อนเวลา
      </span>";
    $deleted_by_user ="<span class='info-box-icon text-bg-warning shadow-sm' data-label='ห้องถุกยกเลิก'>
      ห้องถุกยกเลิก
      </span>";
    $expired ="<span class='info-box-icon text-bg-secondary shadow-sm' data-label='ห้องหมดเวลา'>
     หมดเวลา
      </span>";

    $no = 0;
    $u_data = $find_sso_data(array_column($rows, 'st_id'));

    foreach ($rows as $row) :
        $data = $typeModel->get_by_id($row['r_s_id']);
        $service_name = $data['type'];
        $fullname = isset($u_data[$row['st_id']]) ? $u_data[$row['st_id']] : 'Unknown'; // Fetch the full name from the result
        
        // Store fullname in the correct entry inside the array
        $row['fullname'] = $fullname;
        $select_icon = '';
        $no++;
        switch ($row['r_note']) {
            case 'deleted_by_admin':
                $select_icon = $deleted_by_admin;
                break;
            case 'deleted_by_user':
                $select_icon = $deleted_by_user;
                break;
            default:
               $select_icon = $expired;
                break;
        }
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
                    <td>$select_icon</td>
                    
                ";
    
    ?>

  
    </tr>
    <?php endforeach ?>

</tbody>