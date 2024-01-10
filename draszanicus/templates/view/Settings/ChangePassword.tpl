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
              <label for="currentPassword" class="form-label"
                >Current Password:</label
              >
              <input
                type="password"
                class="form-control"
                id="currentPassword"
                name="currentPassword"
                required
              />
            </div>
            <div class="mb-3">
              <label for="newPassword" class="form-label">New password:</label>
              <input
                type="password"
                class="form-control"
                id="newPassword"
                name="newPassword"
                required
              />
            </div>
            <div class="mb-3">
              <label for="confirmPassword" class="form-label"
                >Confirm new password:</label
              >
              <input
                type="password"
                class="form-control"
                id="confirmPassword"
                name="confirmPassword"
                required
              />
            </div>
            <button type="submit" class="btn btn-primary">
              change password
            </button>

            <input
              type="hidden"
              class="form-control"
              id="newPassword"
              name="action"
              value="change-password"
            />
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
