<div>
<div class="relative mb-6 w-full">
  <h1 class="text-2xl font-bold">Create Students</h1>
  <p class="text-lg text-gray-600 mb-4">create student form</p>
  <hr class="border-gray-200" />
</div>

<div class="flex justify-start mb-4">
 <a href="{{route('student.index')}}" class="bg-green-500 text-white font-semibold px-2 py-2 rounded hover:bg-green-600 cursor-pointer">
    Back
</a>
</div>
<form wire:submit="submit" class="mt-6 space-y-6">
<flux:input wire:model="name" label="name" placeholder="Name" />
<flux:input wire:model="dob" label="dob" type="date" max="2999-12-31" label="Date" />
<flux:radio.group wire:model="gender" label="Select your Gender">
    <flux:radio value="1" label="Male" checked />
    <flux:radio value="2" label="Female" />
    <flux:radio value="other" label="Other" />
</flux:radio.group>
<flux:input wire:model="nrc" label="nrc" type="text" placeholder="NRC No." />
<flux:input wire:model="phone" label="phone" type="tel" placeholder="Phone No." />
<flux:input wire:model="email" label="email" type="email" placeholder="Email" />
<flux:input wire:model="address" label="address" type="text" placeholder="Address" />
<flux:button type="submit" variant="primary">Submit</flux:button>

</form>

</div>

