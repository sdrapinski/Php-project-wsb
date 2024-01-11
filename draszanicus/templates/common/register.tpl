<script src="/js/modals/modal.min.js"></script>

<button id="registertn" class="btn btn-primary" type="button">Log in</button>

<script>
  const btn = document.getElementById("registertn");

  const body = `
        <div class="card">
        <form method="post" id="registerForm">
        <div class="card-body">
        <div class="row">
        <div class="col-12 input-group my-1">
        <input class="form-control" type="text" placeholder="Login" name="inputLogin">
        </div>
    <div class="col-12 input-group my-1">
        <input class="form-control" type="text" placeholder="Password" name="inputPassword">
    </div>
    <div class="col-12 input-group my-1">
        <input class="form-control" type="text" placeholder="Repeat Password" name="inputPasswordAgain">
    </div>
    <div class="col-12 input-group my-1">
        <input class="form-control" type="text" placeholder="e-mail" name="inputEmail">
    </div>
    </div>
    </div>
    </form>
    <div class="card-footer">
        <button class="btn btn-primary" data-bs-dismiss="modal" type="button" id="register">Register</button>
    </div>
    </div>
    <script>
        document.getElementById("register").addEventListener("click",async ()=>{
            const form = new FormData(document.getElementById("registerForm"))
            const response = await fetch("/RegisterApi",{
                method:"post",
                body: form
            })
            const result = await response.text()
            if(result === '"fail"'){
                return
            }

            document.getElementById("navPanel").innerHTML = result
        })
   <\/script>`;

  btn.addEventListener("click", () => {
    makeModal({
      body: body,
      size: "md",
    });
  });
</script>
