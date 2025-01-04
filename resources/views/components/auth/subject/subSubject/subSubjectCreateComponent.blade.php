<div class="modal fade" id="sbuSubjectCreateModal" tabindex="-1" aria-labelledby="sbuSubjectCreateModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Your Sub Subject</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="subjectForm">
                    <div class="mb-  d-none">
                        <label for="subject_name" class="form-label">ID</label>
                        <input type="text" class="form-control" id="sub_subject_id" name="id">
                        <div id="sub_subject_id_error" class="text-danger"></div>
                    </div>

                    <div class="mb-3">
                        <label for="subject_name" class="form-label">Class</label>
                        <input type="text" class="form-control" id="class_name" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="sub_create_form_subject_name" class="form-label">Subject Name</label>
                        <input type="text" class="form-control" id="sub_create_form_subject_name" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="sub_create_form_subject_id" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="sub_create_form_subject_id" readonly>
                    </div>


                    <div class="mb-3">
                        <label for="subject_name" class="form-label">Subject Paper</label>
                        <input type="text" class="form-control" id="sub_subject_name" name="sub_subject_name" placeholder="Enter your subject name">
                        <div id="sub_subject_name_error" class="text-danger"></div>
                    </div>

                    <div class="mb-3">
                        <label for="subject_name" class="form-label">Subject Code</label>
                        <input type="text" class="form-control" id="sub_subject_code" name="sub_subject_code" placeholder="Enter your subject code">
                        <div id="sub_subject_code_error" class="text-danger"></div>
                    </div>

                    <div class="mb-3">
                        <label for="subject_name" class="form-label">Full Marks</label>
                        <input type="text" class="form-control" id="full_marks" name="full_marks">
                        <div id="full_marks_error" class="text-danger"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="createSubSubject(event)">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>


   async function subSubjectCreateShow(id) {
    document.getElementById('sub_subject_id').value = id;
        try {
          let res = await axios.post('/subject-detail-by-id',{id:id});
          if (res.data.status === 'success') {
            let subject = res.data.subject;
            console.log(res.data.subject);
            document.getElementById('class_name').value = subject.student_class.name;
            document.getElementById('sub_create_form_subject_id').value = subject.id;
            document.getElementById('sub_create_form_subject_name').value = subject.name;
          } else {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: res.data.message,
            });
          }
        } catch (error) {
            console.error('Error fetching subject:', error);
        }
    }









  //  async function createSubSubject(event) {
  //       event.preventDefault();
  //       let id = document.getElementById('sub_subject_id').value;
  //       let subject_id = document.getElementById('sub_create_form_subject_id').value;
  //       let sub_subject_name = document.getElementById('sub_subject_name').value;
  //       let sub_subject_code = document.getElementById('sub_subject_code').value;
  //       let full_marks = document.getElementById('full_marks').value;

      
  //       let data = {
  //           id:id,
  //           subject_id: subject_id,
  //           sub_subject_name: sub_subject_name,
  //           sub_subject_code: sub_subject_code,
  //           full_marks: full_marks,
  //       };
  //       try{
  //         let res = await axios.post('/create-sub-subject', data);
  //         if (res.data.status === 'success') {
  //           Swal.fire({
  //             icon: "success",
  //             title: "Success",
  //             text: res.data.message,
  //           });
  //           document.getElementById('subjectForm').reset();
  //           $('#sbuSubjectCreateModal').modal('hide');
  //         } else {
  //           Swal.fire({
  //             icon: "error",
  //             title: "Error",
  //             text: res.data.message,
  //           });
  //         }
  //       }catch(error){
  //         console.error("create subject error", error)
  //       }   
    
  //   }







</script>
