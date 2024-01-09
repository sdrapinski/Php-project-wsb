<!DOCTYPE html>
<head>
  {include "../../common/Head.tpl"}
</head>
<body>
  <div class="container-fluid">{include "../../common/Navbar.tpl"}</div>
  <div class="row m-2">
    {include "./Teams.tpl" teams=$teams teamButton=$teamButton} {include
    "./MainContent.tpl" posts=$posts} {include "./CreateTeam.tpl"}
  </div>
  {var_dump($info)}
  <script defer src="/js/textareaFunctions.js"></script>
</body>