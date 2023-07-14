<!-- Start Modal -->
<div class="modal fade" id="introductionModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Introduction</h5>
        <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="/instructor/update_course_metadata">
          @csrf
          <input type="hidden" name="course_info_id" value="{{ $courseInfo->course_info_id }}">
          <div class="form-group">
            <textarea class="form-control" rows="5" name="introductionInput" placeholder="Type here"
              id="introductionInput">{{ old('introductionInput') ?? $courseInfo->introduction ?? '' }}</textarea>
            @error('introductionInput')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group mt-5">
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->