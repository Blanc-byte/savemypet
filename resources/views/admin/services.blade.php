<x-app-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <x-slot name="header">
        <h2 class="header-title">
            {{ __('Doctors') }}
        </h2>
    </x-slot> --}}

    <style>
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
        .table-container {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table-container th, .table-container td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .table-container th {
            background-color: #B2F5E1;
            font-weight: bold;
        }

        .table-container td.concern-cell {
            word-wrap: break-word;
            white-space: pre-wrap;
            width: 40%; 
        }

        .assign-button {
            background-color: #007BFF;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .assign-button:hover {
            background-color: #0056b3;
        }

        .header-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        
        .doctor-modal-content {
            background-color: #ffffff; 
            padding: 2rem;
            border-radius: 10px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            animation: fadeIn 0.4s ease-out;
        }
        .doctor-modal-content h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #333;
            text-align: center;
        }

        .doctor-modal-content input,
        .doctor-modal-content select {
            display: block;
            width: 100%;
            padding: 0.75rem;
            margin-top: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.3s;
        }

        .doctor-modal-content input:focus,
        .doctor-modal-content select:focus {
            border-color: #3490dc; 
            box-shadow: 0 0 5px rgba(52, 144, 220, 0.5);
        }

        .assign-button {
            background-color: #3490dc; 
            color: white;
            padding: 0.5rem 1.5rem;
            border: none;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .assign-button:hover {
            background-color: #2779bd; 
        }

        .assign-button4 {
            background-color: #ee2d2d; 
            color: white;
            padding: 0.5rem 1.5rem;
            border: none;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 5px;
        }

        .assign-button4:hover {
            background-color: #bd0802; 
        }

        .assign-button.cancel {
            background-color: #e3342f;
        }

        .assign-button.cancel:hover {
            background-color: #cc1f1a;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .modal-buttons .button{
            background-color: #3490dc; 
            color: white;
            padding: 0.5rem 1.5rem;
            border: none;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        #confirmation-modal{
            background-color: rgba(49, 49, 49, 0.534);
        }
        .confirmation-modal-content{
            background-color: rgb(255, 255, 255);
            border-radius: 10px;
            padding: 1.5rem 1.5rem;
        }
    </style>

    <div style="padding: 30px;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 style="font-size: 20px; font-weight: bold; margin-bottom: 20px;">List Of Services</h3>
                    
                    <button onclick="openAddDoctorModal()" class="assign-button" style="margin-bottom: 20px;">Add Service</button>

                    @if(empty($services))
                        <p>No Services found.</p>
                    @else
                    
                        <table class="table-container">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Pet Type</th>
                                    <th class="concern-cell">Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($services as $service)
                                    <tr>
                                        <td>{{ $service->id }}</td>
                                        <td>{{ $service->description }}</td>
                                        <td>{{ $service->price }}</td>
                                        <td>{{ $service->pet_type }}</td>
                                        <td class="concern-cell">{{ $service->status }}</td>
                                        <td>
                                            <button class="assign-button" onclick="openEditDoctorModal('{{ $service->id }}', '{{ $service->description }}', '{{ $service->price }}', '{{ $service->status }}', '{{ $service->pet_type }}')">Edit</button>
                                            <form action="{{ route('service.destroy', $service->id) }}" method="POST" id="delete-form-{{ $service->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="assign-button4 ab" onclick="event.preventDefault(); openConfirmationModal2(document.getElementById('delete-form-{{ $service->id }}'))">
                                                    DELETE
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
<div id="confirmation-modal" class="modal-overlay hidden">
    <div class="confirmation-modal-content">
        <h2 class="text-xl font-bold mb-4">Are you sure you want to remove this service?</h2>
        <div class="modal-buttons">
            <button type="button" onclick="closeConfirmationModal2()" class="button button-red">Cancel</button>
            <button id="confirm-delete-btn" type="button" class="button button-blue">Confirm</button>
        </div>
    </div>
</div>
    <!-- Edit Doctor Modal -->
<div id="edit-doctor-modal" class="modal-overlay hidden">
    <div class="modal-content">
        <h3>Edit Service</h3>
        
        <form id="edit-doctor-form">
            @csrf
            <div class="mb-4">
                <label for="doctor-name" class="block">Description</label>
                <input type="text" id="doctor-name" name="name" class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-4">
                <label for="doctor-price" class="block">Price</label>
                <input type="number" id="doctor-price" name="price" class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-4">
                <label for="doctor-type" class="block">Pet Type</label>
                <input type="text" id="doctor-type" name="type" class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-4">
                <label for="doctor-status" class="block">Status</label>
                <select id="doctor-status" name="status" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                    <option value="available">available</option>
                    <option value="unavailable">unavailable</option>
                </select>
            </div>
            <input type="hidden" id="doctor-id" name="doctor_id">
            <div class="flex justify-end">
                <button type="button" class="assign-button" onclick="closeEditDoctorModal()">Cancel</button>
                <button type="submit" class="assign-button ml-2" onclick="closeConfirmationModal()">Save Changes</button>
            </div>
        </form>
    </div>
</div>
<!-- Add Doctor Modal -->
<div id="add-doctor-modal" class="modal-overlay hidden">
    <div class="doctor-modal-content">
        <h3>Add Service</h3>
        <form action="{{ route('service.add') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="add-doctor-name" class="block">Description</label>
                <input type="text" id="add-doctor-name" name="name" class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-4">
                <label for="add-doctor-price" class="block">Price</label>
                <input type="number" id="add-doctor-price" name="price" class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-4">
                <label for="add-doctor-type" class="block">Pet Type</label>
                <input type="text" id="add-doctor-type" name="type" class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-4">
                <label for="add-doctor-status" class="block">Status</label>
                <select id="add-doctor-status" name="status" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                    <option value="available">available</option>
                    <option value="unavailable">unavailable</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button type="button" class="assign-button" onclick="closeAddDoctorModal()">Cancel</button>
                <button type="submit" class="assign-button ml-2">Add Service</button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>
<script>
    // Open the confirmation modal and set the form for deletion
    function openConfirmationModal2(form) {
        deleteForm = form;
        document.getElementById('confirmation-modal').classList.remove('hidden');
        document.getElementById('confirmation-modal').style.display = 'flex';
    }

    // Close the confirmation modal
    function closeConfirmationModal2() {
        document.getElementById('confirmation-modal').classList.add('hidden');
        document.getElementById('confirmation-modal').style.display = 'none';
    }

    // Confirm deletion
    document.getElementById('confirm-delete-btn').onclick = function() {
        if (deleteForm) {
            deleteForm.submit();
        }
        closeConfirmationModal();
    }
    function openAddDoctorModal() {
        document.getElementById('add-doctor-modal').classList.remove('hidden');
        document.getElementById('add-doctor-modal').style.display = 'flex';
    }

    function closeAddDoctorModal() {
        document.getElementById('add-doctor-modal').classList.add('hidden');
        document.getElementById('add-doctor-modal').style.display = 'none';
    }

    let appID = null;

    
    function openEditDoctorModal(doctorId, name, price, status, type) {
        appID = doctorId;
        
        document.getElementById('doctor-id').value = doctorId;
        document.getElementById('doctor-name').value = name;
        document.getElementById('doctor-price').value = price;
        document.getElementById('doctor-type').value = type;
        document.getElementById('doctor-status').value = status;

        
        document.getElementById('edit-doctor-modal').classList.remove('hidden');
        document.getElementById('edit-doctor-modal').style.display = 'flex';
    }


    function closeEditDoctorModal() {
        document.getElementById('edit-doctor-modal').classList.add('hidden');
        document.getElementById('edit-doctor-modal').style.display = 'none';
    }

    function closeConfirmationModal() {
        const doctorName = document.getElementById('doctor-name').value;
        const doctorPrice = document.getElementById('doctor-price').value;
        const doctorType = document.getElementById('doctor-type').value;
        const doctorStatus = document.getElementById('doctor-status').value;

        
        console.log('Doctor ID:', appID);
        console.log('Doctor Name:', doctorName);
        console.log('Doctor Price:', doctorPrice);
        console.log('Doctor Type:', doctorType);
        console.log('Status:', doctorStatus);

        fetch(`/update-service`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                doctor_id: appID,
                doctor_name: doctorName,
                doctor_price: doctorPrice,
                doctor_type: doctorType,
                doctor_status: doctorStatus
            })
        })
        .then(response => response.json())
        .then(data => {
            window.location.reload();
            console.log(data);
            closeEditDoctorModal();
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

</script>