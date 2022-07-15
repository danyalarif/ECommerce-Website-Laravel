
handleCategoriesClick()
let current = 'all'
function handleCategoriesClick(){
    let selectedCategory = null
    const categoriesTags = document.querySelectorAll('#categories-dropdown a')
    for (let link of categoriesTags)
    {
        link.onclick = () => {
            selectedCategory = link.innerHTML
            let newPage = 'category?category=' + selectedCategory      //passing the selected category as a query string to the next page
            window.open(newPage, '_self')
        }
    }
}

$( document ).ready(function() {
    $('.dropdown').each(function (key, dropdown) {
        var $dropdown = $(dropdown);
        $dropdown.find('.dropdown-menu a').on('click', function () {
            $dropdown.find('button').text($(this).text()).append(' <span class="caret"></span>');
            current = this.innerHTML
        });
    });
});

let form = document.getElementsByClassName('header-form')[0]
form.onsubmit = () => {
    form.setAttribute('action', '/search?category=' + current)
}

let cartCount = document.getElementById('lblCartCount')
let p = JSON.parse(localStorage.getItem("products") || "[]")
cartCount.innerText = p.length

let speech = document.getElementById('voice-search')
speech.onclick = () => {
    let field = document.getElementsByName('searchField')[0]
    var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
    var recognition = new SpeechRecognition(); 
    recognition.onstart = function() {
        //do stuff
    };

    recognition.onspeechend = function() {
        recognition.stop();
    }
                
    // This runs when the speech recognition service returns result
    recognition.onresult = function(event) {
        let transcript = event.results[0][0].transcript;
        let confidence = event.results[0][0].confidence;
        field.value = transcript
    };
                
    // start recognition
    recognition.start();   
}