<table>
    <thead>
        @if($parameters > 0)
            <tr>
                @foreach ($parameters as $parameter)
                    <th>{{ $parameter->name }}</th>
                @endforeach
            </tr>
        @endif

        <tr>
            @if($parameters > 0)
                @foreach ($parameters as $parameter)
                    <td colspan="{{ (count($parameter->subParameter) > 1 ? count($parameter->subParameter) : 1) }}">{{ $parameter->name ?? 'kosong' }}</td>
                @endforeach
            @endif
        </tr>

        <tr>
            @if($parameters > 0)
                @foreach ($parameters as $parameter)
                    @foreach ($parameter->subParameter as $subParameter)
                        @foreach ($subParameter->subParameter as $subSubParameter)
                            <td>{{ $subSubParameter->name }}</td>
                        @endforeach
                    @endforeach
                @endforeach
            @endif
        </tr>
    </thead>

    <tbody>
        @php
            $columns = 0;

            foreach ($parameters as $parameter) {
                if (count($parameter->subParameter) > 1) {
                    foreach ($parameter->subParameter as $subParameter) {
                        if (count($subParameter->subParameter) > 1) {
                            foreach ($subParameter->subParameter as $subSubParameter) {
                                $columns++;
                            }
                        } else {
                            $columns++;
                        }
                    }
                } else {
                    $columns++;
                }
            }
        @endphp
        @foreach($rows as $row)
            <tr>
                @foreach ($columns as $c)
                    <td><input type="text" class="form-control"></td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
