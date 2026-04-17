@foreach($properties as $property)
    <div class="property-card">
        <h3>{{ $property->description }}</h3>
        <p>Price: ${{ number_with_delimiter($property->price) }}</p>
        
        <p>Location: {{ $property->address->address }}, {{ $property->address->country }}</p>
        
        <a href="{{ route('properties.show', $property->id) }}">View Details</a>
    </div>
@endforeach