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

<div class="overflow-x-auto">
  <table class="min-w-full bg-white border border-gray-200">
    <thead>
      <tr class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
        <th class="px-4 py-2">Name</th>
        <th class="px-4 py-2">Date of Birth</th>
        <th class="px-4 py-2">Gender</th>
        <th class="px-4 py-2">NRC</th>
        <th class="px-4 py-2">Phone</th>
        <th class="px-4 py-2">Email</th>
        <th class="px-4 py-2">Address</th>
        <th class="px-4 py-2">Actions</th>
      </tr>
    </thead>
    <tbody class="text-sm text-gray-700">
      <tr class="border-t">
        <td class="px-4 py-2">John Doe</td>
        <td class="px-4 py-2">2000-01-01</td>
        <td class="px-4 py-2">Male</td>
        <td class="px-4 py-2">12/MaYa(N)123456</td>
        <td class="px-4 py-2">09123456789</td>
        <td class="px-4 py-2">john@example.com</td>
        <td class="px-4 py-2">Yangon</td>
        <td class="px-4 py-2 space-x-2">
          <a href="#" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Edit</a>
          <a href="#" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</a>
        </td>
      </tr>
      <!-- More student rows can be added here -->
    </tbody>
  </table>
</div>

</div>

