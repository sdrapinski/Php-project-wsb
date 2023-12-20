<div class="col-md-8">
  <div class="row">
    <div class="col-md-12">
      <form method="get" id="PostForm">
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

      <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title">Username</h5>
          <p class="card-text">Post text goes here.</p>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  const textarea = document.getElementById("PostTextArea");
  let currentHeight = 100;
  document
    .getElementById("PostTextArea")
    .addEventListener("keydown", function (event) {
      if (event.key === "Enter" && !event.shiftKey) {
        document.getElementById("PostForm").submit();
      } else if (event.key === "Enter" && event.shiftKey) {
        event.preventDefault();

        let startPos = textarea.selectionStart;
        let endPos = textarea.selectionEnd;

        let value = textarea.value;
        let newValue =
          value.substring(0, startPos) +
          "\n" +
          value.substring(startPos, endPos) +
          value.substring(endPos, value.length);

        textarea.value = newValue;
        textarea.setSelectionRange(startPos + 1, startPos + 1);
        adjustTextareaHeight();
      }
    });

  function adjustTextareaHeight() {
    currentHeight += 15;
    textarea.style.height = currentHeight + "px";
  }
</script>
