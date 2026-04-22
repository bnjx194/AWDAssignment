<x-header/>
    <h1 class ="title">Create Listing For Your Property</h1>

<form method="POST" action="/sell" enctype="multipart/form-data" onsubmit="return confirm('Do you want to list this property now?')">
    @csrf
    <div class="property-section">
        <h2>Property Details</h2><hr>
        <div>
            <label for="description" class="form-label">Property Description :</label><br>
            <textarea type="text" id="description" name="description" placeholder="Describe your property......" required></textarea>
        </div>
        <div>
            <label for="bedrooms" class="form-label">Bedrooms :</label><br>
            <input type="number" id="bedrooms" name="bedrooms" placeholder="Number of Bedrooms"required>
        </div>
        <div>
            <label for="bathrooms" class="form-label">Bathrooms :</label><br>
            <input type="number" id="bathrooms" name="bathrooms" placeholder="Number of Bathrooms"required>
        </div>
        <div>
            <label for="sqft" class="form-label">Area(sqft) :</label><br>
            <input type="number" id="sqft" name="sqft" placeholder="e.g. 1200" required>
        </div>
        <div class ="image-section">
            <label for="image" class="form-label">Property Image :</label><br><br>
            <input type="file" id="image" name="image" required>
        </div>
    </div>

    <div class="address-section">
        <h2>Address</h2><hr>
        <div>
            <label for="address" class="form-label">Address :</label><br>
            <input type="text" id="address" name="address" placeholder="Street Address" required>
        </div>
        <div>
            <label for="Postal Code" class="form-label">Postal Code :</label><br>
            <input type="number" id="postal_code" name="postal_code" placeholder="e.g. 43200" required>
        </div>
        <div>
            <label for="country" class="form-label">Country :</label><br>
            <input type="text" id="country" name="country" placeholder="e.g. Malaysia" required>
        </div>
    </div>

    <div class="listing-section">
        <h2>Listing Info</h2><hr>
        <div>
            <label for="price" class="form-label">Price(RM):</label><br>
            <input type="number" id="price" name="price" placeholder="e.g. 1200" required>
        </div>
    </div>   

    <button type="submit" class="submit-btn">Save Property</button>
</form>   

<x-footer/>

<style>
    .title{
        text-align: center;
        margin-bottom:25px;
        color: #333;
    }
    form {
        max-width: 600px;
        margin: 2rem auto;
        padding: 1rem;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .image-section{
        padding: 0.5rem;
        margin-top: 0.25rem;
        border: 1px solid #6f1b1ba0;
        border-radius: 4px;
    }

    h2 {
        margin-bottom: 0.5rem;
        color: #333;
    }

    label {
        font-weight: bold;
        color: #555;
    }

    input[type="text"], input[type="number"], textarea {
        width: 100%;
        padding: 0.5rem;
        margin-top: 0.25rem;
        border: 1px solid #6f1b1ba0;
        border-radius: 4px;
    }

    .submit-btn {
        margin-top: 1rem;
        display: block;
        width: 100%;
        padding: 0.75rem;
        background-color: #a95303;
        color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 1rem;
        cursor: pointer;
    }

    .submit-btn:hover {
        background-color: #b38000;
    }
</style>