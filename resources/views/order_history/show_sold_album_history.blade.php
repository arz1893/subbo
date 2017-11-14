@extends('home')

@section('main')
    <div class="container">
        <h5>Your album list</h5>
        <hr>

        <table class="display" style="width: 100%" id="table-sold-album">
            <thead>
                <tr>
                    <th>No. </th>
                    <th>Image</th>
                    <th>Album's title</th>
                    <th>Price</th>
                    <th>Downloaded</th>
                </tr>
            </thead>
            <tbody>
                <?php $counter = 1; ?>
                @foreach($userAlbums as $userAlbum)
                    <tr>
                        <td>{{ $counter }}</td>
                        <td>
                            @foreach($imageThumbnails as $imageThumbnail)
                                @if($imageThumbnail->id == $userAlbum->album_cover_id)
                                    <a href="#!">
                                        <img src="{{ asset($imageThumbnail->thumbnail_path) }}" width="75" style="margin: 2%;">
                                    </a>
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <a href="#!">
                                {{ $userAlbum->title }}
                            </a>
                        </td>
                        <td>{{ $currency->code . " " . number_format( $userAlbum->price , 2 , '.', '.' ) }}</td>
                        <td>
                            @if(count($userAlbum->purchased_albums()->get()) != 0)
                                <a href="{{ route('user_download', $userAlbum) }}">
                                    {{ count($userAlbum->purchased_albums()->get()) }} times
                                </a>
                            @else
                                no one download it yet
                            @endif
                        </td>
                    </tr>
                    <?php $counter++; ?>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection