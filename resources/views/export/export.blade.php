<table>
    <thead>
    <tr>
        <th>title</th>
        <th>content</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $row)
        <tr>
            <td>{{ $row->title }}</td>
            <td>{{ $row->content }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
