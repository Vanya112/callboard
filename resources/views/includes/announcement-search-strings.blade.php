<div class="row">

    <div class="col-md-12">

        <form method="get" action="{{ route('searchAnnouncements') }}">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <p>
                        <input type="text" class="form-control" id="searchName" name="searchName" placeholder="SearchByName">
                    </p>
                    <p>
                        <input type="text" class="form-control" id="searchTitle" name="searchTitle" placeholder="SearchByTitle">
                    </p>
                    <p>
                        <input type="text" class="form-control" id="searchPhone" name="searchPhone" placeholder="SearchByPhone">
                    </p>
                    <p style="max-width: 150px;">
                        <button type="submit" class="btn btn-primary btn-block">Search</button>
                    </p>
                </div>
            </div>

        </form>

    </div>

</div>
