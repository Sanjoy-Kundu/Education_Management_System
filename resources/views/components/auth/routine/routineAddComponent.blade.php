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
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Filter By Day</label>
                                <select class="form-select routine-subject" aria-label="Default select example"
                                    name="day_id" id="filterByDay">
                                </select>
                                <span id="routineDayError" class="text-danger"></span>
                            </div>
                              <table class="table table-bordered" id="routineTableParent">
                                <thead>
                                  <tr>
                                    <th scope="col">Day</th>
                                    <th scope="col">Subject Name</th>
                                    <th scope="col">Subject Paper</th>
                                    <th scope="col">Class Time</th>
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


    //getFilterByDay
    getFilterByDay();
    async function getFilterByDay() {
        try {
            // Fetch the day lists from the backend
            let res = await axios.get('/day-lists');

            // Check if the response contains data
            if (res.data.dayLists.length > 0) {
                let parent = document.getElementById('filterByDay');
                parent.innerHTML = ''; 

                // Add a default option
                let defaultOption = document.createElement('option');
                defaultOption.value = ''; 
                defaultOption.textContent = 'Select a Day'; //
                parent.appendChild(defaultOption);

                // Loop through the day lists and create options
                res.data.dayLists.forEach(day => {
                    let option = document.createElement('option');
                    option.value = day.id;
                    option.textContent = day.name; 
                    parent.appendChild(option);
                });
            } else {
                console.error("No data found in the response.");
            }
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

    // Handle form submission
    async function onRoutineSubmit(event) {
        event.preventDefault();

        document.getElementById('routineSubjectError').innerText = '';
        document.getElementById('routineSubjectPaperError').innerText = '';
        document.getElementById('routineDayError').innerText = '';
        document.getElementById('routineDateError').innerText = '';
        document.getElementById('routineStartingTimeError').innerText = '';
        document.getElementById('routineEndingTimeError').innerText = '';

        //initilize border color 
        document.getElementById('routineSubjectSelect').style.borderColor = '';
        document.getElementById('routineSubjectPaperSelect').style.borderColor = '';
        document.getElementById('routineDaySelect').style.borderColor = '';
        document.getElementById('routineDate').style.borderColor = '';
        document.getElementById('startingTime').style.borderColor = '';
        document.getElementById('endingTime').style.borderColor = '';

        let student_class_id = document.getElementById('student_class_id').value;
        let subject_id = document.getElementById('routineSubjectSelect').value;
        let sub_subject_id = document.getElementById('routineSubjectPaperSelect').value;
        let day_id = document.getElementById('routineDaySelect').value;
        let date = document.getElementById('routineDate').value;
        let starting_time = document.getElementById('startingTime').value;
        let ending_time = document.getElementById('endingTime').value;

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
            student_class_id:student_class_id,
            subject_id: subject_id,
            sub_subject_id: sub_subject_id,
            day_id: day_id,
            date: date,
            starting_time: starting_time,
            ending_time: ending_time
        };

      

        try{
            let res = await axios.post('/routine-create', data)
            if(res.data.status === 'success'){
                await getUploadedRoutinelist(student_class_id);
                Swal.fire({
                title: res.data.message,
                icon: "success",
                draggable: true,
                timer: 1500
                });
                
            document.getElementById('student_class_id').value  = '';
            document.getElementById('routineSubjectSelect').value = '';
            document.getElementById('routineSubjectPaperSelect').value = '';
            document.getElementById('routineDaySelect').value = '';
            document.getElementById('routineDate').value = '';
            document.getElementById('startingTime').value = '';
            document.getElementById('endingTime').value = '';
            }else if(res.data.status === 'exists'){
                Swal.fire({
                title: res.data.message,
                icon: "warning",
                draggable: true,
                timer: 7500
                });
            }else{
                console.log(res.data.message);
            }
        }catch(error){
            console.log("error",error);
        }
    }


 //routine list show component working not good
 
    async function getUploadedRoutinelist(id){
     try{

        let tableBody = $('#routineTableBody');
        tableBody.empty();

        let data = {student_class_id:id};
        let res = await axios.post('/routine-lists-by-class-id',data);
        if(res.data.status === 'success'){
            let lenght = res.data.routines.length;
            if(lenght > 0){
                let routines = res.data.routines;
                routines.forEach((routine)=>{
                    console.log(routine.ending_time);
                    let startingTime = routine.starting_time;
                    let endingTime = routine.ending_time;
                    let timeSlot = startingTime+'-'+endingTime;
                    let day = routine.day.name;
                    let subject = routine.subject_name.name; 
                    let paper = routine.subject_paper.sub_subject_name;

                    let row = `
                    <tr>
                        <td>${day}</td>
                        <td>${subject}</td>
                        <td>${paper}</td>
                        <td>${timeSlot}</td>
                    </tr>
                    `
                    tableBody.append(row);
                })




                    // Initialize DataTables
                    $('#routineTableParent').DataTable({
                    paging: true,
                    searching: true, 
                    ordering: true, 
                    info: true, 
                    responsive: true 
                });
            }else{
                console.log(lenght);
            }
     

        }else{
            console.log("data not found");
        }
           
     }catch(error){
        console.error("error",error);
     }
 
}


</script>


<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
