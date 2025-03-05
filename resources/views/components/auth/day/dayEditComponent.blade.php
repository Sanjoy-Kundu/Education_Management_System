<div class="modal fade" id="dayEditModal" tabindex="-1" aria-labelledby="dayEditModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Your Day</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="mb-3 d-none">
                        <label for="name" class="form-label">id</label>
                        <input type="text" class="form-control" id="edit_day_id">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit_day_name" name="name"
                            placeholder="Enter Your Name">
                        <div id="day_name_error" class="text-danger"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    id="day_modal_close">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateClass(event)">UPDATE</button>
            </div>
        </div>
    </div>
</div>

<script>
    async function dayEditModalShow(id) {
        document.getElementById('edit_day_id').value = id;
        try {
            let res = await axios.post('/day-details-by-id', {
                id: id
            })
            if (res.data.status === 'success') {
                document.getElementById('edit_day_name').value = res.data.dayData.name
            } else {
                console.log(res.data.message);
            }
        } catch (error) {
            console.error("error", error);
        }
    }



    async function updateClass(event) {
        event.preventDefault();
        let id = document.getElementById('edit_day_id').value
        let name = document.getElementById('edit_day_name').value


        let data = {
            id: id,
            name: name,
        }
        try {
            let res = await axios.post("/day-update-by-id", data)
            if (res.data.status === 'success') {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: res.data.message,
                    timer: 1000
                });
                await getDayLists();
                let modal = bootstrap.Modal.getInstance(document.getElementById('dayEditModal'));
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
