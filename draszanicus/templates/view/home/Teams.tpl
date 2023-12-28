<div class="col-md-2 h-100">
  {if count($teams) > 0} {foreach $teams as $team}
  <div class="col m-3 d-flex justify-content-center">
    <button style="min-width: 100px" class="btn btn-block btn-outline-primary">
      {$team.name}
    </button>
  </div>
  {/foreach} {else}
  <div class="col m-3 d-flex justify-content-center">
    <span> You dont have any teams</span>
  </div>
  {/if}
</div>
