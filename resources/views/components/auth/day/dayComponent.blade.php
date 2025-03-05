<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard / day</li>
            </ol>
            <div class="row">
                <div class="col-xl-11 col-md-12 col-sm-12 mx-auto">
                    <div class="card">
                        <h5 class="card-header">Days Lists</h5>
                        <div class="card-body">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dayModal">ADD Day</button><br><br>
                            <table class="table table-bordered" id="routineTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
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
        } else {
            console.error('No auth token found');
        }
        console.log(token);
        getDayLists();
        async function getDayLists() {
            try {

                let res = await axios.get('/day-lists');
                let lists = res.data.dayLists;
                let listTableBody = $('#lists-table-body')
                listTableBody.empty(); //clear previous data

                if (lists.length === 0) {
                    listTableBody.append('<tr><td colspan="5" class="text-center text-primary">No data found</td></tr>')
                }

                lists.forEach((element,index) => {
                    console.log(element)
                    let tr = `
                              <tr>
                                <th scope="row">${index+1}</th>
                                <td>${element.name}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <button type="button" class="btn btn-danger dayDelete" data-id="${element.id}">DELETE</button>
                                    <button type="button" class="btn btn-warning classEdit" data-id="${element.id}">EDIT</button>
                                    </div>
                                </td>
                             </tr>
                    `
                    listTableBody.append(tr)
                });




  


            } catch (error) {
                console.error('Error', error);
            }

            $('.dayDelete').on('click', function(){
                let id = $(this).data('id')
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
                        try{
                            let res = await axios.post('/day-delete-by-id',{id:id})
                            if(res.data.status === 'success'){
                                await getDayLists();
                                Swal.fire({
                                title: "Deleted!",
                                text: res.data.message,
                                icon: "success",
                                timer:3000
                                });
                            }else{
                                Swal.fire({
                                            icon: "error",
                                            title: "Error",
                                            text: res.data.message,
                                        });
                            }
                        }catch(error){
                            console.error("error",error)
                        }
                    }
                });
            })


            $('.classEdit').on('click',async function(){
                let id = $(this).data('id')
                await dayEditModalShow(id);
                $('#dayEditModal').modal('show');
            })

            $('.classSectionAdd').on('click', function(){
                let id = $(this).data('id')
              
            })
        }
</script>
        