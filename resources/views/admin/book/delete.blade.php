
<!-- Delete -->
<div class="modal fade pchannelModel" id="delete{{ $row->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header " style="align-items: center">
               
              <h4 class="modal-title "><span class="books_id"><?php echo translate('delete_books_title') ?></span></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('books.destroy', $row->id) }}">
                    @csrf
                    {{ method_field('DELETE') }}
                    <div class="text-center">
                        <h6><?php echo translate('are_you_sure_delete') ?></h6>
                        <h4 class="bold del_Reward Type_name">{{$row->name}}</h4>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i> <?php echo translate('deleteBtn') ?></button>
                </form>
            </div>
        </div>
    </div>
</div>
