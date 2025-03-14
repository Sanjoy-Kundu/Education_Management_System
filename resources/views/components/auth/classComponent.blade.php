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
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">ADD CLASS</button><br><br>
                            <table class="table table-bordered" id="routineTable">
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
        let classListToken = localStorage.getItem('authToken');
        if (!classListToken) {
            window.location.href = '/login';
        }
        getClassLists();
        async function getClassLists() {
            try {

                let res = await axios.get('/student-class-lists',{
                    headers: {
                        Authorization: `Bearer ${classListToken}`
                    }
                });
                let lists = res.data.classLists;
                let listTableBody = $('#lists-table-body')
                listTableBody.empty(); //clear previous data

                if (lists.length === 0) {
                    listTableBody.append('<tr><td colspan="5" class="text-center text-primary">No data found</td></tr>')
                }

                lists.forEach((element,index) => {
                    //console.log(element)
                    let tr = `
                              <tr>
                                <th scope="row">${index+1}</th>
                                <td>${element.name}</td>
                                <td>${element.section === ''? "NULL" : element.section}</td>
                                <td>${element.capacity}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <button type="button" class="btn btn-danger classDelete" data-id="${element.id}">DELETE</button>
                                    <button type="button" class="btn btn-warning classEdit" data-id="${element.id}">EDIT</button>
                                    <button type="button" class="btn btn-success classSectionAdd" data-id="${element.id}">ADD SECTION</button>
                                    </div>
                                </td>
                             </tr>
                    `
                    listTableBody.append(tr)
                });




  


            } catch (error) {
                console.error('Error', error);
            }

            $('.classDelete').on('click', function(){
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
                            let res = await axios.post('/student-class-delete-by-id',{id:id},{
                                headers: {
                                    Authorization: `Bearer ${classListToken}`,
                                    'Content-Type': 'application/json'
                                }
                            })
                            if(res.data.status === 'success'){
                                await getClassLists();
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
                await classEditModalShow(id);
                $('#classEditModal').modal('show');
            })

            $('.classSectionAdd').on('click', function(){
                let id = $(this).data('id')
              
            })
        }
</script>
        