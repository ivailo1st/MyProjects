//Variables for checkbox
var checkbox = document.getElementById('checkbox');
var checked = true;
//Variables for flip animation

//Variables for Buttons
var buttonBack = document.getElementById("ToDo-Back-Button");
var buttonAdd = document.getElementById("button-add");
var buttonDone = document.getElementById("done-button");
var buttonRemove = document.getElementById("remove-button");
var buttonSave = document.getElementById("save-button");

//Variables for the list and input
var toDoEntry = document.getElementById("todo-entry");
var toDoList = document.getElementById("todo-list");

//EventListener for Checkbox
checkbox.addEventListener("click",rememberText);

//EventListeners for buttons
buttonAdd.addEventListener("click",addItem);
buttonDone.addEventListener("click",doneItem);
buttonRemove.addEventListener("click",removeItem);
buttonSave.addEventListener("click",saveItem);

//Function for checkbox
function rememberText(){
  if(checked){
    checked = false;
  }
  else{
    checked = true;
  }
}

//Functions for flipping animation
$('.ToDo-task-wrapper').click(function(){
  $(this).addClass('flipped').mouseleave(function(){
      $(this).removeClass('flipped');
  });
    return true;
});
$('.Weather-task-wrapper').click(function(){
  $(this).addClass('flipped').mouseleave(function(){
      $(this).removeClass('flipped');
  });
    return true;
});
$('.Tetris-wrapper').click(function(){
  $(document).keypress(function(event){
      var Key = (event.keyCode ? event.keyCode : event.which);
      if(Key == '13'){
          GameStart(true);
      }
  });
  $(this).addClass('flipped').mouseleave(function(){
      $(this).removeClass('flipped');
      $(document).off('keypress');

  });
    return true;
});

//Function for Starting Tetris Game


//Functions for buttons
function addItem(){
  var item = toDoEntry.value;
  newItem(item,false);
  console.log(checked);
  if(!checked){
    toDoEntry.value = '';
  }
}
function doneItem(){
  clearItems();
}
function removeItem(){
  emptyList();
}
function saveItem(){
  SaveList();
}

//Function for adding list items
function newItem(item, completed){
  var toDoItem = document.createElement("li");
  var toDoText = document.createTextNode(item);
  if(item!=''){
    toDoItem.appendChild(toDoText);
    if(completed){
      toDoItem.classList.add("completed");
      toDoItem.style.color="#009dd6";
      toDoItem.style.fontWeight="bold";
    }
    toDoList.appendChild(toDoItem);
    toDoItem.addEventListener("click", toggleItemState);
    if(newItem.caller.name != "LoadList"){
      AutoSave();
    }
  }
  else{
    alert("Enter Something");
  }
}

//Function for list completion
function toggleItemState(){

  if(this.classList.contains("completed")){
    this.classList.remove("completed");
    this.style.color="black";
    this.style.fontWeight="400";
  }
  else{
    this.classList.add("completed");
    this.style.color="#009dd6";
    this.style.fontWeight="bold";
  }
  SaveList();
}

//Function for clearing completed items
function clearItems(){
  var completeItems = toDoList.getElementsByClassName('completed');

  while (completeItems.length>0){
    completeItems.item(0).remove();
  }
  AutoSave();
}

//Function for clearing the whole List
function emptyList(){
  var toDoItems=toDoList.children;
  while(toDoItems.length > 0){
    toDoItems.item(0).remove();
  }
  AutoSave();
}

//Function for saving the list
function SaveList(){
  var TodoArray = [];
  for (var i=0; i<toDoList.children.length; i++){
    var ToDo = toDoList.children.item(i);

    var ToDoInfo ={
        "task": ToDo.innerText,
        "completed": ToDo.classList.contains("completed")
    };

    TodoArray.push(ToDoInfo);
    console.log(TodoArray);
  }

  localStorage.setItem("To-Do",JSON.stringify(TodoArray))
  if(SaveList.caller.name == "saveItem"){
    $("#SaveText").html("Saved");
    $("#SaveText").fadeIn(500);
    setTimeout(function(){
    $("#SaveText").fadeOut(500); }, 2000);
  }
}

//Function for loading a saved list
function LoadList(){
    console.log(localStorage.getItem("To-Do"));
    if(localStorage.getItem("To-Do")!=null){
      var TodoArray = JSON.parse(localStorage.getItem("To-Do"));

      for (var i=0; i < TodoArray.length; i++){
        var ToDo = TodoArray[i];
        newItem(ToDo.task,ToDo.completed);
      }
    }
}
LoadList();

//Function for automatically saving
function AutoSave(){
  setTimeout(function(){ SaveList();
  $("#SaveText").html("Saved");
  $("#SaveText").fadeIn(500); }, 500);
  setTimeout(function(){
  $("#SaveText").fadeOut(500); }, 2000);
}
