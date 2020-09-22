// お知らせ個別ページiframe

const comment = document.getElementById("comment");

function commentHeight() {
  comment.style.height = comment.contentWindow.document.body.scrollHeight + "px";
  console.log('Hhhh')
}

