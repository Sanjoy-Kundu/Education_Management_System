<!-- Modal -->
<div class="modal fade" id="routineAddModal" tabindex="-1" aria-labelledby="routineModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-1" id="routineModalLabel"><span class="text-primary">MANAGE YOUR</span> <span
                        class="text-danger">CLASS ROUTINE</span> OF CLASS </h1>
                <p><input type="number" name="student_class_id" class="form-control w-50 d-none" id="student_class_id">
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
                              <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th scope="col">10::00 AM - 10:30 AM</th>
                                    <th scope="col">10::30 AM - 11:00 AM</th>
                                    <th scope="col">11::30 AM - 12:00 AM</th>
                                    <th scope="col">12::00 AM - 12:30 AM</th>
                                    <th scope="col">12::30 AM - 1:00 PM</th>
                                    <th scope="col">2:: 00 PM - 2:30 PM </th>
                                    <th scope="col">3::00 AM -  4:00 AM</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <th scope="row">Bangla 1st</th>
                                    <td>Bangla 1st</td>
                                    <td>Bangla 1st</td>
                                    <td>Bangla 1st</td>
                                    <td>Bangla 1st</td>
                                    <td>Bangla 1st</td>
                                    <td>Bangla 1st</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">Bangla 1st</th>
                                    <td>Bangla 1st</td>
                                    <td>Bangla 1st</td>
                                    <td>Bangla 1st</td>
                                    <td>Bangla 1st</td>
                                    <td>Bangla 1st</td>
                                    <td>Bangla 1st</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">Bangla 1st</th>
                                    <td>Bangla 1st</td>
                                    <td>Bangla 1st</td>
                                    <td>Bangla 1st</td>
                                    <td>Bangla 1st</td>
                                    <td>Bangla 1st</td>
                                    <td>Bangla 1st</td>
                                  </tr>
                              
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
    function fillRoutineComponent(student_class_id) {
        document.getElementById('student_class_id').value = student_class_id;
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
            console.log(res.data.dayLists);

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

        console.log('Routine Data:',data);

        try{
            let res = await axios.post('/routine-create', data)
            if(res.data.status === 'success'){
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

</script>






























<!-- JavaScript -->
{{-- <script>
    function fillRoutineComponent(student_class_id) {
        document.getElementById('student_class_id').value = student_class_id;
        const selectElement = document.querySelector("#routineSubjectSelect");
        if (selectElement) {
            getSubjectLists_name_by_subject_id(selectElement);
        } else {
            console.error('Select element not found!');
        }
    }

    // document.addEventListener("DOMContentLoaded", function() {
    //     const addMoreBtn = document.getElementById("addMore");
    //     const routineContainer = document.getElementById("routineContainer");

    //     // first time data load
    //     if (document.getElementById('student_class_id').value) {
    //         const selectElement = document.querySelector("#routineSubjectSelect");
    //         if (selectElement) {
    //             getSubjectLists_name_by_subject_id(selectElement);
    //         } else {
    //             console.error('Select element not found!');
    //         }
    //     }

    //     // new routine block add
    //     addMoreBtn.addEventListener("click", function() {
    //         const newBlock = document.createElement("div");
    //         newBlock.classList.add("routine-block", "card", "shadow-sm", "p-3", "mb-3");

    //         //block number 
    //         const blockNumber = routineContainer.querySelectorAll(".routine-block").length + 1;
    //         newBlock.innerHTML = `
    //        <div class="card-body row g-3">
    //          <div class="card-header">
    //             <h5>Routine Block - <span class="text-danger">${blockNumber}</span></h5>
    //         </div>
    //            <div class="col-md-6">
    //                <label class="form-label">Subject</label>
    //             <select class="form-select routine-subject" name="subject_id[]" onchange="getSubjectPapers(this.value, this.closest('.routine-block').querySelector('.routine-subject-paper'))"></select>
    //            </div>
    //             <div class="col-md-6">
    //                         <label class="form-label">Subject Paper</label>
    //                         <select class="form-select routine-subject-paper" aria-label="Default select example" name="sub_subject_id[]" id="routineSubjectPaperSelect">
    //                             <option value="">Please Select Subject</option>
    //                         </select>
    //                     </div>
    //            <div class="col-12">
    //                <label class="form-label">Day</label>
    //                <input type="text" class="form-control" name="day[]">
    //            </div>
    //            <div class="col-12">
    //                <label class="form-label">Routine Date</label>
    //                <input type="date" class="form-control" name="date[]">
    //            </div>
    //            <div class="col-6">
    //                <label class="form-label">Starting Time</label>
    //                <input type="time" class="form-control" name="starting_time[]">
    //            </div>
    //            <div class="col-6">
    //                <label class="form-label">Ending Time</label>
    //                <input type="time" class="form-control" name="ending_time[]">
    //            </div>
    //            <div class="col-12 text-end">
    //                <button type="button" class="btn btn-danger remove-block">
    //                    <i class="bi bi-trash"></i> Remove
    //                </button>
    //            </div>
    //        </div>
    //    `;

    //         routineContainer.appendChild(newBlock);

    //         //new block subject load
    //         const newSelect = newBlock.querySelector(".routine-subject");
    //         if (newSelect) {
    //             getSubjectLists_name_by_subject_id(newSelect);
    //         } else {
    //             console.error('New select element not found!');
    //         }

    //         // Add event listener to the new subject select element
    //         newSelect.addEventListener("change", function() {
    //             const subjectId = this.value;
    //             const subjectPaperSelect = this.closest(".routine-block").querySelector(".routine-subject-paper");
    //             getSubjectPapers(subjectId, subjectPaperSelect);
    //         });
    //     });

    //     // routine block remove
    //     routineContainer.addEventListener("click", function(event) {
    //         if (event.target.closest(".remove-block")) {
    //             event.target.closest(".routine-block").remove();
    //         }
    //     });

    //     // Add event listener to the initial subject select element
    //     const initialSubjectSelect = document.querySelector("#routineSubjectSelect");
    //     if (initialSubjectSelect) {
    //         initialSubjectSelect.addEventListener("change", function() {
    //             const subjectId = this.value;
    //             const subjectPaperSelect = this.closest(".routine-block").querySelector(
    //                 ".routine-subject-paper");
    //             getSubjectPapers(subjectId, subjectPaperSelect);
    //         });
    //     } else {
    //         console.error('Initial select element not found!');
    //     }
    // });

    // Get subject list and update select options
    async function getSubjectLists_name_by_subject_id(selectElement) {
        try {
            let student_class_id = document.getElementById('student_class_id').value;

            if (!student_class_id) {
                console.error('Student Class ID is missing!');
                return;
            }
            // initial value
            selectElement.innerHTML = `<option value="">Choose your subject</option>`;

            let res = await axios.post('/subject-lists-by-class-name-routine', {
                student_class_id: student_class_id
            });
            let lists = res.data.subjects;

            selectElement.innerHTML = ""; // Clear previous data

            if (lists.length === 0) {
                selectElement.innerHTML = '<option>No Data Found</option>';
            } else {
                selectElement.innerHTML = '';
                //add placeholder 
                const placeholderOption = document.createElement("option");
                placeholderOption.value = "";
                placeholderOption.textContent = "Choose your subject";
                selectElement.appendChild(placeholderOption);

                //opiton subject foreach
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
            console.log(papers);
            selectElement.innerHTML = ""; // Clear previous data

            if (papers.length === 0) {
                // If no papers found, set value to "none"
                selectElement.innerHTML = '<option value="none" selected style="color: red;">No Papers Found</option>';
            } else {
                selectElement.innerHTML = '';
                const placeholderOption = document.createElement("option");
                placeholderOption.value = "";
                placeholderOption.textContent = "Select your paper";
                selectElement.appendChild(placeholderOption);

                // Add papers to the select element
                papers.forEach(element => {
                    console.log(element);
                let option = document.createElement("option");
                option.value = element.id;
                option.textContent = element.sub_subject_name === 'null' ? 'No paper found' : element.sub_subject_name;
                
                if (option.textContent === 'No paper found') {
                    option.selected = true;
                    option.disabled = true;
                    option.style.color = 'red';
                }else{
                    option.style.color = 'blue';
                    option.selected = true;
                }
                selectElement.appendChild(option);
            });
            }
        } catch (error) {
            console.error('Error fetching subject papers:', error);
        }
    }

    //:::::::::::: routing section calculation :::::::::::::::
    async function onRoutineSubmit(event) {
    event.preventDefault();

    let student_class_id = document.getElementById('student_class_id').value;
    const routineBlocks = document.querySelectorAll('.routine-block');
    const routines = [];
    let hasError = false;

    routineBlocks.forEach(block => {
        const subjectId = block.querySelector('.routine-subject').value;
        let subSubjectId = block.querySelector('.routine-subject-paper').value;

        if (subSubjectId === "none") {
            subSubjectId = null; 
        }

        const day = block.querySelector('input[name="day[]"]').value;
        const date = block.querySelector('input[name="date[]"]').value;
        const startingTime = block.querySelector('input[name="starting_time[]"]').value;
        const endingTime = block.querySelector('input[name="ending_time[]"]').value;

        block.querySelectorAll('.error-message').forEach(el => el.remove());

        if (!subjectId || !day || !startingTime || !endingTime || !date) {
            hasError = true;
            block.classList.add('border', 'border-danger');

            if (!subjectId) {
                const error = document.createElement('div');
                error.classList.add('error-message', 'text-danger');
                error.textContent = 'Subject is required';
                block.querySelector('.routine-subject').parentElement.appendChild(error);
            }

            if (!day) {
                const error = document.createElement('div');
                error.classList.add('error-message', 'text-danger');
                error.textContent = 'Day is required';
                block.querySelector('input[name="day[]"]').parentElement.appendChild(error);
            }

            if (!date) {
                const error = document.createElement('div');
                error.classList.add('error-message', 'text-danger');
                error.textContent = 'Date is required';
                block.querySelector('input[name="date[]"]').parentElement.appendChild(error);
            }

            if (!startingTime) {
                const error = document.createElement('div');
                error.classList.add('error-message', 'text-danger');
                error.textContent = 'Starting Time is required';
                block.querySelector('input[name="starting_time[]"]').parentElement.appendChild(error);
            }

            if (!endingTime) {
                const error = document.createElement('div');
                error.classList.add('error-message', 'text-danger');
                error.textContent = 'Ending Time is required';
                block.querySelector('input[name="ending_time[]"]').parentElement.appendChild(error);
            }
        } else {
            block.classList.remove('border', 'border-danger');
        }

        routines.push({
            subject_id: subjectId,
            sub_subject_id: subSubjectId,
            day: day,
            date:date,
            starting_time: startingTime,
            ending_time: endingTime
        });
    });


    if (hasError) {
        return;
    }

    console.log('Routines Array:', routines);

    try {
        let res = await axios.post('/routine-create', {
            routines: routines,
            student_class_id: student_class_id
        }, {
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        });

        if (res.data.status === "success") {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: res.data.message,
            }).then(() => {
                document.getElementById('student_class_id').value = '';
                document.querySelectorAll('.routine-block').forEach(block => block.remove());

                const routineAddModal = bootstrap.Modal.getInstance(document.getElementById('routineAddModal'));
                routineAddModal.hide();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: res.data.message,
            });
        }
    } catch (error) {
        console.error('Error creating routine:', error);
        if (error.response && error.response.data) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.response.data.message || 'An error occurred while creating the routine.',
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while creating the routine.',
            });
        }
    }
}
    // Helper Function: Error Message যোগ করা
    function addErrorMessage(element, message) {
        const error = document.createElement('div');
        error.classList.add('error-message', 'text-danger');
        error.textContent = message;
        element.appendChild(error);
    }
</script> --}}





<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
