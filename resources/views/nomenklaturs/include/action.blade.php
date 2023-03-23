<td>
    @can('nomenklatur view')
        <a href="{{ route('nomenklaturs.show', $model->id) }}" class="btn btn-outline-success btn-sm">
            <i class="fa fa-cog"></i>
        </a>
    @endcan

    @can('nomenklatur edit')
        <a href="{{ route('nomenklaturs.edit', $model->id) }}" class="btn btn-outline-primary btn-sm">
            <i class="fa fa-pencil-alt"></i>
        </a>
    @endcan

    @can('nomenklatur delete')
        <form action="{{ route('nomenklaturs.destroy', $model->id) }}" method="post" class="d-inline"
            onsubmit="return confirm('Are you sure to delete this record?')">
            @csrf
            @method('delete')

            <button class="btn btn-outline-danger btn-sm">
                <i class="ace-icon fa fa-trash-alt"></i>
            </button>
        </form>
    @endcan
</td>
