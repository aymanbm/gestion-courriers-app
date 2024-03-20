@if (session()->has("green"))
                <x-alert2 type="green" >
                    {{session("green")}}
                </x-alert2>
@elseif(session()->has("red"))
<x-alert2 type="danger" >
    {{session("danger")}}
</x-alert2>

@endif
