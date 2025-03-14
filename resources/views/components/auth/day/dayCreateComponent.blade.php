<div class="modal fade" id="dayModal" tabindex="-1" aria-labelledby="dayModal" aria-hidden="true">
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
                <input type="text" class="form-control" id="name" placeholder="Enter Your Day">
                <div id="day_name_error" class="text-danger"></div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="day_modal_close">Close</button>
          <button type="button" class="btn btn-primary" onclick="createDay(event)">Create Day</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    let dayCreateToken = localStorage.getItem('authToken');
    async function createDay(event){
        event.preventDefault();
        document.getElementById('day_name_error').innerText = "";
  

        let name = document.getElementById('name').value;
        let isError = false;


        if(!name){
            document.getElementById('day_name_error').innerText = "Name Field is required";
            isError = true
        }




        if(isError) return 
        let data = {
            name:name,
        }
        console.log(data);

       try{
        let res = await axios.post('/create-day-post',data,{
            headers:{
              Authorization: `Bearer ${dayCreateToken}`, 
              'Content-Type': 'application/json'
            }
        })
        if(res.data.status === 'success'){
            document.getElementById('name').value = ""
            document.getElementById('day_modal_close').click();
           await getDayLists();
            console.log(res.data.message);
        }else{
          document.getElementById('day_name_error').innerText = res.data.message;
          isError = true
        }
       }catch(error){
        console.error("error message", error)
       }


    }
  </script>