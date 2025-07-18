<thead class="table-light">
    <tr>
        <th>No.</th>
        <th>เวลาเปิดระบบ</th>
        <th>เวลาปิดระบบ</th>
        <th>จัดการ</th>
    </tr>
</thead>
<tbody>
    <?php

    $no = 0;

    foreach ($rows as $row):
        $no++;
        echo "<tr>
                    <td>$no</td>
                    <td>" . $row['start_sys_time'] . "</td>
                    <td>" . $row['end_sys_time'] . "</td>      
                  
                ";

        ?>
        <td>
            <?= $this->load->view('admin/time_system_setting/manage_row', ['row' => $row], true) ?>

        </td>
        </tr>
    <?php endforeach ?>

</tbody>