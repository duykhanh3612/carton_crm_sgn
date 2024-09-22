<table>
    <tr>
        <td><b>Họ và Tên </b>:</td>
        <td> {{ $data['name'] }}</td>
    </tr>
    <tr>

    </tr>
    <tr>
        <td><b>Đơn vị</td></b>: </td>

        <td>{{ $data['organization'] }}</td>
    </tr>
    <tr>
        <td><b>Địa chỉ</td></b>: </td>

        <td>{{ $data['address'] }}</td>
    </tr>
    <tr>
        <td><b>Số điện thoại</b>: </td>

        <td>{{ $data['phone'] }}</td>
    </tr>
    <tr>
        <td><b>Email</td></b>: </td>

        <td>{{ $data['email'] }}</td>
    </tr>
    <tr>
        <td><b>Tin nhắn</b></td>
    </tr>
    <tr>
        <td> {{ $data['message'] }}</td>
    </tr>
</table>
