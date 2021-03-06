 <!doctype html>
<!--
  Material Design Lite
  Copyright 2015 Google Inc. All rights reserved.

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

      https://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License
-->

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="ecordering is an online ordering system for restaurants">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ecordering</title>

    <!-- Page styles -->
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.0/material.min.css">
<link rel="stylesheet" href="../../CSS/styles.css">
    
  
    <style>
    #view-source {
      position: fixed;
      display: block;
      right: 0;
      bottom: 0;
      margin-right: 40px;
      margin-bottom: 40px;
      z-index: 900;
    }

#registrationDiv{
      margin-left:0px;
      height:525px;
      width: 330px;
    }

@media screen and (min-width: 400px) {
    #registrationDiv{
      margin-left:30%;
      height:510px;
      width: 420px;
 
    }
}


    
    </style>
  </head>
  <body style="background-image:url('../../images/slide01.jpg')">
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">

      <div class="android-header mdl-layout__header mdl-layout__header--waterfall">
        <div class="mdl-layout__header-row">
          <span class="android-title mdl-layout-title">
            <img class="ecordering" src="../../images/ecordering.png">
          </span>
          <!-- Add spacer, to align navigation to the right in desktop -->
          <div class="android-header-spacer mdl-layout-spacer"></div>
          
          <!-- Navigation -->
          <div class="android-navigation-container">
           
          </div>
          <button class="android-more-button mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect" id="more-button">
            <i class="material-icons">more_vert</i>
          </button>
          <ul class="mdl-menu mdl-js-menu mdl-menu--bottom-right mdl-js-ripple-effect" for="more-button">
            <li disabled class="mdl-menu__item">Hello <?= $_SESSION['login']; ?></li>
            <li class="mdl-menu__item"><a href="http://ecordering.be">Log out</a></li>
            <li class="mdl-menu__item">My subscription<strong>(avaiable soon)</strong></li>
            <li class="mdl-menu__item">My help center<strong> (avaiable soon)</strong></li>
          </ul>
          <span class="android-mobile-title mdl-layout-title">
            <img class="android-logo-image" src="../../images/android-logo.png">
          </span>
        </div>
      </div>
<!--
      <div class="android-drawer mdl-layout__drawer">
        <span class="mdl-layout-title">
          <h2></h2>
        </span>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link" href="">Phones</a>
          <a class="mdl-navigation__link" href="">Tablets</a>
          <a class="mdl-navigation__link" href="">Wear</a>
          <a class="mdl-navigation__link" href="">TV</a>
          <a class="mdl-navigation__link" href="">Auto</a>
          <a class="mdl-navigation__link" href="">One</a>
          <a class="mdl-navigation__link" href="">Play</a>
          <div class="android-drawer-separator"></div>
          <span class="mdl-navigation__link" href="">Versions</span>
          <a class="mdl-navigation__link" href="">Lollipop 5.0</a>
          <a class="mdl-navigation__link" href="">KitKat 4.4</a>
          <a class="mdl-navigation__link" href="">Jelly Bean 4.3</a>
          <a class="mdl-navigation__link" href="">Android history</a>
          <div class="android-drawer-separator"></div>
          <span class="mdl-navigation__link" href="">Resources</span>
          <a class="mdl-navigation__link" href="">Official blog</a>
          <a class="mdl-navigation__link" href="">Android on Google+</a>
          <a class="mdl-navigation__link" href="">Android on Twitter</a>
          <div class="android-drawer-separator"></div>
          <span class="mdl-navigation__link" href="">For developers</span>
          <a class="mdl-navigation__link" href="">App developer resources</a>
          <a class="mdl-navigation__link" href="">Android Open Source Project</a>
          <a class="mdl-navigation__link" href="">Android SDK</a>
        </nav>
      </div>
-->
<!-- CUT : Default view -->
<link rel="stylesheet" href="../../bloc1.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<div class="testbox" id="registrationDiv">
<h2>Registration</h2>


    <form id="registrationForm" action="/reg/registrationSubmit.php" method="POST">
      <fieldset class="centerFieldsets">
         <h5 class="back_title">You are:</h5>
    <div class="input-group">
      <select name="userKind"><option>Cook</option><option>Supplier</option></select>
    </div>
    <h5 class="back_title" >Companies Name:</h5>
    <div class="input-group">
      <input name="companyName" type="text" class="form-control" placeholder="Company" aria-describedby="basic-addon1" required>
    </div>
    <h5 class="back_title" >e-mail:</h5>
    <div class="input-group">
      <input name="email" type="text" class="form-control" placeholder="Mail" aria-describedby="basic-addon1" required>
    </div>
    <h5 class="back_title">Phone number:</h5>
    <div class="input-group">
      <input name="phone" type="text" class="form-control" placeholder="Phone" aria-describedby="basic-addon1" required>
    </div>
    <h5 class="back_title">Adress:</h5>
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Adress" aria-describedby="basic-addon1" name="adress" required>
      <input type="text" class="form-control" placeholder="City" aria-describedby="basic-addon1" name="city" required>
    </div>
    <h5 class="back_title">Password:</h5>
    <div class="input-group" >
      <input name="password" type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1" required>
    </div>
    <div class="input-group">
      <input type="password" class="form-control" placeholder="Password confirmation" aria-describedby="basic-addon1" required>
    </div>

     </fieldset>
    <input type="submit" style="margin-top:10px;margin-left:40px;" value="Envoyer">
  </form>
</div>


      
<!-- ENDCUT -->   

  </body>
</html>

