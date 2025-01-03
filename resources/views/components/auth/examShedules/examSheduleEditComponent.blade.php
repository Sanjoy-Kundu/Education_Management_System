<div class="modal fade" id="examSheduleUpdateModal" tabindex="-1" aria-labelledby="examSheduleUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Update Your Exam Shedule</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="examSheduleForm">

            <div class="mb-3 d-none">
                <label for="shedule_id" class="form-label">ID</label>
                <input type="text" class="form-control" id="shedule_id"  name="id">
                <div id="update_shedule_id_error" class="text-danger"></div>
              </div>



            <div class="mb-3">
              <label for="select-class-lists" class="form-label">Select Your Class</label>
              <select class="form-select" id="shedule-select-class-lists" name="student_class_id">
              </select>
              <div id="update_shedule_class_name_error" class="text-danger"></div>
            </div>
  
            <div class="mb-3">
              <label for="select-class-lists" class="form-label">Select Your Subject</label>
              <select class="form-select" id="shedule-select-subject-lists" name="subject_id">
              </select>
              <div id="update_shedule_subject_name_error" class="text-danger"></div>
            </div>
  
  
            <div class="mb-3">
              <label for="suject_name" class="form-label">Exam Name</label>
              <input type="text" class="form-control" id="shedule_exam_name" placeholder="Enter Your Exam Name" name="name">
              <div id="update_shedule_exam_name_error" class="text-danger"></div>
            </div>
            <div class="mb-3">
              <label for="subject_code" class="form-label">Exam Date</label>
              <input type="date" class="form-control" id="shedule_exam_date" name="exam_date">
              <div id="update_shedule_exam_date_error" class="text-danger"></div>
            </div>
            <div class="mb-3">
              <label for="subject_fullmarks" class="form-label">Exam Starting Time</label>
              <input type="time" class="form-control" id="shedule_starting_time" placeholder="Enter Full Marks" name="start_time">
              <div id="update_shedule_start_time_error" class="text-danger"></div>
            </div>
  
            <div class="mb-3">
              <label for="subject_fullmarks" class="form-label">Exam Ending Time</label>
              <input type="time" class="form-control" id="shedule_ending_time" placeholder="Enter Full Marks" name="end_time">
              <div id="update_shedule_end_time_error" class="text-danger"></div>
            </div>
  
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="uploadExam(event)">Upload Exam</button>
        </div>
      </div>
    </div>
  </div>


<script>
    getSheduleSubjectLists()
    async function getSheduleSubjectLists(subject_id) {
        try {
            let res = await axios.get('/subject-lists');
            let lists = res.data.subjectLists;
            let selectSubject = $('#shedule-select-subject-lists');
            selectSubject.empty(); // Clear previous data
            if (lists.length === 0) {
                selectSubject.append('<option value="">No data found</option>');
            }

            let defaultOption = `<option value="" selected>Select Your Subject</option>`;
            selectSubject.append(defaultOption);

            lists.forEach((element) => {
                if(subject_id === element.id){
                    let option = `<option value="${element.id}" selected>${element.name}</option>`;
                    selectSubject.append(option);
                    return;
                }
                let option = `<option value="${element.id}">${element.name}</option>`;
                selectSubject.append(option);
            });
        } catch (error) {
            console.error(error);
        }
    }



    getSheduleClassLists();
    async function getSheduleClassLists(class_id){
        try{
            let res = await axios.get('/student-class-lists');
            let lists = res.data.classLists;
            let selectClass = $('#shedule-select-class-lists');
            selectClass.empty(); 
            if(lists.length === 0){
                selectClass.append('<option value="">No data found</option>');
            }

            let defaultOption = `<option value="" selected>Select Your Class</option>`;
            selectClass.append(defaultOption);

            lists.forEach((element) => {
                if(class_id === element.id){
                    let option = `<option value="${element.id}" selected>${element.name}</option>`;
                    selectClass.append(option);
                    return;
                }
                let option = `<option value="${element.id}">${element.name}</option>`;
                selectClass.append(option);
            });
            
        }catch(error){
            console.error(error);
        }
    }



    async function examSheduleEditShow(id){

        document.getElementById('update_shedule_id_error').innerText = "";
        document.getElementById('update_shedule_class_name_error').innerText = "";
        document.getElementById('update_shedule_subject_name_error').innerText = "";
        document.getElementById('update_shedule_exam_name_error').innerText = "";
        document.getElementById('update_shedule_exam_date_error').innerText = "";
        document.getElementById('update_shedule_start_time_error').innerText = "";
        document.getElementById('update_shedule_end_time_error').innerText = "";


        document.getElementById('shedule_id').value = id;
        try{
            let res = await axios.post('/exam-shedule-detail-by-id', {
                id: id
            });
            if(res.data.status === 'success'){
                let examShedule = res.data.exam_schedule;
                document.getElementById('shedule_exam_name').value = examShedule.name;
                document.getElementById('shedule_exam_date').value = examShedule.exam_date;
                document.getElementById('shedule_starting_time').value = examShedule.start_time;
                document.getElementById('shedule_ending_time').value = examShedule.end_time;
                let class_id = examShedule.student_class_id;
                let subject_id = examShedule.subject_id;
                await getSheduleClassLists(class_id);
                await getSheduleSubjectLists(subject_id);
                document.getElementById('shedule-select-class-lists').value = class_id;
                document.getElementById('shedule-select-subject-lists').value = subject_id;
            }else{
                console.log('not found');
            }
        }catch(error){
            console.error(error);
        }

    } 
</script>