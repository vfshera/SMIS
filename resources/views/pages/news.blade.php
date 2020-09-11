@extends('layouts.app')

@section('content')

    <div id="news" class="container m-auto pt-5">
        <h1 class="text-center mt-5">News</h1>
        <div class="row ">
            @foreach($news as $post)
                <div class="card col-md-4 mb-2 p-0">
                    <div class="card-body" data-aos="fade-up"
                         data-aos-offset="200"
                         data-aos-delay="25"
                         data-aos-duration="1000"
                         data-aos-easing="ease-in-out"
                    >
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">
                            {{ substr($post->info ,0,240). '...' }}
                        </p>
                        <a href="/news-post/{{ $post->id }}/{{ preg_replace("/[\s_]/", "-", strtolower($post->title)) }}" >Read More...</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                {{ $news->links() }}
            </div>
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
