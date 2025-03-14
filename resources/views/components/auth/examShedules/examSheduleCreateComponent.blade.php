<div class="modal fade" id="examSheduleModal" tabindex="-1" aria-labelledby="examSheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Your Exam Shedule</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="examSheduleForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Exam Name</label>
                        <input type="text" name="exam" id="exam_name" class="form-control" placeholder="Enter Exam Name">
                        <div id="exam_name_error" class="text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="select-class-lists" class="form-label">Select Your Class</label>
                        <select class="form-select" id="select-class-lists" name="student_class_id">
                        </select>
                        <div id="shedule_class_name_error" class="text-danger"></div>
                    </div>

                    <div class="mb-3">
                        <label for="select-class-lists" class="form-label">Select Your Subject</label>
                        <select class="form-select" id="select-subject-lists" name="subject_id">
                        </select>
                        <div id="shedule_subject_name_error" class="text-danger"></div>
                    </div>

                    <div class="mb-3 d-none" id="sub-subject-group-section">
                        <label for="suject_name" class="form-label">Sub Subject</label>
                        <div class="sub-group-section" id="select-sub-subject-lists">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="subject_code" class="form-label">Exam Date</label>
                        <input type="date" class="form-control" id="exam_date" name="exam_date">
                        <div id="shedule_exam_date_error" class="text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="subject_fullmarks" class="form-label">Exam Starting Time</label>
                        <input type="time" class="form-control" id="starting_time" placeholder="Enter Full Marks" name="start_time">
                        <div id="shedule_start_time_error" class="text-danger"></div>
                    </div>

                    <div class="mb-3">
                        <label for="subject_fullmarks" class="form-label">Exam Ending Time</label>
                        <input type="time" class="form-control" id="ending_time" placeholder="Enter Full Marks" name="end_time">
                        <div id="shedule_end_time_error" class="text-danger"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="uploadExam(event)">Upload Exam</button>
            </div>
        </div>
    </div>
</div>

<script>
    let examSheduleCreateToken = localStorage.getItem('authToken');
    if(!examSheduleCreateToken){
        window.location.href = '/login';
    }
    // Fetch class lists
    ClassSelectLists();
    async function ClassSelectLists() {
        try {
     // Fetch class lists from the server
     let res = await axios.get('/student-class-lists',{
        headers:{
            Authorization:`Bearer ${examSheduleCreateToken}`
        }
     });
        let lists = res.data.classLists;

        // Get the select element for class lists
        let listSectionBody = $('#select-class-lists');
        listSectionBody.empty(); // Clear previous data

        let defaultOption = `<option value="" selected>Select One</option>`;
        if (lists.length === 0) {
            defaultOption = `<option value="" selected>No Class Found</option>`;
        }
        listSectionBody.append(defaultOption);
        
            lists.forEach((element) => {
                let option = `<option value="${element.id}">${element.name}</option>`;
                listSectionBody.append(option);
            });
        } catch (error) {
            console.error('Error fetching class lists:', error);
        }
    }

    // Fetch subject lists
    $("#select-class-lists").on("change", async function() {
        let student_class_id = $(this).val();

        try {
            let res = await axios.post('/subject-lists-by-class-id', {student_class_id: student_class_id},{
                headers: {
                    Authorization: `Bearer ${examSheduleCreateToken}`,
                    'Content-Type': 'application/json'
                }
            });
            let lists = res.data.subjectLists;
            let listSectionBody = $('#select-subject-lists');
            listSectionBody.empty(); // Clear previous data

            if (lists.length === 0) {
                let defaultOption = `<option value="" selected>Subject Not Found</option>`;
                listSectionBody.append(defaultOption);
                return;
            }

            let defaultOption = `<option value="" selected>Select One</option>`;
            listSectionBody.append(defaultOption);
            lists.forEach((element) => {
                let option = `<option value="${element.id}">${element.name}</option>`;
                listSectionBody.append(option);
            });
        } catch (error) {
            console.error('Error fetching subject lists:', error);
        }
    });

    // Fetch sub-subject lists
    $('#select-subject-lists').on('change', async function() {
        let subject_id = $(this).val();
        try {
            let res = await axios.post('/sub-subject-lists-by-subject-id', { subject_id: subject_id },{
                headers: {
                    Authorization: `Bearer ${examSheduleCreateToken}`,
                    'Content-Type': 'application/json'
                }
            });
            if (res.data.status === 'success') {
                document.querySelector('#sub-subject-group-section').classList.remove('d-none');
                let lists = res.data.sub_subjects_lists;
                let listSectionBody = $('#select-sub-subject-lists');
                listSectionBody.empty(); // Clear previous data

                if (lists.length === 0) {
                    let defaultOption = `   
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="inlineRadio1">
                                <input type="radio" name="sub_subject_id" class="form-check-input" value="0" checked> No Sub Subject Found
                            </label>
                        </div>`;
                    listSectionBody.append(defaultOption);
                    return;
                }

                lists.forEach((element) => {
                    let isCheck; 
                    if (element.sub_subject_name === "null") {
                        isCheck = 'checked';
                    } else {
                        isCheck = '';
                    }
                    let subSubjectChecked = element.sub_subject_name ? '' : 'checked';
                    let radio = `
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sub_subject_id" id="radio_sub_subject_name_${element.id}" value="${element.id}" ${isCheck}>
                            <label class="form-check-label" for="radio_sub_subject_name_${element.id}">${element.sub_subject_name? element.sub_subject_name : 'According to the Subject'}</label>
                        </div>
                    `;
                    listSectionBody.append(radio);
                });
            }
        } catch (error) {
            console.error('Error fetching sub-subject lists:', error);
        }
    });

    // Upload Exam Function
    async function uploadExam(event) {
        event.preventDefault();
        document.getElementById('exam_name_error').innerText = '';
        document.getElementById('shedule_class_name_error').innerText = '';
        document.getElementById('shedule_subject_name_error').innerText = '';
        document.getElementById('shedule_exam_date_error').innerText = '';
        document.getElementById('shedule_start_time_error').innerText = '';
        document.getElementById('shedule_end_time_error').innerText = '';

        let name = document.getElementById('exam_name').value;
        let student_class_id = document.getElementById('select-class-lists').value;
        let subject_id = document.getElementById('select-subject-lists').value;
        let exam_date = document.getElementById('exam_date').value;
        let start_time = document.getElementById('starting_time').value;
        let end_time = document.getElementById('ending_time').value;
        let sub_subject_id = document.querySelector('input[name="sub_subject_id"]:checked')?.value || 0;

        let isError = false;

        if (!student_class_id) {
            document.getElementById('shedule_class_name_error').innerText = 'Please select a class';
            isError = true;
        }
        if (!subject_id) {
            document.getElementById('shedule_subject_name_error').innerText = 'Please select a subject';
            isError = true;
        }
        if (!name) {
            document.getElementById('exam_name_error').innerText = 'Please enter exam name';
            isError = true;
        }
        if (!exam_date) {
            document.getElementById('shedule_exam_date_error').innerText = 'Please enter exam date';
            isError = true;
        }
        if (!start_time) {
            document.getElementById('shedule_start_time_error').innerText = 'Please enter exam starting time';
            isError = true;
        }
        if (!end_time) {
            document.getElementById('shedule_end_time_error').innerText = 'Please enter exam ending time';
            isError = true;
        }
        if (isError) return;

        let data = {
            student_class_id: student_class_id,
            subject_id: subject_id,
            sub_subject_id: sub_subject_id,
            name: name,
            exam_date: exam_date,
            start_time: start_time,
            end_time: end_time
        };

        console.log("Data to be sent to server:", data);

        try {
        

            let res = await axios.post('/exam-schedule-post', data, {
                headers: {
                    Authorization: `Bearer ${examSheduleCreateToken}`,
                    'Content-Type': 'application/json'
                }
            });

            if (res.data.status === 'success') {
                await getExamSheduleListsShow(); 
                $('#examSheduleModal').modal('hide');

                Swal.fire({
                    title: 'Success!',
                    text: res.data.message,
                    icon: 'success',
                    timer: 3000
                });

                document.getElementById('examSheduleForm').reset();
            } else {
                document.getElementById('shedule_class_name_error').innerText = res.data.message;
                document.getElementById('shedule_subject_name_error').innerText = res.data.message;
                document.getElementById('exam_name_error').innerText = res.data.message;
                document.getElementById('shedule_exam_date_error').innerText = res.data.message;
                document.getElementById('shedule_start_time_error').innerText = res.data.message;
                document.getElementById('shedule_end_time_error').innerText = res.data.message;
            }
        } catch (error) {
            console.error('Error uploading exam:', error);

            if (error.message === 'No token found in localStorage') {
                Swal.fire({
                    title: 'Error!',
                    text: 'You are not authenticated. Please login again.',
                    icon: 'error',
                    timer: 3000
                });
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while uploading the exam schedule.',
                    icon: 'error',
                    timer: 3000
                });
            }
        }
    }
</script>