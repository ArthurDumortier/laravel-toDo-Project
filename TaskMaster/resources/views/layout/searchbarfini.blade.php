<form action="{{ url("SearchTacheFini",$id) }}">
    <div class="input-group">
        <input type="search" name="searchText" class="form-control" value="{{ request()->searchText ?? '' }}" placeholder="Rechercher une tâche fini">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit">Rechercher</button>
        </span>
    </div>
</form>