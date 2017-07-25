@extends('layouts.app')

@section('content')
    <div id="app">

        <Chat data='{{ json_encode($msgs) }}'></Chat>
    </div>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.4.3/css/bulma.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>

@endsection
