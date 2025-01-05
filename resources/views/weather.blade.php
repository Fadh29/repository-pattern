@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Ramalan Cuaca</h1>
        <form action="{{ route('weather.check') }}" method="GET">
            <div class="form-group">
                <label for="city">Masukkan Nama Kota:</label>
                <input type="text" name="city" id="city" class="form-control" placeholder="Contoh: Jakarta" required>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Cek Cuaca</button>
        </form>

        @if (isset($weatherData))
            <h2 class="mt-4">Ramalan Cuaca untuk {{ $city }}:</h2>
            <ul>
                @foreach ($weatherData['list'] as $forecast)
                    <li>
                        <strong>{{ \Carbon\Carbon::parse($forecast['dt_txt'])->format('d M Y, H:i') }}</strong> -
                        {{ $forecast['main']['temp'] }}°C, {{ $forecast['weather'][0]['description'] }}
                    </li>
                @endforeach
            </ul>
        @elseif(isset($error))
            <div class="alert alert-danger mt-4">{{ $error }}</div>
        @endif
    </div>
@endsection
