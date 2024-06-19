<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width,
initial-scale=1.0">
    <title>Selamat Datang</title>
    <style>
        body {
            background-color: #ddd;
        }

        table {
            width: 90%;
            margin: auto;
            max-width: 800px;
            background-color: #fff;
            border: 1px solid #aaa;
            border-radius: 10px;
            font-family: arial;
            padding: 20px;
        }

        h1 {
            margin-top: 0px;
        }
    </style>
</head>

<body>
    <table cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td>
                <h1>Selamat Datang {{ $orderBuyerName }}</h1>
                <p>Anda kini adalah ahli dalam Mart4U dengan alamat emel: {{ $orderEmail }}.</p>
            </td>
        </tr>
    </table>
</body>

</html>