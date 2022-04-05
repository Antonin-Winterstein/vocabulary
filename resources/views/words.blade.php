@extends("layouts.master")

@section("content")

  <h1 class="mb-4">Vocabulary List</h1>
  <div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h2 class="m-0 h4">Data</h2>
        </div>
        <div class="card-body">
          <div class="accordion col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4" id="accordionFilters">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingFilters">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters">
                  <b>FILTERS</b>
                </button>
              </h2>
              <div id="collapseFilters" class="accordion-collapse collapse" aria-labelledby="headingFilters" data-bs-parent="#accordionFilters">
                <div class="accordion-body">

                  <form action="{{ route('words.filters') }}" method="GET" autocomplete="off">
                    <div class="mb-3">
                      <label class="form-label" for="wordsFilter">
                        Sorting:
                      </label>
                      <select class="form-select" name="wordsFilter" id="wordsFilter" aria-label="Words filter">
                        <option selected value="latestWords">Latest words</option>
                        <option value="oldestWords">Oldest words</option>
                        <option value="randomWords">Random words</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">
                          Category:
                      </label>
                      <div class="form-check">  
                        <input class="form-check-input" type="checkbox" name="getNounsCheckbox" id="getNounsCheckbox" value="noun">
                        <label class="form-check-label" for="getNounsCheckbox">
                          Nouns
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="getVerbsCheckbox" id="getVerbsCheckbox" value="verb">
                        <label class="form-check-label" for="getVerbsCheckbox">
                          Verbs
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="getAdjectivesCheckbox" id="getAdjectivesCheckbox" value="adjective">
                        <label class="form-check-label" for="getAdjectivesCheckbox">
                          Adjectives
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="getAdverbsCheckbox" id="getAdverbsCheckbox" value="adverb">
                        <label class="form-check-label" for="getAdverbsCheckbox">
                          Adverbs
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="getOthersCheckbox" id="getOthersCheckbox" value="other">
                        <label class="form-check-label" for="getOthersCheckbox">
                          Others
                        </label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="accordion col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="accordionVocabulary">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingVocabulary">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseVocabulary" aria-expanded="true" aria-controls="collapseVocabulary">
                  <b>VOCABULARY</b>
                </button>
              </h2>
              <div id="collapseVocabulary" class="accordion-collapse collapse show" aria-labelledby="headingVocabulary" data-bs-parent="#accordionVocabulary">
                <div class="accordion-body">
                  <div class="row mb-4">
                    <form class="col-9 col-sm-5 col-md-5 col-lg-5 col-xl-4" action="{{ route('words.search') }}" method="GET" autocomplete="off">
                      <div class="p-1 bg-light rounded rounded-pill shadow-sm">
                          <div class="input-group">
                            <input type="text" name="search" placeholder="Search" class="form-control border-0 bg-light" required>
                            <div class="input-group-append">
                              <button type="submit" class="btn btn-link text-primary"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                    </form>
                    <a href="{{ route('words') }}" type="button" class="resetButton btn btn-link col-3 col-sm-1 col-md-1 col-lg-1 col-xl-1">Reset</a>
                    <!-- Button trigger create modal -->
                    <div class="createWordButton offset-5 offset-sm-1 offset-md-2 offset-lg-3 offset-xl-5 col-7 col-sm-5 col-md-4 col-lg-3 col-xl-2">
                      <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#createWord">Add a new word</button>
                    </div>
                    


                    <!-- Create modal -->
                    <div class="modal fade" id="createWord" tabindex="-1" aria-labelledby="createWordLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="createWordLabel">Add a new word</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                          <form method="post" action="{{ route('words.add') }}" autocomplete="off">

                            @csrf

                            <div class="mb-3">
                              <label class="form-label" for="createEnglish">English:</label>
                              <input type="text" class="form-control" name="english" id="createEnglish" placeholder="This field must be filled." required>
                            </div>
                            <div class="mb-3">
                              <label class="form-label" for="createFrench">French:</label>
                              <input type="text" class="form-control" name="french" id="createFrench" placeholder="This field must be filled." required>
                            </div>
                            <div class="mb-3">
                              <label class="form-label" for="createKorean">Korean:</label>
                              <input type="text" class="form-control" name="korean" id="createKorean" placeholder="This field must be filled." required>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Category:</label>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="category" id="createNoun" value="noun" checked required>
                                <label class="form-check-label" for="createNoun">
                                  Noun
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="category" id="createVerb" value="verb" required>
                                <label class="form-check-label" for="createVerb">
                                  Verb
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="category" id="createAdjective" value="adjective" required>
                                <label class="form-check-label" for="createAdjective">
                                  Adjective
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="category" id="createAdverb" value="adverb" required>
                                <label class="form-check-label" for="createAdverb">
                                  Adverb
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="category" id="createOther" value="other" required>
                                <label class="form-check-label" for="createOther">
                                  Other
                                </label>
                              </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Add this word</button>
                          </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  @if(session()->has("success"))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <i class="fa-solid fa-circle-check"></i>&nbsp;
                      <b>Success:</b> 
                      {{ session()->get("success") }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  @endif
                    
                  @if(session()->has("successUpdate"))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <i class="fa-solid fa-circle-check"></i>&nbsp;
                      <b>Success:</b> 
                      {{ session()->get("successUpdate") }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  @endif

                  @if(session()->has("successDelete"))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <i class="fa-solid fa-circle-check"></i>&nbsp;
                      <b>Success:</b> 
                      {{ session()->get("successDelete") }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  @endif

                  @if ($errors->any())
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-circle-xmark"></i>&nbsp;
                    <b>Error:</b> 
                    <ul>
                      @foreach($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif
                    @if($words->isNotEmpty())
                    <div class="vocabularyResults table-responsive overflow-auto">
                      <table class="table table-striped">
                        <thead class="table-light">
                          <tr>
                            <th scope="col" class="hidden">#</th>
                            <th scope="col">English</th>
                            <th scope="col">French</th>
                            <th scope="col">Korean</th>
                            <th scope="col">Category</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Updated at</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($words as $word)
                          <tr>
                            <th class="id hidden" scope="row">{{ $word->id }}</th>
                            <td class="english">{{ $word->english }}</td>
                            <td class="french">{{ $word->french }}</td>
                            <td class="korean">{{ $word->korean }}</td>
                            @if($word->category == "noun")
                              <td class="category"><span class="badge bg-primary">{{ $word->category }}</span></td>
                            @elseif ($word->category == "verb")
                              <td class="category"><span class="badge bg-info">{{ $word->category }}</span></td>
                            @elseif ($word->category == "adjective")
                              <td class="category"><span class="badge bg-success">{{ $word->category }}</span></td>
                            @elseif ($word->category == "adverb")
                              <td class="category"><span class="badge bg-warning">{{ $word->category }}</span></td>
                            @elseif ($word->category == "other")
                              <td class="category"><span class="badge bg-secondary">{{ $word->category }}</span></td>
                            @else
                              <td class="category"><span class="badge bg-primary">{{ $word->category }}</span></td>
                            @endif
                            <td class="createdAt">{{ date("m/d/Y - H:i", strtotime($word->created_at)) }}</td>
                            <td class="updatedAt">{{ date("m/d/Y - H:i", strtotime($word->updated_at)) }}</td>
                            <td>
                              <!-- Button trigger create modal -->
                              <a class="btn btn-info edit" href="#" data-bs-toggle="modal" data-idUpdate="'$word->id'" data-bs-target="#updateWord">Update</a>

                              <a href="#" class="btn btn-danger" onclick="if(confirm('Do you really want to delete this word?')){document.getElementById('form-{{ $word->id }}').submit() }">Delete</a>
                              <form id="form-{{ $word->id }}" method="post" action="{{ route('words.delete', ['word'=>$word->id])}}">
                                @csrf
                                <input type="hidden" name="_method" value="delete">
                              </form>
                            </td>
                          </tr>
                          @endforeach
                          </tbody>
                        </table>
                      </div>
                      @else
                      <div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
                        <i class="fa-solid fa-triangle-exclamation"></i>&nbsp;
                        <b>Warning:</b> 
                          @php
                            $categoryArray = [];
                          @endphp
                        @if(app('request')->input('getNounsCheckbox'))
                          @php
                            array_push($categoryArray, "nouns");
                          @endphp
                        @endif
                        @if(app('request')->input('getVerbsCheckbox'))
                          @php
                            array_push($categoryArray, "verbs");
                          @endphp
                        @endif
                        @if(app('request')->input('getAdjectivesCheckbox'))
                          @php
                            array_push($categoryArray, "adjectives");
                          @endphp
                        @endif
                        @if(app('request')->input('getAdverbsCheckbox'))
                          @php
                            array_push($categoryArray, "adverbs");
                          @endphp
                        @endif
                        @if(app('request')->input('getOthersCheckbox'))
                          @php
                            array_push($categoryArray, "others");
                          @endphp
                        @endif
                        @if (!empty($categoryArray))
                          No words found in database for categories: {{ implode(', ', $categoryArray);  }}.
                        @elseif(app('request')->input('search'))
                          No words found in database for the input: "{{ app('request')->input('search') }}".
                        @else
                          No words found in database, please add at least one in the "Vocabulary List" page.
                        @endif
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                      @endif
                  {{ $words->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Update modal -->
  <div class="modal fade" id="updateWord" tabindex="-1" aria-labelledby="updateWordLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createWordLabel">Update</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form method="post" action="{{route('words.update')}}" autocomplete="off">

          @csrf

          <input type ="text"hidden class="col-sm-9 form-control" id="id" name="id" value="" />
          <div class="mb-3">
            <label class="form-label" for="updateEnglish">English:</label>
            <input type="text" class="form-control" id="updateEnglish" name="english" placeholder="This field must be filled." required>
          </div>
          <div class="mb-3">
            <label class="form-label" for="updateFrench">French:</label>
            <input type="text" class="form-control" id="updateFrench" name="french" placeholder="This field must be filled." required>
          </div>
          <div class="mb-3">
            <label class="form-label" for="updateKorean">Korean:</label>
            <input type="text" class="form-control" id="updateKorean" name="korean" placeholder="This field must be filled." required>
          </div>
          <div class="mb-3">
            <label class="form-label">Category:</label>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="category" id="updateNoun" value="noun" required>
                <label class="form-check-label" for="updateNoun">Noun</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="category" id="updateVerb" value="verb" required>
                <label class="form-check-label" for="updateVerb">Verb</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="category" id="updateAdjective" value="adjective" required>
                <label class="form-check-label" for="updateAdjective">Adjective</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="category" id="updateAdverb" value="adverb" required>
                <label class="form-check-label" for="updateAdverb">Adverb</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="category" id="updateOther" value="other" required>
                <label class="form-check-label" for="updateOther">Other</label>
              </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Update this word</button>
          </form>
          </div>
        </div>
    </div>



@endsection