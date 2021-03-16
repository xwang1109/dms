<tbody>
    @foreach($users as $user)
    <tr>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">{{ $user->email }}</div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">{{ $user->name }}</div>
        </td>
        
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">{{ $user->team }}</div>
        </td>

        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
            <a href="{{ url('/teams/assign_team/'.$user->id )}}" class="text-indigo-600 hover:text-indigo-900">Assign Team</a>
        </td>

        
    </tr>
    @endforeach
</tbody>