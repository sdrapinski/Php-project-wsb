let currentHeight = 100;
const textarea = document.getElementById("PostTextArea");

const Post = document.getElementById("PostForm");

textarea.addEventListener("keydown", (event)=>{
  HandleEnter(event, textarea, Post, true)
})

function HandleEnter(event, textarea, Post, changeSize) {
  if (event.key === "Enter" && !event.shiftKey) {
    Post.submit();
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
    if (changeSize) {
      adjustTextareaHeight(textarea, currentHeight);
    }
  }
}

function adjustTextareaHeight(textarea, currentHeight) {
  currentHeight += 15;
  textarea.style.height = currentHeight + "px";
}
