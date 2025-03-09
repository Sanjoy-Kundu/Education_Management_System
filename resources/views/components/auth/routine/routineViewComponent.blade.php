<!-- Modal -->
<div class="modal fade" id="routineViewModal" tabindex="-1" aria-labelledby="routineViewModal" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-1" id="routineModalLabel"><span class="text-primary">UPDATE YOUR</span> <span
                        class="text-danger">CLASS ROUTINE</span> OF CLASS </h1>
                <p><input type="number" name="id"  class="form-control w-50" id="view_routine_id">
                <p><input type="number" name="student_class_id" class="form-control w-50"
                        id="view_update_student_class_id">
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
                                    name="subject_id" id="updateRoutineSubjectSelect">
                                </select>
                                <span id="routineSubjectError" class="text-danger"></span>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Subject Paper</label>
                                <select class="form-select update-routine-subject-paper"
                                    aria-label="Default select example" name="sub_subject_id"
                                    id="updateRoutineSubjectPaperSelect">
                                    <option value="">Please Select Subject</option>
                                </select>
                                <span id="routineSubjectPaperError" class="text-danger"></span>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Day</label>
                                <select class="form-select routine-subject" aria-label="Default select example"
                                    name="day_id" id="updateRoutineDaySelect">
                                </select>
                                <span id="routineDayError" class="text-danger"></span>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Routine Date</label>
                                <input type="date" class="form-control" name="date" id="updateRoutineDate">
                                <span id="routineDateError" class="text-danger"></span>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Starting Time</label>
                                <input type="time" class="form-control" name="starting_time" id="updateStartingTime">
                                <span id="updateRoutineStartingTimeError" class="text-danger"></span>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Ending Time</label>
                                <input type="time" class="form-control" name="ending_time" id="updateEndingTime">
                                <span id="updateRoutineEndingTimeError" class="text-danger"></span>
                            </div>
                            <div class="col-3">
                                <button type="button" class="btn btn-primary" onclick="onRoutineUpdate(event)">UPDATE
                                    ROUTINE</button>
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
    // Function to load routine details into the modal
    async function viewRoutineComponent(id) {
    try {
        let res = await axios.post('/routine-detail-by-id', { id: id });
        if (res.data.status == 'success') {
            let routine = res.data.data;
            console.log(routine);
            // console.log(routine.date);
            // console.log(routine.starting_time);
            // console.log(routine.ending_time);
            document.getElementById('view_routine_id').value = routine.id;
            document.getElementById('view_update_student_class_id').value = routine.student_class_id;
            document.getElementById('updateRoutineDate').value = routine.date;
            document.getElementById('updateStartingTime').value = routine.starting_time;
            document.getElementById('updateEndingTime').value = routine.ending_time;;
        
            let subject_paper_id = routine.sub_subject_id; 
            await viewRoutineDayLists(routine.day_id);
            await routinegetSubjectLists_name_by_subject_id(
                routine.student_class_id,
                routine.subject_id,
                subject_paper_id
            );
        }
    } catch (error) {
        console.error('Error loading routine:', error);
    }
}



    //get day name 
    async function viewRoutineDayLists(dayId) {
        try {

            let res = await axios.get('/day-lists');
            let lists = res.data.dayLists;


            const daySelect = document.getElementById('updateRoutineDaySelect');


            daySelect.innerHTML = '';


            if (lists.length === 0) {
                // If no data found, add a default option
                let option = document.createElement('option');
                option.value = '';
                option.textContent = 'No data found';
                daySelect.appendChild(option);
                return;
            }

            let placeholderOption = document.createElement('option');
            placeholderOption.value = '';
            placeholderOption.textContent = 'Select a day';
            daySelect.appendChild(placeholderOption);


            lists.forEach((element) => {
                let option = document.createElement('option');
                option.value = element.id;
                option.textContent = element.name;
                if (element.id.toString() === dayId.toString()) {
                    option.selected = true;
                }
                daySelect.appendChild(option);
            });

        } catch (error) {
            console.error('Error fetching day lists:', error);
        }
    }


    /* starting part*/
    // Get Subject List by Class ID
    async function routinegetSubjectLists_name_by_subject_id(student_class_id, subject_id, subject_paper_id) {
        try {
            let selectElement = document.getElementById('updateRoutineSubjectSelect');

            if (!student_class_id) {
                console.error('Student Class ID is missing!');
                return;
            }

           
            selectElement.innerHTML = '<option value="">Loading...</option>';

            let res = await axios.post('/subject-lists-by-class-name-routine', {
                student_class_id: student_class_id
            });

            let lists = res.data.subjects;

         
            selectElement.innerHTML = '<option value="">Choose your subject</option>';

            if (lists.length === 0) {
                selectElement.innerHTML = '<option value="">No Data Found</option>';
            } else {
             
                lists.forEach(element => {
                    let option = document.createElement("option");
                    option.value = element.id;
                    option.textContent = element.name;
                    if (element.id.toString() === subject_id?.toString()) { 
                        option.selected = true;
                    }
                    selectElement.appendChild(option);
                });
            }

         
            const handleSubjectChange = () => {
                let subjectId = selectElement.value;
                viewGetSubjectPapers(subjectId, null);
            };

            selectElement.removeEventListener("change", handleSubjectChange);
            selectElement.addEventListener("change", handleSubjectChange);

        
            if (subject_id) {
                try {
                    await viewGetSubjectPapers(subject_id, subject_paper_id);
                } catch (error) {
                    console.error("Error loading subject papers:", error);
                }
            }

        } catch (error) {
            console.error('Error fetching subject lists:', error);
            selectElement.innerHTML = '<option value="">Error loading data</option>';
        }
    }

    // Get Subject Papers by Subject ID
    async function viewGetSubjectPapers(subjectId, subject_paper_id) {
        try {
            let selectElement = document.getElementById('updateRoutineSubjectPaperSelect');
            selectElement.innerHTML = '<option value="">Loading...</option>';

            if (!subjectId) {
                selectElement.innerHTML = '<option value="">Please Select Subject</option>';
                return;
            }

            let res = await axios.post('/subject-papers-by-subject-id', {
                subject_id: subjectId
            });
            let papers = res.data.papers;
            selectElement.innerHTML = "";

            if (papers.length === 0) {
                selectElement.innerHTML = '<option value="" selected style="color: red;">No Papers Found</option>';
            } else {
                const placeholderOption = document.createElement("option");
                placeholderOption.value = "";
                placeholderOption.textContent = "Select your paper";
                selectElement.appendChild(placeholderOption);

                let found = false;
                papers.forEach(element => {
                    let option = document.createElement("option");
                    option.value = element.id;
                    const paperName = element.sub_subject_name === 'null' ? 'No paper found' : element
                        .sub_subject_name;
                    option.textContent = paperName;

                    // Style and selection logic
                    if (paperName === 'No paper found') {
                        option.disabled = true;
                        option.style.color = 'red';
                    } else {
                        option.style.color = 'blue';
                        if (element.id.toString() === subject_paper_id?.toString()) {
                            option.selected = true;
                            found = true;
                        }
                    }
                    selectElement.appendChild(option);
                });

                if (!found) selectElement.value = "";
            }

        } catch (error) {
            console.error('Error fetching subject papers:', error);
            selectElement.innerHTML = '<option value="" style="color: red;">Error loading papers</option>';
        }
    }
    /* ending part*/

    /* routine update part start*/
    async function onRoutineUpdate(event) {
        event.preventDefault();

   
        let token = localStorage.getItem('authToken');
        if (!token) {
            Swal.fire({
                title: "Authentication Error!",
                text: "You are not authenticated. Please log in again.",
                icon: "warning",
                confirmButtonText: "OK"
            });
            return;
        }

      
        let id = document.getElementById('view_routine_id').value;
        let student_class_id = document.getElementById('view_update_student_class_id').value;
        let subject_id = document.getElementById('updateRoutineSubjectSelect').value;
        let sub_subject_id = document.getElementById('updateRoutineSubjectPaperSelect').value;
        let day_id = document.getElementById('updateRoutineDaySelect').value;
        let date = document.getElementById('updateRoutineDate').value;
        let starting_time = document.getElementById('updateStartingTime').value;
        let ending_time = document.getElementById('updateEndingTime').value;

    
        if (!subject_id || !date || !starting_time || !ending_time) {
            Swal.fire({
                title: "Validation Error!",
                text: "Please fill in all required fields.",
                icon: "error",
                confirmButtonText: "OK"
            });
            return;
        }

   
        let data = {
            id: id,
            student_class_id: student_class_id,
            subject_id: subject_id,
            sub_subject_id: sub_subject_id, 
            day_id: day_id,
            date: date,
            starting_time: starting_time,
            ending_time: ending_time
        };

        try {
      
            let res = await axios.post('/routine-update', data, {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            });

       
            if (res.data.status === 'success') {
                Swal.fire({
                    title: "Success!",
                    text: res.data.message,
                    icon: "success",
                    confirmButtonText: "OK"
                }).then((result) => {
                    if (result.isConfirmed) {
                        let modal = document.getElementById('routineViewModal');
                        let modalInstance = bootstrap.Modal.getInstance(modal);
                        modalInstance.hide();
                    }
                });
                await getUploadedRoutinelist(student_class_id); // ✅ await যোগ
            } else {
                Swal.fire({
                    title: "Error!",
                    text: res.data.message,
                    icon: "error",
                    confirmButtonText: "OK"
                });
            }
        } catch (error) {
 
            let errorMessage = error.response?.data?.message || "Something went wrong";
            console.error("Error updating routine:", error);
            Swal.fire({
                title: "Server Error!",
                text: errorMessage,
                icon: "error",
                confirmButtonText: "OK"
            });
        }
    }
    /* routine update part end*/
</script>
<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
