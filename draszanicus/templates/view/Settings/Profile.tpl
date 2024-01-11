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
    <div class="container-fluid">
      <a href="/">
        <button class="btn btn-link">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            fill="currentColor"
            class="bi bi-arrow-left"
            viewBox="0 0 16 16"
          >
            <path
              fill-rule="evenodd"
              d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"
            />
          </svg>
          Back
        </button></a
      >
    </div>
    <div class="mt-5 container">
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
