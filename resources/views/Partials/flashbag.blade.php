@if (session()->has("green"))
                <x-alert type="green" >
                    {{session("green")}}
                </x-alert>
@elseif(session()->has("red"))
<x-alert type="red" >
    {{session("red")}}
</x-alert>

@endif
