<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Be+Vietnam+Pro:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic);
        *{
            font-family: 'Be Vietnam Pro'
        }
    </style>
</head>
<body>
    <livewire:dashboard />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        let waktu = new Date();
        let jam = waktu.getHours();
        let menit = waktu.getMinutes();
        let detik = waktu.getSeconds();

        updateTime()

        $(function() {
            setInterval(updateTime, 900);
        });

        function updateTime() {
            if (jam >= 5 && jam < 10) {
                $('#salam').html('Selamat Pagi, ');
            } else if (jam >= 10 && jam < 15) {
                $('#salam').html('Selamat Siang, ');
            } else if (jam >= 15 && jam < 18) {
                $('#salam').html('Selamat Sore, ');
            } else {
                $('#salam').html('Selamat Malam, ');
            }
        }


        function checkTime(i) {
            if (i < 10) {
                i = "0" + i;
            }
            return i;
        }

        function startTime() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            // add a zero in front of numbers<10
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('waktu').innerHTML = h + ":" + m + ":" + s;
            t = setTimeout(function() {
                startTime()
            }, 500);
        }
        startTime();
    </script>
</body>
</html>