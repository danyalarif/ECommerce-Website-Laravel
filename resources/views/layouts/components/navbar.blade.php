<div class="headercontainer">
    <header class="header">
        <div>
            <a class="navbar-brand" href="home">
                <img id="logo-img" src="./images/logo-Desktop.png" style="display: block;" width="100">
            </a>
        </div>
        <div class="header-search-container">
            <div class="dropdown">
                <button class="dropdown-toggle header-categories-button" type="button" data-toggle="dropdown">categories
                    <span class="caret"></span></button>
                <ul class="dropdown-menu search-dropdown">
                    <li><a style="display: block;" href="#">Electronic Devices</a></li>
                    <li><a style="display: block;"href="#">Electronic Accessories</a></li>
                    <li><a style="display: block;"href="#">TV and Home Appliances</a></li>
                    <li><a style="display: block;"href="#">Toys</a></li>
                    <li><a style="display: block;"href="#">Clothes and Sports</a></li>
                </ul>
            </div>
            <div class="header-search">
                <form class="header-form" method="POST" action="/search">
                    @csrf
                    <div class="header-input-container">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg><input class="input-field" name="searchField" id="category-search" type="search">
                        <svg id="voice-search" style="cursor: pointer;" class="goxjub" width="26" height="26" focusable="false" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="#4285f4" d="m12 15c1.66 0 3-1.31 3-2.97v-7.02c0-1.66-1.34-3.01-3-3.01s-3 1.34-3 3.01v7.02c0 1.66 1.34 2.97 3 2.97z"></path><path fill="#34a853" d="m11 18.08h2v3.92h-2z"></path><path fill="#fbbc04" d="m7.05 16.87c-1.27-1.33-2.05-2.83-2.05-4.87h2c0 1.45 0.56 2.42 1.47 3.38v0.32l-1.15 1.18z"></path><path fill="#ea4335" d="m12 16.93a4.97 5.25 0 0 1 -3.54 -1.55l-1.41 1.49c1.26 1.34 3.02 2.13 4.95 2.13 3.87 0 6.99-2.92 6.99-7h-1.99c0 2.92-2.24 4.93-5 4.93z"></path></svg>
                    </div>
                    <button class="custom-button" type="submit">Submit</button>
                </form>
            </div>
        </div>
        <div class="icons-div">
            <a style="color: black;" href="cart"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cart icon" viewBox="0 0 16 16">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg></a>
            <span class='badge badge-danger' id='lblCartCount'>0</span>
            <a style="color: black;" href="profile"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person icon" viewBox="0 0 16 16">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
            </svg></a>
            <a style="color: black;" href="wishlist"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-heart icon" viewBox="0 0 16 16">
                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
            </svg></a>
        </div>
    </header>
    <nav class="navbar navbar-expand-md navbar-dark">
        <div class="dropdown" data-size="8">
            <button class="secondary-button dropdown-toggle" type="button" data-toggle="dropdown">Browse by Categories
            <span class="caret"></span></button>
            <ul id="categories-dropdown" class="dropdown-menu categories-dropdown">
                <li class="dropdown-header">Clothes and Sports</li>
                <li><a href="#">Fitness Equipment</a></li>
                <li><a href="#">Sports Equipment</a></li>
                <li><a href="#">Shirts</a></li>
                <li><a href="#">Pants</a></li>
                <li><a href="#">Shoes</a></li>
                <li style="padding: 0;"><div class="dropdown-divider"></div></li>
              <li class="dropdown-header">Electronic Devices</li>
              <li><a href="#">Laptops</a></li>
              <li><a href="#">Smart Phones</a></li>
              <li><a href="#">Desktops</a></li>
              <li><a href="#">Cameras</a></li>
              <li><a href="#">Drones</a></li>
              <li><a href="#">Consoles</a></li>
              <li style="padding: 0;"><div class="dropdown-divider"></div></li>
              <li class="dropdown-header">Electronic Accessories</li>
              <li><a href="#">Headphones</a></li>
              <li><a href="#">Computer Components</a></li>
              <li><a href="#">Speakers</a></li>
              <li><a href="#">Storage</a></li>
              <li><a href="#">Printers</a></li>
              <li style="padding: 0;"><div class="dropdown-divider"></div></li>
              <li class="dropdown-header">TV and Home Appliances</li>
              <li><a href="#">LED Televisions</a></li>
              <li><a href="#">Smart Televisions</a></li>
              <li><a href="#">Home Audio</a></li>
              <li><a href="#">Cooling and Heating</a></li>
              <li><a href="#">Washers and Dryers</a></li>
              <li style="padding: 0;"><div class="dropdown-divider"></div></li>
              <li class="dropdown-header">Toys</li>
              <li><a href="#">Puzzles</a></li>
              <li><a href="#">Games</a></li>
              <li><a href="#">RC Vehicles</a></li>
              <li><a href="#">Dolls</a></li>
            </ul>
        </div> 
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul id="navlist" class="navbar-nav">
                <li class="nav-item"> <a id="homeli" class="nav-link" href="/home">HOME</a> </li>
                <li class="nav-item"> <a class="nav-link" href="/cart">CART</a></li>
                <li class="nav-item"> <a class="nav-link" href="/wishlist">WISHLIST</a></li>
                <li class="nav-item"> <a class="nav-link" href="/orders">ORDERS</a></li>
            </ul>
        </div>
    </nav>
</div>