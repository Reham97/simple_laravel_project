@extends('layouts.master')

@section('content')
<div class="row mt-2">
    <div class="col-md-9 offset-md-2">
        <div class="card mb-3" style="min-width: 18rem;">
           @if(auth()->user()->id == $post->user_id)
            <div class="card-body">
                <div class="card-title">
                    <h4> {{$post->title}}</h4>
                </div>

               <img src="{{asset('/storage/coverImage/'.$post->image)}}" height="400" width="700" >

                <div class="card-text">
                    {{$post->body}}
                </div>
                
                <hr>
                <small class="text-muted"> <p> {{$post->created_at}}</p></small>
                 <a href="{{ '/posts/' . $post->id . '/edit'}}" class="btn btn-primary float-left mr-2"> Edit</a>
            
                <form action="{{route('posts.destroy', $post->id )}}" method="POST">      
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger float-left"> Delete</button>
                </form>

            </div> 

            @else
            <h1> what are you doing ???? </h1>
           @endif
   
        </div>
    </div>
</div>
@endsection