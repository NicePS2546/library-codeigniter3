<thead class="table-light">
    <tr>
        <th>No.</th>
        <th>ห้องบริการ</th>
        <th>เวลาเปิดเริ่ม</th>
        <th>หมดเวลา</th>
        <!-- <th>คำอธิบายปิดห้อง</th> -->
        <th>เวลาการจอง</th>
        <th>จัดการ</th>
    </tr>
</thead>
<tbody>
    <?php
    
    $no = 0;

    foreach ($rows as $row) :
        $service = $get_type($row['s_id']);  
        $no++;
        echo "<tr>
                    <td>$no</td>
                    <td>" . $service . "</td>
                    <td>" . $row['start_time'] . "</td>
                    <td>" . $row['end_time'] . "</td>
                    <td>" . $row['interval_hours'] . " ชั่วโมง</td>

                    
                  
                ";
    
    ?>
    <td >
        <?= $this->load->view('admin/time_setting/manage_row',['row'=>$row],true )?>

    </td>
    </tr>
    <?php endforeach ?>

</tbody>
