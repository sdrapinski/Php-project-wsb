<div class="col-md-8 border-end border-start">
  <div class="row">
    <div class="col-md-12">
      <form method="post" id="PostForm">
        <div class="form-floating">
          <textarea
            id="PostTextArea"
            class="form-control mb-3"
            placeholder="Create a Post here"
            style="height: 50px"
          ></textarea>
          <label for="floatingTextarea2">Create a Post</label>
        </div>
      </form>
      {if count($posts) > 0} {foreach $posts as $post}
      <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title">{$post.username}</h5>
          <p class="card-text">{$post.description}</p>
        </div>
      </div>
      {/foreach}{else}
      <div>
        <p class="card-text">this team has no posts</p>
      </div>
      {/if}
    </div>
  </div>
</div>
