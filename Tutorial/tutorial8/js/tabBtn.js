function chooseOperation(event, operationName) {
  content = document.getElementsByClassName("edit-blk");
  for(i = 0 ; i < content.length; i++) {
    content[i].style.display = "none";
  }
  
  document.getElementById(operationName).style.display = "block";

  tab = document.getElementsByClassName("op-btn");
  
  for (i = 0; i < tab.length; i++) {
    tab[i].className = tab[i].className.replace(" active", "");
  }
  event.currentTarget.className += " active";
}