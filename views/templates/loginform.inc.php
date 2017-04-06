
      <div class="android-content mdl-layout__content">
        <a name="top"></a>
        <div class="android-be-together-section mdl-typography--text-center">
          <div class="android-font android-create-character">
            <div class="login">
    <div class="login-screen">
      <div class="app-title">
        <h1></h1>
      </div>

      <div class="login-form">
        <div class="control-group">
          <h3>Professional space</h3>
          <?php if($model->getLoginError()!= NULL){
              echo('<p>'.$model->getLoginError().'</p>');
          } ?>
        <form  action= "index.php?action=Login" method="POST">
        <input type="text" class="login-field" value="" placeholder="registration email" name="nickname">
        <label class="login-field-icon fui-user" for="nickname"></label>
        </div>

        <div class="control-group">
        <input type="password" class="login-field" value="" placeholder="password" name="password">
        <label class="login-field-icon fui-lock" for="password"></label>
        </div>
        <input style="color:grey;" class="btn btn-primary btn-large btn-block" type="submit" value="login"> 
       <a class="login-link" href="/registration.php">New cook or new supplier ?</a>
      </form>
      </div>
    </div>
  </div> 
          </div>


    </div>
      </div>      
    <script src="../../material.min.js"></script>
    
