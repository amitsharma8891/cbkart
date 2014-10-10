 <!DOCTYPE html>
<html>
<body>

<a href="{{URL::route('logout')}}">Logout</a>

<a href="{{URL::route('register')}}">{{ Session::get('user_name');}}</a>

</body>
</html> 