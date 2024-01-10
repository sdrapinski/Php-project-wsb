<script src="/js/modals/modal.min.js"></script>

<button id="loginBtn" class="btn btn-primary" type="button">Log in</button>

<script>
    const btn = document.getElementById("loginBtn")

    const body = `
        <div class="card">
        <form method="post" id="loginForm">
        <div class="card-body">
        <div class="row">
        <div class="col-12 input-group my-1">
        <input class="form-control" type="text" placeholder="Login" name="inputLogin">
        </div>
    <div class="col-12 input-group my-1">
        <input class="form-control" type="text" placeholder="Password" name="inputPassword">
    </div>
    </div>
    </div>
    </form>
    <div class="card-footer">
        <button class="btn btn-primary" data-bs-dismiss="modal" type="button" id="login">Log in</button>
        <button class="btn btn-primary" data-bs-dismiss="modal" type="button" id="register">Register</button>
    </div>
    </div>
    <script>
        document.getElementById("login").addEventListener("click",async ()=>{
            const form = new FormData(document.getElementById("loginForm"))
            const response = await fetch("/loginApi",{
                method:"post",
                body: form
            })
            const result = await response.text()
            if(result === '"fail"'){
                return
            }

            document.body.innerHTML = result
            const html = document.getElementById("navPanel")
            const scripts = html.querySelectorAll("script")
            scripts.forEach((script)=>{
            eval(script.textContent)
            })
        })
   <\/script>`

    btn.addEventListener("click", ()=>{
        makeModal({
            body: body,
            size: "md"
        })
    })
</script>