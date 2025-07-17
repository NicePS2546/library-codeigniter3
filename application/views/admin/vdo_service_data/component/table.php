


<thead class="table-light">
    <tr>
        <th>No.</th>
        <th>รูปภาพ</th>
        <th>รหัส</th>
        <th>รูปแบบ</th>
        <th>ชื่อไทย</th>
        <th>ชื่ออังกฤษ</th>
        <th>คำอธิบาย</th>
        
        <th>จัดการ</th>
    </tr>
</thead>
<tbody>
    <?php
    $no = 0;

    foreach ($rows as $row) :
       $desc = $row['s_desc'] ? $row['s_desc'] : 'ยังไม่ได้ใส่';
        $no++;
        echo "<tr>
                    <td>$no</td>
                   <td><img heigh='50px' width='50px' class='img-fluid rounded' src='" . base_url('public/assets/img/service_img/') . $row['s_picture'] . "'></td>
                    <td>" . $row['service_id'] . "</td>
                    <td>" . $row['s_type']. "</td>
                    <td>" . $row['name_TH']. "</td>
                    <td>" . $row['name_EN']. "</td>
                    <td>" . $desc. "</td>
                   
                  
                ";
    
    ?>
    <td >
        <?= $this->load->view('admin/vdo_service_data/component/manage_row',['row'=>$row],true )?>

    </td>
    </tr>
    <?php endforeach ?>

</tbody>
