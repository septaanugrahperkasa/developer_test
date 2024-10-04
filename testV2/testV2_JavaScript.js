(async () => {
    const fetch = (await import('node-fetch')).default;

    const API_KEY = '97009df79eb620c9b031039b48bbb92c'; // Ganti dengan API key Anda dari OpenWeatherMap
    const CITY = 'Jakarta';
    const URL = `http://api.openweathermap.org/data/2.5/forecast?q=${CITY}&units=metric&appid=${API_KEY}`;

    async function getWeatherForecast() {
        try {
            const response = await fetch(URL);
            const data = await response.json();

            if (data.cod !== '200') {
                console.error('Error fetching weather data:', data.message);
                return;
            }

            const forecast = data.list.filter((reading) => reading.dt_txt.includes('12:00:00'));
            console.log(`5-Day Weather Forecast for ${CITY}:`);
            forecast.forEach((day) => {
                const date = new Date(day.dt_txt).toLocaleDateString('en-GB', {
                    weekday: 'long',
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                });
                console.log(`${date}: ${day.main.temp}°C`);
            });
        } catch (error) {
            console.error('Error:', error);
        }
    }

    getWeatherForecast();
})();
