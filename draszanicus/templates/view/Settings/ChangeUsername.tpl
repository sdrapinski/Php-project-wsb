<!DOCTYPE html>
<html lang="en">

<head>
    {include "../../common/Head.tpl"}
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="/profile/change-username" method="post">

                    <div class="mb-3">
                        <label for="currentUsername" class="form-label">Obecna nazwa użytkownika:</label>
                        <input type="text" class="form-control" id="currentUsername" name="currentUsername" required>
                    </div>
                    <div class="mb-3">
                        <label for="newUsername" class="form-label">Nowa nazwa użytkownika:</label>
                        <input type="text" class="form-control" id="newUsername" name="newUsername" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Zmień nazwę użytkownika</button>

                    <input type="hidden" class="form-control" id="newUsername" name="action" value="change-username">
                </form>
            </div>
        </div>
    </div>

</body>

</html>
