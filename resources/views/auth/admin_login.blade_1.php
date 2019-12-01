<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Jaff | Admin Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/ico" href="{{asset('/public/favicon.ico')}}">
  <link rel="stylesheet" href="{{asset('public/css/back/all.min.css')}}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{asset('public/css/back/icheck-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/css/back/adminlte.min.css')}}">
  <script src="{{asset('public/css/back/vue.js')}}"></script>
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="login-box" style="margin-top: -200px;">
        <div class="login-logo">
            <a href="#">
                <img src="{{asset('public/logo.png')}}" style="height: 100px;width: 100px;">
            </a>
        </div>
        <div class="card" >
            <div class="card-body login-card-body">
                <form id="app" @submit="checkForm" action="{{route('admin.login.submit')}}" method="post">
                    <label  class="col-form-label" style="color: red;"></label>
                    <div class="input-group mb-3 has-error {{$errors->has('phone')? 'has-error':''}}">
                        <input type="text" v-model="phone" @keypress="isNumber($event)" name="phone" class="form-control" value="{{old('phone')}}" placeholder="Enter Phone No.">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-mobile"></span></div>
                        </div>
                    </div>
                    @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    {{csrf_field()}}
                    <label for="phone" class="col-form-label" style="color: red;"></label>
                    <div class="input-group mb-3 {{$errors->has('password')? 'has-error':''}}">
                        <input type="password" v-model="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                          <div class="input-group-text"><span class="fas fa-lock"></span></div>
                        </div>
                    </div>
                    <span class="invalid-feedback" role="alert"><strong>rfhyrtfhfgh</strong></span>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                              <input type="checkbox" id="remember" {{old('remember') ? 'checked' : ''}} >
                              <label for="remember">Remember Me</label>
                            </div>
                        </div>
                    </div>
                    <div class="social-auth-links text-center mb-3">
                        <button type="submit" class="btn btn-block" style="background-color: #030079;color:white;">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{asset('public/js/back/jquery.min.js')}}"></script>
    <script src="{{asset('public/js/back/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('public/js/back/adminlte.min.js')}}"></script>
<script>
const app = new Vue( {
    el: '#app',
    data: {
        phone: null,password: null
    },
    methods:{
        isNumber: function(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
              evt.preventDefault();;
            } else {
              return true;
            }
        },
        checkForm: function (e) {
          if (this.phone && this.password) {
            return true;
          }
          this.errors = [];
          if (!this.phone) {
            this.errors.push('Name required.');
          }
          if (!this.password) {
            this.error = 'Pawword required';
          }
          e.preventDefault();
        }
    }
});
</script>
</body>
</html>
