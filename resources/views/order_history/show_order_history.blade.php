@extends('home')

@section('main')
    <div class="container">
        <h5 class="blue-grey-text">Albums that have been purchased by you</h5>
        <hr>

        <div class="col s12 m12 l12">
            <?php $counter = 1; ?>
            <table id="order-history-table" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>No. </th>
                    <th>Image Cover</th>
                    <th>Album Title</th>
                    <th>Price</th>
                    <th>Bought At</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($purchasedAlbums as $purchasedAlbum)
                        <tr>
                            <td>{{ $counter }}</td>
                            <td>
                                @foreach($purchasedAlbum->image_thumbnails as $imageThumbnail)
                                    @if($purchasedAlbum->album_cover_id == $imageThumbnail->id)
                                        <img src="{{ asset($imageThumbnail->thumbnail_path) }}" width="70" style="margin: 2%">
                                    @endif
                                @endforeach
                            </td>
                            <td><a href="{{ route('showcase_album', $purchasedAlbum->id) }}">{{ $purchasedAlbum->title }}</a></td>
                            <td>{{ $currency->code . " " . number_format( $purchasedAlbum->price , 2 , '.', '.' ) }}</td>
                            <td>
                                {{ $purchasedAlbum->pivot->created_at->format('d-M-Y') }}
                            </td>
                        </tr>

                        <?php $counter++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection