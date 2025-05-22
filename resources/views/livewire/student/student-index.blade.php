<div>
<div class="relative mb-6 w-full">
  <h1 class="text-2xl font-bold">Students</h1>
  <p class="text-lg text-gray-600 mb-4">Manage all your students</p>
  <hr class="border-gray-200" />
</div>

<div class="flex justify-start mb-4">
 <a href="{{route('student.create')}}" class="bg-green-500 text-white font-semibold px-2 py-2 rounded hover:bg-green-600 cursor-pointer">
    Create User
</a>
</div>
@if (session()->has('success'))
<div class="alert alert-success d-flex align-items-center" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
        <use xlink:href="#check-circle-fill"/>
    </svg>
    <span class="font-medium">
        {{ session('success') }}
    </span>
</div>
@endif


  
 
<div class="overflow-x-auto">
  <table class="min-w-full bg-white border border-gray-200">
    <thead>
      <tr class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
       
        <th class="px-4 py-2">Name</th>
        <th class="px-4 py-2">DOB</th>
        <th class="px-4 py-2">Gender</th>
        <th class="px-4 py-2">NRC</th>
        <th class="px-4 py-2">Phone</th>
        <th class="px-4 py-2">Email</th>
        <th class="px-4 py-2">Address</th>
        <th class="px-4 py-2">Action</th>
      </tr>
    </thead>
    @foreach ($students as $student)
    <tbody class="text-sm text-gray-700">
      <tr class="border-t">
        
        <td class="px-4 py-2">{{$student->name}}</td>
        <td class="px-4 py-2">{{$student->dob}}</td>
        <td class="px-4 py-2">@if ($student->gender == 1)
          <span class="text">Male</span>
          @elseif ($student->gender == 2)
          <span class="text">Female</span>
        @endif</td>
        <td class="px-4 py-2">{{$student->nrc}}</td>
        <td class="px-4 py-2">{{$student->phone}}</td>
        <td class="px-4 py-2">{{$student->email}}</td>
        <td class="px-4 py-2">{{$student->address}}</td>
        <td class="px-4 py-2 space-x-2">
          <a href="{{route('student.edit',$student->id)}}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600"><x-far-edit /></a>
          <button wire:click="delete({{$student->id}})" wire:confirm="Are you sure you want to delete" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
        </td>
      </tr>
      @endforeach
      <!-- More student rows can be added here -->
    </tbody>
  </table>
</div>

</div>

