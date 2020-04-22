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
                        @if (!empty($action))
                            <th style="width: 60px;">操作</th>
                        @endif
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
                        @if (!empty($action))
                            <td>
                                @foreach($action as $op)
                                    @if ($op == 'view')
                                    <a href="/{{ $_path }}/{{ $item['id'] }}"><i class="fas fa-eye"></i></a>&nbsp;&nbsp;
                                    @elseif ($op == 'edit')
                                    <a href="/{{ $_path }}/{{ $item['id'] }}/edit"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                                    @elseif ($op == 'delete')
                                    <a href="javascript:void(0);" data-id="{{ $item['id'] }}" class="grid-row-delete"><i class="fas fa-trash"></i></a>&nbsp;&nbsp;
                                    @else
                                    {!! $op($item) !!}
                                    @endif
                                @endforeach
                            </td>
                        @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>