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
              <label for="newEmail" class="form-label"
                >New Email address:</label
              >
              <input
                type="email"
                class="form-control"
                id="new_email"
                name="newEmail"
                required
              />
            </div>
            <button type="submit" class="btn btn-primary">Change email</button>
            <input
              type="hidden"
              class="form-control"
              id="newEmail"
              name="action"
              value="change-email"
            />
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
