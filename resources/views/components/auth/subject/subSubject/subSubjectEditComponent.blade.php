<div class="modal fade" id="subjectEditModal" tabindex="-1" aria-labelledby="subjectEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Your Subject</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="subjectForm">

                    <div class="mb-3">
                        <label for="suject_name" class="form-label">ID</label>
                        <input type="text" class="form-control" id="subject_id" placeholder="Enter Subject Name"
                            name="id">
                        <div id="edit_subject_name_error" class="text-danger"></div>
                    </div>

                    <div class="mb-3">
                        <label for="select-class-lists" class="form-label">Select Your Class</label>
                        <select class="form-select" id="edit-select-class-lists">
                        </select>
                        <div id="edit_class_name_error" class="text-danger"></div>
                    </div>

                    <div class="mb-3">
                        <label for="suject_name" class="form-label">Subject Name</label>
                        <input type="text" class="form-control" id="edit_suject_name"
                            placeholder="Enter Subject Name" name="name">
                        <div id="edit_subject_name_error" class="text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="subject_code" class="form-label">Subject Code</label>
                        <input type="text" class="form-control" id="edit_subject_code" placeholder="example: cse-101"
                            name="code">
                        <div id="edit_subject_code_error" class="text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="subject_fullmarks" class="form-label">Full Marks</label>
                        <input type="number" class="form-control" id="edit_subject_fullmarks"
                            placeholder="Enter Full Marks" name="full_marks">
                        <div id="edit_subject_fullmarks_error" class="text-danger"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateSubject(event)">Update</button>
            </div>
        </div>
    </div>
</div>



<script>

// async subjectEditShow(id){
//     document.getElementById('subject_id').value = id;
//     try {
//         let res = await axios.post("/subject-detail-by-id", {
//             id: id
//         });
//         if (res.data.status === 'success') {

//             let subject = res.data.subject;
//             document.getElementById('edit_suject_name').value = subject.name;
//             document.getElementById('edit_subject_code').value = subject.code;
//             document.getElementById('edit_subject_fullmarks').value = subject.full_marks;
//             let class_id = subject.student_class_id;
//             await getEidtClassSelectLists(class_id);
//         } else {
//             console.log("not foun");
//         }
//     } catch (error) {
//         console.error('Error fetching class lists:', error);
//     }
// }


    // async function subjectEditShow(id) {
    //     document.getElementById('subject_id').value = id;
    //     try {
    //         let res = await axios.post("/subject-detail-by-id", {
    //             id: id
    //         });
    //         if (res.data.status === 'success') {

    //             let subject = res.data.subject;
    //             document.getElementById('edit_suject_name').value = subject.name;
    //             document.getElementById('edit_subject_code').value = subject.code;
    //             document.getElementById('edit_subject_fullmarks').value = subject.full_marks;
    //             let class_id = subject.student_class_id;
    //             await getEidtClassSelectLists(class_id);
    //         } else {
    //             console.log("not foun");
    //         }
    //     } catch (error) {
    //         console.error('Error fetching class lists:', error);
    //     }

    // }


    // async function updateSubject(event) {
    //     event.preventDefault();

    //     document.getElementById("edit_subject_name_error").innerText = "";
    //     document.getElementById("edit_subject_code_error").innerText = "";
    //     document.getElementById("edit_subject_fullmarks_error").innerText = "";
    //     document.getElementById("edit_class_name_error").innerText = "";


    //     let id = document.getElementById('subject_id').value;
    //     let name = document.getElementById('edit_suject_name').value.trim();
    //     let code = document.getElementById('edit_subject_code').value.trim();
    //     let full_marks = document.getElementById('edit_subject_fullmarks').value.trim();

    //     let student_class_id = document.getElementById('edit-select-class-lists').value;
    //     let isError = false;
    //     if (!name) {
    //         document.getElementById("edit_subject_name_error").innerText = "Input field is required";
    //         isError = true;
    //     }
    //     if (!code) {
    //         document.getElementById("edit_subject_code_error").innerText = "Input field is required";
    //         isError = true;
    //     }
    //     if (!full_marks) {
    //         document.getElementById("edit_subject_fullmarks_error").innerText = "Input field is required";
    //         isError = true;
    //     }
    //     if (!student_class_id) {
    //         document.getElementById("edit_class_name_error").innerText = "Please choose a class";
    //         isError = true;
    //     }
    //     if (isError) return;
    //     let data = {
    //         id: id,
    //         name: name,
    //         code: code,
    //         full_marks: full_marks,
    //         student_class_id: student_class_id,
    //     };

    //     try {
    //         let res = await axios.post('/subject-update-by-id', data);
    //         if (res.data.status === 'success') {
    //             Swal.fire({
    //                 title: "Updated!",
    //                 text: res.data.message,
    //                 icon: "success",
    //                 timer: 3000,
    //             });
    //             $('#subjectEditModal').modal('hide');
    //             getSubjectListsShow();
    //         } else {
    //             document.getElementById("edit_subject_name_error").innerText = res.data.message
    //             document.getElementById("edit_subject_code_error").innerText = res.data.message
    //             document.getElementById("edit_subject_fullmarks_error").innerText = res.data.message
    //             document.getElementById("edit_class_name_error").innerText = res.data.message
    //         }

    //     } catch (error) {
    //         console.error('Error fetching class lists:', error);
    //     }
    // }
</script>

