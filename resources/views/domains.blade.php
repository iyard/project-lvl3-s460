@extends('layouts.app')

@section('title', 'Domains')

@section('content')
    <table class="table">
        <thead class="thead-light">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Url</th>
            <th scope="col">Last</th>
            <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <th scope="row">1</th>
            <td>{{ $url[0]->name }}</td>
            <td>Otto</td>
            <td>@mdo</td>
            </tr>
        </tbody>
    </table>
@endsection