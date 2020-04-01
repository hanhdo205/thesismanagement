@extends('layouts.app')

@section('title', _i('Opponent management'))
@section('description', _i('The SIS management'))
@section('keyword', _i('management'))

@section('content')
<nav class="nav-breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ url('/') }}">{{ _i('Home') }}</a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ _i('Opponent management') }}</li>
	</ol>
</nav>
<div id="page-inner">
	<div class="card">
		<div class="card-header">
			{{ _i('Opponent management') }}
		</div>
		<div class="card-body">
			<div class="card-text">
				<div class="form-group">
					<div class="form-inline">
						<select name="target_academic" class="form-control" id="target_academic">
							<option>対象学術大会を選択してください</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="form-inline">
						<button class="form-control btn btn-primary mr-sm-2 pl-5 pr-5" data-toggle="modal" data-target="#importUsers">{{ _i('Import from CSV') }}</button>
						<button class="form-control btn btn-primary pl-5 pr-5">新規追加</button>
					</div>
				</div>
				@if ($message = Session::get('success'))
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">×</button>
					  	{{ $message }}
					</div>
				@endif
				<div class="table-scroll mb-5">
					<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="fix-width text-center">
									<label class="custom-check">
										<input type="checkbox" id="selectAll" />
										<span class="checkmark"></span>
									</label>
								</th>
								<th class="fix-width">{{ _i('No.') }}</th>
								<th>{{ _i('Name') }}</th>
								<th>{{ _i('Status') }}</th>
							</tr>
						</thead>
						<tbody>
						@foreach ($data as $key => $user)
							<tr>
								<td class="fix-width text-center">
									<label class="custom-check">
										<input type="checkbox" id="{{ ++$i }}" />
										<span class="checkmark"></span>
									</label>
								</td>
								<td class="fix-width">{{ $i }}</td>
								<td>{{ $user->name }}</td>
								<td></td>
							</tr>
						@endforeach
						</tbody>
					</table>
					{!! $data->render() !!}
				</div>
				<div class="form-group">
					<form action="/review/confirmation" class="d-flex justify-content-center" method="POST">
					@csrf <!-- {{ csrf_field() }} -->
					<button type="submit" class="btn btn-primary col-sm-12 col-md-6 col-lg-6 col-xl-3 pl-5 pr-5">査読対応確認</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="importUsers" tabindex="-1" role="dialog" aria-labelledby="importUsers" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">{{ _i('Import from CSV') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      	</div>
      	<div class="modal-body">
        	<form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success">Import User Data</button>
                <a class="btn btn-warning" href="{{ route('export') }}">Export User Data</a>
            </form>
      	</div>
      	<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ _i('Cancel') }}</button>
        <button type="button" class="btn btn-primary">{{ _i('Import') }}</button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->
<!-- /. PAGE INNER  -->
@endsection