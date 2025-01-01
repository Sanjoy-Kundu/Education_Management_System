<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard / class</li>
            </ol>
            <div class="row">
                <div class="col-xl-11 col-md-12 col-sm-12 mx-auto">
                    <div class="card">
                        <h5 class="card-header">Class Lists</h5>
                        <div class="card-body">
                            <button class="btn btn-primary w-25">ADD CLASS</button><br><br>

                            <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Action</th>
                                       
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                        </tr>
                                    </tbody>
                          
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <script>
        let token = localStorage.getItem('auth_token');
        
        if (token) {
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
            getClassLists();
        } else {
            console.error('No auth token found');
        }
        
        async function getClassLists() {
            try {
                const res = await axios.get('/student-class-lists');
                console.log(res.data);
            } catch (error) {
                console.error('Error', error);
            }
        }
        </script>
        