<div class="modal fade" id="subSubjectViewModal" tabindex="-1" aria-labelledby="subSubjectViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">View Your Sub Subject</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control d-none" id="sub_subject_view_id" name="id">
                <table class="table table-bordered" id="subSubjectViewTable">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Subject Paper</th>
                        <th scope="col">Subject Code</th>
                        <th scope="col">Full Marks</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody id="subSubjectViewTableBody">
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>




<script>
  let subSubjectViewToken = localStorage.getItem('authToken');
  if(!subSubjectViewToken){
    window.location.href = "/login";
  }
   async function subSubjectViewShow(id) {
        document.getElementById('sub_subject_view_id').value = id;
      try{
        let res = await axios.post("/sub-subject-view-lists", {subject_id: id},{
          headers:{
            Authorization: `Bearer ${subSubjectViewToken}`,
            'Content-Type': 'application/json'
          }
        });
        if(res.data.status === 'success'){
          $('#subSubjectViewTableBody').empty();
          let subSubjectLists = res.data.sub_subjects_lists;

          if(subSubjectLists.length === 0){
            $('#subSubjectViewTableBody').append('<tr align="center"><td colspan="5" class="text-primary">No data found</td></tr>');
          }

          subSubjectLists.forEach((element, index) => {
            let row = `<tr>
                        <td>${index+1}</td>
                        <td>${element.subject.name}</td>
                        <td>${element.sub_subject_name?element.sub_subject_name:"NULL"}</td>
                        <td>${element.sub_subject_code}</td>
                        <td>${element.full_marks}</td>
                        <td>
                            <button class="btn btn-danger" data-id="${element.id}">DELETE</button>
                            <button class="btn btn-warning" data-id="${element.id}">UPDATE</button>
                        </td>
                      </tr>`;
            $('#subSubjectViewTableBody').append(row);
          });
        }
      }catch(e){
        console.log(e);
      }
    }
</script>

