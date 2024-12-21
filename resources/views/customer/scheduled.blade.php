<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="container">
            <div class="appointment-box">
                @if ($appointment)
                    <div class="appointment-details">
                        <h3>Appointment Details</h3>

                        <div>
                            <strong>Pet Type:</strong>
                            <span>{{ $appointment->pet_type }}</span>
                        </div>

                        <div>
                            <strong>Breed:</strong>
                            <span>{{ $appointment->breed }}</span>
                        </div>

                        <div>
                            <strong>Services:</strong>
                            <span>{{ $appointment->service }}</span>
                        </div>

                        <div>
                            <strong>Total Price:</strong>
                            <span>${{ $appointment->total_price }}</span>
                        </div>

                        <div>
                            <strong>Status:</strong>
                            <span>{{ ucfirst($appointment->status) }}</span>
                        </div>

                        <div>
                            <strong>Room:</strong>
                            <span>{{ ucfirst($appointment->room) }}</span>
                        </div>

                        <div>
                            @if(is_null($appointment->date))
                                <strong>Date: </strong><span>Please wait</span>
                            @else
                                <strong>Date:</strong>
                                <span>{{ $appointment->date }}</span>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="no-appointment">
                        You don't have any scheduled appointments.
                    </div>
                @endif
            </div>
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

        .appointment-details h3 {
            text-align: center;
            font-size: 1.5em;
            margin-bottom: 20px;
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
    </style>
</x-app-layout>
