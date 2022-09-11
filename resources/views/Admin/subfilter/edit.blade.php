<div class="modal fade" id="Edit{{$fil->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add {{\Illuminate\Support\Facades\Request::segment(2)}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('sub_filter.update','test')}}" method="post">
                @csrf
                {{method_field('put')}}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <input type="hidden" name="id" value="{{$fil->id}}">
                            <input type="text" id="first_input" value="{{$fil->name}}" class="mb-3 form-control" name="sub_filter_name" placeholder="sub filter name .....">
                            <select class="form-control" name="filter_name">
                                <option value="{{$fil->filter_id}}">{{$fil->filter->name}}</option>
                                @foreach($filter as $filt)
                                    <option value="{{$filt->id}}">{{$filt->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" value="Submit" class="btn btn-primary">
                    </div>
                </div>
            </form>


        </div>

    </div>
</div>
