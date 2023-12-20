<!DOCTYPE html>
<html lang="en">

<head>
    {include "../../common/Head.tpl"}
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="/profile/change-email" method="post">
                    <div class="mb-3">
                        <label for="currentEmail" class="form-label">Obecny adres e-mail:</label>
                        <input type="email" class="form-control" id="currentEmail" name="currentEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="newEmail" class="form-label">Nowy adres e-mail:</label>
                        <input type="email" class="form-control" id="newEmail" name="newEmail" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Zmień adres e-mail</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
