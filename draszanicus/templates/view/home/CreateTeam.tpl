<div class="col-md-2">
  <form action="/createTeam" method="post">
    <div class="form-floating mb-3">
      <input
        type="text"
        class="form-control"
        id="floatingInput"
        placeholder="Group name"
        name="teamName"
      />

      <label for="floatingInput">Group Name</label>
    </div>
    <div class="form-floating mb-3">
      <textarea
        class="form-control"
        placeholder="Enter a group Description"
        name="teamDescription"
        id="floatingTextarea"
      ></textarea>
      <label for="floatingTextarea">Description</label>
    </div>
    <button type="submit" class="btn btn-primary w-100 h-30">
      Create Group
    </button>
    <input type="hidden" name="action" value="createTeam" />
  </form>
</div>
