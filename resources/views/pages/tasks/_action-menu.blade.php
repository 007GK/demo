<!--begin::Action--->
<td class="text-end">
     <a href="{{ route('task.edit', $model->id) }}" class="btn btn-sm">
        <i class="fa fa-edit"></i>
    </a>
    <button data-destroy="{{ route('task.destroy', $model->id) }}" class="btn btn-sm delete">
    <i class="fa fa-times"></i>
    </button>
</td>
<!--end::Action--->
