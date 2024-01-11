<!DOCTYPE html>
<head>
  {include "../../common/Head.tpl"}
</head>
<body>
  <div class="container-fluid">{include "../../common/Navbar.tpl"}</div>
  <div class="row m-2">
    {include "home/Teams.tpl" teams=$userGroups teamButton=0} {include
    "./Teams.tpl" userId=$userId teams=$teams} {include "home/CreateTeam.tpl"
    user_id=$userId}
  </div>
  <script defer src="/js/textareaFunctions.js"></script>
</body>
