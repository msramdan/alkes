@php

    $colspan = 1;


    // loop through parameters, count subParameters, if subParameters has subSubParameters, count subSubParameters, then set colspan
    foreach ($parameters as $parameter) {
        if (isset($parameter['subParameters'])) {
            $colspan += count($parameter['subParameters']);

            foreach ($parameter['subParameters'] as $subParameter) {
                if (isset($subParameter['subSubParameters'])) {
                    $colspan += count($subParameter['subSubParameters']);
                }
            }
        }
    }

    $rowspan = 1;

    // loop through parameters, if has subParameters,set rowspan to 2, if subParameters has subSubParameters, set rowspan to 3
    foreach ($parameters as $parameter) {
        if (isset($parameter['subParameters'])) {
            $rowspan = 2;

            foreach ($parameter['subParameters'] as $subParameter) {
                if (isset($subParameter['subSubParameters'])) {
                    $rowspan = 3;
                }
            }
        }
    }


    function hasSubSubParameter($subParameter) {
        if (isset($subParameter['subSubParameters'])) {
            return true;
        }

        return false;
    }

    function hasSubParameter($parameter) {
        if (isset($parameter['subParameters'])) {
            return true;
        }

        return false;
    }
@endphp

<style>
    .table-preview td {
        border: 1px solid black !important;
    }

    .table-preview thead > th {
        border: 1px solid black !important;
    }

    .table-preview:not(.table-borderless) thead th {
        border: 1px solid black !important;
    }

    .table-preview>:not(:first-child) {
        border-top: 1px solid black !important;
    }

    .table-preview {
        border: 1px solid black !important;
    }
</style>

<table class="table table-bordered table-preview">
    <thead>
        <tr>
            @if($acuanParameter['status'] == 'true')
                <th class="text-center" rowspan="{{ $rowspan }}">{{ $acuanParameter['name'] }}</th>
            @endif

            @if($parameters > 0)
                @foreach($parameters as $parameter)
                    <th class="text-center"
                        @if(hasSubParameter($parameter))
                            colspan="{{ (count($parameter['subParameters']) + 1) % 2 == 0 ? count($parameter['subParameters']) * 2 : count($parameter['subParameters']) * 2 + 1 }}"
                        @else
                            rowspan="{{ $rowspan }}"
                        @endif
                    >{{ $parameter['name'] }}</th>
                @endforeach
            @endif
        </tr>

        <tr>
            @if($parameters > 0)
                @foreach($parameters as $parameter)
                    @if(isset($parameter['subParameters']))
                        @foreach($parameter['subParameters'] as $subParameter)
                            <th class="text-center"
                                @if(hasSubSubParameter($subParameter))
                                    colspan="{{ count($subParameter['subSubParameters']) }}"
                                @else
                                    rowspan="2"
                                @endif

                            >{{ $subParameter['name'] }}</th>
                        @endforeach
                    @endif
                @endforeach
            @endif
        </tr>

        <tr>
            @if($parameters > 0)
                @foreach ($parameters as $parameter)
                    @if(isset($parameter['subParameters']))
                        @foreach ($parameter['subParameters'] as $subParameter)
                            @if(isset($subParameter['subSubParameters']))
                                @foreach ($subParameter['subSubParameters'] as $subSubParameter)
                                    <td class="text-center">{{ $subSubParameter['name'] }}</td>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @endif
        </tr>
    </thead>

    <tbody>
        @for($i = 0; $i < $rowTotal; $i++)
            <tr>
                @if($acuanParameter['status'] == 'true')
                    <td class="text-center">
                        {{ $acuanParameter['values'][$i] }}
                    </td>
                @endif
                @foreach($parameters as $parameter)
                    @if(isset($parameter['subParameters']))
                        @foreach($parameter['subParameters'] as $subParameter)
                            @if(isset($subParameter['subSubParameters']))
                                @foreach($subParameter['subSubParameters'] as $subSubParameter)
                                    <td class="text-center">
                                        <input type="text" name="input_{{ $i }}_{{ replaceSpaceWithUnderscore($parameter['name']) }}_{{ replaceSpaceWithUnderscore($subParameter['name']) }}_{{ replaceSpaceWithUnderscore($subSubParameter['name']) }}" class="form-control form-control-sm">
                                    </td>
                                @endforeach
                            @else
                                <td class="text-center"
                                >
                                    <input type="text" name="input_{{ $i }}_{{ replaceSpaceWithUnderscore($parameter['name']) }}_{{ replaceSpaceWithUnderscore($subParameter['name']) }}" class="form-control form-control-sm">
                                </td>
                            @endif
                        @endforeach
                    @else
                        <td class="text-center"
                            @if(hasSubParameter($parameter))
                                colspan="{{ count($parameter['subParameters']) }}"
                            @endif
                        >
                            <input type="text" name="input_{{ $i }}_{{ replaceSpaceWithUnderscore($parameter['name']) }}" class="form-control form-control-sm">
                        </td>
                    @endif
                @endforeach
            </tr>
        @endfor
    </tbody>
</table>
