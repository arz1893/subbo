@extends('home')

@section('main')
    <div class="container">
        <h5 class="blue-grey-text">Download</h5>
        <hr>

        {{ Form::open(['action' => 'DownloadController@downloadAlbum', 'id' => 'download-request']) }}
            {{ Form::hidden('album_id', $album->id) }}
        {{ Form::close() }}

        <div id="download_link" style="display: none">if your download is not starting click
            <a href="#!" onclick="$('#download-request').submit()">here</a>
        </div>
        <div id="countdown">
            Now Downloading in . . . <span id="counter">10</span> second
        </div>
    </div>

    <script type="text/javascript">
        window.onload = function () {
            $('#download_link').hide();
            (function(){
                var counter = 10;

                setInterval(function() {
                    counter--;
                    if (counter >= 0) {
                        span = document.getElementById("counter");
                        span.innerHTML = counter;
                    }
                    // Display 'counter' wherever you want to display it.
                    if (counter === 0) {
                        $('#download_link').removeAttr('style');
                        $('#countdown').hide();
                        $('#download-request').submit();
                        clearInterval(counter);
                    }

                }, 1000);

            })();
        }
    </script>
@endsection