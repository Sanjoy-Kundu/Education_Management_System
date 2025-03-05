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
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Subject Paper</label>
                                <select class="form-select routine-subject-paper" aria-label="Default select example"
                                    name="sub_subject_id" id="routineSubjectPaperSelect">
                                    <option value="">Please Select Subject</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Day</label>
                                <select class="form-select routine-subject" aria-label="Default select example"
                                    name="day_id" id="routineDaySelect">
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Routine Date</label>
                                <input type="date" class="form-control" name="date">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Starting Time</label>
                                <input type="time" class="form-control" name="starting_time">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Ending Time</label>
                                <input type="time" class="form-control" name="ending_time">
                            </div>
                            <div class="col-3">
                                <button type="button" class="btn btn-primary" onclick="onRoutineSubmit(event)">ADD
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

        let student_class_id = document.getElementById('student_class_id').value;
        const routineBlock = document.querySelector(".routine-block");
        const routines = [];
        let hasError = false;

        const subjectId = routineBlock.querySelector('.routine-subject').value;
        let subSubjectId = routineBlock.querySelector('.routine-subject-paper').value;

        if (subSubjectId === "none") {
            subSubjectId = null;
        }

        const day = routineBlock.querySelector('input[name="day"]').value;
        const date = routineBlock.querySelector('input[name="date"]').value;
        const startingTime = routineBlock.querySelector('input[name="starting_time"]').value;
        const endingTime = routineBlock.querySelector('input[name="ending_time"]').value;

        routineBlock.querySelectorAll('.error-message').forEach(el => el.remove());

        if (!subjectId || !day || !startingTime || !endingTime || !date) {
            hasError = true;
            routineBlock.classList.add('border', 'border-danger');

            if (!subjectId) {
                addErrorMessage(routineBlock.querySelector('.routine-subject').parentElement,
                'Subject is required');
            }

            if (!day) {
                addErrorMessage(routineBlock.querySelector('input[name="day"]').parentElement, 'Day is required');
            }

            if (!date) {
                addErrorMessage(routineBlock.querySelector('input[name="date"]').parentElement, 'Date is required');
            }

            if (!startingTime) {
                addErrorMessage(routineBlock.querySelector('input[name="starting_time"]').parentElement,
                    'Starting Time is required');
            }

            if (!endingTime) {
                addErrorMessage(routineBlock.querySelector('input[name="ending_time"]').parentElement,
                    'Ending Time is required');
            }
        } else {
            routineBlock.classList.remove('border', 'border-danger');
        }

        if (hasError) {
            return;
        }

        const routine = {
            subject_id: subjectId,
            sub_subject_id: subSubjectId,
            day: day,
            date: date,
            starting_time: startingTime,
            ending_time: endingTime
        };

        console.log('Routine Data:', routine);

        try {
            let res = await axios.post('/routine-create', {
                routines: [routine], // Send as an array with one routine
                student_class_id: student_class_id
            });

            if (res.data.status === "success") {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: res.data.message,
                }).then(() => {
                    document.getElementById('student_class_id').value = '';
                    const routineAddModal = bootstrap.Modal.getInstance(document.getElementById(
                        'routineAddModal'));
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
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while creating the routine.',
            });
        }
    }

    // Helper Function: Add error message
    function addErrorMessage(element, message) {
        const error = document.createElement('div');
        error.classList.add('error-message', 'text-danger');
        error.textContent = message;
        element.appendChild(error);
    }
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
