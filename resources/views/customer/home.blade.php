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
