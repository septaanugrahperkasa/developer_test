import requests
from datetime import datetime

API_KEY = '97009df79eb620c9b031039b48bbb92c'  # Ganti dengan API key Anda dari OpenWeatherMap
CITY = 'Jakarta'
URL = f'http://api.openweathermap.org/data/2.5/forecast?q={CITY}&units=metric&appid={API_KEY}'

def get_weather_forecast():
    try:
        response = requests.get(URL)
        data = response.json()

        if data['cod'] != '200':
            print('Error fetching weather data:', data['message'])
            return

        forecast = [reading for reading in data['list'] if '12:00:00' in reading['dt_txt']]
        print(f"5-Day Weather Forecast for {CITY}:")

        for day in forecast:
            date = datetime.strptime(day['dt_txt'], '%Y-%m-%d %H:%M:%S').strftime('%A, %d %b %Y')
            temp = day['main']['temp']
            print(f"{date}: {temp}°C")
    
    except Exception as e:
        print('Error:', str(e))

get_weather_forecast()
