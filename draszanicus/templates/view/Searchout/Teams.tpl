<div class="col-md-8 border-end border-start">
  <div class="row">
    <div class="col-md-12">
      {if $teams && is_array($teams)}
        {foreach $teams as $team}
          <div class="card mb-3">
            <div class="card-body">
              <h5 class="card-title">{$team.name}</h5>
              <form class="form-inline mx-auto col-6" method="post" action="/search">
                {if $team.isJoined}
                  <button class="btn btn-block btn-outline-danger" style="position: absolute; top: 0; right: 0;" name="Leave" value="{$team.id}">Leave</button>
                {else}
                  <button class="btn btn-block btn-outline-primary" style="position: absolute; top: 0; right: 0;" name="Join" value="{$team.id}">Join</button>
                {/if}
              </form>
              <p class="card-text">{$team.description}</p>
              <p class="card-text">Members:{$team.MemberCount}</p>
            </div>
          </div>
        {/foreach}
      {else}
        <p>No Groups Found.</p>
      {/if}
    </div>
  </div>
</div>