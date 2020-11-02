//Creating Variables for different elements
const game = document.getElementById('tetris-game');
const content = game.getContext("2d");
const scoreObject = document.getElementById("score");

//Deciding on how big the game board is
const ROW = 15;
const COL = COLUMN = 10;
const SQ = squareSize = 20;
const FREE = "WHITE";

//Drawing the squares on the board
function DrawSquare(x,y,color){
    content.fillStyle= color;
    content.fillRect(x*SQ,y*SQ,SQ,SQ);
    content.strokeStyle = "BLACK";
    content.strokeRect(x*SQ,y*SQ,SQ,SQ);
}

//Making the board into an array that contains Columns and rows
let board =[];
for( r = 0; r<ROW; r++){
    board[r] = [];
    for(c=0; c < COL; c++){
      board[r][c] = FREE;
    }
}

//Displaying the board
function DrawBoard(){
    for( r=0; r<ROW; r++){
      for(c=0; c<COL; c++){
        DrawSquare(c,r,board[r][c]);
      }
    }
}

DrawBoard();

//Random Color generator
function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  var white =/(^#ff)(.*)/;
  if(color.match(white)){
    color = color.replace(white,'#00$2');
  }
  return color;
}

//Defines the colour of the different blocks that are defined in the tetrisFigures file
function MakeFigure(){
  var FIGURES = [
      [Z,getRandomColor()],
      [S,getRandomColor()],
      [T,getRandomColor()],
      [O,getRandomColor()],
      [L,getRandomColor()],
      [I,getRandomColor()],
      [J,getRandomColor()]
  ];
  return FIGURES;
}

//Choosing a random piece from the above Function
function RandomPiece(){
    let r = randomF = Math.floor(Math.random() * MakeFigure().length) // 0 -> 6
    return new Figure( MakeFigure()[r][0],MakeFigure()[r][1]);
}

let f = RandomPiece();

//Creating a figure that acts as said piece properties
function Figure(tetromino,color){
    this.tetromino=tetromino;
    this.color=color;
    this.tetrominoN=0;
    this.activeTetromino=this.tetromino[this.tetrominoN];
    this.x=3;
    this.y=-2;
}

//Drawing said piece and colouring the border and pause depending on said piece color
Figure.prototype.fill = function(color){
    for(r=0;r<this.activeTetromino.length;r++){
      for(c=0; c<this.activeTetromino.length;c++){
        if(this.activeTetromino[r][c]){
          DrawSquare(this.x + c,this.y + r,color);
          document.getElementById("tetris-game").style.borderColor=color;
          document.getElementById("Pause").style.background=color;
        }
      }
    }
}

//Colouring said piece
Figure.prototype.Draw=function(){
    this.fill(this.color);
}

//UnColouring said piece making it white
Figure.prototype.UnDraw=function(){
    this.fill(FREE);
}

//Creating a variable that stores game state
var GameOver = false;

//Function that is used when piece is moved down
Figure.prototype.MoveDown= function(){
    if(!this.collision(0,1,this.activeTetromino)&&!GameOver){
      this.UnDraw();
      this.y++;
      this.Draw();
    }
    else{
      this.lock();
      f = RandomPiece();
    }
}

//Function used when piece is moved to the right
Figure.prototype.MoveRight= function(){
    if(!this.collision(1,0,this.activeTetromino)){
      this.UnDraw();
      this.x++;
      this.Draw();
    }
}

//Function that is used when the piece is move to the left
Figure.prototype.MoveLeft= function(){
    if(!this.collision(-1,0,this.activeTetromino)){
      this.UnDraw();
      this.x--;
      this.Draw();
    }
}

//Function that is called when rotating the piece clock wise
Figure.prototype.rotate= function(){
    let nextPatern = this.tetromino[(this.tetrominoN + 1)%this.tetromino.length];
    let kick = 0;

    if(this.collision(0,0,nextPatern)){
      if(this.x>COL/2){
        kick = -1;
      }
      else{
        kick= 1;
      }
    }
    if(!this.collision(kick,0,nextPatern)){
      this.UnDraw();
      this.x += kick;
      this.tetrominoN = (this.tetrominoN + 1)%this.tetromino.length;
      this.activeTetromino = this.tetromino[this.tetrominoN];
      this.Draw();
    }
}

//Variable that stores the user's score
let score = 0;

//Function that temporary places the different pieces when they reach the bottom or collide
//with another piece that is underneath them until row is cleared or game is reset
Figure.prototype.lock = function(){
  for(r=0; r< this.activeTetromino.length; r++){
    for(c=0; c<this.activeTetromino.length; c++){
      if(!this.activeTetromino[r][c]){
        continue;
      }
      if(this.y + r < 0){
        GameOver=true;
        break;
      }
      board[this.y+r][this.x+c]=this.color;
    }
  }
  for(r = 0; r<ROW;r++){
    let IsRowFull = true;
    for(c=0;c<COL;c++){
      IsRowFull= IsRowFull && (board[r][c]) != FREE;
    }
    if(IsRowFull){
      for( y = r; y>1 ; y--){
        for( c=0; c<COL; c++){
        board[y][c] = board[y-1][c];
        }
      }
      for(c=0; c<COL; c++){
        board[0][c]= FREE;
      }
      score+= 10;
    }
  }
  DrawBoard();

  scoreObject.innerHTML= score;
}

//Function that detects whether pieces will colide with the different size of the box or with each other
Figure.prototype.collision = function(x,y,figure){
  for(r=0;r<figure.length;r++){
    for(c=0;c<figure.length;c++){
      if(!figure[r][c]){
        continue;
      }
      let NewX = this.x + c + x;
      let NewY = this.y + r + y;

      if(NewX < 0 || NewX >=COL || NewY>=ROW){
        return true;
      }
      if(NewY < 0){
        continue;
      }
      if(board[NewY][NewX] != FREE){
        return true;
      }
    }
  }
  return false;
}

//EventListener for user presses
document.addEventListener("keydown",MOVESET);

//Function that calls specific function for movement of said piece depending on user keypress
function MOVESET(event){
  if(event.keyCode==37){
    f.MoveLeft();
    DropStart = Date.now();
  }
  else if(event.keyCode==38){
    f.rotate();
    DropStart = Date.now();
  }
  else if(event.keyCode==39){
    f.MoveRight();
    DropStart = Date.now();
  }
  else if(event.keyCode==40){
    f.MoveDown();
  }
}

//Variables used for the timeout function that moves said piece down after a certain amount of time
// that decreases each time the user scores 50 points
var id;
var timeDelay=500;
var timesScoredUp=50;

//Function that continuesly drops said piece until it collides with the bottom or another piece from bellow
function Drop(){
  if(!GameOver){
    RandomPiece();
    if(timeDelay>75){
      if(timesScoredUp<=score){
        timeDelay-=50;
        timesScoredUp+=50;
      }
    }
    id = setTimeout(function(){ f.MoveDown(); requestAnimationFrame(Drop); }, timeDelay);

  }
  else if(GameOver || MPressed){
    window.clearTimeout(id);
    RanTimes = 0;
    document.getElementById("Pause").innerHTML="Game Over<br>Press Enter To Start Again";
    document.getElementById("Pause").style.display="block";
  }

}

//Variable that stores how many times the user has pressed enter
var RanTimes = 0;

//Function that initisializes the game
function GameStart(start){
  if(start && RanTimes==0){
    document.getElementById("Pause").style.display="none";
    console.log("I Ran1");
    if(GameOver){
      score=0;
      timeDelay=500;
      scoreObject.innerHTML= score;
      timesScoredUp=50;
      GameOver = false;
      for( r = 0; r<ROW; r++){
          board[r] = [];
          for(c=0; c < COL; c++){
            board[r][c] = FREE;
          }
      }
      DrawBoard();
    }
    Drop();
    RanTimes++;
  }
  else if(RanTimes==1){
    window.clearTimeout(id);
    document.getElementById("Pause").innerHTML="Game Paused";
    document.getElementById("Pause").style.display="block";
    RanTimes = 0;
  }

}
