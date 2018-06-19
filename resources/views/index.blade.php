@extends('view_tamplate')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3" id="searchBox">
            <h2 style="margin-top: 300px;">Search City</h2>
                <form id="citySearchForm" method="post" class="form-inline my-2 my-lg-0" action="{{action('CityController@index')}}">
                    {{ csrf_field() }}
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <input id="searchCity" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button id="searchCityBut" class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="waitModal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <span style="font-size: 30px; margin: 20px;">Please Wait</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="justify-content-center modal-content">
                            <div class="modal-body">
                                <div id="map" style="width:100%;height:400px;background:yellow"></div>
                                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHckGkDnRE3RkzmpSy5y98X6gpzCswDuk&callback=initMap"></script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection