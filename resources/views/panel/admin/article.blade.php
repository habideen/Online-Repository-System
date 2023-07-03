@extends('layouts.admin')


@section('content')
<div class="content-body">
  <!-- container starts -->
  <div class="container-fluid">
    <div class="page-titles">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Article</a></li>
      </ol>
    </div>
    <!-- row -->
    <!-- Row starts -->
    <div class="card">
      <div class="card-header d-block">
        <h4 class="card-title">Create</h4>
      </div>
      <div class="card-body">

        @if(Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif
        @if(Session::has('fail'))
        <div class="alert alert-danger">{{Session::get('fail')}}</div>
        @endif

        <div class="row justify-content-between">

          <form action="{{ url($formLink) }}" method="post" enctype="multipart/form-data" class="">
            @csrf

            <input type="text" name="article_id" value="{{$article->id ?? ''}}" class="d-none" readonly>

            <div class="form-group mb-4">
              <label for="title">Image (optional)</label>
              <input type="file" style="height: 55px;" class="form-control" name="image" id="image"
                accept=".png,.jpeg,.jpg,.gif" {{ isset($article->id) ? '' : 'required' }}>
              <textarea name="image_result" id="image_result" class="d-none" readonly></textarea>
              @error('image_result')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group mb-4">
              <label for="title">Title</label>
              <input type="text" class="form-control" name="title" id="title" placeholder="Please enter news title"
                value="{{ old('title') ?? $article->title ?? '' }}" required='true'>
              @error('title')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group mb-4 row">
              <div class="col-sm-12">
                <label for="type">Article Type</label>
                <select class="form-control" name="type" id="type" required='true'>
                  <option value="">Select</option>
                  <option value="Blog">Blog</option>
                  <option value="Event">Event</option>
                </select>
                @error('type')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
            </div>

            <div class="form-group mb-4 d-none" id="location-div">
              <label for="location">Location</label>
              <input type="text" class="form-control" name="location" id="location"
                placeholder="Please enter news location" value="{{ old('location') ?? $article->location ?? '' }}">
              @error('location')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group mb-4">
              <label for="body">Body</label>
              <textarea class="form-control" rows="9" name="body"
                id="body">{{ old('body') ?? $article->body ?? '' }}</textarea>
              @error('body')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group mt-5">
              <button class="btn btn-primary form-control" type="submit">Create</button>
            </div>

          </form>

        </div>
      </div>
      <!--card-body-->
    </div>
    <!-- Row ends -->
  </div>
  <!-- container ends -->
</div>


<!-- Start Crop image Modal -->
<div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
  aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-fullscreen" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Upload Avatar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body pt-4 pb-4">
        <div id="upload-demo"></div>
      </div>
      {{-- {{ route('updateAvatar') }} --}}
      {{-- <form action="" method="post"> --}}
        @csrf
        {{-- <input type="text" class="readonly d-none" name="image_result" id="image_result" readonly> --}}
        <div class="border-top p-3">
          <div class="d-flex">
            <button type="button" class="btn btn-primary btn-upload-image">Upload</button>
            <div class="ms-auto">
              <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
        {{--
      </form> --}}
    </div>
  </div>
</div>
<!-- End Crop image Modal -->
@endsection


@section('script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css"
  integrity="sha512-zxBiDORGDEAYDdKLuYU9X/JaJo/DPzE42UubfBw9yg8Qvb2YRRIQ8v4KsGHOx2H1/+sdSXyXxLXv5r7tHc9ygg=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"
  integrity="sha512-Gs+PsXsGkmr+15rqObPJbenQ2wB3qYvTHuJO6YJzPe/dTLvhy0fmae2BcnaozxDo5iaF8emzmCZWbQ1XXiX2Ig=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
<script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
<script>
  const easyMDE = new EasyMDE({element: document.getElementById('body')});
</script>

<script>
  $(document).ready(function() {
    function typeSelect() {
      if ($('#type').val() == 'Event') {
        $('#location-div').removeClass('d-none')
        $('#location').prop('required', 'true')
      }
      else if ($('#type').val() == 'Blog') {
        $('#location-div').addClass('d-none')
        $('#location').removeProp('required')
      }
    }
    $('#type').change(()=>{
      typeSelect()   
    })

    typeSelect()

    var resize = $('#upload-demo').croppie({
        enableExif: true,
        enableOrientation: true,
        enableResize: false,
        maxZoom: 0.3,
        viewport: { // Default { width: 100, height: 100, type: 'square' } 
            width: 450,
            height: 225,
            type: 'square' //circle
        },
        boundary: {
            width: 550,
            height: 400
        }
    });
    $('#image').on('change', function () { 
    var reader = new FileReader();
        reader.onload = function (e) {
        resize.croppie('bind', {
            url: e.target.result
        }).then(function(){
            console.log('jQuery bind complete');
            $('.cr-slider').attr({'min':0.02000, 'max':1.5000});
            $('#image_result').val('')
        });
        }
        reader.readAsDataURL(this.files[0]);
        $('#modal').modal('show')
    });

    // 

    $('.btn-upload-image').on('click', function (ev) {
        resize.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (img) {
            $('#image_result').val(img)
            $('#modal').modal('hide')
        });
    });
    //End Crop Image
})

</script>
@endsection