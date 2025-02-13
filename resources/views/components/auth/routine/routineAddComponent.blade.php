<!-- Modal -->
<div class="modal fade" id="routineAddModal" tabindex="-1" aria-labelledby="routineModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="routineModalLabel">ADD YOUR CLASS ROUTINE</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <section id="routineContainer" class="p-2" style="width: 90%; margin:0 auto">
            <!-- Default Routine Block -->
            <div class="routine-block card shadow-sm p-3 mb-3">
              <div class="card-body row g-3">
                <div class="col-md-6">
                  <label class="form-label">Subject</label>
                  <select class="form-select" aria-label="Default select example" name="subject[]" id="routineSubjectSelect">
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Subject Paper</label>
                  <input type="text" class="form-control" name="subject_paper[]">
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

    document.addEventListener("DOMContentLoaded", function () {
      const addMoreBtn = document.getElementById("addMore");
      const routineContainer = document.getElementById("routineContainer");
  
      // Function to add new routine block
      addMoreBtn.addEventListener("click", function () {
        const newBlock = document.createElement("div");
        newBlock.classList.add("routine-block", "card", "shadow-sm", "p-3", "mb-3");
  
        newBlock.innerHTML = `
          <div class="card-body row g-3">
                <div class="col-md-6">
                  <label class="form-label">Subject</label>
                  <select class="form-select" aria-label="Default select example" name="subject[]" id="routineSubjectSelect">
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Subject Paper</label>
                  <input type="text" class="form-control" name="subject_paper[]">
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
  
        // Append new block
        routineContainer.appendChild(newBlock);
        getSubjectListsName();
      });
  
      // Function to remove routine block
      routineContainer.addEventListener("click", function (event) {
        if (event.target.classList.contains("remove-block")) {
          event.target.closest(".routine-block").remove();
        }
      });
    });





    //get student class api
    getSubjectListsName();
    async function getSubjectListsName() {
        try {
            let res = await axios.get('/subject-lists');
            let lists = res.data.subjectLists;
        
            let listSectionContainer = $('#routineSubjectSelect');
            listSectionContainer.empty(); // Clear previous data
            if (lists.length === 0) {
                listSectionContainer.append(
                    '<option>No Data Found</option>');
            } else {
                let uniqueNames = new Set();
                lists.forEach(element => {
                    if (!uniqueNames.has(element.name)) {
                        uniqueNames.add(element.name);
                        listSectionContainer.append(
                            `<option value="${element.id}">${element.name}</option>`);
                    }
                });
            }
        } catch (error) {
            console.error('Error fetching class lists:', error);
        }
    }


  </script>
  
  <!-- Bootstrap Icons CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  