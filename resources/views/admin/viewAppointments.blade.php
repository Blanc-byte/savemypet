<x-app-layout>
    <div id="add-equipment-modal" class="modal-overlay hidden">
        <div class="modal-content">
            {{-- <h2 class="text-xl font-bold mb-4">Add Equipment</h2> --}}
            <!-- Form in Modal -->
            <form id="add-equipment-form" action="{{ route('update.appointment') }}" method="POST">
                @csrf

                <!-- Hidden Input for Appointment ID -->
                <input type="hidden" name="appointment_id" id="appointment_id">

                <!-- Room Selection -->
                <div class="mb-4">
                    <label for="room" class="block font-semibold mb-2">Select Room:</label>
                    <select name="room" id="room" class="input-field" required>
                        <option value="" disabled selected>Select a room</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->name }}">{{ $room->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Date and Time Selection -->
                <div class="mb-4">
                    <label for="datetime" class="block font-semibold mb-2">Select Date and Time:</label>
                    <input type="datetime-local" name="datetime" id="datetime" class="input-field" required>
                </div>

                <div class="flex justify-end">
                    <button type="button" onclick="closeAddEquipmentModal()" class="button button-red mr-2">Cancel</button>
                    <button type="submit" class="button button-blue">Confirm</button>
                </div>
            </form>

            
        </div>
    </div>
    
    <div class="py-12">
        <div class="container">
            <div class="appointment-box">
                @if(is_null($appointment))
                    <p class="no-data">No Appointments found.</p>
                @else
                    @foreach($appointment as $appointments)
                        <div class="appointment-details">
                            <div>
                                <strong>Customer Name:</strong>
                                <span>{{ $appointments->name }}</span>
                            </div>

                            <div>
                                <strong>Pet Type:</strong>
                                <span>{{ $appointments->pet_type }}</span>
                            </div>

                            <div>
                                <strong>Breed:</strong>
                                <span>{{ $appointments->breed }}</span>
                            </div>

                            <div>
                                <strong>Services:</strong>
                                <span>{{ $appointments->service }}</span>
                            </div>

                            <div>
                                <strong>Total Price:</strong>
                                <span>${{ $appointments->total_price }}</span>
                            </div>
                            <button class="btn" onclick="openAddEquipmentModal({{ $appointments->id }})">ASSIGN</button>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <style>
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
        }

        .input-field {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .button {
            padding: 8px 16px;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
        }

        .button-blue {
            background: #007bff;
            color: white;
            border: none;
        }

        .button-red {
            background: #dc3545;
            color: white;
            border: none;
        }
        .btn{
            padding: .5rem .5rem;
            background-color: #4CAF50;
            border-radius: 10px;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .appointment-box {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 50%;
        }

        .appointment-details{
            padding: 10px;
            border-bottom: 1px solid #ddd;
            margin-bottom: 50px;
        }

        .appointment-details div {
            margin-bottom: 10px;
        }

        .appointment-details strong {
            font-weight: bold;
        }

        .no-appointment {
            text-align: center;
            color: #666;
        }
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .modal-content {
            background: #fff;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        .hidden {
            display: none;
        }
    </style>

    <script>
        function openAddEquipmentModal(appointmentId) {
            const modal = document.getElementById('add-equipment-modal');
            const appointmentIdInput = document.getElementById('appointment_id');
            
            // Set the value of the hidden input field
            appointmentIdInput.value = appointmentId;
            
            // Display the modal
            modal.classList.remove('hidden');
        }

        function closeAddEquipmentModal() {
            const modal = document.getElementById('add-equipment-modal');
            modal.classList.add('hidden');
        }

    </script>
</x-app-layout>
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