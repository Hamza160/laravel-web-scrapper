<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Data Scrapper</title>
</head>
<body>
    <div class="container text-center" style="margin: 50px auto; justify-content:center !important">
        <h1>Processor <span class="processor"></span></h1>
        <h1>Totla Inserted Records <span class="Records"></span></h1>
        <h1>Errors <span class="Errors"></span></h1>
        <button class="btn btn-primary btn-lg ready">Yup! So Ready To Scrap Data</button>
        <table class="inserted-urls table-bordered table-striped table-hover w-100 mt-3 table-sm">
            <thead>
                <tr>
                    <th width="10%">ID</th>
                    <th width="90%">URL</th>
                </tr>
            </thead>
            <tbody class="tbody"></tbody>
        </table>
    </div>
 <script>
    $(document).ready(function(){
        // 2920
        // 574
        // 331
        var i = 135;
        var error = 0;
        let RequestTime = 6000;

        $('.ready').click(function() {
            var interval = setInterval(() => {
                    $('.Records').html(i);
                    scrapeData(`https://www.propertyfinder.ae/en/commercial-rent/properties-for-rent.html?page=${i}`);
                    if(i == 331){
                        clearInterval(interval);
                    }
            }, RequestTime);
        });



        function scrapeData(url){
            $.ajax({
                url:"{{ route('post-property-scraper') }}",
                data:{url, _token: "{{ csrf_token() }}"},
                method:"POST",
                beforeSend:function(){
                    $('.processor').html('wait....');
                    RequestTime = 0;
                },
                success:function(res){
                    if(res == 'true'){
                        // getInsertedURLS();
                        $('.processor').html('Completed');
                        // RequestTime = 3000;
                        i++;
                    }
                },error:function(xhr){
                    console.log(xhr.responseText);
                    error++;
                    i--;
                    $('.Errors').html(error)
                }
            });
        }


        function getInsertedURLS(){
            $.ajax({
                url:"{{ route('get-latest-property-scraper') }}",
                method:"GET",
                success:function(res){
                    $('.tbody').append(res);
                },error:function(xhr){
                    console.log(xhr.responseText);
                }
            });
        }

    });
</script>
</body>
</html>
