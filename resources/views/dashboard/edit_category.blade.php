<form method="POST" action="{{ route('dashboard.update_category',$category->id ) }}" enctype="multipart/form-data">
    @csrf @method('PATCH')
    <h5 class="mg-b-2"><strong>Editing {{ !empty($category->name) ? $category->name : 'UNAVAILABLE' }} Category</strong></h5>
    <hr>
    <div class="form-row mt-4">
        <div class="form-group col-md-12">
            <label for="name">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') ?? !empty($category->name) ? $category->name : 'UNAVAILABLE' }}" placeholder="Name" autocomplete="off">
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group col-md-12">
            <label for="Cat Img">Category Image</label><br>
            @if($category->cat_img_url == null)

            @else
            <img width="100" height="100" src='{{asset("assets/img/$category->cat_img_url")}}'>
            @endif
            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" autocomplete="off" required>
            @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <form>