

<tbody>
    @foreach($documents as $document)
    <tr>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">{{ $document->file_name }}</div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">{{ $document->created_at }}</div>
        </td>
        
        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
            <a href="{{ url('/download/'.$document->id )}}" class="text-indigo-600 hover:text-indigo-900">Download</a>
        </td>

        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
            <a href="{{ url('/delete/'.$document->id )}}" class="text-red-500	 hover:text-red-900">Delete</a>
        </td>
    </tr>
    @endforeach
</tbody>