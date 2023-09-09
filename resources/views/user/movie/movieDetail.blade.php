 @extends('user.layout.main')
@section('title')
{{$movie->name}}
@endsection
 @section('content')
    <!-- breadcrumb area start -->
        <section class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-area-content">
                            <h1>Movie Detalied Page</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- breadcrumb area end -->
        <!-- transformers area start -->
        <section class="transformers-area">
            <div class="container">
                <div class="transformers-box">
                    <div class="row flexbox-center">
                        <div class="col-lg-5 text-lg-left text-center">
                            <div class="transformers-content">
                                <img src="{{asset('/admin/assets/img/movies/'.$movie->image)}}" alt="about" />
                                <a href="{{$movie->trailer}}" class="popup-youtube">
                                    <i class="icofont icofont-ui-play"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="transformers-content">
                                <h2>{{$movie->name}}</h2>
                            <p></p>
                                <ul>
                                    <li>
                                        <div class="transformers-left">
                                            Thể loại:
                                        </div>
                                        <div class="transformers-right">
                                            {{$movie->categories->name}} <button href="" class="theme-btn">{{$movie->age_limit !=0?$movie->age_limit.'+':'không giới hạn tuổi' }}</button>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="transformers-left">
                                            Thời lượng:
                                        </div>
                                        <div class="transformers-right">
                                            {{$movie->time}} phút
                                        </div>
                                    </li>
                                    <li>
                                        <div class="transformers-left">
                                            Khởi chiếu:
                                        </div>
                                        <div class="transformers-right">
                                            {{date('d/m/Y', strtotime($movie->start_date))}}
                                        </div>
                                    </li>
                                    <li>
                                        <div class="transformers-left">
                                            Nội dung:
                                        </div>
                                        <div class="transformers-right">
                                           <p>{!!$movie->description!!}</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <a href="#" class="theme-btn"><i class="icofont icofont-ticket"></i>Mua vé</a>
                    </div>
                    
                </div>
            </div>
        </section><!-- transformers area end -->
        <!-- details area start -->
        <section class="details-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="details-content">
                            <div class="details-overview">
                                <h2>Overview</h2>
                                <p>Humans are at war with the Transformers, and Optimus Prime is gone. The key to saving the future lies buried in the secrets of the past and the hidden history of Transformers on Earth. Now it's up to the unlikely alliance of inventor Cade Yeager, Bumblebee, a n English lord and an Oxford professor to save the world. Transformers: The Last Knight has a deeper mythos and bigger spectacle than its predecessors, yet still ends up being mostly hollow and cacophonous. The first "Transformers" movie that could actually be characterized as badass. Which isn't a bad thing. It may, in fact, be better.</p>
                            </div>
                            <div class="details-reply">
                                <h2>Leave a Reply</h2>
                                <form action="#">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="select-container">
                                                <input type="text" placeholder="Name"/>
                                                <i class="icofont icofont-ui-user"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="select-container">
                                                <input type="text" placeholder="Email"/>
                                                <i class="icofont icofont-envelope"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="select-container">
                                                <input type="text" placeholder="Phone"/>
                                                <i class="icofont icofont-phone"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="textarea-container">
                                                <textarea placeholder="Type Here Message"></textarea>
                                                <button><i class="icofont icofont-send-mail"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="details-comment">
                                <a class="theme-btn theme-btn2" href="#">Post Comment</a>
                                <p>You may use these HTML tags and attributes: You may use these HTML tags and attributes: You may use these HTML tags and attributes: </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- details area end -->
 @endsection