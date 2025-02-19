<!-- Modal -->
<div class="modal fade" id="routineAddModal" tabindex="-1" aria-labelledby="routineModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-1" id="routineModalLabel"><span class="text-primary">MANAGE YOUR</span> <span class="text-danger">CLASS ROUTINE</span></h1>
                <p><input type="number" name="student_class_id" class="form-control w-50 d-none" id="student_class_id"></p>
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
                                <select class="form-select routine-subject" aria-label="Default select example" name="subject[]" id="routineSubjectSelect">
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Subject Paper</label>
                                <select class="form-select routine-subject-paper" aria-label="Default select example" name="subject_paper[]" id="routineSubjectPaperSelect">
                                    <option value="">Please Select Subject</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Day</label>
                                <input type="text" class="form-control" name="day[]">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Starting Time</label>
                                <input type="time" class="form-control" name="starting_time[]">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Ending Time</label>
                                <input type="time" class="form-control" name="ending_time[]">
                            </div>
                            <div class="col-12 text-end">
                                <button type="button" class="btn btn-danger remove-block">
                                    <i class="bi bi-trash"></i> Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="mt-3 text-center">
                    <button type="button" id="addMore" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Add More
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    function fillRoutineComponent(student_class_id) {
        document.getElementById('student_class_id').value = student_class_id;
        getSubjectLists_name_by_subject_id(document.querySelector("#routineSubjectSelect"));
    }

    document.addEventListener("DOMContentLoaded", function() {
        const addMoreBtn = document.getElementById("addMore");
        const routineContainer = document.getElementById("routineContainer");

        // first time data load
        if (document.getElementById('student_class_id').value) {
            getSubjectLists_name_by_subject_id(document.querySelector("#routineSubjectSelect"));
        }

        // new routine block add
        addMoreBtn.addEventListener("click", function() {
            const newBlock = document.createElement("div");
            newBlock.classList.add("routine-block", "card", "shadow-sm", "p-3", "mb-3");

            //block number 
            const blockNumber = routineContainer.querySelectorAll(".routine-block").length + 1;
            newBlock.innerHTML = `
               <div class="card-body row g-3">
                 <div class="card-header">
                    <h5>Routine Block - <span class="text-danger">${blockNumber}</span></h5>
                </div>
                   <div class="col-md-6">
                       <label class="form-label">Subject</label>
                    <select class="form-select routine-subject" name="subject[]" onchange="getSubjectPapers(this.value, this.closest('.routine-block').querySelector('.routine-subject-paper'))"></select>
                   </div>
                    <div class="col-md-6">
                                <label class="form-label">Subject Paper</label>
                                <select class="form-select routine-subject-paper" aria-label="Default select example" name="subject_paper[]" id="routineSubjectPaperSelect">
                                    <option value="">Please Select Subject</option>
                                </select>
                            </div>
                   <div class="col-12">
                       <label class="form-label">Day</label>
                       <input type="text" class="form-control" name="day[]">
                   </div>
                   <div class="col-6">
                       <label class="form-label">Starting Time</label>
                       <input type="time" class="form-control" name="starting_time[]">
                   </div>
                   <div class="col-6">
                       <label class="form-label">Ending Time</label>
                       <input type="time" class="form-control" name="ending_time[]">
                   </div>
                   <div class="col-12 text-end">
                       <button type="button" class="btn btn-danger remove-block">
                           <i class="bi bi-trash"></i> Remove
                       </button>
                   </div>
               </div>
           `;

            routineContainer.appendChild(newBlock);

            //new block subject load
            const newSelect = newBlock.querySelector(".routine-subject");
            getSubjectLists_name_by_subject_id(newSelect);

            // Add event listener to the new subject select element
            newSelect.addEventListener("change", function() {
                const subjectId = this.value;
                const subjectPaperSelect = this.closest(".routine-block").querySelector(".routine-subject-paper");
                getSubjectPapers(subjectId, subjectPaperSelect);
            });
        });

        // routine block remove
        routineContainer.addEventListener("click", function(event) {
            if (event.target.closest(".remove-block")) {
                event.target.closest(".routine-block").remove();
            }
        });

        // Add event listener to the initial subject select element
        const initialSubjectSelect = document.querySelector("#routineSubjectSelect");
        initialSubjectSelect.addEventListener("change", function() {
            const subjectId = this.value;
            const subjectPaperSelect = this.closest(".routine-block").querySelector(".routine-subject-paper");
            getSubjectPapers(subjectId, subjectPaperSelect);
        });
    });

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

            selectElement.innerHTML = ""; // Clear previous data

            if (papers.length === 0) {
                selectElement.innerHTML = '<option value="none" selected style="color: red;">No Papers Found</option>';
            } else {
                selectElement.innerHTML = '';
                //add placeholder 
                const placeholderOption = document.createElement("option");
                placeholderOption.value = "";
                placeholderOption.textContent = "Choose your paper";
                selectElement.appendChild(placeholderOption);

                //opiton paper foreach
                papers.forEach(element => {
                    console.log(element)
                    let option = document.createElement("option");
                    option.value = element.id;
                    option.textContent = element.sub_subject_name?element.sub_subject_name:"none";
                    selectElement.appendChild(option);
                });
            }
        } catch (error) {
            console.error('Error fetching subject papers:', error);
        }
    }
</script>

<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">