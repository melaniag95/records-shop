<nav class="navbar navbar-expand-lg navbar-light bg-warning myNav">
        <div class="container-fluid">
            <img src="https://www.pngrepo.com/png/144854/512/vinyl-record.png" alt="logo-store" id="logo-img" class="navbar-brand">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item hvr-underline-from-center mx-4">
                        <a class="nav-link text-dark" href="/">Home</a>
                    </li>
                    <li class="nav-item hvr-underline-from-center mx-4">
                        <a class="nav-link text-dark" href="/records">Catalogo</a>
                    </li>

                    <li class="nav-item hvr-icon-hang mx-4 dropdown">
                        <a class="nav-link text-dark" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" href="">
                        Categorie
                            <svg class="icon_cat" xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </a>
                        <ul class="myMenu dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuLink">
                            <?php $genres = DB::table('genres')->get(); ?>
                            @foreach($genres as $genre)
                            <li><a class="dropdown-item" href="{{url('genre', $genre->id)}}">{{$genre->name}}</a></li> 
                            @endforeach         
                        </ul>
                    </li>
                </ul>

                <div class="hvr-icon-shrink mx-3">
                    <a href="/cart" class="btn btn-primary d-flex align-items-stretch">
                        <svg class="hvr-icon" xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                      </svg>
                      <span class="mx-2">Carrello</span>
                    </a>
                </div>

                <div class="mx-3">
                    <a href="{{url('/admin')}}" class="btn btn-light">Area riservata</a>
                </div>
            </div>
        </div>
</nav>