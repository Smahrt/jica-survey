<!DOCTYPE html>
<html>
    <head>
    <title>View-response</title>
    </head>
    
    <body>
        <table>
            <thead>
                <td>Phone Number</td>
            </thead>
            
            <tbody>
                @foreach($num_query as $num)
                    <tr>
                        <td>{{$num->session_sid}}</td>
                    </tr>
                
                @endforeach
            </tbody>
        </table>
    </body>


</html>