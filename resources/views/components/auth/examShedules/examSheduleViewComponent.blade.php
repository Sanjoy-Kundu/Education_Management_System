<style>
    .modal-header {
        background-color: #7b8794;
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
                    <h5 class="shedule-year">Exam Year: <span id="sheduleYear"></span></h5>
                    <h5 class="shedule-date"> Date: <span id="sheduleDate"></span></h5>
                    <h5 class="shedule-time"> Time: <span id="sheduleTime"></span></h5>
                </div>
                <img src="{{asset('assets/logo/logo.png')}}" alt="Logo" class="logo" style="height: 70px; width:70px; border-radius: 50%; margin-left: 20px;">
            </div>
            <div class="modal-body">
                <!-- Dynamic Table for Routine -->
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

                <!-- Instructions -->
                <div class="instructions">
                    <h5>Instructions:</h5>
                    <ul>
                        <li>Entry in the Exam Center will be from 9 AM to 10 AM only. No candidate shall be allowed
                            thereafter.</li>
                        <li>Candidate is advised to carry only BLR/ROYAL BLUE BALL POINT/GEL/FOUNTAIN pen.</li>
                        <li>Candidate is advised to carry only permissible items at the examination center as given in
                            Admit Card.</li>
                        <li>Candidate will only appear in subjects offered by him/her.</li>
                        <li>Candidate should occupy the seat allotted to him/her against the roll number.</li>
                        <li>Candidate should read the instructions carefully given in Answer Book and Question Paper.
                        </li>
                        <li>Candidate should fill in relevant and correct details in Answer Book and Question Paper.
                        </li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="uploadExam(event)">Download PDF</button>
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

                // Set dynamic exam year
                document.getElementById('sheduleYear').innerText = res.data.exam_year || '2021';

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

    // Current year
    const currentYear = new Date().getFullYear();
    document.getElementById("sheduleYear").textContent = currentYear;

    // Current date
    const currentDate = new Date().toLocaleDateString();
    document.getElementById("sheduleDate").textContent = currentDate;

    // Current time
    const currentTime = new Date().toLocaleTimeString();
    document.getElementById("sheduleTime").textContent = currentTime;
</script>
