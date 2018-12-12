@extends('layouts.master')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>DATA WARGA NEGARA INDONESIA <small></small></h3>
      </div>

      <div class="title_right">
        <div class="col-md-4 col-sm-8 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
              <a href="{{ route('trainweb') }}" class="btn btn-primary btn-xs"><i class="fa fa-globe"></i> Train From Web</a>
              <a href="{{ route('dashboard') }}" class="btn btn-warning btn-xs"><i class="fa fa-refresh"></i> Refresh</a>
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <ul class="nav navbar-right">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
              </ul>
              <div class="clearfix">Jumlah Warga Negara: <b>{{ $citizen->count() }} </b></div>
            </div>
            <div class="x_content">
          @if($citizen->count())
              <table id="datatable" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <?php $no=1; ?>
                    <td align="center"><b>No.</b></td>
                    <td align="center"><b>Fullname</b></td>
                    <td align="center"><b>NIK</b></td>
                    <td align="center"><b>Gender</b></td>
                    <td align="center"><b>Place of Birth</b></td>
                    <td align="center"><b>Birth Date</b></td>
                    <td align="center"><b>State</b></td>
                    <td align="center"><b>Status</b></td>
                    <td align="center"><b>Kontrol</b></td>
                  </tr>
                </thead>
                @foreach($citizen as $data)
                    <tr>
                      <td align="center" width="30px"> {{$no++}} </td>
                      <td width="300px">{{ ucwords($data->fullname) }}</td>
                      <td width="200px">{{ ucwords($data->nik) }}</td>
                      <td width="70px">{{ ucwords($data->gender) }}</td>
                      <td width="150px">{{ ucwords($data->place_of_birth) }}</td>
                      <td width="150px">{{ date('F d, Y', strtotime($data->birth_date)) }}</td>
                      <td width="70px">{{ $data->state }}</td>
                      <td width="70px">{{ $data->the_status }}</td>
                      <td align="center">
                        <form method="POST" action="{{ route('destroy', $data->id) }}" accept-charset="UTF-8">
                          <input name="_method" type="hidden" value="DELETE">
                          <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <a class='btn btn-primary btn-xs' href="{{ route('detail', $data->id) }}"><i class="fa fa-info-circle"></i> Details</a>
                            <a target="_blank" class='btn btn-default btn-xs' href="http://localhost:81/myktp/api/viewImages.php?id={{ $data->id }}"><i class="fa fa-info-circle"></i> View Image</a>
                            <a href="{{ route('edit', $data->id) }}" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> Edit</a>
                            <input type="submit" class="btn btn-warning btn-xs" onclick="return confirm('Are You Sure?');" value="Hapus">
                        </form>
                      </td>
                    </tr>
                @endforeach
              </table>
            </div>
            <!-- PAGINATION -->
           {!! $citizen->links() !!}
          @else
              <div class="alert">
                  <i class="fa fa-exclamation-triangle"></i> Data Tidak Tersedia...
              </div>
          @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
@stop
