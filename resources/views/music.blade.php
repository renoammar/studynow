<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Music Playlist</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{asset('style/music.css')}}">
</head>
<body>
  <x-wrapper>
  <div class="container playlist-container">
    <h2 class="playlist-title">Music Playlist For Study</h2>

    <div class="spotify-tracks">
      <!-- First Track -->
      <div class="spotify-embed">
        <iframe 
          src="https://open.spotify.com/embed/track/4Lx7mjMqpeNAe3jb58QzPh" 
          width="100%" 
          height="80" 
          frameborder="0" 
          allowtransparency="true" 
          allow="encrypted-media"
          loading="lazy">
        </iframe>
      </div>

      <!-- Second Track -->
      <div class="spotify-embed">
        <iframe 
          src="https://open.spotify.com/embed/track/78pATVtCPzSFJXHO5j0k4U" 
          width="100%" 
          height="80" 
          frameborder="0" 
          allowtransparency="true" 
          allow="encrypted-media"
          loading="lazy">
        </iframe>
      </div>

      <!-- Third Track -->
      <div class="spotify-embed">
        <iframe 
          src="https://open.spotify.com/embed/track/2KbDWTdcBWAk3lSXadhemv" 
          width="100%" 
          height="80" 
          frameborder="0" 
          allowtransparency="true" 
          allow="encrypted-media"
          loading="lazy">
        </iframe>
      </div>

      <!-- Fourth Track -->
      <div class="spotify-embed">
        <iframe 
          src="https://open.spotify.com/embed/track/6h0Ot63iDprbarV3qq6H0P" 
          width="100%" 
          height="80" 
          frameborder="0" 
          allowtransparency="true" 
          allow="encrypted-media"
          loading="lazy">
        </iframe>
      </div>

      <!-- Fifth Track -->
      <div class="spotify-embed">
        <iframe 
          src="https://open.spotify.com/embed/track/0clvKlDlGGxBqy0Xsb384V" 
          width="100%" 
          height="80" 
          frameborder="0" 
          allowtransparency="true" 
          allow="encrypted-media"
          loading="lazy">
        </iframe>
      </div>
    </div>
  </div>
</x-wrapper>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
