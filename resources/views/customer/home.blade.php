<x-app-layout>
    <div class="py-12">
        <div class="container">
            <div class="appointment-box">
                <div class="p-6 text-gray-900 items-center">
                    <p class="text-lg font-medium text-gray-700">
                        "Pamper your furry friends with love and professional grooming care. They deserve the best!"
                    </p>

                    <div class="appCon">
                        <button class="appointment-button mt-6" id="openModalBtn" onclick="openConfirmationModal2()">
                            Make Appointment
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="confirmation-modal" class="modal-overlay hidden">
        <div class="modal-content bg-white rounded-lg p-6">
            <h3 class="text-xl font-medium text-gray-800 mb-4">Menu</h3>

            <!-- Form for Appointment -->
            <form action="{{ route('appointments.store') }}" method="POST">
                @csrf

                <!-- Hidden Inputs for Services and Total Price -->
                <input type="hidden" id="selected_services" name="selected_services" value="">
                <input type="hidden" id="selected_totalPrice" name="totalPrice" value="0">

                <div class="mb-4 modal-con">
                    <!-- Pet Details -->
                    <div class="mb-4">
                        <label for="petType" class="block text-gray-700">Pet Type</label>
                        <input type="text" id="petType" name="petType" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>

                        <label for="breed" class="block text-gray-700 mt-4">Breed</label>
                        <input type="text" id="breed" name="breed" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                    </div>

                    <!-- Services with Prices -->
                    <div class="mb-4">
                        <label for="services" class="block text-gray-700">Select Services</label>
                        <div class="space-y-4 services-container">
                            @foreach($service as $item)
                                <div class="flex items-center the-b">
                                    <div>
                                        <input 
                                            type="checkbox" 
                                            id="service{{ $item->id }}" 
                                            value="{{ $item->description }}" 
                                            data-price="{{ $item->price }}" 
                                            class="service-checkbox" 
                                            onchange="updateTotalPrice()"> 
                                        <label for="service{{ $item->id }}" class="ml-2">
                                            {{ $item->description }} - ${{ number_format($item->price, 2) }}
                                        </label>
                                    </div>
                                    <div>
                                        <h1>{{ $item->pet_type }}</h1>
                                    </div>
                                    

                                </div>
                            @endforeach
                        </div>
                    </div>


                    <!-- Total Price -->
                    <div class="mb-4">
                        <label for="totalPrice" class="block text-gray-700">Total Price</label>
                        <input type="text" id="totalPrice" name="totalPriceDisplay" class="w-full px-4 py-2 border border-gray-300 rounded-md" value="$0" disabled>
                    </div>

                    <!-- Confirm Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="bg-green-500 text-black px-6 py-2 rounded-md">Confirm</button>
                        <button type="button" class="ml-4 bg-gray-300 text-black px-6 py-2 rounded-md" id="closeModalBtn" onclick="closeConfirmationModal2()">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
        }

        .appointment-box {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 50%;
        }

        .appCon{
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .appointment-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 25px;
            padding: 15px 25px;
            font-size: 16px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .appointment-button:hover {
            background-color: #45a049;
        }

        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(110, 110, 110, 0.7);
            justify-content: center;
            align-items: center;
            z-index: 50;
        }

        .modal-content {
            background: #ffffff;
            border-radius: 0.5rem;
            padding: 2rem;
            width: 90%;
            max-width: 500px;
        }
        .services-container {
            max-height: 200px; /* Adjust height as needed */
            overflow-y: auto;
            padding-right: 10px; /* Add padding to avoid scrollbar overlapping content */
        }

        /* Optional: Style the scrollbar for a better look */
        .services-container::-webkit-scrollbar {
            width: 8px;
        }

        .services-container::-webkit-scrollbar-thumb {
            background-color: #4CAF50;
            border-radius: 4px;
        }

        .services-container::-webkit-scrollbar-track {
            background-color: #f1f1f1;
        }
        .the-b{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        /* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    color: #333;
    margin: 0;
    padding: 0;
}

.content-wrapper {
    padding: 50px 20px;
    background-color: #ffffff;
}

h1, h2, h3 {
    margin: 0;
    padding: 10px 0;
}

h1 {
    font-size: 36px;
    font-weight: bold;
    text-align: center;
}

h2 {
    font-size: 28px;
    font-weight: 600;
    text-align: center;
    color: #2d3748;
}

h3 {
    font-size: 22px;
    font-weight: 500;
    margin-top: 10px;
    color: #2b6cb0;
}

/* Welcome Section */
.welcome-section {
    text-align: center;
    margin-bottom: 40px;
}

.welcome-section p {
    font-size: 18px;
    color: #4a5568;
}

/* Services Section */
.services {
    padding: 60px 20px;
    background-color: #ffffff;
}

.service-list {
    display: flex;
    overflow-x: auto; /* Enable horizontal scrolling */
    gap: 20px; /* Add space between cards */
    padding: 10px 0; /* Optional: add padding for spacing */
    scroll-snap-type: x mandatory; /* Enable snapping for smoother scrolling */
}

.service-card {
    width: 400px;
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    padding: 20px;
    text-align: center;
    transition: transform 0.3s ease-in-out;
    scroll-snap-align: start; /* Align the cards to the start of the container */
}

.service-card:hover {
    transform: scale(1.05);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
}

.service-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 12px;
}

.price {
    font-size: 18px;
    font-weight: bold;
    color: #38b2ac; /* Teal */
    margin-top: 15px;
}

/* Optional: Style for the scrollbar */
.service-list::-webkit-scrollbar {
    height: 8px;
}

.service-list::-webkit-scrollbar-thumb {
    background-color: #38b2ac; /* Teal */
    border-radius: 4px;
}

.service-list::-webkit-scrollbar-track {
    background: #f0f0f0;
}


.price {
    font-size: 18px;
    font-weight: 500;
    margin-top: 10px;
    color: #48bb78;
}

/* Ratings Section */
.ratings {
    padding: 40px 20px;
    background-color: #f7fafc;
}

.rating-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

.rating-card {
    width: 320px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: center;
}

.rating-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 10px;
}

.client-name {
    font-weight: bold;
    color: #2d3748;
}

.rating-stars {
    color: #f6e05e;
}

/* Promotions Section */
.promotions {
    padding: 40px 20px;
    background-color: #f0fff4;
}

.promo-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

.promo-card {
    width: 280px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: center;
    background-color: #e6fffa;
}

.promo-card h3 {
    color: #38b2ac;
}

.promo-card p {
    color: #4a5568;
}


/* Footer Styling */
.footer {
    background-color: #2d3748; /* Dark background */
    color: white;
    padding: 40px 20px;
    text-align: center;
}

.footer h3 {
    font-size: 1.5rem;
    margin-bottom: 5px;
    margin-right: 20px;
    font-weight: bold;
}

.contact-items {
    display: flex;
    justify-content: center;
    gap: 30px;
    flex-wrap: wrap; /* Allows items to wrap on smaller screens */
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 1.1rem;
}

.contact-item a {
    color: white;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 10px;
}

.contact-item:hover {
    color: #38b2ac; /* Teal color on hover */
}

.icon {
    width: 24px;
    height: 24px;
}

.contact-item span {
    font-size: 1.1rem;
}

@media (max-width: 768px) {
    .footer {
        padding: 40px 15px;
    }

    .contact-item {
        font-size: 1rem;
    }

    .icon {
        width: 20px;
        height: 20px;
    }
}


    </style>

    <script>
        // Function to update the total price
        // Function to update the total price and store selected services
function updateTotalPrice() {
    let totalPrice = 0;
    let selectedServices = [];
    const checkboxes = document.querySelectorAll('.service-checkbox:checked');
    
    checkboxes.forEach(function(checkbox) {
        totalPrice += parseFloat(checkbox.getAttribute('data-price'));
        selectedServices.push(checkbox.value); // Collect selected service IDs
    });

    // Update the total price display
    document.getElementById('totalPrice').value = `$${totalPrice}`;

    // Set the selected services to the hidden input
    document.getElementById('selected_services').value = selectedServices.join(',');
    
    // Set the total price to the hidden input as well
    document.getElementById('selected_totalPrice').value = totalPrice;
}



        // Open the confirmation modal
        function openConfirmationModal2(form) {
            document.getElementById('confirmation-modal').classList.remove('hidden');
            document.getElementById('confirmation-modal').style.display = 'flex';
        }

        // Close the confirmation modal
        function closeConfirmationModal2() {
            document.getElementById('confirmation-modal').classList.add('hidden');
            document.getElementById('confirmation-modal').style.display = 'none';
        }
    </script>

</x-app-layout>
<x-app-layout>
    <div class="content-wrapper">
        <div class="welcome-section">
            <h1>Welcome to Our Pet Grooming Shop</h1>
            <p>Pamper your furry friends with love and professional grooming care. They deserve the best!</p>
        </div>
    </div>

    <!-- Services Section -->
    <section class="services">
        <div class="section-header">
            <h2>Our Grooming Services</h2>
        </div>
        <div class="service-list">
            @foreach($service as $item)
                <div class="service-card">
                    {{-- <img src="{{ asset('images/logo.jpg') }}" alt="Dog Grooming" class="service-image"> --}}
                    <h3>{{ $item->description }}</h3>
                    <p>{{ $item->pet_type }}</p>
                    <p class="price">Price: ${{ number_format($item->price, 2) }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Ratings Section -->
    <section class="ratings">
        <div class="section-header">
            <h2>What Our Clients Say</h2>
        </div>
        <div class="rating-list">
            <div class="rating-card">
                <p>"The best grooming service we've ever had! Our dog looks amazing, and the staff is so friendly."</p>
                <div class="rating-footer">
                    <span class="client-name">John D.</span>
                    <span class="rating-stars">⭐⭐⭐⭐⭐</span>
                </div>
            </div>
            <div class="rating-card">
                <p>"Highly recommend this shop. My cat is always so calm after grooming!"</p>
                <div class="rating-footer">
                    <span class="client-name">Sarah M.</span>
                    <span class="rating-stars">⭐⭐⭐⭐</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Promotions Section -->
    <section class="promotions">
        <div class="section-header">
            <h2>Special Offers</h2>
        </div>
        <div class="promo-list">
            <div class="promo-card">
                <h3>First Time Grooming Discount</h3>
                <p>Get 20% off your first grooming service. Book your appointment now and treat your pet!</p>
            </div>
            <div class="promo-card">
                <h3>Loyalty Program</h3>
                <p>Earn points with each visit. Get a free grooming session after 5 appointments!</p>
            </div>
        </div>
    </section>
<!-- Footer Section -->
<footer class="footer">
    <div class="container">
        <h3>Contact Us</h3>
        <div class="contact-items">
            <!-- Phone Icon -->
            <div class="contact-item">
                <a href="tel:+123456789">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l4-4m0 0l4 4M7 3h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"/>
                    </svg>
                    <span>+1 (234) 567-890</span>
                </a>
            </div>

            <!-- Email Icon -->
            <div class="contact-item">
                <a href="mailto:contact@petgrooming.com">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12l-8 8-8-8m8-8l8 8-8 8"/>
                    </svg>
                    <span>contact@petgrooming.com</span>
                </a>
            </div>

            <!-- Address Icon -->
            <div class="contact-item">
                <a href="https://www.google.com/maps" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2c2.485 0 4 2.014 4 4s-1.515 4-4 4-4-2.014-4-4 1.515-4 4-4zm0 12c-3.314 0-6 2.686-6 6s2.686 6 6 6 6-2.686 6-6-2.686-6-6-6z"/>
                    </svg>
                    <span>123 Pet Grooming Ave, City, State</span>
                </a>
            </div>
        </div>
    </div>
</footer>


</x-app-layout>


<!-- Include this in your Blade view file -->
@if(session('success'))
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const message = '{{ session('success') }}';
            showNotification(message, 'success');
        });

        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.classList.add('notification', type);
            notification.textContent = message;

            // Style the notification
            notification.style.position = 'fixed';
            notification.style.top = '5%';
            notification.style.left = '50%';
            notification.style.transform = 'translate(-50%, -50%)';
            notification.style.backgroundColor = '#38a169'; // Green for success
            notification.style.color = 'white';
            notification.style.padding = '15px';
            notification.style.borderRadius = '5px';
            notification.style.boxShadow = '0px 4px 6px rgba(0, 0, 0, 0.1)';
            notification.style.fontSize = '16px';
            notification.style.zIndex = '9999';
            notification.style.transition = 'opacity 0.5s ease-in-out';

            // Append to body
            document.body.appendChild(notification);

            // Make the notification disappear after 2 seconds
            setTimeout(() => {
                notification.style.opacity = 0;
            }, 2000);

            // Remove the notification from the DOM after it fades out
            setTimeout(() => {
                notification.remove();
            }, 2500);
        }
    </script>
@endif
