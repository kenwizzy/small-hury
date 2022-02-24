{{--<form method="POST" action="{{ url('')}}" enctype="multipart/form-data">
@csrf
<h5 class="mg-b-2"><strong>Assigning {{ !empty($order->is) ? $order->id : 'UNAVAILABLE' }} to biker</strong></h5>
<hr>
<div class="col-md-12">
    <div class="form-row col-md-8">
        <div class="form-group">
            <label for="name">Biker Name</label>
            <input type="text" class="form-control @error('biker') is-invalid @enderror" name="biker" value="{{ old('name') ?? !empty($user->id) ? $user->first_name : 'UNAVAILABLE' }}" readonly autocomplete="off">
            @error('biker')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
        {{--<button type="submit" class="btn btn-primary">Update</button>--}}

    </div>
</div>
</form>--}}