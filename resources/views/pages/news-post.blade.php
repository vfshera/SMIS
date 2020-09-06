@extends('layouts.app')

@section('content')
    <div class="card col-md-12 mt-5">
        <div class="card-body container  mt-3">
                <h3 class="card-title text-bold"><a href="/" style="text-decoration: none">{{ $post->title }}</a></h3>

            <p class="card-text">{{ $post->info }} </p>
        </div>
    </div>


    {{-- SCROLL TO TOP --}}
    <a id="gotopbtn" href="#">
        <i class="fas fa-arrow-up"></i>
    </a>


    <footer class=" home-footer mt-5">
        <div class="text-center pb-4 pt-5">
            <h5>Phone : 122356789</h5>
            <h5>Address : 101 TAVETA</h5>
            <h5>Email : info@smis.ac.ke</h5>

            <h4 class="mt-3">&copy;SMIS</h4>

        </div>

    </footer>





@endsection
