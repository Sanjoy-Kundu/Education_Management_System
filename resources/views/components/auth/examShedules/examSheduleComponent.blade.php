<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard / exam lists</li>
            </ol>
            <div class="row">
                <div class="col-xl-11 col-md-12 col-sm-12 mx-auto">
                    <div class="card">
                        <h5 class="card-header">Class Lists</h5>
                        <div class="card-body">
                            <button class="btn btn-primary w-25" data-bs-toggle="modal"
                                data-bs-target="#examSheduleModal">ADD EXAM</button><br><br>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Class</th>
                                        <th scope="col">Subject Name</th>
                                        <th scope="col">Suject Code</th>
                                        <th scope="col">Exam Name</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Full Marks</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="examshedule-table-body">

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <script>
        let token = localStorage.getItem('authToken');
        if (token) {
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
            console.log(token)
        } else {
            console.error('No auth token found');
        }


        getExamSheduleListsShow();
        async function getExamSheduleListsShow(){
            try{
                let res = await axios.get('/exam-schedule-lists');
                let lists = res.data.exam_schedules;
                let listSectionBody = $('#examshedule-table-body');
                listSectionBody.empty(); // Clear previous data
                if (lists.length === 0) {
                    listSectionBody.append(
                        '<tr align="center"><td colspan="9" class="text-primary">No data found</td></tr>');
                }
                lists.forEach((element,index) => {
                    console.log(element);
                    let row = `
                                    <tr>
                                        <td>${index+1}</td>
                                        <td>${element.student_class.name}</td>
                                        <td>${element.subject.name}</td>
                                        <td>${element.subject.code}</td>
                                        <td>${element.name}</td>
                                        <td>${element.exam_date}</td>
                                        <td>${element.start_time} - ${element.end_time}</td>
                                        <td>${element.subject.full_marks}</td>
                                        <td>
                                          <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                          <button type="button" class="btn btn-danger subjectDelete" data-id="${element.id}">DELETE</button>
                                          <button type="button" class="btn btn-warning subjectEdit" data-id="${element.id}">EDIT</button>
                                         </div>
                                        </td>
                                    </tr>
                    `
                    listSectionBody.append(row);
                });
            }catch(error){
                console.error('Error fetching exam lists:', error);
            }
        }



        // getSubjectListsShow()
        // async function getSubjectListsShow() {
        //     try {
        //         let res = await axios.get('/exam-schedule-lists');
        //         let lists = res.data.exam_schedules;
        //         let listSectionBody = $('#subject-table-body');
        //         listSectionBody.empty(); // Clear previous data
        //         if (lists.length === 0) {
        //             listSectionBody.append(
        //                 '<tr align="center"><td colspan="5" class="text-primary">No data found</td></tr>');
        //         }

        //         lists.forEach((element, index) => {
        //             let row = `<tr>
        //                 <td>${index+1}</td>
        //                 <td>${element.student_class.name}</td>
        //                 <td>${element.name}</td>
        //                 <td>${element.code}</td>
        //                 <td>${element.full_marks}</td>
        //                 <td>
                            // <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            //     <button type="button" class="btn btn-danger subjectDelete" data-id="${element.id}">DELETE</button>
                            //     <button type="button" class="btn btn-warning subjectEdit" data-id="${element.id}">EDIT</button>
                            // </div>
        //                 </td>
        //             </tr>`;
        //             listSectionBody.append(row);
        //         });




        //         $('.subjectDelete').on('click', function() {
        //             let id = $(this).data('id'); // Get the id
        //             console.log('Deleting subject with id:', id); // Check if id is correct

        //             Swal.fire({
        //                 title: "Are you sure?",
        //                 text: "You won't be able to revert this!",
        //                 icon: "warning",
        //                 showCancelButton: true,
        //                 confirmButtonColor: "#d33",
        //                 cancelButtonColor: "#3085d6",
        //                 confirmButtonText: "Yes, delete it!"
        //             }).then(async (result) => {
        //                 if (result.isConfirmed) {
        //                     try {
        //                         // Send the delete request
        //                         let res = await axios.post('/subject-delete-by-id', {
        //                             id: id
        //                         });
        //                         console.log(res); // Log the response to check the status
        //                         if (res.data.status === 'success') {
        //                             await getSubjectListsShow
        //                         (); // Reload the subject list after deletion
        //                             Swal.fire({
        //                                 title: "Deleted!",
        //                                 text: res.data.message,
        //                                 icon: "success",
        //                                 timer: 3000
        //                             });
        //                         } else {
        //                             Swal.fire({
        //                                 icon: "error",
        //                                 title: "Error",
        //                                 text: res.data.message,
        //                             });
        //                         }
        //                     } catch (error) {
        //                         console.error("Error during deletion:", error);
        //                         Swal.fire({
        //                             icon: "error",
        //                             title: "Error",
        //                             text: "There was an issue deleting the subject.",
        //                         });
        //                     }
        //                 }
        //             });
        //         });



                
        //     $('.subjectEdit').on('click',async function(){
        //         let id = $(this).data('id')
        //         await subjectEditShow(id);
        //         $('#subjectEditModal').modal('show');
        //         // await classEditModalShow(id);
        //         // $('#classEditModal').modal('show');
        //     })


        //     } catch (error) {
        //         console.error('Error fetching class lists:', error);
        //     }






        // }
    </script>