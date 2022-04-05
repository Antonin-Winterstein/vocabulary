@extends("layouts.master")

@section("content")
@inject('provider', 'App\Http\Controllers\WordController')

  <h1 class="mb-4">Home</h1>
  <div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h2 class="m-0 h4">Latest words added</h2>
        </div>
        <div class="card-body">
          @php
            $words = $provider::getLastNWords(9);
          @endphp
          @if($words->isNotEmpty())
          <div id="carouselRecentWords" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselRecentWords" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselRecentWords" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselRecentWords" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
            @php
                $i = 0;
            @endphp
            @foreach($words as $word)

              @if ($i == 0)
              <div class="carousel-item active">
                <div class="row">

              @elseif ($i == 3 || $i == 6)
              <div class="carousel-item">
                <div class="row">

              @endif

              <div class="col-md-4">
                <div class="card mb-2">
                  <div class="card-header">Created at	{{ date("m/d/Y - H:i", strtotime($word->created_at)) }}
                  @if($word->category == "noun")
                    <span class="badge bg-primary">{{ $word->category }}</span>
                  @elseif ($word->category == "verb")
                    <span class="badge bg-info">{{ $word->category }}</span>
                  @elseif ($word->category == "adjective")
                    <span class="badge bg-success">{{ $word->category }}</span>
                  @elseif ($word->category == "adverb")
                    <span class="badge bg-warning">{{ $word->category }}</span>
                  @elseif ($word->category == "other")
                    <span class="badge bg-secondary">{{ $word->category }}</span>
                  @else
                    <span class="badge bg-primary">{{ $word->category }}</span>
                  @endif
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>English:</b> {{ $word->english }}</li>
                    <li class="list-group-item"><b>French:</b> {{ $word->french }}</li>
                    <li class="list-group-item"><b>Korean:</b> {{ $word->korean }}</li>
                  </ul>
                  <div class="card-footer">
                    <small class="text-muted">Updated {{ time_elapsed_string($word->updated_at) }}</small>
                  </div>
                </div>
              </div>

              @if ($i == 2)
                </div>
              </div>

              @elseif ($i == 5 || $i == 8)
                </div>
              </div>

              @endif

              @php
                $i = $i + 1;
              @endphp
            @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselRecentWords" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselRecentWords" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
          @else
          <div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
            <i class="fa-solid fa-triangle-exclamation"></i>&nbsp;
            <b>Warning:</b> No words found in database, please add at least one in the "Vocabulary List" page.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h2 class="m-0 h4">Random word</h2>
        </div>
        <div class="card-body">
          <a href="{{ route('index') }}" type="button" class="btn btn-primary mb-3">Generate</a>
          <div class="card mb-2">
            @php
              $randomWord = $provider::getRandomWord();
            @endphp
            <div class="card-header">Created at	{{ date("m/d/Y - H:i", strtotime($randomWord->created_at)) }}
            @if($randomWord->category == "noun")
              <span class="badge bg-primary">{{ $randomWord->category }}</span>
            @elseif ($randomWord->category == "verb")
              <span class="badge bg-info">{{ $randomWord->category }}</span>
            @elseif ($randomWord->category == "adjective")
              <span class="badge bg-success">{{ $randomWord->category }}</span>
            @elseif ($randomWord->category == "adverb")
              <span class="badge bg-warning">{{ $randomWord->category }}</span>
            @elseif ($randomWord->category == "other")
              <span class="badge bg-secondary">{{ $randomWord->category }}</span>
            @else
              <span class="badge bg-primary">{{ $randomWord->category }}</span>
            @endif
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><b>English:</b> {{ $randomWord->english }}</li>
              <li class="list-group-item"><b>French:</b> {{ $randomWord->french }}</li>
              <li class="list-group-item"><b>Korean:</b> {{ $randomWord->korean }}</li>
            </ul>
            <div class="card-footer">
              <small class="text-muted">Updated {{ time_elapsed_string($randomWord->updated_at) }}</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  @php
  function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
  }
  @endphp

@endsection