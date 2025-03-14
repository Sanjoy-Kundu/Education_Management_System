<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard / subjects</li>
            </ol>
            <div class="row">
                <div class="col-xl-11 col-md-12 col-sm-12 mx-auto">
                    <div class="card">
                        <h5 class="card-header">Class Lists</h5>
                        <div class="card-body">
                            <button class="btn btn-primary w-25" data-bs-toggle="modal"
                                data-bs-target="#subjectModal">ADD SUBJECT</button><br><br>
                            <!-- Filter Dropdown -->
                            <div class="mb-3 w-25">
                                <label for="classFilter" class="form-label">
                                    <h5>Filter by Class:</h5>
                                </label>
                                <select class="form-select" id="subjectComponentClassFilter">
                                    <option value="">Select Class</option>
                                </select>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Class</th>
                                        <th scope="col">Subject Name</th>
                                        <th scope="col">Sub Subject</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="subject-table-body">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <script>
        let SubjectListToken = localStorage.getItem('authToken');
        if (!SubjectListToken) {
            window.location.href = '/login';
        }


             // filtering class list
             filteringClassLists()
        async function filteringClassLists(classId = '') {
            try {
                let res = await axios.get('/student-class-lists',{
                    headers: {
                        Authorization: `Bearer ${SubjectListToken}`
                    }
                });
                let classes = res.data.classLists;
                let classFilter = $('#subjectComponentClassFilter');
                classFilter.empty();
                classFilter.append('<option value="">Select Class</option>');
                classes.forEach(cls => {
                    classFilter.append(`<option value="${cls.id}">${cls.name}</option>`);
                });
            } catch (error) {
                console.error('Error fetching class lists:', error);
            }
        }




        $('#subjectComponentClassFilter').on('change', function() {
            let selectedClassId = $(this).val();
            console.log(selectedClassId);
            getSubjectListsShow(selectedClassId);
        });

        getSubjectListsShow()
        async function getSubjectListsShow(class_id = "") {
            try {
                let res = await axios.get('/subject-lists',{
                    headers: {
                        Authorization: `Bearer ${SubjectListToken}`
                    }
                });
                let lists = res.data.subjectLists;

                if(class_id){
                    lists = lists.filter(list => list.student_class_id == class_id);

                }

                let listSectionBody = $('#subject-table-body');
                listSectionBody.empty(); // Clear previous data
                if (lists.length === 0) {
                    listSectionBody.append(
                        '<tr align="center"><td colspan="4">No data available</td></tr>'
                    );
                } else {
                }

                listSectionBody.empty(); // Clear previous data
                if (lists.length === 0) {
                    listSectionBody.append(
                        '<tr align="center"><td colspan="5" class="text-primary">No data found</td></tr>');
                }

                lists.forEach((element, index) => {
                    let row = `<tr>
                        <td>${index+1}</td>
                        <td>${element.student_class.name}</td>
                        <td>${element.name}</td>
                        <td>
                             <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button type="button" class="btn btn-primary text-white subjectSubjectCreate" data-id="${element.id}">Sub Subject Create</button>
                                <button type="button" class="btn btn-success subSubjectView" data-id="${element.id}">View</button>
                            </div>
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button type="button" class="btn btn-danger subjectDelete" data-id="${element.id}">DELETE</button>
                                <button type="button" class="btn btn-warning subjectEdit" data-id="${element.id}">EDIT</button>
                            </div>
                        </td>
                    </tr>`;
                    listSectionBody.append(row);
                });



                $('.subjectDelete').on('click', function() {
                    let id = $(this).data('id'); // Get the id
                    console.log('Deleting subject with id:', id); // Check if id is correct

                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, delete it!"
                    }).then(async (result) => {
                        if (result.isConfirmed) {
                            try {
                                // Send the delete request
                                let res = await axios.post('/subject-delete-by-id', {id: id},{
                                    headers:{
                                        Authorization: `Bearer ${SubjectListToken}`,
                                        'Content-Type': 'application/json'
                                    }
                                });
                                console.log(res); // Log the response to check the status
                                if (res.data.status === 'success') {
                                    await getSubjectListsShow
                                        (); // Reload the subject list after deletion
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: res.data.message,
                                        icon: "success",
                                        timer: 3000
                                    });
                                } else {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Error",
                                        text: res.data.message,
                                    });
                                }
                            } catch (error) {
                                console.error("Error during deletion:", error);
                                Swal.fire({
                                    icon: "error",
                                    title: "Error",
                                    text: "There was an issue deleting the subject.",
                                });
                            }
                        }
                    });
                });


                $('.subjectEdit').on('click', async function() {
                    let id = $(this).data('id')
                    await subjectEditShow(id);
                    $('#subjectEditModal').modal('show');
                })


                $('.subjectSubjectCreate').on('click', async function() {
                    let id = $(this).data('id')
                    await subSubjectCreateShow(id);
                    $('#sbuSubjectCreateModal').modal('show');
                })

                $('.subSubjectView').on('click', async function() {
                    let id = $(this).data('id')
                    await subSubjectViewShow(id);
                    $('#subSubjectViewModal').modal('show');
                })

            } catch (error) {
                console.error('Error fetching class lists:', error);
            }

        }
    </script>
