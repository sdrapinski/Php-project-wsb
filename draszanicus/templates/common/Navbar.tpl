<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="./images/logo.png" alt="Logo" height="40" />
    </a>

    <form class="form-inline mx-auto col-6">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Group name" />
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="button">
            Search
          </button>
        </div>
      </div>
    </form>

    <div id="navPanel">
      {include "./NavPanel.tpl"}
    </div>

  </div>
</nav>
