<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Php SpreadSheet</title>
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
{{Form::open(['url'=>route('filter'), 'method' => 'POST'])}}
<input type="hidden" value="{{\Illuminate\Support\Facades\Session::get('fileName') ?? ''}}" name="old_file">
<button class="filter" name="filter" type="submit">Filter & Export</button>
{{Form::close()}}
<br>
{{Form::open(['url'=>route('count'), 'method' => 'POST'])}}
<button class="count" name="count" type="submit">Count</button>
{{Form::close()}}
<br>
</body>
</html>
