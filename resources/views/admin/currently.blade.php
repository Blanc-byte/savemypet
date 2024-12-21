<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

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
                            {{-- onclick="openAddEquipmentModal({{ $appointments->id }})" --}}
                            <button class="btn" onclick="handleCheck({{ $appointments->id }})">DONE</button>
                            <button class="btnn" onclick="handleCancel({{ $appointments->id }})">CANCEL</button>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .btn{
            padding: .5rem .5rem;
            background-color: #4CAF50;
            border-radius: 10px;
        }
        .btnn{
            margin-left: 5px;
            padding: .5rem .5rem;
            background-color: #e22323;
            border-radius: 10px;
        }

        .appointment-box {
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 50%;
            
            background-color: white;
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

        .appointment-details strong {
            font-weight: bold;
        }

        .no-appointment {
            text-align: center;
            color: #666;
        }
    </style>
</x-app-layout>

<script>
    function handleCheck(id) {
        fetch(`/update-appointment-toDone`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                appointment_id: id,
            })
        })
        .then(response => response.json())
        .then(data => {
            window.location.reload();
            console.log(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function handleCancel(id) {
        fetch(`/update-appointment-toCanceled`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                appointment_id: id,
            })
        })
        .then(response => response.json())
        .then(data => {
            window.location.reload();
            console.log(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>