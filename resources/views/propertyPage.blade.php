<x-header/>

@foreach ($properties as $property)
    <div style="border:1px solid #ccc; padding:10px; margin:10px; width:200px;">
        <h3>{{ $property->name }}</h3>

        <img src="{{ asset('storage/' . $property->image) }}" >

    </div>
@endforeach

<x-footer/>