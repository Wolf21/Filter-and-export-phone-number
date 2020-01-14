<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Convert</title>
    <link rel="stylesheet" type="text/css"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    body {
        margin: 100px 500px;
    }

    button {
        width: 100px;
    }
</style>
<body>
<h2><a href="/">Anh Cường đẹp trai ơiiiiiiiiii</a></h2>
<br>
<h3 style="color: green">{{\Illuminate\Support\Facades\Session::get('msg')}}</h3>
<h3 style="color: red">{{\Illuminate\Support\Facades\Session::get('err-msg')}}</h3>
<br>
{{Form::open(['url'=>route('upload'), 'method' => 'POST', 'files'=>true])}}
<div class="row">
    <input type="file" name="file" class="col-md-8">
    <button class="upload" type="submit">Upload</button>
</div>
{{Form::close()}}
<br>
{{Form::open(['url'=>route('convert'), 'method' => 'POST'])}}
<button class="convert" name="convert">Convert</button>
{{Form::close()}}
<br>
{{Form::open(['url'=>route('check'), 'method' => 'POST'])}}
<h3>Check record</h3>
<div class="row">
    <label for="vina" class="col-md-2" style="text-align: center">Vina</label>
    <input type="text" name="vina" id="vina" value="{{old('vina') ?? ''}}">
</div>
<br>
<div class="row">
    <label for="vt" class="col-md-2" style="text-align: center">Việt teo</label>
    <input type="text" name="vt" id="vt" value="{{old('vt') ?? ''}}">
</div>
<br>
<div class="row">
    <label for="mobi" class="col-md-2" style="text-align: center">Mobi</label>
    <input type="text" name="mobi" id="mobi" value="{{old('mobi') ?? ''}}">
</div>
<br>
<button type="submit">Check</button>
{{Form::close()}}
<br>
<a href="{{route('truncate')}}">Truncate</a>
</body>
</html>
