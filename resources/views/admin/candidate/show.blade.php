@extends('admin.candidate.base')
@section('action-content')

<!-- Main content -->
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="w3-content w3-margin-top" style="max-width:1400px;">

    <!-- The Grid -->
    <div class="w3-row-padding">

        <!-- Left Column -->
        <div class="w3-third">

            <div class="w3-white w3-text-grey w3-card-4">
                <div class="w3-display-container">
                    <img src="{{ asset('storage/app/candidates/'. $detail['slug'] .'/'. $detail['image']) }}" style="width:100%" alt="Avatar">
                    <div class="w3-display-bottomleft w3-container w3-text-black">
                        <h3>{{ $detail['name'] }}</h3>
                    </div>
                </div>
                <div class="w3-container">
                    <p><i class="fa fa-transgender-alt fa-fw w3-margin-right w3-large w3-text-teal"></i>
                        @switch($detail['gender'])
                            @case(1)
                                Nam
                                @break
                            @case(2)
                                Không xác định
                                @break
                            @default
                                Nữ
                        @endswitch
                        
                    </p>
                    <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i>{{ $detail['address'] }}</p>
                    <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i><a href="javascript:void(0)">{{ $detail['email'] }}</a></p>
                    <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i><a href="tel:{{ $detail['phone'] }}">{{ $detail['phone'] }}</a></p>
                    <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-large w3-text-teal"></i>{{ $detail['birthday'] }}</p>
                    <p><i class="fa fa-heart fa-fw w3-margin-right w3-large w3-text-teal"></i>{{ $detail['marital'] == 0 ? 'Độc Thân' : 'Đã Kết Hôn' }}</p>
                    <hr>
                    

                    <p title="Thời gian làm việc">
                        <i class="fa fa-clock-o fa-fw w3-margin-right w3-large w3-text-teal"></i>
                        {{ $detail['time']['title'] }}
                    </p>
                    <p title="Kinh ngiệm">
                        <i class="fa fa-line-chart fa-fw w3-margin-right w3-large w3-text-teal"></i>
                        {{ $detail['experience'] }}
                    </p>
                    <br>
                    <p title="Ngoại ngữ"><i class="fa fa-language fa-fw w3-margin-right w3-large w3-text-teal"></i>Ngoại Ngữ</p>
                        @foreach ($detail['language'] as $key => $value)
                            <i class="fa fa-angle-right fa-fw w3-margin-right w3-large w3-text-teal"></i>{{ $value['title'] }}<br>
                        @endforeach
                    

                    <hr>
                    <p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>Vị Trí Mong Muốn</b></p>
                        @foreach ($detail['position'] as $key => $value)
                            <p><i class="fa fa-angle-right fa-fw w3-margin-right w3-large w3-text-teal"></i>{{ $value['title'] }}</p>
                        @endforeach
                    <br>

                    <p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>Công Việc Mong Muốn</b></p>
                        @foreach ($detail['career'] as $key => $value)
                            <p><i class="fa fa-angle-right fa-fw w3-margin-right w3-large w3-text-teal"></i>{{ $value['title'] }}</p>
                        @endforeach
                    <br>

                    <p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>Lĩnh Vực Mong Muốn</b></p>
                        @foreach ($detail['field'] as $key => $value)
                            <p><i class="fa fa-angle-right fa-fw w3-margin-right w3-large w3-text-teal"></i>{{ $value['title'] }}</p>
                        @endforeach
                    <br>

                    <p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>Nơi Làm Việc Mong Muốn</b></p>
                        @foreach ($detail['location'] as $key => $value)
                            <p><i class="fa fa-angle-right fa-fw w3-margin-right w3-large w3-text-teal"></i>{{ $value['title'] }}</p>
                        @endforeach
                    <br>

                    <p class="w3-large w3-text-theme"><b><i class="fa fa-globe fa-fw w3-margin-right w3-text-teal"></i>Dil bilikləri</b></p>
                    <p>Russian</p>
                    <div class="w3-light-grey w3-round-xlarge">
                        <div class="w3-round-xlarge w3-teal" style="height:24px;width:100%"></div>
                    </div>
                    <p>English</p>
                    <div class="w3-light-grey w3-round-xlarge">
                        <div class="w3-round-xlarge w3-teal" style="height:24px;width:60%"></div>
                    </div>
                    <br>
                </div>
            </div><br>

            <!-- End Left Column -->
        </div>

        <!-- Right Column -->
        <div class="w3-twothird">

            <div class="w3-container w3-card w3-white w3-margin-bottom">
                <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Kinh Nghiêm</h2>
                <div class="w3-container">
                    <h5 class="w3-opacity"><b>Əməliyyatçı, Kassir / Kapital Bank ASC</b></h5>
                    <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Mart 2017 - <span class="w3-tag w3-teal w3-round">Hal-hazırda işləyir</span></h6>
                    <p></p>
                    <hr>
                </div>
                <div class="w3-container">
                    <h5 class="w3-opacity"><b>Web Developer / something.com</b></h5>
                    <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Mar 2012 - Dec 2014</h6>
                    <p>Consectetur adipisicing elit. Praesentium magnam consectetur vel in deserunt aspernatur est reprehenderit sunt hic. Nulla tempora soluta ea et odio, unde doloremque repellendus iure, iste.</p>
                    <hr>
                </div>
                <div class="w3-container">
                    <h5 class="w3-opacity"><b>Graphic Designer / designsomething.com</b></h5>
                    <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Jun 2010 - Mar 2012</h6>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p><br>
                </div>
            </div>

            <div class="w3-container w3-card w3-white">
                <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Giáo Dục</h2>
                <div class="w3-container">
                    <h5 class="w3-opacity"><b>W3Schools.com</b></h5>
                    <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Forever</h6>
                    <p>Web Development! All I need to know in one place</p>
                    <hr>
                </div>
                <div class="w3-container">
                    <h5 class="w3-opacity"><b>London Business School</b></h5>
                    <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>2013 - 2015</h6>
                    <p>Master Degree</p>
                    <hr>
                </div>
                <div class="w3-container">
                    <h5 class="w3-opacity"><b>School of Coding</b></h5>
                    <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>2010 - 2013</h6>
                    <p>Bachelor Degree</p><br>
                </div>
            </div>

            <!-- End Right Column -->
        </div>

        <!-- End Grid -->
    </div>

    <!-- End Page Container -->
</div>

@endsection