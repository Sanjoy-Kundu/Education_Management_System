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
                            <button class="btn btn-primary w-25" data-bs-toggle="modal" data-bs-target="#subjectModal">ADD CLASS</button><br><br>

                            <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Section</th>
                                            <th scope="col">Capacity</th>
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


    <script>
        let token = localStorage.getItem('authToken');
        if (token) {
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
            console.log(token)
        } else {
            console.error('No auth token found');
        }
        
        </script>
        