<script>
  // JavaScript code to handle team switching and storing the current team ID in localStorage
  document.addEventListener("DOMContentLoaded", function () {
    // Check if localStorage has a stored team ID
    var currentTeamId = localStorage.getItem("currentTeamId");

    // If there's a stored team ID, highlight the corresponding button or perform other actions
    var buttonTest = document.getElementById("actualID").value;
    if (currentTeamId) {
      if (buttonTest) {
        var highlightedButton = document.querySelector(
          'button[data-team-id="' + buttonTest + '"]'
        );
      } else {
        var highlightedButton = document.querySelector(
          'button[data-team-id="' + currentTeamId + '"]'
        );
      }

      var teamIdInput = document.getElementById("teamIdInput");
      if (teamIdInput) {
        teamIdInput.value = currentTeamId;
      }
      if (highlightedButton) {
        highlightedButton.classList.add("btn-primary");
        highlightedButton.style.color = "white";
      }
    }

    // Add click event listeners to all team buttons
    var teamButtons = document.querySelectorAll(".team-button");
    teamButtons.forEach(function (button) {
      button.addEventListener("click", function (event) {
        // Get the team ID from the clicked button
        var teamId = event.target.getAttribute("data-team-id");

        // Store the team ID in localStorage
        localStorage.setItem("currentTeamId", teamId);

        // Optionally, highlight the clicked button or perform other actions
        teamButtons.forEach(function (btn) {
          btn.classList.remove("btn-primary");
        });
        event.target.classList.add("btn-primary");
      });
    });
  });
</script>

<div class="col-md-2 h-100">
  {if count($teams) > 0} {foreach $teams as $team}
  <div class="col m-3 d-flex justify-content-center">
    <form action="/switchTeam" method="get">
      <input type="hidden" name="action" value="switchTeam" />
      <input type="hidden" name="teamId" value="{$team.id}" />
      <button
        style="min-width: 100px"
        class="btn btn-block btn-outline-primary team-button"
        data-team-id="{$team.id}"
      >
        {$team.name}
      </button>
    </form>
    <input type="hidden" id="actualID" value="{$teamButton}" />
  </div>
  {/foreach} {else}
  <div class="col m-3 d-flex justify-content-center">
    <span> You don't have any teams</span>
  </div>
  {/if}
</div>