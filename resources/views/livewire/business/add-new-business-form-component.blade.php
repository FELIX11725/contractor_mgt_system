<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <x-section-title>
        <x-slot name="title">Add New Business</x-slot>
        <x-slot name="description">Create a new business</x-slot>
    </x-section-title>

    <x-form-section submit="createBusiness">
        <x-slot name="title">
            Business Details
        </x-slot>

        <x-slot name="description">
            Create a new business
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6">
                <x-section-title>
                    <x-slot name="title">Business Profile</x-slot>
                    <x-slot name="description">Information of the business</x-slot>
                </x-section-title>
            </div>

            <div class="col-span-3">
               <label>Name</label>
               <input type="text">
            </div>

            <div class="col-span-3">
                <label>Email</label>
                <input type="text">
             </div>

             <x-section-border />

             <div class="col-span-6">
                <x-section-title>
                    <x-slot name="title">Staff Profile</x-slot>
                    <x-slot name="description">Information of the a staff member of the business</x-slot>
                </x-section-title>
            </div>

            <label>Name</label>
            <input type="text">
         </div>

         <div class="col-span-3">
             <label>Email</label>
             <input type="text">
          </div>

        </x-slot>

        <x-slot name="actions">
            <x-button type="submit">
                Save
            </x-button>
        </x-slot>

    </x-form-section>
</div>
