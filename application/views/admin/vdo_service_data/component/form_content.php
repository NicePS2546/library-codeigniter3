<link rel="stylesheet" href="<?= base_url('public/assets/css/form_room.css') ?>?v=<?= time() ?>">

<style>

</style>

<?php print_r($row) ?>

<div class="container mt-4">
    <?php if($row): ?>
    <h1 class="text-center">แก้ไขข้อมูล <?= $row['name_TH'] ?></h1>
    <?php endif ?>
    <h1 class="text-center">เพิ่มข้อมูล</h1>
    <div class="row">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 p-4 bg-light">
                <div class="card-body bg-light">
                    <div>
                        <!-- Room Number & Status -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="service_id">หมายเลขรหัส</label>
                                    <input id="service_id" type="text" name="service_id" value="<?= $row['service_id'] ?>"
                                        class="form-control" placeholder="โปรดใส่หมายเลขห้อง" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name_EN">ชื่ออังกฤษ</label>
                                    <input name="name_EN" value="<?= $row['name_EN'] ?>" id="name_EN"
                                        class="form-control text-center "/>
                                        
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name_TH">ชื่อภาษาไทย</label>
                                    <input id="name_TH" type="text" name="name_TH" value="<?= $row['name_TH'] ?>"
                                        class="form-control" placeholder="โปรดใส่หมายเลขห้อง" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="s_type">รูปแบบ</label>
                                    <input name="s_type" value="<?= $row['s_type'] ?>" id="s_type"
                                        class="form-control text-center "/>
                                        
                                    
                                </div>
                            </div>
                        </div>
                      
                        <!-- Room Description -->
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="s_desc">คำอธิบายห้อง</label>
                                    <textarea id="s_desc" name="s_desc" class="form-control"
                                        placeholder="โปรดใส่คำอธิบายห้อง" cols="3" rows="3"
                                        ><?= $row['s_desc'] ?></textarea>
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
                                    <img id="preview" src="<?= base_url("public/assets/img/service_img/" . $row['s_picture']) ?>"
                                        class="img-fluid border border-1 border-dark rounded-2">
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-success btn-block">เพิ่ม</button>
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
















