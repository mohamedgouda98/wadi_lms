var rush = rush || {};
rush.Preloader = (function(){
  // constructor
  function Preloader(game) {
    this.game = game;

    var bg = new createjs.Shape();
    bg.graphics.beginFill("#000");
    bg.graphics.rect(0, 0, game.stage.canvas.width, game.stage.canvas.height);
    this.addChild(bg);

    var progressBar = new createjs.Shape();
    progressBar.graphics.beginFill("#333");
    this.addChild(progressBar);
    this.progressBar = progressBar;

    var percentageText = new createjs.Text("loading...0", "32px sans-serif", "#999");
    percentageText.x = game.stage.canvas.width/2;
    percentageText.y = game.stage.canvas.height/2;
    percentageText.textAlign = "center";
    percentageText.textBaseline = "middle";
    this.addChild(percentageText);
    this.percentageText = percentageText;
  };

  Preloader.prototype = new createjs.Container();

  var root_url = document.getElementById('root_url').value;

  Preloader.prototype.loadGraphics = function(){
    var imagesList = [
      {name:"coin", path:root_url+ "/public/games/rush/images/coin.png"},
      {name:"obstacle", path:root_url+ "/public/games/rush/images/obstacle.png"},
      {name:"platform", path:root_url+ "/public/games/rush/images/platform.png"},
      {name:"platformLeft", path:root_url+ "/public/games/rush/images/platform-left.png"},
      {name:"platformRight", path:root_url+ "/public/games/rush/images/platform-right.png"},
      {name:"platformMiddle", path:root_url+ "/public/games/rush/images/platform-middle.png"},
      {name:"hero", path:root_url+ "/public/games/rush/images/running.png"},
      {name:"trees", path:root_url+ "/public/games/rush/images/trees.png"},
    ];

    rush.graphics = {};

    var totalFiles = imagesList.length;
    var loadedFiles = 0;
    for (var i=0, len=totalFiles; i<len; i++) {
      imageToLoad = imagesList[i];
      var img = new Image();
      // make sure we have onload event declaring before setting the src property.
      img.onload = (function(event) {
        loadedFiles++;
        console.log ('loaded', event, loadedFiles, '/', totalFiles)

        this.updateProgress(loadedFiles/totalFiles);

        if (loadedFiles >= totalFiles) {
          this.game.stage.removeChild(this);
		  var menuScene = document.getElementById('menu');
          menuScene.classList.remove('hidden');
        }
      }).bind(this);

      console.log ("loading: ", imageToLoad.path);
      img.src = imageToLoad.path;

      rush.graphics[imageToLoad.name] = imageToLoad;
    };
  }

  Preloader.prototype.updateProgress = function(percentage) {
    var width = percentage * this.game.stage.canvas.width;
    this.progressBar.graphics.rect(0, 0, width, this.game.stage.canvas.height);
    this.percentageText.text = "loading..." + Math.round(percentage*100);
    this.game.stage.update();
  }


  return Preloader;
})();