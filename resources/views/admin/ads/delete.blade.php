<div class="modal fade" id="deletemodel{{$ad->id}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> {{__("Warning")}} </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">{{__ ("Are you sure you want to delete the element?")}}
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">{{__ ("Close")}}</button>
                <form id="logout-form" action="{{route('admin.ads.destroy', $ad->id)}}"method="POST">
                    @csrf
                    @method("Delete")
                    <button type="submit" class="btn btn-danger">{{__ ("Delete")}}</button>
                </form>

            </div>
        </div>
    </div>
</div>