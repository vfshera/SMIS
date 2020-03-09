@extends('layouts.master')

@section('content')
     <div id="app">
     <admin :user ="{{ auth()->User() }}"></admin>
     </div>

     <script>
         window.user = @json([
             'user' => auth()->User(),
         ])
     </script>
@endsection
