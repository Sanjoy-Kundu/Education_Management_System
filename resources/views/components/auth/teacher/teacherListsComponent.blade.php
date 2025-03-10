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
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#teacherCreateModal">CREATE TEACHER</button><br><br>
                            <table class="table table-bordered" id="teacherTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">Age</th>
                                            <th scope="col">Action</th>
                                       
                                        </tr>
                                    </thead>
                                    <tbody id="lists-table-body">
                                    
                                    </tbody>
                          
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>