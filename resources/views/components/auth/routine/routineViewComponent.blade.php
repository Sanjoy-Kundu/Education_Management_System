<!-- Modal -->
<div class="modal fade" id="routineViewModal" tabindex="-1" aria-labelledby="routineViewModal" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-1" id="routineModalLabel"><span class="text-primary">UPDATE YOUR</span> <span
                        class="text-danger">CLASS ROUTINE</span> OF CLASS </h1>
                <p><input type="number" name="id" hidden class="form-control w-50" id="routine_id">
                <p><input type="number" name="student_class_id" hidden class="form-control w-50"
                        id="update_student_class_id">
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
                                <select class="form-select routine-subject-paper" aria-label="Default select example"
                                    name="sub_subject_id" id="updateRoutineSubjectPaperSelect">
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
        let routineIdElement = document.getElementById('routine_id');
        try {
            let res = await axios.post('/routine-detail-by-id', {
                id: id
            });
            if (res.data.status == 'success') {
                let routine = res.data.data;
                console.log(routine);
                document.getElementById('updateRoutineDate').value = routine.date;
                document.getElementById('updateStartingTime').value = routine.starting_time;
                document.getElementById('updateEndingTime').value = routine.ending_time;
                let dayId = routine.day_id;
                await viewRoutineDayLists(dayId);
            } else {
                console.error('One or more form elements not found!');
            }
        } catch (error) {
            console.log('error', error);
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
            }

            let placeholderOption = document.createElement('option');
            placeholderOption.value = '';
            placeholderOption.textContent = 'Select a day';
            daySelect.appendChild(placeholderOption);


            lists.forEach((element) => {
                let option = document.createElement('option');
                option.value = element.id;
                option.textContent = element.name;
                if(element.id == dayId){
                    option.selected = true;
                }
                daySelect.appendChild(option);
            });

        } catch (error) {
            console.error('Error fetching day lists:', error);
        }
    }
</script>
<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
