<div class="modal fade" id="subjectModal" tabindex="-1" aria-labelledby="subjectModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Your Subject</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="subjectForm">
          <div class="mb-3">
            <label for="select-class-lists" class="form-label">Select Your Class</label>
            <select class="form-select" id="select-class-lists">
              <option value="" selected>Open this select menu</option>
            </select>
            <div id="class_name_error" class="text-danger"></div>
          </div>
          <div class="mb-3">
            <label for="suject_name" class="form-label">Subject Name</label>
            <input type="text" class="form-control" id="suject_name" placeholder="Enter Subject Name" name="name">
            <div id="subject_name_error" class="text-danger"></div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="createSubject(event)">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
  // Fetch class lists
  getClassSelectLists();
  async function getClassSelectLists() {
    try {
      let res = await axios.get('/student-class-lists');
      let lists = res.data.classLists;
      let listSectionBody = $('#select-class-lists');
      listSectionBody.empty(); // Clear previous data

      let defaultOption = `<option value="" selected>Select One</option>`;
      listSectionBody.append(defaultOption);
      lists.forEach((element) => {
        let option = `<option value="${element.id}">${element.name}</option>`;
        listSectionBody.append(option);
      });
    } catch (error) {
      console.error('Error fetching class lists:', error);
    }
  }





  async function createSubject(event) {
    event.preventDefault();

    // Clear previous error messages
    document.getElementById("subject_name_error").innerText = "";
    document.getElementById("class_name_error").innerText = "";

    let name = document.getElementById('suject_name').value.trim();
    let student_class_id = document.getElementById('select-class-lists').value;

    let isError = false;

    // Validation
    if (!name) {
      document.getElementById("subject_name_error").innerText = "Input field is required";
      isError = true;
    }

    if (!student_class_id) {
      document.getElementById("class_name_error").innerText = "Please choose a class";
      isError = true;
    }

    if (isError) return;

    let data = {
      name: name,
      student_class_id: student_class_id,
    };

    try {
      let token = localStorage.getItem('authToken');
      if (!token) {
        console.error('No auth token found');
        return;
      }
      let res = await axios.post('/subject-post', data, {
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${token}`,
        },
      });

      if (res.data.status === 'success') {
        await getClassSelectLists();
        await getSubjectListsShow();
        Swal.fire({
          title: "Created!",
          text: res.data.message,
          icon: "success",
          timer: 3000,
        });

        // Clear form fields after success
        document.getElementById('suject_name').value = '';
        document.getElementById('select-class-lists').value = '';

        // Optionally, close the modal
        $('#subjectModal').modal('hide');
      } else{
          document.getElementById("subject_name_error").innerText = res.data.message
      }
    } catch (error) {
      console.error("Error posting subject:", error);
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "There was an error saving the subject.",
      });
    }
  }

</script>
