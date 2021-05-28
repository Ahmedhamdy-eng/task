
<form action="{{ route('dashboard.' .$route. '.destroy', $model->id) }}" method="post" style="display: inline-block">
    {{ csrf_field() }}
    {{ method_field('delete') }}
    <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('delete')</button>
</form><!-- end of form -->