<x-header/>

@foreach($properties as $property)
    <div class="property-card">
        <h3>{{ $property->description }}</h3>
        <p>Price: ${{ number_format($property->price, 2) }}</p>
        
        <p>Location: {{ $property->address->address }}, {{ $property->address->country }}</p>
        
       
    </div>
@endforeach

<x-footer/>