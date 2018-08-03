<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://bootswatch.com/4/cerulean/bootstrap.min.css">
    <title>My Tweetz</title>
</head>
<body>
    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <div class="navbar-header"><a href="/" class="navbar-brand">My Tweetz</a></div>
        </div>
    </nav>
    <div class="container mt-2">
    <div class="card alert alert-primary p-1">
        <form action="{{route('post.tweet')}}" class="card-body" method="POST" enctype="multipart/form-data">
    @csrf
    @if(count($errors)>0)
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                {{$error}}
            </div>
        @endforeach
    @endif
    <div class="form-group">
        <label for="tweet">Tweet Text</label>
        <input type="text" name="tweet" id="tweet" class="form-control">
    </div>
    <div class="form-group">
        <label for="file">Upload images</label>
        <input type="file" name="images[]" multiple class="form-control">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success">Send Tweet</button>
    </div>
    </form>
    </div>
        @if(!empty($data))
            @foreach($data as $key => $tweet)
                <div class="card">
                    <div class="card-body">
                    <h4>{{$tweet['text']}}
                        <i class="fab fa-twitter"></i> {{$tweet['favorite_count']}}
                        <i class="fas fa-retweet"></i> {{$tweet['retweet_count']}}
                    </h4>
                    @if(!empty($tweet['extended_entities']['media']))
                        @foreach($tweet['extended_entities']['media'] as $i)
                            <img src="{{$i['media_url_https']}}" style="width:100px;">
                        @endforeach
                    @endif
                    </div>
                </div>

            @endforeach
        @else
            <p>No tweets found ...</p>    
        @endif
    </div>
</body>
</html>