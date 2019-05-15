@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Jumbotron -->
    <form action="/domains" method="POST">
        <div class="jumbotron">
            <h1 class="display-4">Input URL and start!</h1>
            <p class="lead">This is a simple SEO test for your web-site. Example URL: http://seotest.com</p>
            <p>{{ $urlErrorMessage }}</p>
            <hr class="my-4">
            <div class="form-group">
                <input type="text" name="url" class="form-control" id="testControl" placeholder="Enter webpage URL">
            </div>
            <input class="btn btn-primary btn-lg" type="submit" value="Test" name="submit" /> 
        </div>
    </form>
@endsection