<div id="popUpConfirm" class="modal">
    <div class="modal-content">
        <h4>Info</h4>
        <p id="infoContent"></p>
    </div>
    <div class="modal-footer">
        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat" onclick="applyCover()">Agree</a>
        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Disagree</a>
    </div>
</div>

<div id="popUpDeleteAlbum" class="modal">
    <div class="modal-content">
        <h4 class="red-text">Alert!</h4>
        <p id="alertContentAlbum"></p>
    </div>
    <div class="modal-footer">
        {{--{!! Form::open(['method' => 'DELETE', 'action' => ['AlbumController@destroy', $album->id]]) !!}--}}
        {{--{!! Form::submit('Agree', ['class' => 'modal-action modal-close waves-effect waves-green btn-flat']) !!}--}}
        {{--{!! Form::close() !!}--}}
        <a
                href="#!" class="modal-action modal-close waves-effect waves-green btn-flat"
                onclick="deleteAlbum(this)">Agree
        </a>
        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Disagree</a>
    </div>
</div>

<div id="popUpDeleteImage" class="modal">
    <div class="modal-content">
        <h4 class="red-text">Alert!</h4>
        <p id="alertContentImage"></p>
    </div>
    <div class="modal-footer">
        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat" onclick="deleteImage()">Agree</a>
        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Disagree</a>
    </div>
</div>

<div id="popUpSetPublish" class="modal">
    <div class="modal-content">
        <h4 class="red-text">Alert!</h4>
        <p id="alertPublishContent"></p>
    </div>
    <div class="modal-footer">
        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat" onclick="publishAlbum(this)">Agree</a>
        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Disagree</a>
    </div>
</div>

<div id="popUpSetUnpublish" class="modal">
    <div class="modal-content">
        <h4 class="red-text">Alert!</h4>
        <p id="alertUnpublishContent"></p>
    </div>
    <div class="modal-footer">
        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat" onclick="unpublishAlbum(this)">Agree</a>
        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Disagree</a>
    </div>
</div>

