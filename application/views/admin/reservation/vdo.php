<thead class="table-light">
    <tr>
        <th>หมายเลขห้อง</th>
        <th>รหัสผู้ใช้</th>
        <th>ชื่อ-นามสกุลผู้ใช้</th>

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


    foreach ($rows as $row):
        $no++;
        echo "<tr>
                   <td>" . $row['r_number'] . "</td>
                    <td>" . $row['st_id'] . "</td>
                    <td>" . $row['fullname'] . "</td>
                    <td>" . $row['total_pp'] . " คน</td>
                    <td>" . $row['start_time'] . "</td>
                    <td>" . $row['exp_time'] . "</td>
                    <td>" . $row['r_date'] . "</td>
                    
                ";

        ?>
        <td class="<?= $row['r_verify'] == 1 ? 'text-success' : 'text-danger' ?>">
            <?= ($row['r_verify'] == 1 ? '<i class="bi bi-check-lg"></i>' : '<i class="bi bi-x-lg"></i>') ?>
        </td>
        <td>
            <?= $this->load->view('admin/component/manage_row', ['row' => $row], true) ?>

        </td>
        </tr>
    <?php endforeach ?>

</tbody>