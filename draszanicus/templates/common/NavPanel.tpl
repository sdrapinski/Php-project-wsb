{if !empty($user)}
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="#">{$user["username"]}</a>
        </li>
    </ul>
{else}
    {include "./LoginModal.tpl"}
{/if}