<link href="css/login.css" rel="stylesheet">

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <h2 class="active"> ITSCO </h2>
    
    <!-- Icon -->
    <div class="fadeIn first">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTiB6UcPV58dBeVdkiN63ZboxZOBPxmVtf_AFhJ5Wc9N-4Z_UsC&s" id="icon" alt="User Icon" width="100" height="100" />
    </div>

    <!-- Login Form -->
    <form class="user" method="POST" action="{{ route('login') }}">
      {{ csrf_field() }}
      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class=" control-label">E-Mail Address</label>

        <input type="email" class="fadeIn second" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Ingrese Email..." id="email" name="email" value="{{ old('email') }}" required autofocus >
       
      </div>
       @if ($errors->has('email'))
        <span class="help-block">
          <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="col-md-4 control-label">Password</label>

        <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password" required>
                      
      </div>
       @if ($errors->has('password'))
        <span class="help-block">
          <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif   
      
      <input type="submit" class="fadeIn fourth" value="Ingresar">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div>

  </div>
</div>