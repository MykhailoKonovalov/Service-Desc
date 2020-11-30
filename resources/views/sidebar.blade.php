<nav class="navbar navbar-expand-lg navbar-light bg-dark text-center text-light">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown  text-light">
                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Фільтрація
                </a>
                <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                    <a class="nav-link text-light" href="{{Request()->fullUrlWithQuery(['filter' => 1])}}">
                        Веб-сайт</a>
                    <a class="nav-link text-light" href="{{Request()->fullUrlWithQuery(['filter' => 2])}}">
                        iOS</a>
                    <a class="nav-link text-light" href="{{Request()->fullUrlWithQuery(['filter' => 3])}}">
                        Android</a>
                    <a class="nav-link text-light" href="{{Request()->fullUrlWithQuery(['filter' => 4])}}">
                        Стан автомобіля</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle  text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Сортування
                </a>
                <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                    <a class="nav-link text-light" href="{{Request()->fullUrlWithQuery(['order' => 'theme'])}}">
                        За алфавітом</a>
                    <a class="nav-link text-light" href="{{Request()->fullUrlWithQuery(['order' => 'detection_date'])}}">
                        По даті виникнення</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle  text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    За статусом
                </a>
                <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                    <a class="nav-link text-light" href="{{Request()->fullUrlWithQuery(['status' => 1])}}">
                        Нові</a>
                    <a class="nav-link text-light" href="{{Request()->fullUrlWithQuery(['status' => 2])}}">
                        Відправлені експертам</a>
                    <a class="nav-link text-light" href="{{Request()->fullUrlWithQuery(['status' => 3])}}">
                        Вирішені</a>
                </div>
            </li>
            <div class="row col-12">
                <a class="nav-link text-light" href="{{Request()->fullUrlWithQuery(['keyword' => 'asc'])}}">
                    З початку</a>
                <a class="nav-link text-light" href="{{Request()->fullUrlWithQuery(['keyword' => 'desc'])}}">З кінця</a>

                <a class="nav-link text-light" href="/problems">Скинути всі фільтри</a>
            </div>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="/problems">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" name="query" aria-label="Search">
            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
