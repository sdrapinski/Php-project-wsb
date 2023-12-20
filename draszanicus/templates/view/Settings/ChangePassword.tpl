<!DOCTYPE html>
<html lang="en">

<head>
    {include "../../common/Head.tpl"}
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="/profile/change-password" method="post">
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Obecne hasło:</label>
                        <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">Nowe hasło:</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Potwierdź nowe hasło:</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Zmień hasło</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
