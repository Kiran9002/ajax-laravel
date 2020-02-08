<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Ajax-Laravel</title>
  </head>
  <body>
    
        <div class="container pt-5">
            <div class="row">
                <div class="offset-lg-3 col-lg-6">
                    <div class="card" id="items">
                        <h5 class="card-header text-center">Ajax-laravel <a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">Add</a></h5>
                        
                        <div class="card-body">
                            <ul class="list-group">
                              @foreach($items as $item)
                                <li class="list-group-item">
                                    <h5 class="card-title">{{$item->title}}</h5>
                                    <p class="card-text">{{$item->body}}
                                      <button class="btn btn-success float-right" id="edit" value="{{$item->id}}">Update</button>
                              {!!Form::open(['action'=>'AjaxController@delete','method'=>'POST'])!!}
                              {{Form::hidden('_method','DELETE')}}
                                      <button class="btn btn-danger float-right" id="delete" value="{{$item->id}}">Delete</button>
                              {!!Form::close()!!}     
                                    </p>
                                    
                                </li>
                                @endforeach
                              </ul>
                          
                        </div>
                      </div>

                      <!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Topic</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!!Form::open(['action'=>'AjaxController@create','method'=>'POST'])!!}
        
        <div class="modal-body">
        
           
                <div class="form-group">
                    {{Form::label('title','Title')}}
                    {{Form::text('title','',['class'=>'form-control','id'=>'title','placeholder'=>'Title'])}}
                </div>
                <div class="form-group">
                    {{Form::label('body','Body')}}
                    {{Form::text('body','',['class'=>'form-control','id'=>'body','placeholder'=>'Body'])}}
                </div>
           

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        {{Form::submit('Save',['class'=>'btn btn-primary','id'=>'submit','data-dismiss'=>'modal'])}}
        </div>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
                </div>
            </div>
        </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
    src="https://code.jquery.com/jquery-3.4.1.js"
    integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script>
          $(document).ready(function(){
              $('#submit').click(function(event){
                event.preventDefault();
                $.ajaxSetup({
                  headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                  }
                });
                $.ajax({
                  url:"/add",
                  method:'post',
                  data:{
                    title:$('#title').val(),
                    body:$('#body').val()
                  },
                  success:function(data){
                    console.log(data);
                    $("#items").load(location.href+' #items');
                  }
                  

                });
                $('#delete').click(function(event){
                  event.preventDefault();
                  $.ajax({
                    url:"/delete",
                    method:'post',
                    data:{id:$('#delete').val()},
                    success:function(data){
                      console.log(data);
                      $("#items").load(location.href+' #items');
                    }
                  });
                });
    });
  });
        </script>
  </body>
</html>