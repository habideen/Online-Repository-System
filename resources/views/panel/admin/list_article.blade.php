@extends('layouts.admin')


@section('content')
<div class="content-body">
  <!-- container starts -->
  <div class="container-fluid">
    <!-- Add Order -->
    <div class="modal fade" id="addOrderModalside">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Create Project</h5>
            <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label class="text-black font-w500">Project Name</label>
                <input type="text" class="form-control">
              </div>
              <div class="form-group">
                <label class="text-black font-w500">Deadline</label>
                <input type="date" class="form-control">
              </div>
              <div class="form-group">
                <label class="text-black font-w500">Client Name</label>
                <input type="text" class="form-control">
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-primary">CREATE</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="page-titles">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $type }} List</a></li>
      </ol>
    </div>
    <!-- Card starts -->
    <div class="card">
      <div class="card-header d-block">
        <h4 class="card-title">{{ $type }} List</h4>
      </div>
      <div class="card-body">
        <table class="table table-responsive-md">
          <thead>
            <tr>
              <th class="width80"><strong>#</strong></th>
              <th><strong>TITLE</strong></th>
              <th><strong>DATE CREATED</strong></th>
              <th><strong>STATUS</strong></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @php
            $count = 1;
            @endphp

            @foreach ($articles as $article)
            <tr>
              <td>{{ ++$count }}</td>
              <td><a href="/blog/{{$article->id}}/{{urlencode(str_replace(' ', '-', $article->title))}}" class="link">{{
                  $article->title }}</a></td>
              <td>{{ date('d M, Y') }}</td>
              <td><span class="badge light badge-{{ $article->enabled ? 'success' : 'danger' }}">{{ $article->enabled ?
                  'Enabled' : 'Disabled' }}</span></td>
              <td>
                <a href="" class="btn btn-success light sharp" data-bs-toggle="dropdown">
                  @component('components.svg.hr-dot3', ['height'=>'20', 'width'=>'20'])
                  @endcomponent
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- End card-body -->
    </div>
    <!-- Card ends -->
  </div>
  <!-- container ends -->
</div>
@endsection