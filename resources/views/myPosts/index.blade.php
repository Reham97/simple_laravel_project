@extends('layouts.master')

@section('content')
    <h1> List of all Posts</h1>
    <div class="row">
       filter :  
       <a href="/posts?select=2">Even ID </a>|
       <a href="/posts?select=1">Odd ID </a>|
    </div>
    <hr>
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-md-6">
                            <div class="card mb-3" style="min-width: 20rem;">
                                <div class="card-header bg-dark text-white">
                                        {{$post->title}}
                                </div>
                                <div class="card-body">
                                    <div class="card-title">
                                        <h4> {{$post->id}} - {{$post->title}}</h4>
                                    </div>
                                    <div class="card-text">
                                        {{$post->body}}
                                    </div>
                                    <hr>
                                    <a href="{{ '/posts/'.$post->id}}" class="btn btn-primary"> Show More</a>
                                </div>    
                            </div>
                       </div>
                    @endforeach
                </div>

            </div>

        </div>

        <div class="col-md-3">
                <div class="card mb-3" style="max-width: 18rem;">
                        <div class="card-header bg-info text-white"> Stats.</div>
                        <div class="card-body">

                        <p class="card-text"> All Posts: {{$count}}</p>
                        </div>
                    </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 ">
            
            @if(empty($posts->links()))
            @else
                {{$posts->links()}}
            @endif
        </div>
    </div>
    @endsection 
