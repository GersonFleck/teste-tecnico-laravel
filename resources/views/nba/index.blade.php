<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogadores NBA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .player-card {
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .player-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .highlighted {
            border: 3px solid #ffc107;
            box-shadow: 0 0 15px rgba(255, 193, 7, 0.5);
        }
        #playerHighlight {
            transition: all 0.3s ease;
            border-bottom: 2px solid #ffc107;
        }
    </style>
</head>
<body>
    <header class="bg-dark text-white sticky-top shadow">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark container">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center" href="#">
                    <img src="{{ asset('images/logo.png') }}" 
                         alt="NBA Logo" 
                         width="40" 
                         height="40" 
                         class="d-inline-block align-top me-2">
                    <span class="fw-bold">NBA Stats</span>
                </a>
            </div>
        </nav>
    </header>
    
    <div id="playerHighlight" class="container-fluid bg-light py-3 shadow-sm mb-4" style="display: none;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-2 text-center">
                    <div class="mt-2">
                        <span class="badge bg-primary">#<span id="highlightJersey">00</span></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4 class="mb-1"><span id="highlightName"></span></h4>
                    <div class="d-flex flex-wrap gap-3">
                        <div><i class="bi bi-person-badge"></i> <span id="highlightPosition"></span></div>
                        <div><i class="bi bi-rulers"></i> <span id="highlightHeight"></span>, <span id="highlightWeight"></span></div>
                        <div><i class="bi bi-flag"></i> <span id="highlightCountry"></span></div>
                        <div><i class="bi bi-mortarboard"></i> <span id="highlightCollege"></span></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-white">
                        <div class="card-body p-2">
                            <h6 class="card-title mb-1"><i class="bi bi-people"></i> Time</h6>
                            <p class="mb-0" id="highlightTeam"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        @foreach($players as $player)
        <div class="card mb-3 player-card" 
             onclick="showPlayerDetails({
                 first_name: '{{ $player['first_name'] }}',
                 last_name: '{{ $player['last_name'] }}',
                 position: '{{ $player['position'] }}',
                 height: '{{ $player['height'] }}',
                 weight: '{{ $player['weight'] }}',
                 jersey_number: '{{ $player['jersey_number'] }}',
                 college: '{{ $player['college'] }}',
                 country: '{{ $player['country'] }}',
                 team: '{{ $player['team']['full_name'] ?? 'Sem time' }}'
             })">
            <div class="card-header bg-primary text-white d-flex justify-content-between">
                <span>{{ $player['first_name'] }} {{ $player['last_name'] }}</span>
                <span class="badge bg-light text-dark">#{{ $player['jersey_number'] ?? '00' }}</span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <p><strong>Time:</strong> {{ $player['team']['full_name'] ?? 'Sem time' }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Posição:</strong> {{ $player['position'] ?? 'Sem posição' }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Altura/Peso:</strong> {{ $player['height'] ?? 'N/A' }}, {{ $player['weight'] ?? 'N/A' }} lbs</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <script>

        function showPlayerDetails(player) {
    window.scrollTo({
        top: 0,
        behavior: 'auto'
    });
    
}
    function showPlayerDetails(player) {
        document.getElementById('highlightName').textContent = `${player.first_name} ${player.last_name}`;
        document.getElementById('highlightPosition').textContent = player.position;
        document.getElementById('highlightHeight').textContent = player.height;
        document.getElementById('highlightWeight').textContent = `${player.weight} lbs`;
        document.getElementById('highlightJersey').textContent = player.jersey_number;
        document.getElementById('highlightCountry').textContent = player.country;
        document.getElementById('highlightCollege').textContent = player.college;
        document.getElementById('highlightTeam').textContent = player.team;
        
        document.getElementById('playerHighlight').style.display = 'block';
        
        document.getElementById('playerHighlight').scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
        
        event.currentTarget.classList.add('highlighted');
    }
    </script>
    <script>
document.addEventListener('click', function(e) {
    const card = e.target.closest('.player-card');
    if (!card) return;
    
    document.querySelectorAll('.player-card').forEach(c => {
        c.classList.remove('highlighted');
    });
    
    card.classList.add('highlighted');
});
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>