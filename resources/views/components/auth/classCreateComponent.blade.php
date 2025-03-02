<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter Your Name">
                <div id="class_name_error" class="text-danger"></div>
            </div>
            <div class="mb-3">
                <label for="section" class="form-label">Section</label>
                <input type="text" class="form-control" id="section" placeholder="Enter Your Section">
                <div id="class_section_error" class="text-danger"></div>
            </div>
            <div class="mb-3">
                <label for="section" class="form-label">Capacity</label>
                <input type="number" class="form-control" id="capacity" placeholder="Enter Your Capacity">
                <div id="class_capacity_error" class="text-danger"></div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="class_modal_close">Close</button>
          <button type="button" class="btn btn-primary" onclick="createClass(event)">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    async function createClass(event){
        event.preventDefault();
        document.getElementById('class_name_error').innerText = "";
        document.getElementById('class_section_error').innerText = "";
        document.getElementById('class_capacity_error').innerText = "";

        let name = document.getElementById('name').value;
        let section = document.getElementById('section').value;
        let capacity = document.getElementById('capacity').value;
        let isError = false;


        if(!name){
            document.getElementById('class_name_error').innerText = "Name Field is required";
            isError = true
        }


        // if(!capacity){
        //     document.getElementById('class_capacity_error').innerText = "Capacity Field is required";
        //     isError = true
        // }


        if(isError) return 
        let data = {
            name:name,
            section:section,
            capacity:capacity
        }

       try{
        let res = await axios.post('/student-class-post',data)
        if(res.data.status === 'success'){
            document.getElementById('name').value = ""
            document.getElementById('section').value = ""
            document.getElementById('capacity').value = ""
            document.getElementById('class_modal_close').click();
            await getClassLists();
            console.log(res.data.message);
        }else{
            console.log(res.data.message)
        }
       }catch(error){
        console.error("error message", error)
       }


    }
  </script>