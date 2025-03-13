<!-- Modal -->
<div class="modal fade" id="teacherCreateModal" tabindex="-1" aria-labelledby="teacherCreateModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h1 class="modal-title fs-5">Create Your Teacher</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form id="teacher_form">
                  <div class="mb-3">
                      <label for="teacher_name" class="form-label">Name</label>
                      <input type="text" class="form-control" id="teacher_name" placeholder="Enter Teacher Name">
                      <div id="teacher_name_error" class="text-danger"></div>
                  </div>
                  <div class="mb-3">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" class="form-control" id="email" placeholder="Enter Your Email">
                      <div id="teacher_email_error" class="text-danger"></div>
                  </div>
              </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="createTeacher(event)">Create Teacher</button>
          </div>
      </div>
  </div>
</div>


<script>
  let TeacherCreateToken = localStorage.getItem('authToken');
  if (!TeacherCreateToken) {
      window.location.href = "/login";
  }

  async function createTeacher(event) {
      event.preventDefault();

      let teacher_name = document.getElementById('teacher_name').value;
      let email = document.getElementById('email').value;
      let teacher_name_error = document.getElementById('teacher_name_error');
      let teacher_email_error = document.getElementById('teacher_email_error');

      teacher_name_error.innerHTML = '';
      teacher_email_error.innerHTML = '';

      let isError = false;

      if (teacher_name.trim() === '') {
          teacher_name_error.innerHTML = 'Teacher Name is required';
          isError = true;
      }
      if (email.trim() === '') {
          teacher_email_error.innerHTML = 'Email is required';
          isError = true;
      }

      if (isError) return;

      let data = {
          name: teacher_name,
          email: email,
      };

      try {
          let res = await axios.post('/teacher-create', data, {
              headers: {
                  'Authorization': `Bearer ${TeacherCreateToken}`,
                  'Content-Type': 'application/json'
              }
          });

          if (res.status === 200 || res.status === 201) {
              Swal.fire({
                  title: 'Success!',
                  text: res.data.message || 'Teacher added successfully!',
                  icon: 'success',
                  confirmButtonText: 'OK'
              });


              let modal = bootstrap.Modal.getInstance(document.getElementById('teacherCreateModal'));
              modal.hide();


              document.getElementById('teacher_form').reset();
          }
      } catch (error) {
          console.error('Error:', error);
          Swal.fire({
              title: 'Error!',
              text: 'Failed to add teacher. Please try again.',
              icon: 'error',
              confirmButtonText: 'OK'
          });
      }
  }
</script>
