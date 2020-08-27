@extends('layouts.app')

@section('content')
    <div class="card col-md-12 mt-5">
        <div class="card-body container  mt-3">
            @guest
                <h3 class="card-title text-bold"><a href="/" style="text-decoration: none">Special title treatment</a></h3>
            @endguest

            @auth
                    <h3 class="card-title text-bold"><a href="/news-center" style="text-decoration: none">Special title treatment</a></h3>
             @endauth
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus alias assumenda blanditiis dolor doloribus est fuga laborum, magnam minus non nostrum obcaecati, odio omnis optio porro provident quod, recusandae vero! Ad asperiores autem, culpa, cum dolorem eaque id iusto libero nobis nostrum odit perferendis praesentium quia sequi sunt suscipit ut, voluptatum. A adipisci aliquid aperiam asperiores culpa doloremque, doloribus earum fugiat, iure libero modi neque odio quia, quibusdam quidem reprehenderit soluta tenetur velit veritatis voluptates? Accusantium aliquam assumenda blanditiis eaque eius esse fugiat provident quas totam, veniam. Assumenda at aut deleniti dolore dolorem doloribus et eveniet fugit ipsa itaque, laudantium, maxime molestias quam quasi quia totam voluptates. Ad alias dolor incidunt neque provident veritatis! Animi aperiam commodi error explicabo illum ipsa iste laborum laudantium, minus molestias perspiciatis quaerat quo quod rem tempore! Aspernatur aut delectus distinctio eius eos molestias officia perferendis temporibus vel voluptatum. Corporis exercitationem, labore. Aliquid maxime molestias mollitia quisquam ullam unde veniam. Ab ad aperiam consequatur ducimus id inventore iusto nulla quo rem. Asperiores aspernatur autem blanditiis deserunt dolor dolorem eligendi error itaque maxime minima nihil odio quis recusandae repellat tenetur unde, veritatis voluptas voluptates? Asperiores aut commodi dolore, eaque error illum incidunt itaque labore, laborum magnam, omnis possimus quo repellendus. Accusamus animi architecto corporis ducimus eum exercitationem impedit laboriosam modi nihil numquam officia pariatur quam quasi quo repellendus saepe ullam veniam voluptas, voluptates voluptatibus? Aliquid beatae, blanditiis cumque eaque et eum excepturi exercitationem id illo, ipsam iste iusto labore magni maiores molestiae mollitia nemo nulla numquam odit officiis quia reprehenderit repudiandae saepe sed sit sunt tenetur totam ullam velit voluptatibus. Ab assumenda, cupiditate delectus deleniti eos et hic id iusto mollitia, odio omnis soluta voluptatem? Autem culpa doloribus, eligendi explicabo harum libero molestias natus nesciunt odit voluptate? Consequuntur ex ipsa libero voluptatem? Deserunt exercitationem incidunt iure libero. Accusantium cumque dicta dolorem error, ex, excepturi fugit nesciunt nihil nisi officia possimus provident sapiente totam vitae voluptate. Commodi, deleniti id inventore libero nesciunt non perspiciatis praesentium quae quaerat soluta! Cum dolore eaque eius iure modi nam neque quae sapiente tempore veniam. Aperiam aut beatae commodi culpa deserunt dolore, doloribus error facilis ipsam libero maiores minus molestiae nam quas sit soluta, velit. Architecto atque consequatur ducimus eligendi, harum minus, necessitatibus neque numquam officiis omnis perspiciatis, quo rem veritatis vitae voluptates. A asperiores aspernatur at dolor dolorem eos et eveniet hic itaque natus nesciunt, omnis, quod ratione tempora vel? Cum id ipsam natus quod. Accusamus commodi deserunt dolore dolorem dolores ducimus eos eveniet explicabo facere inventore ipsam iste maxime modi molestiae mollitia nobis nostrum praesentium provident quidem, quis quo reprehenderit saepe similique sunt ullam unde veniam vero! Consectetur, dicta voluptatibus? Commodi dolores earum molestiae tenetur voluptas? Architecto eligendi expedita perspiciatis ratione reprehenderit! Aspernatur exercitationem ipsa iure laboriosam, tempora voluptate! Aut commodi doloribus, ea, error exercitationem expedita inventore iste minima, necessitatibus officia recusandae sint veritatis. Consectetur deleniti ex facere ipsa maiores modi rem. Aliquam at dolorem facere hic incidunt, ipsa labore natus nesciunt nobis, odit quae quisquam ratione tempora veniam veritatis.
            </p>
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
