@extends('/layout.layout')
@section('content')
<div class="container ">    
  <div class="row">
    <div class="col-md-12"> 
        <div class="panel panel-default">
             <div class="panel-body">
             
                <div class="row">
                    <div class="col-md-4">
                        <label for="timeline">Timeline</label>
                            <select name="timeline" id="timeline" class="form-control">
                                <option value="0">Select...</option>
                                <option value="M" selected>Monthly</option>
                            </select>
                    </div>
                    <div class="col-md-4">
                        <label for="category">Category</label>
                            <select name="category" id="search_category" class="form-control">
                                @php $categories = App\categoryInfo::all(); @endphp
                                <option value="0">Select...</option>
                                @if($categories)
                                    @foreach($categories as $category)
                                        <option value=" {{ $category->id }} "> {{ $category->category }} </option>
                                    @endforeach
                                @endif
                            </select>
                    </div>
                    <div class="col-md-4">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <label for="">&nbsp;</label>
                        <button id="btn_search" class="btn btn-success btn-block btn-submit"><i class="fas fa-search-dollar"></i> Search</button>
                    </div>
                </div>
                
                
                <div id="category" clas="row">
                </div>
                <div id="monthly" clas="row">
                    <div class="col-md=12">
                        <h2 class="table-head-options">Monthly Wise Report</h2>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Month</th>
                                    <th scope="col">Expanse</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total=0;
                                @endphp
                                @foreach ($data as $item)
                                    <tr>
                                        <td> {{ $item->month }}-{{ $item->year }} </td>
                                        <td> {{ $item->sum }} </td>
                                        @php $total += $item->sum;  @endphp
                                    </tr>
                                @endforeach
                                    <tr>
                                        <td> <b>Total Expanse</b> </td>
                                        <td> {{ $total }}</td>
                                    </tr>
                            </tbody>
                        </table>
                                               
                    </div>
                </div>
            </div>
            <div>
         </div>
    </div>
  </div>
</div>
@endsection
@section('footerscripts')

<script type="text/javascript">
$('.btn-submit').click(function(event){
    jQuery('#monthly').show();
    jQuery('#category').hide();
    event.preventDefault();

    var time = $('#timeline').val();
    var category = $('#search_category').val();
    if(time == 0 && category == 0){
                    alert('Select Minimum one filter to search');
                return false;
            } else if(time == "M" && category == 0){
                jQuery('#monthly').show();
                jQuery('#category').hide();
            }else{
                if(time == 0){
                    alert('Time line is required');
                    return false;
                }else{
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                    jQuery.ajax({
                                    url: "{{ url('/reports') }}",
                                    method: 'get',
                                    data: {
                                        category: $('#search_category').val(),
                                    },
                                    success: function(result){
                                        jQuery('#monthly').hide();
                                        jQuery("#category").html(result.htmls).show();

                                }});
                }
            }
});
</script>
@endsection