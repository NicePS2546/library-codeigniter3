<link rel="stylesheet" href="<?= base_url('public/assets/css/form_room.css') ?>?v=<?= time() ?>">

<style>

</style>



<div class="container mt-4">
    <h1 class="text-center"><?= $row ?  'แก้ไขข้อมูล' : 'เพิ่มข้อมูลห้อง' ?></h1>
    <div class="row">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 p-4 bg-light">
                <div class="card-body bg-light">
                    <div>

                        <!-- Room Number & Status -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="r_numb">หมายเลขห้อง</label>
                                    <input id="r_numb" type="text" name="r_numb" value="<?= $row['r_number'] ?>"
                                        class="form-control" placeholder="โปรดใส่หมายเลขห้อง" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">สถานะห้อง</label>
                                    <select name="r_status" id="status"
                                        class="form-control text-center <?= ($row['r_status'] == 1) ? 'text-success' : 'text-danger' ?>">
                                        <option class="text-success" value="1" <?= ($row['r_status'] == 1) ? 'selected' : ''; ?>>เปิด</option>
                                        <option class="text-danger" value="0" <?= ($row['r_status'] == 0) ? 'selected' : ''; ?>>ปิด</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Room Description -->
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="r_desc">คำอธิบายห้อง</label>
                                    <textarea id="r_desc" name="r_desc" class="form-control"
                                        placeholder="โปรดใส่คำอธิบายห้อง" cols="3" rows="3"
                                        ><?= $row['r_desc'] ?></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Room Closing Description -->
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="r_close_desc">คำอธิบายปิดห้อง</label>
                                    <textarea id="r_close_desc" name="r_close_desc" class="form-control"
                                        placeholder="ใส่คำอธิบายหากมีการปิดห้อง" cols="3"
                                        rows="3"><?= $row['r_close_desc'] ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="form_message">อัพโหลดรูปภาพ</label>
                                    <input type="file" name="img" class="form-control" accept="image/*"
                                        onchange="previewImage(event)">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="form_message">รูปที่จะอัพโหลด</label>
                                    <img id="preview" src="<?= base_url("public/assets/img/room_img/" . $row['r_img']) ?>"
                                        class="img-fluid border border-1 border-dark rounded-2">
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-success btn-block"><?= $row ?  'แก้ไข' : 'เพิ่ม' ?></button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            preview.style.display = 'none';
        }
    }
</script>

















<!-- <div class="card card-shadow">
    <div class="card-body">
   <div class="top-body">
    <div class="text-start">
    <label class="form-label pl-1" for="r_number">หมายเลขห้อง</label>
    <input type="text" class="form-control custom-input" value="<?= $row['r_number'] ?>" name="r_number" id="r_number">
    <div id="result" class="mt-4 mb-2">

    </div>

</div>
<div class="text-start">
    <label class="form-label" for="status">สถานะห้อง</label>
    <select name="r_status" id="status" class="form-control <?= ($row['r_status'] == 1) ? 'text-success' : 'text-danger' ?>">
    <option class="text-success" value="1" <?= ($row['r_status'] == 1) ? 'selected' : ''; ?>>เปิด</option>
    <option class="text-danger" value="0" <?= ($row['r_status'] == 0) ? 'selected' : ''; ?>>ปิด</option>
</select>
</div>
<div id="results" class="mt-3">
   
</div>
</div>

<div class="text-start">
    <label class="form-label" for="time_slot">เลือกช่วงเวลา:</label>
    <textarea class="form-control">

    </textarea>
</div>
<button class="btn mt-4 btn-primary" id="reservBtn" type="submit">แก้ไข</button>
</div>
</div> -->