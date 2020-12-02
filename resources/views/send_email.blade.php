<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<title>Contact Us Form</title>

<style>
  .required:after {
    content:" *";
    color: red;
  }
</style>

</head>

<body>
<br />
<br />
<div class="container">
<h3>Contact Us</h3><br />
    @if(count($errors) > 0)
        <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
        </div>
    @endif

    @if($message = Session('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif

    <form method="POST" action="{{url('sendemail/send')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label class="required">Email From</label>
            <input type="email" name="emailFrom" class="form-control" required placeholder="Enter email From" value="{{ old('emailFrom') }}" />
        </div>

        <div class="form-group">
            <label class="required">Email To</label>
            <input type="email" name="emailTo" class="form-control" required placeholder="Enter email To" value="{{ old('emailTo') }}"/>
        </div>

        <div class="form-group">
            <label>Enter your Subject</label>
            <input type="text" name="subject" class="form-control" required placeholder="Subject" value="{{ old('subject') }}"/>
        </div>

        <div class="form-group">
            <label class="required">Enter your Text Content</label>
            <textarea name="textContent" placeholder="Text Content" required rows="3" class="form-control">{{ old('textContent') }}</textarea>
        </div>

        <div class="form-group">
            <label class="required">Enter your Html Content</label>
            <textarea name="htmlMessage" placeholder="Html Content" required rows="3" class="form-control">{{ old('htmlMessage') }}</textarea>
        </div>

        <div class="form-group">
            <label class="required">Upload File</label>
            <input type="file" name="attachment[]" required class="form-control-file" multiple/>
        </div>

        <br />

        <div class="form-group">
            <input type="submit" name="send" value="Send" class="btn btn-primary mb-2">
        </div>

    </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>