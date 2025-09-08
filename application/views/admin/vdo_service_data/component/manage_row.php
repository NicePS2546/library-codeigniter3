<div class="d-flex  justify-content-center align-items-center gap-2 ">
            

            <a href="<?= base_url("index.php/admin/video/service/edit/". $row['service_id'] ) ?>" class="btn btn-primary">
            <i class="bi bi-gear"></i>
            </a>

            <div style="display:inline;">
               

                <button type="button" class="btn btn-danger btn-action delete-button"
                    data-service-id="<?= $row['service_id']; ?>" data-service-name="<?= $row['name_TH']; ?>"  ><i class="bi bi-x-square" ></i></button>
            </div>
        </div>



