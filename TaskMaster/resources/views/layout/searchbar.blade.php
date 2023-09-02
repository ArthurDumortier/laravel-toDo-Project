<form action="{{ url("SearchTache",$id) }}">
    <div class="input-group">
        <input type="search" name="searchText" class="form-control" value="{{ request()->searchText ?? '' }}" placeholder="Rechercher une tâche">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit">Go!</button>
        </span>
    </div>
</form>