<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <title>The Five Finder</title>
    <style>
        .thumbnail {
            height: 150px;
        }

        .thumbnail img {
            background-clip: padding-box;
            max-width: 100%;
            max-height: 80%;
            height: auto;
        }
    </style>
</head>

<body>
<input id="num" type="hidden" value="{{$num}}"/>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <form class="navbar-form navbar-left" action="{{URL::asset('')}}uploadfile"  method="post"
                  enctype="multipart/form-data" name="ajaxUploadForm"
                  id="ajaxUploadForm">
                <input type="hidden" name="_token" id="csrf-token" value="<?php echo csrf_token(); ?>"/>
                <div class="form-group">
                    <input type="file" multiple="multiple" class="form-control" accept="image/*" name="uploadedImages[]"/>
                    <input type="submit" value="Tải lên" class="btn btn-info upload-image" data-folder="news"/>
                </div>
                <div id="uploadedImages"></div>

            </form>
        </div>
        <div class="col-sm-6" id="print-error-msg">

        </div>

    </div>
    <div class="row" id="img-news">
        @foreach($FileNames as $i)

            <div class="col-xs-6 col-md-2" id="{{$i['filename']}}">
                <div class="thumbnail">
                    <a href="#" class="chooseimg">
                        <img src="{{URL::asset('uploads/news')}}/{{$i['basename']}}" class="img-responsive">
                    </a>
                    <div class="caption">
                        <p class="text-center">
                            <a href="{{URL::asset('')}}deletefile/news/{{$i['filename']}}" class="btn btn-danger btn-xs deletebtn" role="button">Delete</a>
                        </p>
                    </div>
                </div>
            </div>

        @endforeach
    </div>
</div>
<div>

</div>

<script src="//cdn.ckeditor.com/4.7.3/full/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="{{URL::asset('')}}js/hbbfinder.js"></script>
<script>
    $(document).ready(function () {
        localStorage.setItem('num', $('#num').val());
        $(document).on('click', '.chooseimg', (function (e) {
            e.preventDefault();
            var funcNum = localStorage.getItem('num');
            var url = $(this).children('img').attr('src');
            // //alert(url + funcNum);
            window.opener.CKEDITOR.tools.callFunction(funcNum, url);
            window.top.close();
            window.top.opener.focus();
        }));
        $(document).on('click','.deletebtn',(function (e) {
            e.preventDefault();
            var id = '#'+$(this).parents(".thumbnail").parent().attr('id');
            var url = $(this).attr('href');
            $.ajax({
                type: 'GET',
                url: url,
                success: function () {
                    $(id).hide()
                }
                , error: function (result) {
                    alert('can\'t delete this image');
                }
            })
        }))
    });
</script>
</body>

</html>