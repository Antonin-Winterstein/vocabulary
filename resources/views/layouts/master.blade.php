<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vocabulary List</title>
  <style>
			@import url("https://fonts.googleapis.com/css2?family=Courier+Prime:wght@400;700&family=Noto+Sans+KR:wght@400;700&display=swap");
	</style>
  <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
  <header>
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
      <div class="container-fluid">
        <a href="{{ route('index') }}" class="navbar-brand"><i class="fa-solid fa-house-chimney"></i></a>
        <a href="{{ route('words') }}" class="btn btn-dark">Vocabulary List</a>
      </div>
    </nav>
  </header>
  
  <main class="container">

    @yield("content")
  </main>
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script>
        // Update modal with the word selected
        $(document).on('click', '.edit', function(){
            var _this = $(this).parents('tr');
            $('#id').val(_this.find('.id').text());
            $('#updateEnglish').val(_this.find('.english').text());
            $('#updateFrench').val(_this.find('.french').text());
            $('#updateKorean').val(_this.find('.korean').text());

            if (_this.find('.category').text() == "noun") {
              $('#updateNoun').prop("checked", true);
            }
            if (_this.find('.category').text() == "verb") {
              $('#updateVerb').prop("checked", true);
            }
            if (_this.find('.category').text() == "adjective") {
              $('#updateAdjective').prop("checked", true);
            }
            if (_this.find('.category').text() == "adverb") {
              $('#updateAdverb').prop("checked", true);
            }
            if (_this.find('.category').text() == "other") {
              $('#updateOther').prop("checked", true);
            }
        });
    </script>

</body>
</html>