<div class="modal fade" id="subjectModal" tabindex="-1" aria-labelledby="subjectModalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Your Subject</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="">
            <div class="mb-3">
                <label for="name" class="form-label">Selct Your Class</label>
                <select class="form-select" aria-label="" id="select-class-lists">
                  <option selected>Open this select menu</option>
                </select>
                <div id="class_name_error" class="text-danger"></div>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Suject Name</label>
                <input type="text" class="form-control" id="suject_name" placeholder="Enter Your Name" name="name">
                <div id="subject_name_error" class="text-danger"></div>
            </div>
            <div class="mb-3">
                <label for="section" class="form-label">Suject Code</label>
                <input type="text" class="form-control" id="subject_code" placeholder="Enter Your Section" name="code">
                <div id="subject_code_error" class="text-danger"></div>
            </div>
            <div class="mb-3">
                <label for="section" class="form-label">Full Marks</label>
                <input type="integer" class="form-control" id="subject_fullmarks" placeholder="Enter Your Capacity" name="full_marks">
                <div id="suject_full_marks_error" class="text-danger"></div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="class_modal_close">Close</button>
          <button type="button" class="btn btn-primary" onclick="createSubject(event)">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    getClassSelectLists();
        async function getClassSelectLists() {
            try {
                let res = await axios.get('/student-class-lists');
                let lists = res.data.classLists;
                console.log(lists.length);
                let listSectionBody = $('#select-class-lists')
                listSectionBody.empty(); //clear previous data
                lists.forEach((element,index) => {
                    let option = `
                            <option value="${element.id}">${element.name}</option>
                    `
                    listSectionBody.append(option)
                });
            } catch (error) {
                console.error('Error', error);
            }


        }




    function createSubject(event){
      try{

        document.getElementById("subject_name_error").innerText ="";
        document.getElementById("subject_code_error").innerText ="";
        document.getElementById("suject_full_marks_error").innerText ="";

        let name = document.getElementById('suject_name').value;
        let code = document.getElementById('subject_code').value;
        let full_marks = document.getElementById('subject_fullmarks').value;
        let student_class_id = document.getElementById('select-class-lists').value;
        let isError = false; 



        if (!name) {
                document.getElementById("subject_name_error").innerText = "Input field is required";
                isError = true;
            }

        if (!code) {
                document.getElementById("subject_code_error").innerText = "Input field is required";
                isError = true;
            }

        if (!full_marks) {
                document.getElementById("suject_full_marks_error").innerText = "Input field is required";
                isError = true;
            }
      if(isError) return;     
      
      let data = {
        name:name,
        code:code,
        full_marks:full_marks,
        student_class_id:student_class_id	
      }
      console.log(data);
      }catch(error){
        console.error("error",error);
      }
    }    
  </script>