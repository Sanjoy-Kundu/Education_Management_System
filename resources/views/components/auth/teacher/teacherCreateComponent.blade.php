<div class="modal fade" id="teacherCreateModal" tabindex="-1" aria-labelledby="teacherCreateModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Create Your Teacher</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter Your Day">
                <div id="teacher_name_error" class="text-danger"></div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Enter Your Email">
                <div id="teacher_name_error" class="text-danger"></div>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Joining Date</label>
                <input type="date" class="form-control" id="date" name="joining_date" placeholder="Enter Your Date">
                <div id="joining_date_error" class="text-danger"></div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="teacher_modal_close">Close</button>
          <button type="button" class="btn btn-primary" onclick="createTeacher(event)">Create Day</button>
        </div>
      </div>
    </div>
  </div>
