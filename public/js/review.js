const formID = 'reviewProduct';
const starRatingClass = 'rating-color';
var selectedStars = 0;



reviewForm = document.getElementById(formID);


reviewForm.onsubmit=function(){
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('productid');
    reviewForm.setAttribute("action", "/add-review?stars="+selectedStars+"&productid="+myParam);
}
//Set Class Valid / InValid//

function getClasses(field){
    var classes = field.className;
    var classes = classes.split(' ');
    return classes;
}

//Activate the Star in given Field
function activateStar(field){
    var classes = getClasses(field);
    var index = classes.indexOf(starRatingClass);
    if(index == -1){
        field.className += " "  + starRatingClass;
    }
}

//Deactivate the Stars
function deactivateStar(field){
    var classes = getClasses(field);
    field.className = "";
    for(var i = 0; i < classes.length; i++){
        if(classes[i] != starRatingClass)
        {
            field.className += " " + classes[i];
        }
    }
}

function activeAllOnHover(index){
    var ratingContainer = reviewForm.querySelector(".userRating");

    var starsArray = ratingContainer.children;

    for(var i = 0; i<starsArray.length -1 ; i++){
        if(i <= index){
            activateStar(starsArray[i]);
        }
        else{
            deactivateStar(starsArray[i]);
        }
    }
}

function colorSelectedOnly(){
    var ratingContainer = reviewForm.querySelector(".userRating");

    var starsArray = ratingContainer.children;

    for(var i = 0; i<starsArray.length-1; i++){
        if(i < selectedStars){
            activateStar(starsArray[i]);
        }
        else{
            deactivateStar(starsArray[i]);
        }
    }
}

function chooseStars(stars){
    selectedStars=stars;
    var ratingContainer = reviewForm.querySelector(".userRating");

    var rating = ratingContainer.children[5];

    rating.innerHTML = "(" + stars + ")";
}