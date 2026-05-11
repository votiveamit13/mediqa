<style>
.compliant {
    background-color: #d3d3d33b;
    padding: 18px;
    border: solid 1px #d3d3d385;
    border-radius: 11px;
    margin-bottom: 15px;
}
.compliant span {
    line-height: 1.8;
}

.compliant a {
    line-height: 2.5;
    text-decoration: underline;
    font-weight: 500;
    color: #36c !important;
}

.compliant p.MsoNormal span {
    background: none !important;
    line-height: 1.8 !important;
}



</style>


@if ($data->isEmpty())
    <div class="alert alert-warning">
        No data available for the selected state(s) and vaccine(s).
    </div>
@else
<div class="content-container">
    @foreach ($data->groupBy('state_name') as $stateName => $items)
        <h6>{{ $stateName }}</h6>
        <p>{!! $items->first()->policy !!}</p>
        @foreach ($items as $item)
            <div class="compliant">
                {!! $item->complinace_content !!}
            </div> <!-- Properly closed div -->
        @endforeach
    @endforeach
</div>

@endif