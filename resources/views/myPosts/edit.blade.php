@extends('layouts.master')

@section('content')

 <div class="row">
     <div class="col-md-9 offset-md-2">
         <h1>Edit Post Form</h1>
         <hr>
     <form action="{{ '/posts/' . $post->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
            <img src="{{asset('/storage/coverImage/'.$post->image)}}" height="200" width="100%" >
            </div>


            <div class="form-group">
                <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{$post->title}}">
            </div>

            <div class="form-group">
               <label for="body">Body</label>
            <textarea name="body" id="body" cols="30" rows="4" class="form-control"> {{$post->body}}</textarea>
           </div>

           <div class="form-group">
               <label for="body">Cover</label>
            <input type="file" name="postImage" id="postImage" class="form-file"  accept="image/x-png,image/gif,image/jpeg" />         
            </div>

            <div class="form-group">
               <button type="submit" class="btn btn-primary">Update</button>
           </div>
         </form>

     </div>
 </div>
@endsection 