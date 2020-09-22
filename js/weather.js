$(function(){
    $('.weather_closebtn').click(function (){
        $('.weather').addClass('hidden')
    });
});

//htmlのul要素（id = 'messages'）を呼び出し
let todayWeather = $('.today-weather');
let weatherIcon = $('.weather-icon');
let weatherTemperature = $('.weather-temperature');

//openweathermap（天気予報API）に接続
let request = new XMLHttpRequest();
let cityName = "mito";
let owmApiKey = "8cd1fe53f573775ecc284f741890a0b3";
let owmURL = "http://api.openweathermap.org/data/2.5/weather?q="+ cityName +"&APPID="+ owmApiKey +"";

request.open('GET', owmURL, true);
//結果をjson型で受け取る
request.responseType = 'json';

request.onload = function () {
 let data = this.response;
 console.log(data);
//  天気
 let weather=data["weather"][0]["main"]
 switch(weather){
    case 'Rain':
        weather="雨";
        break;
    case 'Clouds':
        weather="くもり";
        break;
    case 'Clear':
        weather="晴れ";
        break;
    case 'Thunderstorm':
        weather="雷雨";
        break;
    case 'Drizzle':
        weather="霧雨";
        break;
    case 'Snow':
        weather="雪";
        break;
    case 'Mist':
    case 'Smoke':
    case 'Haze':
    case 'Dust':
    case 'Fog':
    case 'Sand':
    case 'Dust':
    case 'Ash':
    case 'Squall':
    case 'Tornado':
        weather='霧'
        break;
 }
 let todatElement = $('<p class="today-weather_text">' + weather+ "</p>");
 todayWeather.append(todatElement);
//  アイコン
 let iconcode = data["weather"][0]["icon"]
 let iconurl = "http://openweathermap.org/img/w/" + iconcode + ".png";
 $('#wicon').attr('src', iconurl);
//  気温
 let temperature = data['main']['temp']-273.15
 temperature  = Math.round(temperature)
 console.log(temperature)
 temperatureElement = $('<p class="weather-temperature_text">'+ temperature+ "℃"+"</p>");
weatherTemperature.append(temperatureElement);
// 日付
let date=data["dt"]
console.log(date)
};

request.send();