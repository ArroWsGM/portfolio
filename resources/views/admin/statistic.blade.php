@extends('admin._main')

@section('page_content')
<td class="container-fluid">
	<div class="row">
		<div class="col-sm-12 text-center">
			<h2>View statistic</h2>
            @eval($to = new \Carbon\Carbon($stat->first()->updated_at))
            @eval($from = (new \Carbon\Carbon($stat->first()->updated_at))->subWeek())
            @eval(\Carbon\Carbon::setToStringFormat('d F Y');)
            <p>{{ $from }} - {{ $to }}</p>
		</div>
	</div>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Project name</th>
                        <th>Total views</th>
                        <th>Unique views</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stat as $row)
                        <tr>
                            <td><strong>{{ $row->project->project_name }}</strong></td>
                            <td><span class="label {{ $row->views_total > 0 ? 'label-success' : 'label-danger' }}">{{ $row->views_total }}</span></td>
                            <td><span class="label {{ $row->views_unique > 0 ? 'label-success' : 'label-danger' }}">{{ $row->views_unique }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No Statistic for the last week</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop