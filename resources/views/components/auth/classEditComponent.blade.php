<div class="modal fade" id="classEditModal" tabindex="-1" aria-labelledby="classEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Your Class</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="mb-3 d-none">
                        <label for="name" class="form-label">id</label>
                        <input type="text" class="form-control" id="edit_class_id">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit_class_name" name="name"
                            placeholder="Enter Your Name">
                        <div id="class_name_error" class="text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="section" class="form-label">Section</label>
                        <input type="text" class="form-control" id="edit_class_section" name="section"
                            placeholder="Enter Your Section">
                        <div id="class_section_error" class="text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="section" class="form-label">Capacity</label>
                        <input type="number" class="form-control" id="edit_class_capacity" name="capcity"
                            placeholder="Enter Your Capacity">
                        <div id="class_capacity_error" class="text-danger"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    id="class_modal_close">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateClass(event)">UPDATE</button>
            </div>
        </div>
    </div>
</div>

<script>
    async function classEditModalShow(id) {
        document.getElementById('edit_class_id').value = id;
        try {
            let res = await axios.post('/student-class-detail-by-id', {
                id: id
            })
            if (res.data.status === 'success') {
                document.getElementById('edit_class_name').value = res.data.classData.name
                document.getElementById('edit_class_section').value = res.data.classData.section
                document.getElementById('edit_class_capacity').value = res.data.classData.capacity
            } else {
                console.log(res.data.message);
            }
        } catch (error) {
            console.error("error", error);
        }
    }



    async function updateClass(event) {
        event.preventDefault();
        let id = document.getElementById('edit_class_id').value
        let name = document.getElementById('edit_class_name').value
        let section = document.getElementById('edit_class_section').value
        let capacity = document.getElementById('edit_class_capacity').value

        let data = {
            id: id,
            name: name,
            section: section,
            capacity: capacity
        }
        try {
            let res = await axios.post("/student-class-update-by-id", data)
            if (res.data.status === 'success') {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: res.data.message,
                    timer: 1000
                });
                await getClassLists();

                document.getElementById('edit_class_name').value = ""
                document.getElementById('edit_class_section').value = ""
                document.getElementById('edit_class_capacity').value = ""


                let modal = bootstrap.Modal.getInstance(document.getElementById('classEditModal'));
                modal.hide();

            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: res.data.message,
                });
            }
        } catch (error) {
            console.error("error", error)
        }
    }
</script>
