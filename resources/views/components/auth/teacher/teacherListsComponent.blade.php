<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard / teachers</li>
            </ol>
            <div class="row">
                <div class="col-xl-11 col-md-12 col-sm-12 mx-auto">
                    <div class="card">
                        <h5 class="card-header">Teacher Lists</h5>
                        <div class="card-body">
                            <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#teacherCreateModal">CREATE TEACHER</button><br><br>
                            <table class="table table-bordered" id="teacherTable">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tacherTableBody">

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>




    <script>
        let teacherListToken = localStorage.getItem('authToken')
        if(!teacherListToken){
            window.location.href="/login"
        }

        getTeacherList();
        async function getTeacherList() {
            let tableBody = $('#tacherTableBody');
                tableBody.empty();
            try {
                let res = await axios.get('/teacher-lists',{
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('authToken')}`
                    }
                })
                let teachers = res.data.teachers   
                teachers.forEach((element,index) => {
                    let imagePath;
                    if(element.photo === null){
                        imagePath = `{{asset('assets/profile/default.jpg')}}`
                    }else{
                        imagePath = `{{asset('/assets/profile/${element.photo}')}}`
                    }
                   
                    console.log(imagePath)
                    let row = `
                       <tr>
                          <th scope="col02">${index+1}</th>
                          <th scope="col">${element.name}</th>
                          <th scope="col">${element.email}</th>
                          <th scope="col">
                            <img src='${imagePath}' width="150" height="150" alt="NOT FOUND" class='img-fluid'>
                            </th>
                          <th scope="col">${element.phone ? element.phone:'NONE'}</th>
                          <th scope="col">
                          <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                              <button type="button" class="btn btn-danger">DELETE</button>
                              <button type="button" class="btn btn-warning">MESSAGE</button>
                          </div>
                          </th>
                        </tr>
                    `
                        tableBody.append(row);
                });

            } catch (error) {
                console.log("error", error);
            }
        }
    </script>
