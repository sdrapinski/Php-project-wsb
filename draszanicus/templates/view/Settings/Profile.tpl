<!DOCTYPE html>
<html lang="en">
<head>
    {include "../../common/Head.tpl"}
</head>
<body>
    <div class="container-fluid">
        {include "../../common/Navbar.tpl"}
    </div>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Profil użytkownika</h1>

        <!-- Zakładki -->
        <ul class="nav nav-tabs" id="myTabs">
            <li class="nav-item">
                <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info">Informacje</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="changeUsername-tab" data-toggle="tab" href="#changeUsername">Zmiana nazwy użytkownika</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="changeEmail-tab" data-toggle="tab" href="#changeEmail">Zmiana adresu e-mail</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="changePassword-tab" data-toggle="tab" href="#changePassword">Zmiana hasła</a>
            </li>
        </ul>

        <!-- Zawartość zakładek -->
        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="info">
                {if isset($username)}
                    <p>Nazwa użytkownika: {$username}</p>
                {/if}
                {if isset($currentEmail)}
                    <p>Email: {$currentEmail}</p>
                {/if}
                {if isset($currentGroups)}
                    <p>Grupy do których należysz: {$currentGroups}</p>
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
        $(document).ready(function(){
            // Śledzenie zmiany hashu w adresie URL
            $(window).on('hashchange', function() {
                var hash = window.location.hash;
                // Aktywacja odpowiedniej zakładki na podstawie hashu
                $('.nav-tabs a[href="' + hash + '"]').tab('show');
            });

            // Inicjalizacja zakładek na podstawie aktualnego hashu
            var hash = window.location.hash;
            $('.nav-tabs a[href="' + hash + '"]').tab('show');
        });
    </script>
</body>
</html>
