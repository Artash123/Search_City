function initMap() {

}

$(function () {
    var arr = [];

    $('#searchCity').keyup(function () {


        fd = new FormData
        fd.append('value',$('#searchCity').val())

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method:'post',
            url:'city_autocomplate',
            dataType:'json',
            data: fd,
            processData: false,
            contentType: false,
            success:function (response) {

                $('#autocomplate').remove();
                var div = $('<div  class="highlight" id="autocomplate">')
                $.each(response, function(index, element) {
                    arr[index] = element.name
                    var ul = $('<ul style="list-style: none;">').appendTo(div);
                    var li = $('<li>').appendTo(ul);
                    li.on('click',function () {
                        $('#searchCity').val($(this).html());
                    })
                    li.html(element.name);
                })

                $('#searchBox').append(div);
            }
        })
    })

    $('#searchCityBut').on('click',function () {
        event.preventDefault();

        fd1 = new FormData
        fd1.append('value',$('#searchCity').val())

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method:'post',
            url:'get_near_cities',
            dataType:'json',
            data: fd1,
            processData: false,
            contentType: false,
            success:function (response) {

                var uluru = {lat: parseFloat(response[0][1]), lng: parseFloat(response[0][2])};
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 10,
                    center: uluru
                });

                var markersArray = [];
                for(var i = 0;i<response.length;i++){
                    var currentUser = response[i]
                    var marker2 = new google.maps.Marker({
                        position: {lat: parseFloat(currentUser[1]), lng: parseFloat(currentUser[2])},
                        map: map,
                        draggable:false,
                        title: currentUser[0]
                    });
                    markersArray.push(marker2);
                }
                $("#exampleModal").modal("show");

            }
        })
    })
})
