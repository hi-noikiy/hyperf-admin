<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table admin-table table-bordered table-striped">
                    <thead>
                        <tr>
                        @foreach($columns as $column)
                            @if (!empty($column['width']))
                            <th style="width: {{ $column['width'] }}px !important;">{{ $column['label'] ?? $column }}</th>
                            @else
                            <th>{{ $column['label'] ?? $column }}</th>
                            @endif
                        @endforeach
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($dataProvider as $item)
                        <tr>
                        @foreach($columns as $column)
                            @if (isset($column['value']))
                            <td>{{ $column['value']($item) }}</td>
                            @else
                            <td>{{ $item->{$column['attribute'] ?? $column} ?? '' }}</td>
                            @endif
                        @endforeach
                            <td>
                                <a href="/admin/message/{{ $item['id'] }}/edit"><i class="fas fa-edit"></i></a>
                                <a href="javascript:void(0);" data-id="{{ $item['id'] }}" class="tree_branch_delete"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>