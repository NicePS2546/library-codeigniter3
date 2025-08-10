<?php

$music = $statistic['music'];
$vdo = $statistic['vdo'];
$mini = $statistic['mini'];
$card_res = "col-12 col-sm-2 col-md-2 col-lg-1";
?>



<style>
    .fc-event-title {
        color: black !important;
    }

    #calendar {
        max-width: 800px;
        margin: auto;
    }

    .fc-daygrid-day-holiday {
        background-color: #f8d7da !important;
    }
</style>

<style>
    .fixed-height {
        min-height: 100vh;
    }

    .chart-container {
        display: flex;
        justify-content: center;
    }

    .type-selector {
        display: flex !important;

        align-items: center;
    }

    @media (min-width: 992px) {

        /* Large devices (lg) and up */
        .col-md-2 {
            flex: 0 0 7% !important;
            max-width: 7% !important;
        }

        .col-lg-1 {
            flex: 0 0 10% !important;
            max-width: 10% !important;
        }

        .col-sm-2 {
            flex: 0 0 10% !important;
            max-width: 10% !important;
        }
    }

    @media (max-width: 575px) {
        /* Large devices (lg) and up */

        .col-md-2 {
            flex: 0 0 20% !important;
            max-width: 20% !important;
        }

        .col-sm-2 {
            flex: 0 0 20% !important;
            max-width: 20% !important;
        }
    }

    @media (max-width: 450px) {
        /* Large devices (lg) and up */

        .col-md-2 {
            flex: 0 0 30% !important;
            max-width: 30% !important;
        }

    }

    .info-box-icon {
        position: relative;
        transition: all 0.5s ease-in-out;
    }


    .info-box-icon::after {
        content: attr(data-label);
        position: absolute;
        bottom: 120%;

        left: 50%;
        transform: translateX(-50%);
        background: rgba(0, 0, 0, 0.75);
        color: #fff;
        padding: 6px 10px;
        border-radius: 4px;
        font-size: 14px;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease-in-out;
    }


    .info-box-icon:hover::after {
        opacity: 1;
        visibility: visible;
        transition: all 0.5s ease-in-out;
    }
</style>


<!-- FullCalendar -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales-all.global.min.js"></script>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>



<div class="info-box">
    <div class="info-box-content title-container">
        <span class="info-box-text font-title"><?= $title ?></span>
        <div class="my-auto">
            <button class="btn my-auto btn-primary fetch-btn" id="fetch-btn"
                style="width:180px">ดึงวันหยุดจากปฏิทิน</button>
            <a href="<?= base_url('index.php/admin/system/date/holiday/table') ?>" class="btn my-auto btn-primary" style="width:120px" 
                >ตารางวันหยุด</a>
        </div>

    </div>
</div>



<div id="calendar"></div>







<!-- 🔵 Modal วันปกติ -->
<div class="modal fade" id="normalDayModal" tabindex="-1" aria-labelledby="normalDayLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="normalDayLabel">วันปกติ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="ปิด"></button>
            </div>
            <div class="modal-body" id="normalDayContent">
                ...
            </div>
        </div>
    </div>
</div>

<!-- 🔴 Modal วันหยุด -->
<div class="modal fade" id="holidayModal" tabindex="-1" aria-labelledby="holidayLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="holidayLabel">วันหยุด</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="ปิด"></button>
            </div>
            <div class="modal-body" id="holidayContent">
                ...
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('public/cdn/jQuery/jquery-3.7.1.js') ?>"></script>

<script>

    document.addEventListener('DOMContentLoaded', function () {
        const calendarId = 'th.th#holiday@group.v.calendar.google.com';
        const api_key = '';
        const now = new Date();
        const yearStart = new Date(now.getFullYear(), 0, 1).toISOString();
        const yearEnd = new Date(now.getFullYear(), 11, 31).toISOString();
        const table_url = '';
        const calendarEl = document.getElementById('calendar');

        let holidayDates = [

        ];

        const get_data_from_table = async () => {
            const res = await fetch(table_url);
            if (res.ok) {
                const data = await res.json();
            }
        }


        const fetchHolidayFromTable = async () => {
            const res = await fetch(`<?= base_url("index.php/admin/system/date/holiday/get/table") ?>`)
            if (res.ok) {
                const data = await res.json();

                if (data.items) {
                    const holidays = data.items.map(events => ({
                        title: events.title,
                        date: events.date,
                        color: events.color
                    }))
                    holidayDates = holidayDates.concat(holidays);
                    calendar.removeAllEvents();
                    calendar.addEventSource(holidayDates);


                }
            }
        }

        

        const calendar = new FullCalendar.Calendar(calendarEl, {
            buttonText: {
                today: 'วันนี้'  // change 'today' button text
            },
            locale: 'th',
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: ''
            },
            events: holidayDates,
            dateClick: function (info) {
                const isHoliday = holidayDates.find(h => h.date === info.dateStr);

                if (isHoliday) {
                    document.getElementById('holidayContent').innerHTML = `
          <p><strong>${isHoliday.title}</strong></p>
          <p>วันที่: ${info.dateStr}</p>
        `;
                    new bootstrap.Modal(document.getElementById('holidayModal')).show();
                } else {
                    document.getElementById('normalDayContent').innerHTML = `
          <p>คุณคลิกวันที่: ${info.dateStr}</p>
          <p>นี่คือวันปกติ</p>
        `;
                    new bootstrap.Modal(document.getElementById('normalDayModal')).show();
                }
            }
        });
        fetchHolidayFromTable();
        calendar.render();

       

        async function confirmAndSubmit() {
            const result = await Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                text: 'คุณแน่ใจใหมว่าจะดึงข้อมูลวันหยุดจากปัฏิทิน ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'ใช่',
                cancelButtonText: 'ยกเลิก',
            });

            if (result.isConfirmed) {
                // const holidays = await fetchHoliday();

                // holidayDates = holidayDates.concat(holidays);
                // calendar.removeAllEvents();
                // calendar.addEventSource(holidayDates);
                // console.log(holidays);

                // สร้างฟอร์มและส่ง
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '<?= base_url("index.php/admin/system/date/holiday/get/api") ?>';

                document.body.appendChild(form);
                form.submit();
            }
        }

        // เรียกใช้งาน
        document.getElementById("fetch-btn").addEventListener("click", confirmAndSubmit);
    });
</script>
