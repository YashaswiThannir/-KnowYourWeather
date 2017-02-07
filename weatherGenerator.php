<?php
    $forecast = "";
    $errorMessage="";
    if (array_key_exists('city', $_GET)){
         $cityName =  str_replace(' ', '', $_GET['city']);
        $file_headers = @get_headers("http://www.weather-forecast.com/locations/".$cityName."/forecasts/latest");
        if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
           $errorMessage = "Sorry! This city could not be found.";
        }
        else {
    $presentationPage = file_get_contents("http://www.weather-forecast.com/locations/".$cityName."/forecasts/latest");

    $explodeArray1 = explode('3 Day Weather Forecast Summary:</b><span class="read-more-small"><span class="read-more-content"> <span class="phrase">', $presentationPage);
            if(sizeof($explodeArray1) > 1){
                $explodeArray2 = explode('</span></span></span>',$explodeArray1[1]);
                if(sizeof($explodeArray2)>1){
                   $forecast = $explodeArray2[0];  
                }else{
                     $errorMessage = "Sorry! This city could not be found.";
                    }
                }else{
                $errorMessage = "Sorry! This city could not be found.";
                }
    }
    }
?>
 <!DOCTYPE html>
<html>
    <head>
        <title> #KnowYourWeather </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <style>
            #city{
                width: 40%;
            }
            body{
                width: 100%;
                height: 100%;
                text-align: center;
                position:relative;
                top: 50px;
                background-image: url("weather1.jpg");
            }
            #forecast{
                margin: 10px;
            }
           
        </style>
    </head>
    <body>
        <div class="container">
            <form>
                <div> <h1><strong> #KnowYourWeather </strong></h1></div>
                <div> <p> Enter the name of your city </p></div>
            <div class="form-group">
        <label for="city"></label>
        <input type="text" id="city" name="city" placeholder="Eg. San Jose" autofocus="autofocus" value=" <?php if  (array_key_exists('city', $_GET)!=""){ echo $_GET['city']; }    ?> " > 
        </div>
             <button type="submit" class="btn btn-primary">Submit</button>
            <div id="forecast">
                <?php 
                    if($forecast){
                        echo '<div class="alert alert-success" role="alert">'
.$forecast. '</div>';
                    }else if($errorMessage){
                         echo '<div class="alert alert-danger" role="alert">'
.$errorMessage. '</div>';
                    }
                ?>
            </div>
            </form>
        </div>
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    </body>
</html>
