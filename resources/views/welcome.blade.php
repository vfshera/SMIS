@extends('layouts.app')

@section('content')

{{-- NEWS PHOTO SLIDER --}}
    <div id="smis-carousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#smis-carousel" data-slide-to="0" class="active"></li>
          <li data-target="#smis-carousel" data-slide-to="1"></li>
          <li data-target="#smis-carousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="/storage/images/slide1.jpg" alt="SMIS LOGO">
            <div class="carousel-caption d-none d-md-block">
                <h1 class="carousel-text">Welcome To Murray Girls</h1>
                <p class="carousel-text">We Are Glad</p>
              </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="/storage/images/slide2.jpg" alt="SMIS LOGO">
            <div class="carousel-caption d-none d-md-block">
                <h1 class="carousel-text">Get A Bright Future With Us</h1>
                <p class="carousel-text">Happy Hour</p>
              </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="/storage/images/slide3.jpg" alt="SMIS LOGO">
            <div class="carousel-caption d-none d-md-block">
                <h1 class="carousel-text">The Center Of Knowledge</h1>
                <p class="carousel-text">Empowering Minds</p>
              </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#smis-carousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#smis-carousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
    </div>

    {{-- NEWS --}}
    <div class="container m-auto pt-3 pb-3">
        <h1 class="text-center">News</h1>
        <div class="row">
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
                      <a href="/news-post/{{ $post->id }}/{{ preg_replace("/[\s_]/", "-", strtolower($post->title)) }}" >Read More</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-12 mt-2 container" style="display: flex; justify-content: center;">
            <h4><a href="/news" >More News</a></h4>
        </div>
    </div>

{{-- IMPORTANT DATES --}}

        <div id="announcements"    data-aos="fade-up"
            data-aos-duration="800"
            data-aos-easing="ease-in-out"
            data-aos-delay="10"

        >
            <div id="datesScroll" class="carousel carousel-fade pb-5" data-ride="carousel" >
                <div class="carousel-inner container pt-5">
                  <div class="carousel-item active" data-interval="10000">
                      <div class="row col-md-12">
                          <div class="col-md-8">
                            <h1>{{ $idates[0]->title }}</h1>
                          </div>
                          <div class="col-md-4">
                              <h1  id="count" class="row">
                                  <Timer :date="{{ date('d', strtotime($idates[0]->occur_date)) }}"
                                         :hour="{{ date('H', strtotime($idates[0]->occur_time)) }}"
                                         :minute="{{ date('i', strtotime($idates[0]->occur_time)) }}"
                                         :month="{{ date('n', strtotime($idates[0]->occur_date))-1 }}"
                                         :year="{{ date('Y', strtotime($idates[0]->occur_date)) }}" />
                              </h1>
                              <h3 class="row">{{ date('dS F  Y', strtotime($idates[0]->occur_date)) }}</h3>
                            </div>
                      </div>

                  </div>
                  <div class="carousel-item" data-interval="2000">
                    <div class="row col-md-12">
                        <div class="col-md-8">
                          <h1>{{ $idates[1]->title }}</h1>
                        </div>
                        <div class="col-md-4">
                            <h1  id="count" class="row">
                                <Timer :date="{{ date('d', strtotime($idates[1]->occur_date)) }}"
                                                :hour="{{ date('H', strtotime($idates[1]->occur_time)) }}"
                                                :minute="{{ date('i', strtotime($idates[1]->occur_time)) }}"
                                                :month="{{ date('n', strtotime($idates[1]->occur_date))-1 }}"
                                                :year="{{ date('Y', strtotime($idates[1]->occur_date)) }}" />
                            </h1>
                            <h3 class="row">{{ date('dS F  Y', strtotime($idates[1]->occur_date)) }}</h3>
                          </div>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="row col-md-12">
                        <div class="col-md-8">
                          <h1>{{ $idates[2]->title }}</h1>
                        </div>
                        <div class="col-md-4">
                            <h1  id="count" class="row">
                                <Timer :date="{{ date('d', strtotime($idates[2]->occur_date)) }}"
                                       :hour="{{ date('H', strtotime($idates[2]->occur_time)) }}"
                                       :minute="{{ date('i', strtotime($idates[2]->occur_time)) }}"
                                       :month="{{ date('n', strtotime($idates[2]->occur_date))-1 }}"
                                       :year="{{ date('Y', strtotime($idates[2]->occur_date)) }}" />
                            </h1>
                            <h3 class="row">{{ date('dS F  Y', strtotime($idates[2]->occur_date)) }}</h3>
                          </div>
                    </div>
                  </div>
                </div>
                <a class="carousel-control-prev pt-3" href="#datesScroll" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next pt-3" href="#datesScroll" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
            </div>
        </div>


 <div id="contact" class="row m-auto"style="width:99%">
     <div class="col-md-6 col-sm-5 mt-5 mb-5"
        data-aos="fade-up"
        data-aos-offset="200"
        data-aos-delay="20"
        data-aos-duration="1200"
        data-aos-easing="ease-in-out"
     >
        <h1 class="text-center mb-5">MAP</h1>
         <div style="overflow:hidden;width: 700px;position: relative;">
             <iframe id="school-map" src="https://maps.google.com/maps?hl=en&amp;q=Murray Girls High School+()&amp;ie=UTF8&amp;t=&amp;z=10&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><div style="position: absolute;width: 80%;bottom: 10px;left: 0;right: 0;margin-left: auto;margin-right: auto;color: #000;text-align: center;"><small style="line-height: 1.8;font-size: 0px;background: #fff;"> <a href="https://googlemapsembed.net/" rel="nofollow">Google Maps Embed</a> </small></div><style>.nvs{position:relative;text-align:right;height:325px;width:643px;} #gmap_canvas img{max-width:none!important;background:none!important}</style></div>
{{--        <div id="map">--}}

{{--        </div>--}}
     </div>
     <div  class="col-md-6 col-sm-5 smis-contact mt-5 mb-5"
        data-aos="fade-up"
        data-aos-offset="200"
        data-aos-delay="20"
        data-aos-duration="1200"
        data-aos-easing="ease-in-out"
     >
        <h1 class="text-center mb-5">Contact US</h1>
        <form class="m-auto" method="POST" action="{{ route('contact-form') }}">
            @csrf
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input type="text" class="form-control" value="{{ old('name') }}" id="name" placeholder="Your Name Please" required>
                  <div class="text-danger">{{ $errors->first('name') }}</div>
              </div>
              <div class="form-group col-md-6">
                <label for="email">Email / Phone</label>
                <input type="text" class="form-control" value="{{ old('email') }}"  id="email" placeholder="email or phone" required>
                  <div class="text-danger" >{{ $errors->first('email') }}</div>
              </div>
            </div>
            <div class="form-row mb-2">
                <label for="message">Message :</label>
                <div class="text-danger" >{{ $errors->first('message') }}</div>
                <textarea value="{{ old('message') }}"  name="message" class="col-md-12 form-control" id="message" cols="30" rows="10" required>
                </textarea>

            </div>
            <button type="submit" class="btn btn-lg btn-primary col-md-4 mt-5 m-auto float-right">SEND</button>
        </form>

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

