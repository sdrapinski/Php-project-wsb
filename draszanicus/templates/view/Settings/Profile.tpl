<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Profile</title>
    <!-- Dodaj linki do CSS Bootstrap i JS Bootstrap -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    />
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container mt-5">
      <h1 class="text-center mb-4">User Profile</h1>

      <!-- Zakładki -->
      <ul class="nav nav-tabs" id="myTabs">
        <li class="nav-item">
          <a class="nav-link" id="info-tab" data-toggle="tab" href="#info"
            >User Details</a
          >
        </li>
        <li class="nav-item">
          <a
            class="nav-link"
            id="changeUsername-tab"
            data-toggle="tab"
            href="#changeUsername"
            >Change Username</a
          >
        </li>
        <li class="nav-item">
          <a
            class="nav-link"
            id="changeEmail-tab"
            data-toggle="tab"
            href="#changeEmail"
            >Change Email</a
          >
        </li>
        <li class="nav-item">
          <a
            class="nav-link"
            id="changePassword-tab"
            data-toggle="tab"
            href="#changePassword"
            >Change Password</a
          >
        </li>
      </ul>

      <!-- Zawartość zakładek -->
      <div class="tab-content mt-3">
        <div class="tab-pane fade" id="info">
          {if isset($username)}
          <p>Username: {$username}</p>
          {/if} {if isset($currentEmail)}
          <p>Email: {$currentEmail}</p>
          {/if} {if isset($currentGroups)}
          <p>
            Your groups: {foreach $currentGroups as $group} {$group.name},
            {/foreach}
          </p>
          <p style="color: red; font-weight: bold">{$error_info}</p>
          {/if}
        </div>

        <div class="tab-pane fade" id="changeUsername">
          {include "./ChangeUsername.tpl"}
        </div>
        <div class="tab-pane fade" id="changeEmail">
          {include "./ChangeEmail.tpl"}
        </div>
        <div class="tab-pane fade" id="changePassword">
          {include "./ChangePassword.tpl"}
        </div>
      </div>
    </div>

    <script>
      $(document).ready(function () {
        // Funkcja obsługująca zmianę hasha w adresie URL
        function onHashChange() {
          var hash = window.location.hash;
          // Aktywacja odpowiedniej zakładki na podstawie hashu
          if (hash) {
            $('.nav-tabs a[href="' + hash + '"]').tab("show");
          } else {
            $('.nav-tabs a[href="#info"]').tab("show");
          }
        }

        // Śledzenie zmiany hashu w adresie URL
        $(window).on("hashchange", onHashChange);

        // Inicjalizacja zakładek na podstawie aktualnego hashu
        onHashChange();
      });
    </script>
  </body>
</html>
