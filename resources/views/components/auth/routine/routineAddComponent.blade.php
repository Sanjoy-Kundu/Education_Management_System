<!-- Modal -->
<div class="modal fade" id="routineAddModal" tabindex="-1" aria-labelledby="routineModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-1" id="routineModalLabel"><span class="text-primary">MANAGE YOUR</span> <span
                        class="text-danger">CLASS ROUTINE</span> OF CLASS </h1>
                <p><input type="number" name="student_class_id" hidden class="form-control w-50" id="student_class_id">
                </p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <section id="routineContainer" class="p-2" style="width: 90%; margin:0 auto">
                    <!-- Default Routine Block -->
                    <div class="routine-block card shadow-sm p-3 mb-3">
                        <div class="card-header">
                            <h5>Routine Block - <span class="text-danger">1</span></h5>
                        </div>
                        <div class="card-body row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Subject</label>
                                <select class="form-select routine-subject" aria-label="Default select example"
                                    name="subject_id" id="routineSubjectSelect">
                                </select>
                                <span id="routineSubjectError" class="text-danger"></span>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Subject Paper</label>
                                <select class="form-select routine-subject-paper" aria-label="Default select example"
                                    name="sub_subject_id" id="routineSubjectPaperSelect">
                                    <option value="">Please Select Subject</option>
                                </select>
                                <span id="routineSubjectPaperError" class="text-danger"></span>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Day</label>
                                <select class="form-select routine-subject" aria-label="Default select example"
                                    name="day_id" id="routineDaySelect">
                                </select>
                                <span id="routineDayError" class="text-danger"></span>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Routine Date</label>
                                <input type="date" class="form-control" name="date" id="routineDate">
                                <span id="routineDateError" class="text-danger"></span>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Starting Time</label>
                                <input type="time" class="form-control" name="starting_time" id="startingTime">
                                <span id="routineStartingTimeError" class="text-danger"></span>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Ending Time</label>
                                <input type="time" class="form-control" name="ending_time" id="endingTime">
                                <span id="routineEndingTimeError" class="text-danger"></span>
                            </div>
                            <div class="col-3">
                                <button type="button" class="btn btn-primary" onclick="onRoutineSubmit(event)">ADD
                                    ROUTINE</button>
                            </div>
                        </div>
                    </div>


                    {{-- routine lists --}}
                    <div class="routine-block card shadow-sm p-3 mb-3">
                        <div class="card-header">
                            <h5>Routine Lists of Class 6</h5>
                        </div>
                        <div class="card-body row g-3">
                            <div class="col-md-12 col-sm-12 col-xs-12 col-xl-12">
                                <div class="col-md-6 mb-3 d-flex align-items-end gap-3">
                                    <div class="flex-grow-1">
                                        <label for="filterByDay" class="form-label fw-bold">Filter By Day</label>
                                        <select class="form-select routine-subject" name="day_id" id="filterByDay">
                                            <option value="" selected disabled>Choose a day</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-primary d-flex align-items-center px-3"
                                        id="pdfdownloadbutton">
                                        <i class="bi bi-download me-2"></i>
                                        <span class="dayNameForPdf">Routine Download PDF</span>
                                    </button>
                                </div>

                                <table class="table table-bordered" id="routineTableParent">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sri No.</th>
                                            <th scope="col">Day</th>
                                            <th scope="col">Subject Name</th>
                                            <th scope="col">Subject Paper</th>
                                            <th scope="col">Class Time</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="routineTableBody">
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to initialize the routine component
    async function fillRoutineComponent(student_class_id) {
        document.getElementById('student_class_id').value = student_class_id;

        await getUploadedRoutinelist(student_class_id);
        const selectElement = document.querySelector("#routineSubjectSelect");
        if (selectElement) {
            getSubjectLists_name_by_subject_id(selectElement);
        } else {
            console.error('Select element not found!');
        }
    }



    //get day name 
     routineDayLists();
    async function routineDayLists() {
        try {

            let res = await axios.get('/day-lists');
            let lists = res.data.dayLists;



            const daySelect = document.getElementById('routineDaySelect');


            daySelect.innerHTML = '';


            if (lists.length === 0) {
                document.getElementById('pdfdownloadbutton').style.display =
                    'none'; // Hide the button if no data is found
                // If no data found, add a default option
                let option = document.createElement('option');
                option.value = '';
                option.textContent = 'No data found';
                daySelect.appendChild(option);
            }

            let placeholderOption = document.createElement('option');
            placeholderOption.value = '';
            placeholderOption.textContent = 'Select a day';
            daySelect.appendChild(placeholderOption);


            lists.forEach((element) => {
                let option = document.createElement('option');
                option.value = element.id;
                option.textContent = element.name;
                daySelect.appendChild(option);
            });

        } catch (error) {
            console.error('Error fetching day lists:', error);
        }
    }






    // Get subject list and update select options
    async function getSubjectLists_name_by_subject_id(selectElement) {
        try {
            let student_class_id = document.getElementById('student_class_id').value;

            if (!student_class_id) {
                console.error('Student Class ID is missing!');
                return;
            }

            // Initial value
            selectElement.innerHTML = `<option value="">Choose your subject</option>`;

            let res = await axios.post('/subject-lists-by-class-name-routine', {
                student_class_id: student_class_id
            });
            let lists = res.data.subjects;

            selectElement.innerHTML = ""; // Clear previous data

            if (lists.length === 0) {
                selectElement.innerHTML = '<option>No Data Found</option>';
            } else {
                // Add placeholder
                const placeholderOption = document.createElement("option");
                placeholderOption.value = "";
                placeholderOption.textContent = "Choose your subject";
                selectElement.appendChild(placeholderOption);

                // Add subjects
                let uniqueNames = new Set();
                lists.forEach(element => {
                    if (!uniqueNames.has(element.name)) {
                        uniqueNames.add(element.name);
                        let option = document.createElement("option");
                        option.value = element.id;
                        option.textContent = element.name;
                        selectElement.appendChild(option);
                    }
                });
            }

            // Add event listener to the subject select element
            selectElement.addEventListener("change", function() {
                const subjectId = this.value;
                const subjectPaperSelect = this.closest(".routine-block").querySelector(
                    ".routine-subject-paper");
                getSubjectPapers(subjectId, subjectPaperSelect);
            });

        } catch (error) {
            console.error('Error fetching subject lists:', error);
        }
    }

    // Get subject papers and update select options
    async function getSubjectPapers(subjectId, selectElement) {
        try {
            if (!subjectId) {
                selectElement.innerHTML = '<option value="">Please Select Subject</option>';
                return;
            }

            let res = await axios.post('/subject-papers-by-subject-id', {
                subject_id: subjectId
            });
            let papers = res.data.papers;


            selectElement.innerHTML = ""; // Clear previous data

            if (papers.length === 0) {
                // If no papers found, set value to "none"
                selectElement.innerHTML =
                    '<option value="none" selected style="color: red;">No Papers Found</option>';
            } else {
                // Add placeholder
                const placeholderOption = document.createElement("option");
                placeholderOption.value = "";
                placeholderOption.textContent = "Select your paper";
                selectElement.appendChild(placeholderOption);

                // Add papers
                papers.forEach(element => {
                    let option = document.createElement("option");
                    option.value = element.id;
                    option.textContent = element.sub_subject_name === 'null' ? 'No paper found' : element
                        .sub_subject_name;

                    if (option.textContent === 'No paper found') {
                        option.selected = true;
                        option.disabled = true;
                        option.style.color = 'red';
                    } else {
                        option.style.color = 'blue';
                    }
                    selectElement.appendChild(option);
                });
            }
        } catch (error) {
            console.error('Error fetching subject papers:', error);
        }
    }


    let routineTable;
    // Handle form submission
    async function onRoutineSubmit(event) {
        event.preventDefault();

        // Clear error messages and reset border colors
        document.getElementById('routineSubjectError').innerText = '';
        document.getElementById('routineSubjectPaperError').innerText = '';
        document.getElementById('routineDayError').innerText = '';
        document.getElementById('routineDateError').innerText = '';
        document.getElementById('routineStartingTimeError').innerText = '';
        document.getElementById('routineEndingTimeError').innerText = '';

        document.getElementById('routineSubjectSelect').style.borderColor = '';
        document.getElementById('routineSubjectPaperSelect').style.borderColor = '';
        document.getElementById('routineDaySelect').style.borderColor = '';
        document.getElementById('routineDate').style.borderColor = '';
        document.getElementById('startingTime').style.borderColor = '';
        document.getElementById('endingTime').style.borderColor = '';

        // Get form values
        let student_class_id = document.getElementById('student_class_id').value;
        let subject_id = document.getElementById('routineSubjectSelect').value;
        let sub_subject_id = document.getElementById('routineSubjectPaperSelect').value;
        let day_id = document.getElementById('routineDaySelect').value;
        let date = document.getElementById('routineDate').value;
        let starting_time = document.getElementById('startingTime').value;
        let ending_time = document.getElementById('endingTime').value;

        // Validate form inputs
        let isError = false;
        if (subject_id == '') {
            document.getElementById('routineSubjectSelect').style.borderColor = 'red';
            document.getElementById('routineSubjectError').innerText = 'Subject is required';
            isError = true;
        }
        if (sub_subject_id == '') {
            document.getElementById('routineSubjectPaperSelect').style.borderColor = 'red';
            document.getElementById('routineSubjectPaperError').innerText = 'Subject Paper is required';
            isError = true;
        }
        if (day_id == '') {
            document.getElementById('routineDaySelect').style.borderColor = 'red';
            document.getElementById('routineDayError').innerText = 'Day is required';
            isError = true;
        }
        if (date == '') {
            document.getElementById('routineDate').style.borderColor = 'red';
            document.getElementById('routineDateError').innerText = 'Date is required';
            isError = true;
        }
        if (starting_time == '') {
            document.getElementById('startingTime').style.borderColor = 'red';
            document.getElementById('routineStartingTimeError').innerText = 'Starting Time is required';
            isError = true;
        }
        if (ending_time == '') {
            document.getElementById('endingTime').style.borderColor = 'red';
            document.getElementById('routineEndingTimeError').innerText = 'Ending Time is required';
            isError = true;
        }

        if (isError) return;

        let data = {
            student_class_id: student_class_id,
            subject_id: subject_id,
            sub_subject_id: sub_subject_id,
            day_id: day_id,
            date: date,
            starting_time: starting_time,
            ending_time: ending_time
        };

        try {
            let res = await axios.post('/routine-create', data);

            if (res.data.status === 'success') {
                Swal.fire({
                    title: res.data.message,
                    icon: "success",
                    timer: 1500
                });

                // Clear form inputs
                document.getElementById('routineSubjectSelect').value = '';
                document.getElementById('routineSubjectPaperSelect').value = '';
                document.getElementById('routineDaySelect').value = '';
                document.getElementById('routineDate').value = '';
                document.getElementById('startingTime').value = '';
                document.getElementById('endingTime').value = '';

                if (student_class_id) {
                    await getUploadedRoutinelist(student_class_id);
                } else {
                    console.error("Student Class ID is missing!");
                }
            } else if (res.data.status === 'exists') {
                Swal.fire({
                    title: res.data.message,
                    icon: "warning",
                    timer: 3000
                });
            } else {
                console.log(res.data.message);
            }
        } catch (error) {
            //console.error("Error:", error);
            Swal.fire({
                title: "Error!",
                text: "Failed to submit routine data.",
                icon: "error",
                timer: 3000
            });
        }
    }


    // Global variables to maintain state
    let currentDayId = null;
    let currentClassId = null;

    // Modified getFilterByDay function
    getFilterByDay();
    async function getFilterByDay() {
        try {
            let res = await axios.get('/day-lists');
            let parent = document.getElementById('filterByDay');

            if (res.data.dayLists?.length > 0) {
                parent.innerHTML = '<option value="">Select a Day</option>';

                res.data.dayLists.forEach(day => {
                    let option = new Option(day.name, day.id);
                    option.selected = (day.id === currentDayId);
                    parent.appendChild(option);
                });

                parent.addEventListener('change', function() {
                    currentDayId = this.value;
                    currentClassId = document.getElementById('student_class_id').value;

                    if (currentClassId) {
                        getUploadedRoutinelist(currentClassId, currentDayId);
                    }
                });

                // Auto-select if previous selection exists
                if (currentDayId) {
                    parent.value = currentDayId;
                }
            }
        } catch (error) {
            console.error('Error:', error);
            Swal.fire('Error!', 'Failed to load days', 'error');
        }
    }

    // Modified getUploadedRoutinelist function
    async function getUploadedRoutinelist(studentClassId, dayId = null) {
        try {
            let tableBody = $('#routineTableBody');
            tableBody.html('<tr><td colspan="6" class="text-center">No Routine Found</td></tr>');

            let res = await axios.post('/routine-lists-by-class-id', {
                student_class_id: studentClassId,
                day_id: dayId
            });

            tableBody.empty();

            if (res.data.status === 'success') {
                // Handle empty data case
                if (res.data.routines.length === 0) {
                    document.getElementById('pdfdownloadbutton').style.display = 'none';
                    if (dayId) {
                        // Reset to previous valid selection
                        document.getElementById('filterByDay').value = currentDayId ? currentDayId : '';
                        Swal.fire({
                            title: "No Data!",
                            text: "No routines found for selected day",
                            icon: "info",
                            timer: 2000
                        });
                    }
                    tableBody.html('<tr><td colspan="6" class="text-center">No routines found</td></tr>');
                    return;
                }

                // Populate table
                res.data.routines.forEach((routine, index) => {
                    console.log(routine);
                    let row = `
                    <tr>
                        <td>${index+1}</td>
                        <td>${routine.day.name}</td>
                        <td>${routine.subject_name?.name || 'N/A'}</td>
                        <td>${routine.subject_paper?.sub_subject_name || 'N/A'}</td>
                        <td>${routine.starting_time} - ${routine.ending_time}</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-danger routineDeleteBtn" data-id='${routine.id}'>Delete</button>
                                <button class="btn btn-success routineViewBtn" data-id='${routine.id}'>Update</button>
                            </div>
                        </td>
                    </tr>`;
                    tableBody.append(row);
                });

                // Event delegation for dynamic buttons
                $('#routineTableParent')
                    .off('click', '.routineDeleteBtn')
                    .on('click', '.routineDeleteBtn', async function() {
                        let id = $(this).data('id');
                        await handleDeleteRoutine(id);
                    });

                $('#routineTableParent')
                    .off('click', '.routineViewBtn')
                    .on('click', '.routineViewBtn', async function() {
                        let id = $(this).data('id');
                        await viewRoutineComponent(id);
                        $('#routineViewModal').modal('show');
                    });
            }
        } catch (error) {
            let tableBody2 = $('#routineTableBody');
            //console.error("Error:", error);
            Swal.fire('Error!', error.response?.data?.message || 'Failed to load data', 'error');
            tableBody2.html('<tr><td colspan="6" class="text-center text-danger">No data Found</td></tr>');
        }
    }

    // Unified delete handler
    async function handleDeleteRoutine(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    let res = await axios.post('/routine-delete-by-id', {
                        id: id
                    });
                    if (res.data.status === 'success') {
                        Swal.fire({
                            title: 'Deleted!',
                            text: res.data.message,
                            icon: 'success',
                            timer: 1500
                        });
                        // Refresh with current filters
                        getUploadedRoutinelist(currentClassId, currentDayId);
                    }
                } catch (error) {
                    Swal.fire({
                        title: 'Error!',
                        text: error.response?.data?.message || 'Deletion failed',
                        icon: 'error',
                        timer: 3000
                    });
                }
            }
        });
    }
</script>


<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
