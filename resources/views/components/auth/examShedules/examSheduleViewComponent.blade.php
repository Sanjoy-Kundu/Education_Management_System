<style>
    .modal-header {
        background-color: #fafcff;
        color: rgb(56, 43, 43);
        padding: 20px;
    }

    .modal-title {
        font-weight: bold;
        font-size: 1.5rem;
    }

    .institute-name {
        font-size: 1.2rem;
        margin-top: 10px;
    }

    .exam-year {
        font-size: 1rem;
        margin-top: 5px;
    }

    .table-custom {
        width: 100%;
        border-collapse: collapse;
    }

    .table-custom th,
    .table-custom td {
        padding: 12px;
        text-align: center;
        border: 1px solid #dee2e6;
    }

    .table-custom th {
        background-color: #8b939a;
        color: white;
    }

    .table-custom tbody tr:nth-child(odd) {
        background-color: #f8f9fa;
    }

    .table-custom tbody tr:hover {
        background-color: #e9ecef;
    }

    .instructions {
        margin-top: 20px;
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 5px;
        border: 1px solid #dee2e6;
    }

    .instructions h5 {
        color: #343a40;
        margin-bottom: 10px;
    }

    .instructions ul {
        list-style-type: disc;
        padding-left: 20px;
    }

    .instructions ul li {
        margin-bottom: 5px;
    }

    .logo {
        width: 100px;
        height: auto;
        margin-bottom: 10px;
    }
</style>

<div class="modal fade" id="examSheduleRoutineViewModal" tabindex="-1" aria-labelledby="examSheduleRoutineViewModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <!-- Exam Details -->

                <div class="mt-2">
                    <h1 class="modal-title fs-5" id="examSheduleRoutineViewModalLabel">Professional Certificate
                        Examination</h1>
                    <h2 class="institute-name">Institute Name: Learning Management System</h2>
                    <h5 class="shedule-year">Exam Year: <span>{{ date('Y') }}</span></h5>
                    <h5 class="shedule-date"> Date: <span id="sheduleDate"></span></h5>
                    <h5 class="shedule-time"> Time: <span id="sheduleTime"></span></h5>
                </div>
                <img src="{{ asset('assets/logo/logo.png') }}" alt="Logo" class="logo"
                    style="height: 70px; width:70px; border-radius: 50%; margin-left: 20px;">
            </div>
            <div class="modal-body">
                <!-- Dynamic Table for Routine -->
                <div>
                    <h4>Exam Shedule of Class <span id="className"></span></h4>
                    <input type="number" name="class_id" id="classId">
                </div>
                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th scope="col">No:</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Subject Code</th>
                                <th scope="col">Exam Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Marks</th>
                            </tr>
                        </thead>
                        <tbody id="routineTableBody">
                            <!-- Data will be populated here dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="downloadPdfButton">Download PDF</button>
            </div>
        </div>
    </div>
</div>

<script>
    async function examSheduleRoutineView(id) {
        try {
            let res = await axios.get('/exam-schedule-lists-by-class-id/' + id);
            if (res.data.status === 'success') {
                let exam_schedules = res.data.exam_schedules;
                let routineTableBody = document.getElementById('routineTableBody');
                routineTableBody.innerHTML = ''; // Clear previous data

                document.getElementById('className').innerText = exam_schedules[0].student_class.name ?
                    exam_schedules[0].student_class.name : "Not Found";
                document.getElementById('classId').value = exam_schedules[0].student_class.id;

                if (exam_schedules.length === 0) {
                    routineTableBody.innerHTML = `
                          <tr>
                              <td colspan="6" class="text-center text-primary">No data found</td>
                          </tr>
                      `;
                } else {
                    exam_schedules.forEach((exam_schedule, index) => {
                        let row = `
                              <tr>
                                  <td>${index + 1}</td>
                                  <td>${exam_schedule.subject.name}</td>
                                  <td>${exam_schedule.sub_subject.sub_subject_code}</td>
                                  <td>${exam_schedule.exam_date}</td>
                                  <td>${formatTimeBD(exam_schedule.start_time)} - ${formatTimeBD(exam_schedule.end_time)}</td>
                                  <td>${exam_schedule.sub_subject.full_marks}</td>
                              </tr>
                          `;
                        routineTableBody.innerHTML += row;
                    });
                }
            } else {
                console.error("Error fetching data:", res.data.message);
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }

    // Function to format time in 12-hour format
    function formatTimeBD(time) {
        if (!time) return 'N/A';
        const [hour, minute, second] = time.split(':');
        let h = parseInt(hour);
        const ampm = h >= 12 ? 'PM' : 'AM';
        h = h % 12 || 12;
        return `${h}:${minute} ${ampm}`;
    }



    // Current date
    const currentDate = new Date().toLocaleDateString();
    document.getElementById("sheduleDate").textContent = currentDate;

    // Current time
    const currentTime = new Date().toLocaleTimeString();
    document.getElementById("sheduleTime").textContent = currentTime;



    // document.getElementById('downloadPdfButton').addEventListener('click', async function() {
    //     let student_class_id = document.getElementById('classId').value;
    //     console.log(student_class_id);
    //     if (student_class_id) {
    //         try {
    //             let res = await axios.post(`/download-exam-schedule/{student_class_id:student_class_id}`);
    //             console.log(res.data.exam_schedules);
    //         } catch (error) {
    //             console.error('Error downloading PDF:', error.response?.data?.message || error.message);
    //         }
    //     } else {
    //         console.log("Class ID not found");
    //     }
    // });
</script>
