@extends('layouts.app')

@section('title', 'Domains')

@section('content')
    <table class="table">
        <thead class="thead-light">
            <tr>
            <th scope="col">id</th>
            <th scope="col">URL</th>
            <th scope="col">Response Code</th>
            <th scope="col">content-length</th>
            <th scope="col">H1</th>
            <th scope="col">Keywords</th>
            <th scope="col">Description</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <th scope="row">{{ $url[0]->id }}</th>
            <td>{{ $url[0]->name }}</td>
            <td>{{ $url[0]->responseCode }}</td>
            <td>{{ $url[0]->contentLength }}</td>
            <td>{{ $url[0]->h1 }}</td>
            <td>{{ $url[0]->keywords }}</td>
            <td>{{ $url[0]->description }}</td>
            </tr>
        </tbody>
    </table>
@endsection