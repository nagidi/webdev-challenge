@if($category !=0)
@php                                         
    $find_category_name = App\categoryInfo::find($category);
    $category_name = $find_category_name->category;                                           
    $total = 0;
@endphp
<div id="category" clas="row">
    <div class="col-md=12">
        <h2 class="table-head-options">Category Wise Report</h2>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Category</th>
                    <th scope="col">Month</th>
                    <th scope="col">Expanse</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td> {{ ucwords($category_name) }} </td>
                        <td> {{ $item->month }}-{{ $item->year }} </td>
                        <td> {{ $item->sum }} </td>
                        @php $total += $item->sum;  @endphp
                    </tr>
                @endforeach
                    <tr>
                        <td colspan="2"><b>Total Expanse</b></td>
                        <td> {{ $total }}</td>
                    </tr>
            </tbody>
        </table>
                                
    </div>
</div>
@endif