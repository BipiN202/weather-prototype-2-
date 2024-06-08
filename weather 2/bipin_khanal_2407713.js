//student name:Bipin Khanal
//student id :2407713
const apiKey = "868f28d7fefbd205413b8706cb04001c"; //holds api key
const apiUrl="https://api.openweathermap.org/data/2.5/weather";//holds api url

const searchBox = document.querySelector(".search input");
const searchBtn = document.querySelector(".search button");
const weatherIcon = document.querySelector(".weather-icon");
const back = document.querySelector(".backimg");
const forecastTableBody = document.getElementById("forecast-table-body");
//function for fetching weather data from api 
async function checkWeather(city){
    const response = await fetch(`${apiUrl}?q=${city}&units=metric&appid=${apiKey}`);
    var data = await response.json();
    const currentDate = new Date().toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
    });

    console.log(data);
    const { name } = data;
    
    document.querySelector(".date").textContent = currentDate;
    document.querySelector(".city").textContent = data.name;
    document.querySelector(".temp").textContent = Math.round(data.main.temp) +"°c";
    document.querySelector(".humidity").textContent = data.main.humidity + "%";
    document.querySelector(".wind").textContent = data.wind.speed + "km/h";
    document.querySelector(".pressure").textContent = data.main.pressure + " hPa";
    

    //change backround image accourging to city name using unsplash api
    const backgroundImageUrl = `https://source.unsplash.com/1600x900/?landscape,${city}`;
    document.body.style.backgroundImage = `url('${backgroundImageUrl}')`;

    //compares data of api to show required emoji 
    if (data.weather[0].main == "Clouds"){
        weatherIcon.src = "https://raw.githubusercontent.com/BipiN202/weather-api/main/images/clouds.png";
        document.querySelector(".weather-type").textContent = "Cloudy";
    }
    else if (data.weather[0].main == "Clear"){
        weatherIcon.src = "https://raw.githubusercontent.com/BipiN202/weather-api/main/images/clear.png";
        document.querySelector(".weather-type").textContent = "Clear";
    }
    else if (data.weather[0].main == "Rain") {
        weatherIcon.src = "https://raw.githubusercontent.com/BipiN202/weather-api/main/images/rain.png";
        document.querySelector(".weather-type").textContent = "Rainy";
    }

    
    else if (data.weather[0].main == "Drizzle"){
        weatherIcon.src = "https://raw.githubusercontent.com/BipiN202/weather-api/main/images/drizzle.png";
        document.querySelector(".weather-type").textContent = "Drizzle";
    }
    else if (data.weather[0].main == "Mist"){
        weatherIcon.src = "https://raw.githubusercontent.com/BipiN202/weather-api/main/images/mist.png";
        document.querySelector(".weather-type").textContent = "Misty";
    }
    document.querySelector(".weather").style.display = "block"
    
fetchForecast(city);
}



async function fetchForecast(city) {
    const forecastUrl = `https://api.openweathermap.org/data/2.5/forecast?q=${city}&units=metric&appid=${apiKey}`;
    const response = await fetch(forecastUrl);
    const forecastData = await response.json();

    console.log(forecastData);

    // Clear previous table rows
    forecastTableBody.innerHTML = "";

    // Get the current date and time
    const currentDate = new Date();

    // Populate the table with forecast data for the previous seven days
    for (let i = 0; i < forecastData.list.length; i++) {
        const forecast = forecastData.list[i];
        const forecastDate = new Date(forecast.dt * 1000);

        // Check if the forecast date is within the previous seven days
        if (forecastDate < currentDate && i % 8 === 0) {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${forecastDate.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                })}</td>
                <td>${Math.round(forecast.main.temp)}°C</td>
                <td>${forecast.weather[0].main}</td>
                <td>${forecast.main.humidity}%</td>
                <td>${forecast.wind.speed} km/h</td>
                <td>${forecast.main.pressure} hPa</td>
            `;

            forecastTableBody.appendChild(row);
        }
    }
}



window.addEventListener("load", () => {
const defaultCity = "Nandyal";
checkWeather(defaultCity);
fetchForecast(defaultCity); 
});
window.onload = function() {
    fetch("http://localhost/weather%202/main.php?city=Nandyal");
};

// Combine the click event listeners for the search button
searchBtn.addEventListener("click", () => {
  const city = searchBox.value;
  checkWeather(city);
  fetchForecast(city); 
});
