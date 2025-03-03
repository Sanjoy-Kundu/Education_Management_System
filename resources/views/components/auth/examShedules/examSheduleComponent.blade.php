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

                            <!-- Filter Dropdown -->
                            <div class="mb-3 w-25">
                                <label for="classFilter" class="form-label">
                                    <h5>Filter by Class:</h5>
                                </label>
                                <select class="form-select" id="classFilter">
                                    <option value="">Select Class</option>
                                </select>
                            </div>

                            <!-- Dynamic Button -->
                            <div id="viewClassButtonContainer" class="mb-3" style="display: none">
                                <button id="viewClassButton" class="btn btn-warning">View Your Class Routine</button>
                            </div>

                            <table class="table table-bordered" id="examSheduleTable">
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
                                        <th scope="col">View Routine</th>
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
        } else {
            console.error('No auth token found');
        }


        // filtering class list
        filteringClassLists()
        async function filteringClassLists(classId = '') {
            try {
                let res = await axios.get('/student-class-lists');
                let classes = res.data.classLists;
                let classFilter = $('#classFilter');
                classFilter.empty();
                classFilter.append('<option value="">Select Class</option>');
                classes.forEach(cls => {
                    classFilter.append(`<option value="${cls.id}">${cls.name}</option>`);
                });
            } catch (error) {
                console.error('Error fetching class lists:', error);
            }
        }


        //======== filter data click system ===========
        $('#classFilter').on('change', function() {
            let selectedClassId = $(this).val();
            getExamSheduleListsShow(selectedClassId);
        });
        //======== filter data click system ===========
        // filtering class list



        getExamSheduleListsShow();
        async function getExamSheduleListsShow(classId = "") {
            try {
                let res = await axios.get('/exam-schedule-lists');
                let lists = res.data.exam_schedules;
                //console.log(lists);

                //filter lists by class name 
                if (classId) {
                    //lists = lists.filter(list => list);
                    lists = lists.filter(list => list.student_class_id == classId);
                    //console.log(lists);
                }
                console.log(lists);
                //filter lists by class name 

                let listSectionBody = $('#examshedule-table-body');
                listSectionBody.empty(); // Clear previous data
                if (lists.length === 0) {
                    listSectionBody.append(
                        '<tr align="center"><td colspan="9" class="text-primary">No data found</td></tr>');
                }


                const formatTimeBD = (time) => {
                    const [hour, minute, second] = time.split(':');
                    let h = parseInt(hour);
                    const ampm = h >= 12 ? 'PM' : 'AM';
                    h = h % 12 || 12;
                    return `${h}:${minute}:${second} ${ampm}`;
                };


                lists.forEach((element, index) => {
                    console.log(element.sub_subject === null ? "Vlue is Null" : element.subject);
                    let startTimeBD = formatTimeBD(element.start_time);
                    let endTimeBD = formatTimeBD(element.end_time);

                    let row = `
                                    <tr>
                                        <td>${index+1}</td>
                                        <td>${element.student_class.name}</td>
                                        <td>${element.subject.name}</td>
                                        <td>${element.sub_subject.sub_subject_code}</td>
                                        <td>${element.name}</td>
                                        <td>${element.exam_date}</td>
                                        <td>${startTimeBD} - ${endTimeBD}</td>
                                        <td>${element.sub_subject.full_marks}</td>
                                        <td>
                                          <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                          <button type="button" class="btn btn-danger examSheduleDelete" data-id="${element.id}">DELETE</button>
                                          <button type="button" class="btn btn-warning examSheduleEdit" data-id="${element.id}">EDIT</button>
                                         </div>
                                        </td>
                                        <td><button type="button" class="btn btn-warning examSheduleRoutineView" data-id="${element.student_class.id}">View Routine</button></td>
                                    </tr>
                    `
                    listSectionBody.append(row);
                });



                $('.examSheduleDelete').on('click', function() {
                    let id = $(this).data('id');
                    console.log('Deleting exam with id:', id);

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
                                let res = await axios.post('/exam-schedule-delete-by-id', {
                                    id: id
                                });

                                if (res.data.status === 'success') {
                                    await getExamSheduleListsShow();
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

                $('.examSheduleEdit').on('click', async function() {
                    let id = $(this).data('id')
                    await examSheduleEditShow(id);
                    $('#examSheduleUpdateModal').modal('show');
                })


                $('.examSheduleRoutineView').on('click', async function() {
                    let id = $(this).data('id')
                    await examSheduleRoutineView(id);
                    $('#examSheduleRoutineViewModal').modal('show');
                })



       
            } catch (error) {
                console.error('Error fetching exam lists:', error);
            }
        }
    </script>
